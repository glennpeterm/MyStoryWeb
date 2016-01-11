<?php echo $header;?>
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
				<span><?php echo lang('selfie_videos_view');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                         <li ><a href="<?=site_url('selfie_videos/index');?>"><?=lang('selfie_video_list');?></a></li>
                                        <li class="active"><?=lang('txt_view');?></li>
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
                                                  <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>?showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe>
                                                </div>
                                        </span></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                        
                                        <p><strong><?php echo lang('youtube_likes_count');?> : </strong><?php echo $youtube_likes_count;?></p>
                                        <p><strong><?php echo lang('youtube_views_count');?> : </strong><?php echo $youtube_views_count;?></p>
                                        <p><strong><?php echo lang('twitter_share');?> : </strong><?php echo $twitter_share;?></p>

                                       <!--  <p><strong><?php echo lang('total_likes');?></strong> <?php echo $total_likes_count;?></p>
                                        <p><strong><?php echo lang('facebook');?></strong> <?php echo $fb_likes_count;?></p>
                                        <p><strong><?php echo lang('youtube');?></strong> <?php echo $youtube_likes_count;?></p>
                                        <p><strong><?php echo lang('total_share');?></strong> 0</p>
                                        <p><strong><?php echo lang('facebook');?></strong> 0</p>
                                        <p><strong><?php echo lang('twitter');?></strong> 0</p>
                                        <p><strong><?php echo lang('email');?></strong> 0</p> -->
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                
							</div>
						</div>
                        
						<div class="grid">
							
				<div class="grid-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                        
                                     
                                        <p class="col-lg-12 no-padding"><strong><?php echo lang('video_desc');?> :</strong><span> <?php echo $video_desc;?></span></p>
                                        <p class="col-lg-6 no-padding"><strong><?php echo lang('video_short_desc');?> :</strong><span><?php echo $video_short_desc;?></span></p>
                                        <p class="col-lg-6 no-padding"><strong><?php echo lang('scripture_text');?> :</strong><span> <?php echo $scripture_text;?></span></p>
                                        <p class="col-lg-6 no-padding"><strong><?php echo lang('uploaded_by');?> :</strong><span><?php echo $uploaded_by;?></span></p>
                                          <p class="col-lg-6 no-padding"><strong><?php echo lang('topics');?> :</strong><span><?php echo $topics_array;?></span></p>
                                        
                                          <p class="col-lg-6 no-padding"><strong><?php echo lang('video_tag');?>:</strong><span> <?php echo $hashtag_array;?></span></p>
                                        <p class="col-lg-6 no-padding"><strong><?php echo lang('video_id');?>:</strong><span> <?php echo $youtube_id;?></span></p>
                                        <p class="col-lg-6 no-padding"><strong><?php echo lang('country');?>:</strong><span> <?php echo $video_country;?></span></p>
                                        <p class="col-lg-6 no-padding"><strong><?php echo lang('language');?>:</strong><span> <?php echo $language;?></span></p>
                                          
                                        <p class="col-lg-6 no-padding"><strong><?php echo lang('web_status');?>:</strong><span><?php if($video_status==1) 
                                                                                        {
                                                                                            $status= 'Active';
                                                                                        }
                                                                                        else {
                                                                                             $status= 'In Active';
                                                                                        }
                                                                                            ?>
											<?php echo $status;?></span></p>
                                        <p class="col-lg-6 no-padding"><strong><?php echo lang('highlight_video');?>:</strong><span> 
                                           <?php if($highlight_video==1) 
                                                {
                                                    $highlight_status= 'Yes';
                                                }
                                                else {
                                                     $highlight_status= 'No';
                                                }
                                                    ?>
                                                <?php echo $highlight_status;?>                                   
                                            
                                            </span>
                                        </p>
                                      
                                        

                                         <p class="col-lg-6 no-padding"><strong><?php echo lang('banner_video');?>:</strong><span> 
                                           <?php if($banner_video==1) 
                                                {
                                                    $banner_status= 'Yes';
                                                }
                                                else {
                                                    $banner_status= 'No';
                                                }
                                                    ?>
                                                <?php echo $banner_status;?>                                   
                                            
                                            </span>
                                        </p>
                                        
                                        </div>
                                    </div>
                                </div>
                                     <div class="row">
                             
                                 
                                 
                                   <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="btn-toolbar">
                                                <div class="btn-group">
                                                    
                                                     <?php 
                                                                                                                                                                       
                                                        $cancel_url      = site_url("selfie_videos");
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
                                                    <a href="<?php echo $cancel_url; ?>"><button type="button" class="btn btn-info"><?php echo lang('back');?></button></a>

                                                         <a href="<?php echo base_url();?>selfie_videos/add/<?php echo $video_id;?>"><button style="margin-left: 10px;"type="button" class="btn btn-success"><?php echo lang('txt_edit');?></button></a>
                                                </div>
                                        </div>
                                        <div class="clear"></div>
                                        </div>
                                </div>       
                        
                                
			</div>
                                                    
                                                   
			</div> 

                                                
			</div>
					<!-- END BASIC ELEMENTS -->
				</div>
                                </section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
         <script>
   var pageName = 'video';
   </script>

<?php echo $footer;?>
