<div style="position: absolute;margin-top: -29px;right: 0;"><img src="<?php echo base_url();?>assets/images/pop_up_close.png" class="popupClose"></div>
<div class="video_banner"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $video_details->video_youtube_id; ?>?showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe></div>
   
              <div class="title_holder" style="margin:20px 20px;">
                <div class="title"><?php echo strtoupper($video_details->video_title);?></div>
                
                <div class="pop_social_media_holder">
                    <ul>
                        <li><a href="<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>?typ=fb"><img src="<?php echo base_url();?>assets/img/facebook_icon.png"></a></li>
                        <li><a href="<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>?typ=tw"><img src="<?php echo base_url();?>assets/img/twitter_icon.png"></a></li>
                        <li><a href="<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>?typ=em"><img src="<?php echo base_url();?>assets/img/email_icon.png"></a></li>
                        
                        <div class="clear"></div>
                    </ul>
                </div>
                
                <div class="clear"></div>
              </div>
              
              <div class="video_popus_content_holder">
                 <?php if($video_details->scripture_text!=''){?>
                  <a target="_blank" href="https://www.bible.com/bible/59/jhn.1.esv"><div class="scripture_holder">
                      <?php 
                      
                      $bookvals = "";
                        if($video_details->book_name!='' && $video_details->chapter!='' && $video_details->verse!='' )
                            {
                                $bookvals = $video_details->book_name." ".$video_details->chapter." : ".$video_details->verse." -  ";
                            }
                        echo $bookvals.$video_details->scripture_text;
                      
                      ?></div></a>
                  <?php }?>

                   <?php 
        $topic_count = count($topics_array);
       
        $conent = '';
        for($i=0;$i<$topic_count;$i++){
            
            $conent1 ='<span><a href="'. $topics_array[$i]['key'].'" target="_blank" >'. $topics_array[$i]['value'].'</a></span>';
            if(($topic_count != 1) && ($i != ($topic_count-1))){
               
                $conent .=$conent1.',';
           }
           
           elseif(($i == ($topic_count-1))&&($topic_count>1) )
               
           { 
               $conent = rtrim( $conent,',');
               $conent .=' and '.$conent1;
           }
           else 
           {
                $conent .= $conent1;
            }
       

         }?>


                <?php if($conent!=''){?>
    <div class="familer_tags"><?php echo lang('topic_content');?><?php echo strtolower($conent);?>.</div>
    <?php } ?>
                <div class="knowmore_holder">
                    <ul>
                        <li><a href="<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>"><img src="<?php echo base_url();?>assets/img/see_more.png"></a></li>
                        
                        <div class="clear"></div>
                    </ul>
                </div>
              </div>


