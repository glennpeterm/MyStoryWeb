<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class for managing Inbox
class Inbox extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');        
        $this->lang->load('common');
        $this->lang->load('inbox');
        $this->lang->load('email');
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->library( 'email' );
        $this->load->model('M_Inbox', '', TRUE);
        $this->userid    = $this->session->userdata('kms_ad_id');
        $this->user_role = $this->session->userdata('kms_ad_role');      
        $this->language  = $this->config->item('language');
             

    }
    //     Inbox listing  action       
    public function index()
    {
        $data = array();
        
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        $data['inbox_mails']= $this->M_Inbox->getAllMessages($this->language,$this->user_role);
        $this->load->view('inbox/v_inbox',$data);
    }
     //     End of Inbox listing  action    
    
    
    //    Inbox delete  action      
    public function delete($id)
    {
        
        $id= $this->M_Inbox->deleteMails($id);
        $this->session->set_flashdata('message', lang('deltn_sucs_msg'));
        
        redirect('inbox/index');
        
    }
    //  End of Inbox delete  action       
    
    //     Ajax function for Inbox read  action  and changing the mail status as read 
    public function mailboxread()
    {
        $inboxid = $_POST['id'];
        $status  = 1;
        $this->M_Inbox->updateMessageStatus($inboxid , $status); 
        echo $unreadmail = $this->M_Inbox->countAllUnreadMessages();
        
    }    
    //    End of  Ajax function for Inbox read  action  and changing the mail status as read 
    
   public function index_old($page=0,$searchitem=NULL)
   {  
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        $userid   = $this->userid ;
        $user_role = $this->user_role;       
        $data['unreadmails_count']= $this->M_Inbox->countAllUnreadMessages($this->language,$this->user_role);
        $searchdata=''; 
        if(isset($_POST['searchitem']))
        {
           $searchdata= $_POST['searchitem'];           
        }
        else 
        {
           $searchdata=  $searchitem;
        }    
        if($searchdata!='')
        {
            $search_item=$searchdata;       
        }
        else
        {
            $search_item="";
        }
        $data['search_item']=$search_item;
        $count=count($this->uri->segment_array());
      
        if($count==4)
        {
          $secondLastKey = count($this->uri->segment_array())-1;
          $search_item=$this->uri->segment($secondLastKey);
          $search_item= urldecode ( $search_item );
          $page_1=$this->uri->segment($count);
          $data['search_item']=$search_item;
          if(is_numeric($page_1))
          {
              $page=$this->uri->segment($count);
          }
        else 
          {
             redirect(''); 
          }
        }
        if($count==3)
        {
            $LastKey = count($this->uri->segment_array());
            $LastKey_item=$this->uri->segment($LastKey);
            if(is_numeric($LastKey_item))
            {          

            }
            else
            {   
              $search_item= urldecode ($LastKey_item);
              $data['search_item']=$search_item;
            }          
        }
        
        
      
        $config = array();        
        $data['inbox_mails']= $this->M_Inbox->getAllMessages(4,$page,$search_item,$this->language,$user_role);
        $config['total_rows'] = $this->M_Inbox->countAllMessages($search_item,$this->language,$user_role);
          
        if($search_item!='')
        {
           $config['base_url'] = base_url() . 'inbox/index/'.$search_item.'/'; 
        }
        else 
         {
            $config['base_url'] = base_url() . 'inbox/index/';

        }
        $config["per_page"] = 4; 
        
        if($count==4)
        {
            $config['uri_segment'] = 4;
        }
        else
            {
          $config["uri_segment"] = 3;
        }
       
        
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

       
        $this->pagination->initialize($config);
        $data['search_item']=$search_item; 
        
        $output='';
        if(isset($_POST['searchitem']))
        {
            $page_links = $this->pagination->create_links($config);
            $output.='<table class="table">';

                          if(count($data['inbox_mails']) < 1){
                      $output.='<tr><td style="text-align:center;" colspan="2">No Results</td></tr>';
                  }
                  else{
                          foreach ($data['inbox_mails'] as $mailbox)
                           { 
                              
                              if($mailbox->status==1)
                                {
                                  $style='class="read"';
                                }
                                else 
                                {
                                 $style='class=""';
                                }

                            $output.='<tr'.$style.'><td class="action"><input type="checkbox" class="icheck" /></td><td class="name"><a href="#">'.$mailbox->inbox_name.'</a></td><td class="subject"><a href="#">'.$mailbox->inbox_message.'</a></td><td class="time">'.$mailbox->added_date.'</td><td><a href="'.base_url().'inbox/view/'.$mailbox->inbox_id.'"><input type="button" class="btn btn-primary" value="View"></a></td></tr>';
                          }
                          if($page_links != ''){
                          $output.='<tr><td colspan="7" style="text-align:center">'.$page_links.'</td></tr>';
                          }

                          $output.='</table>';
                    }

            echo $output; 
           }
           else
        { 
	$this->load->view('inbox/v_inbox',$data);
        }
   }
    
}
