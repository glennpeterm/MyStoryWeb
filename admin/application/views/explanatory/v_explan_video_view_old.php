<?php echo $header;?>

<?php echo $menu;?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('explnatory_videos_view');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                         <li ><a href="<?=site_url('explanatory_video/index');?>"><?=lang('explanatory_video_list');?></a></li>
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
								<span class="grid-title"><?php echo lang('view');
                                                                
                                                                
                                                                ?></span>
								
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
                                                                   
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_title');?></label>
										<div class="col-sm-7">
											<?php echo $video_details->exvideo_title;?>
										</div>
									</div>
                                                                     <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('desc');?></label>
										<div class="col-sm-7">
											<?php echo $video_details->exvideo_desc;?>
										</div>
									</div>
                                                                    
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('embed_youtube_video');?></label>
										<div class="col-sm-7">
											<?php echo html_entity_decode($video_details->exvideo_embed);?>
										</div>
									</div>
                                                                    <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('txt_status');?></label>
										<div class="col-sm-7">
											<?php if($video_details->exvideo_status==1) 
                                                                                        {
                                                                                            $status= 'Active';
                                                                                        }
                                                                                        else {
                                                                                             $status= 'In Active';
                                                                                        }
                                                                                            ?>
											<?php echo $status;?>
										</div>
									</div>
                                                                    
                                                                      <div class="form-group">
                                                                        <div class="col-sm-offset-4 col-sm-10">
                                                                            <div class="btn-toolbar"
                                                                                <div class="btn-group">
                                                                                    <a href="<?php echo site_url("explanatory_video"); ?>"><button style="margin-left: 10px;"type="button" class="btn btn-info"><?php echo lang('back');?></button></a>

                                                                                         <a href="<?php echo base_url();?>explanatory_video/add/<?php echo $video_details->exvideo_id;?>"><button style="margin-left: 10px;"type="button" class="btn btn-success"><?php echo lang('common_edit');?></button></a>
                                                                                </div>
                                                                        </div>
                                                                        </div>
                                                                    
									
									
								</form>
							</div>
						</div>
					</div>
					<!-- END BASIC ELEMENTS -->
				</div>
<?php echo $footer;?>

   