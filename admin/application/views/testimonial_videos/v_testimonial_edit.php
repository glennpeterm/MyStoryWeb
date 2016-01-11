<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2-bootstrap.css">
<style>
    html, body, iframe {
    height: 100%;
    width: 100%;
}
body { overflow: hidden;}
    </style>
<?php echo $menu;?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('testimonial_videos_view');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                         <li ><a href="<?=site_url('testimonial_videos/index');?>"><?=lang('testimonial_video_list');?></a></li>
                                        <li class="active"><?=lang('txt_edit');?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			<?php 
                         $message=$this->session->flashdata('message');
                         if($message!=''): ?>
                            <div class="alert alert-success">

                            <?php  echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?>  
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
					<!-- BEGIN BASIC ELEMENTS -->
					
                                            <div class="col-md-12">
							<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title"><?php echo  $video_title;?></span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								
                                
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <div class="col no-padding"><span>
                                        	<div style="height:250px; background:#373737;">
                                                   <?php echo html_entity_decode($embed_code);?>
                                                </div>
                                        </span></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                        
                                        <p><strong><?php echo lang('total_likes');?></strong> <?php echo $total_likes_count;?></p>
                                        <p><strong><?php echo lang('facebook');?></strong> <?php echo $fb_likes_count;?></p>
                                        <p><strong><?php echo lang('youtube');?></strong> <?php echo $youtube_likes_count;?></p>
                                        <p><strong><?php echo lang('total_share');?></strong> 0</p>
                                        <p><strong><?php echo lang('facebook');?></strong> 0</p>
                                        <p><strong><?php echo lang('twitter');?></strong> 0</p>
                                        <p><strong><?php echo lang('email');?></strong> 0</p>
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                
							</div>
						</div>
                        
			<div class="grid-body">
							
				<section class="content">
				<div class="row">
					<!-- BEGIN BASIC ELEMENTS -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title"></span>
								
							</div>
							<div class="grid-body">
                                                                  <form class="form-horizontal" role="form" action="<?php echo base_url();?>testimonial_videos/add/<?php echo $id;?>" method="POST" onsubmit="return form_err_chk()" >

                                                                    
                                                                                                                                     
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_title');?></label>
										<div class="col-sm-7">
                                                                                    <input type="text" class="form-control" id="video_title" name="video_title" placeholder="<?php echo lang('video_title');?>" value="<?php echo isset($video_title) ? $video_title : set_value("video_title") ?>">
                                                                                    <span style="color:red"> <?php echo form_error('video_title'); ?></span>
                                                                                    <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
											
										</div>
									</div>
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_desc');?></label>
										<div class="col-sm-7">
											<textarea id="video_desc" name="video_desc" class="form-control" rows="10"><?php echo isset($video_desc) ? $video_desc : set_value("video_desc") ?></textarea>
                                                                                         <span style="color:red"> <?php echo form_error('video_desc'); ?></span>
										</div>
								   </div>
                                                                     
									<?php
									if($type=='add')
									{
									?>
                                                                            <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_id');?></label>
										<div class="col-sm-7">
                                                                        <input type="text" class="form-control" id="video_id" name="video_id" placeholder="<?php echo lang('video_id');?>">
                                                                        <span style="color:red"> <?php echo form_error('video_id'); ?></span>

											
										</div>
                                                                                 </div>
                                                                            <?php 
                                                                            }?>
                                                                        <div style="clear:both"></div>
                                                                    <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('topics');?></label>
										<div class="col-sm-7">
                                                                                   
                                                                                    <select class="form-control" name="topics[]" multiple="multiple" size="5">
                                                                                        
                                                                                      <?php foreach ($topics as $results)
                                                                                         { 
                                                                                          if(in_array($results->topic_id, $topics_array))
                                                                                           {
                                                                                               $sel= 'selected="selected"';
                                                                                            }
                                                                                            else 
                                                                                            {
                                                                                                 $sel= '';
                                                                                            }                                                                                          
                                                                                         
                                                                                          ?>
                                                                                        
                                                                                       
                                                                                        <option <?php echo $sel ;?>value="<?php echo $results->topic_id;?>"><?php echo $results->topic_name;?></option>
                                                                                        
                                                                                          <?php } ?>
                                                                                    </select>
                                                                                    
                                                                                    
                                                                                    <span style="color:red"> <?php echo form_error('topics'); ?></span>
                                                                                    
											
										</div>
                                                                   	</div>
                                                                      
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_tag');?></label>
										<div class="col-sm-7">
                                                                                    <input type="text" class="form-control" id="video_tag" name="video_tag" placeholder="<?php echo lang('video_tag');?>" value="<?php echo isset($hashtag_array) ? $hashtag_array : set_value("") ?>">
                                                                                    <span style="color:red"> <?php echo form_error('video_tag'); ?></span>
                                                                                    
											
										</div>
									</div>
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('highlight_video');?></label>
										<div class="col-sm-7">
                                                                                    <?php
                                                                                     
                                                                                     $highlight_checked = '';
                                                                                    if(isset($highlight_video) && $highlight_video == '1'){
                                                                                            $highlight_checked = ' checked="checked" ';
                                                                                          
                                                                                        }
                                                                                    ?>
											
											
										<input type="checkbox" class="icheck"  name="high_light_status" id="high_light_status" <?php echo $highlight_checked;?>> 
											
                                                                                        
                                                                                </div>
									</div>
                                                                        
                                                                         <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('banner_video');?></label>
										<div class="col-sm-7">
                                                                                    
											 <?php
                                                                                     
                                                                                     $banner_checked = '';
                                                                                    if(isset($banner_checked) && $banner_video == '1'){
                                                                                            $banner_checked = ' checked="checked" ';
                                                                                          
                                                                                        }
                                                                                    ?>
											
										<input type="checkbox" class="icheck check_banner_limit" name="banner_status" id="banner_status" <?php echo $banner_checked;?> > 
										<br>
                                                                                     <span style="color:red"> <?php echo form_error('banner_status'); ?></span>
                                                                                    <span style="color:red" id="banner_err"> </span>	           	
                                                                                        
                                                                                </div>
									</div>
                                                                      
                                                                        <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('txt_status');?></label>
										<div class="col-sm-7">
                                                                                    <?php
                                                                                     $inactive_checked = ' checked="checked" ';
                                                                                     $active_checked = '';
                                                                                    if(isset($video_status) && $video_status == '1'){
                                                                                            $active_checked = ' checked="checked" ';
                                                                                            $inactive_checked = '';
                                                                                        }
                                                                                    ?>
											<input type="radio" name="status" class="icheck" value="1" <?php echo $active_checked;?> > <?php echo lang('active');?>
											<input type="radio" name="status" class="icheck" value="0" <?php echo $inactive_checked;?> > <?php echo lang('inactive');?>
                                                                                        <span style="color:red"> <?php echo form_error('status'); ?></span>
                                                                                </div>
									</div>
                                                                     
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-10">
                                                                                    <div class="btn-toolbar"
											<div class="btn-group">
                                                                                             <input type="submit" name="submit" value="<?php echo lang('save');?>" class="btn btn-primary" />
										    <?php 
                                                                                       
                                                                                        
                                                                                        $cancel_url      = site_url("testimonial_videos");
                                                                                        $banner_page_url = site_url("banner_videos");
                                                                                        $featured_page_url= site_url("featured_videos");

                                                                                        $sessn_banner_url =  $this->session->userdata('banner_url');
                                                                                        $sessn_featured_url =  $this->session->userdata('featured_url');

                                                                                        if($sessn_banner_url==$banner_page_url)
                                                                                        {
                                                                                            $cancel_url = $banner_page_url;
                                                                                        }
                                                                                        elseif($sessn_featured_url==$featured_page_url)
                                                                                        {
                                                                                            $cancel_url = $featured_page_url;
                                                                                        }
                                                                                    ?>
												 <a href="<?php echo $cancel_url; ?>"><button style="margin-left: 10px;"type="button" class="btn  btn-warning"><?php echo lang('cancel');?></button></a>
											</div>
                                                                                </div>
										</div>
									
									
								</form>
							</div>
						</div>
					</div>
					<!-- END BASIC ELEMENTS -->
				</div>
                                         </section>
                                                    
                                                   
                            </div> 

                                                 
			</div>        
                                             
                                                    
			</div>
					<!-- END BASIC ELEMENTS -->
				
                                         </section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
     <script>
   var pageName = 'video';
   </script>

