<?php
$kms_ad_role = $this->session->userdata('kms_ad_role');
?>
<!-- BEGIN SIDEBAR -->
		<aside class="left-side sidebar-offcanvas">
			<section class="sidebar">
				<div class="user-panel">
					
					<div class="pull-left info">
						<p><?php echo $this->session->userdata('kms_ad_fname');?> <strong><?php echo $this->session->userdata('kms_ad_lname');?></strong></p>
						
					</div>
				</div>
				
				<ul id= "accordion" class="sidebar-menu">
					<li class="<?php echo activate_menu('home'); ?>">
						<a href="<?=site_url('home');?>">
							<i class="fa fa-home"></i><span><?=lang('dashboard');?></span>
						</a>
					</li>
					<li class="menu" id="user-leftmenu">
						<a href="#">
							<i class="fa fa-user"></i><span><?=lang('users');?></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu">
                            <?php
                            if($kms_ad_role == 1){
                            ?>
                                <li class="<?php echo activate_menu('adminusers'); ?>" ><a href="<?=site_url('adminusers');?>"><?=lang('admin_users');?></a></li>
                            <?php
                            }
                            ?>
                            <li class="<?php echo activate_menu('users'); ?>"><a href="<?=site_url('users/index');?>"><?=lang('front_users');?></a></li>
							
						</ul>
					</li>


                    <li class="menu" id ="video-leftmenu">
						<a href="#">
							<i class="fa fa-file-movie-o (alias)"></i><span><?=lang('video_management');?></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu" id="video_sub">
							<!--<li><a href="<?=site_url('testimonial_videos');?>"><?=lang('testimonial_videos');?></a></li>-->
                            <li class="<?php echo activate_menu('scripture_videos'); ?>"><a href="<?=site_url('scripture_videos');?>"><?=lang('scripture_videos');?></a></li>	
                            <li class="<?php echo activate_menu('selfie_videos'); ?>"><a href="<?=site_url('selfie_videos');?>"><?=lang('selfie_videos');?></a></li>
                            <li class="<?php echo activate_menu('banner_videos'); ?>"><a href="<?=site_url('banner_videos');?>"><?=lang('banner_videos');?></a></li>
                            <li class="<?php echo activate_menu('featured_videos'); ?>"><a href="<?=site_url('featured_videos');?>"><?=lang('featured_videos');?></a></li>
                    </ul>
					</li>
					
                   <li class="<?php echo activate_menu('topics'); ?>">
						<a href="<?=site_url('topics');?>">
							<i class="fa fa-align-justify"></i><span><?=lang('topics');?></span>
						</a>
					</li>
                    <li class="<?php echo activate_menu('hashtag'); ?>">
						<a href="<?=site_url('hashtag');?>">
							<i class="fa fa-tags"></i><span><?=lang('hashtags');?></span>
						</a>
					</li>
                    
                     <li class="<?php echo activate_menu('inbox'); ?>">
						<a href="<?=site_url('inbox');?>">
							<i class="fa fa-envelope"></i><span><?=lang('inbox');?></span>
						</a>
					</li>                   
                                        
                   <!--  <li>
						<a href="<?=site_url('configuration');?>">
							<i class="fa fa-toggle-right (alias)"></i><span><?=lang('configuration');?></span>
						</a>
					</li> -->
                                        
                                     
                                        
				</ul>
			</section>
		</aside>
		<!-- END SIDEBAR -->
