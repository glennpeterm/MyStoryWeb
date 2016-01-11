<?php
Class M_Explanatory_Video extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'explanatory_video';
    }
   
            
    function saveDetails($datas)
    {
        $insert_data = array(
                                          
                    'exvideo_title'        => $datas['title'],
                    'exvideo_desc'         => $datas['desc'],
                    'exvideo_embed'        => $datas['embedcode'],
                    'exvideo_language'     => $datas['language'],
                    'exvideo_status'     => $datas['video_status'],
                           );
        if($datas['id'])
            {
                $this->db->where('exvideo_id',$datas['id']);
                $this->db->update($this->table, $insert_data);
                $lastid= $datas['id'];
            }
          else 
           {  
            $this->db->insert($this->table, $insert_data);
            $lastid = $this->db->insert_id();        
          }
        
        
        if($lastid != '')
        {
            return $lastid;
        }
        else
        {
            return false;
        }
    }
    function getAllVideos($language,$role)
    {
        $this->db->select('explanatory_video.*');
        $this->db->from($this->table);
        
        if($role!=1)
        {
            $this->db->where('exvideo_language', $language);
        }     
        $this->db->order_by('explanatory_video.exvideo_added_date', 'desc');
        $result = $this->db->get();
        /*if($_POST['searchitem']){
        echo $str = $this->db->last_query();exit;}*/
        $searchresult = $result->result();
        return $searchresult;
    }
    
    function deleteVideos($id)
    {
        $this->db->where('exvideo_id', $id)->delete($this->table);
        return $id;
    }
    
    function getVideoDetails($id)
    {
        $result = $this->db->get_where($this->table, array('exvideo_id'=>$id));
        return $result->row();
    }
    
    public function setStatus()
    {                
       $upDdata = array();
       $upDdata['exvideo_status'] = $this->input->post('status'); 
       $this->db->update('explanatory_video', $upDdata, array('exvideo_id' => $this->input->post('id')));      
       return true;
    }
    
}   