<?php echo $footer;?>
<script src="<?php echo base_url();?>assets/plugins/select2/select2.js"></script>
        <script>
            /* video tag listing */
        var res= [
            <?php foreach($hashtag as $tag){ 
             echo "\" ".$tag->hash_name."\",";
            } ?>
        ];
        //console.log(res);
         $("#video_tag").select2({ 
             tags:res,    
        tokenSeparators: [",", " "]});
        /* End of video tag listing */
        /* ICHECK */
        $('.icheck').iCheck({
             checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '10%' // optional
        });
</script>
 <script type="text/javascript">
     
                  $( document ).ready(function() {
                     var form_err_flg = false;    
         });
             
             $('.check_banner_limit').on('ifChanged', function(event) {

              var curnt_db_status = "<?php echo $banner_video;?>";
                var banner_video_err_msg = "<?php echo lang('banner_video_err_msg');?>";
               
                
            var isChecked = $('#banner_status').is(':checked');
                       
            if(curnt_db_status == 0 ){
              
              if(isChecked == true)
               {
                   
                $.ajax({
                    url: baseurl+'scripture_videos/banner_limit',
                    type: 'POST', 
                    data: 'id = 1',
                    async: true,
                    success: function(res){
                        
                        if(res>3)
                        {
                            form_err_flg = true;                     
                            $('#banner_err').html(banner_video_err_msg);
                        }
                    }
                });
            
              }
              else
              {
                  form_err_flg = false;  
                   $('#banner_err').html();
              }
            }
          });         
          
            
           function form_err_chk()
           {
              
               if(form_err_flg == false)
               {
                   return true;
               }
               else
               {
                   return false;
               }
               
           }
           
           
</script>

