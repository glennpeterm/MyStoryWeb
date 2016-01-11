<?php echo $header;?>
<?php echo $menu;?>

		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('add_explnatory_video');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li class="active"><?=lang('chanage_password');?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
                         <?php 
                         $error = $this->session->flashdata('error');
                         if($error!=''): ?>
                            <div class="alert alert-danger">

                            <?php  echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>  
                        <?php 
                         $message = $this->session->flashdata('message');
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
								<span class="grid-title"><?=lang('chanage_password');?></span>
								
							</div>
							<div class="grid-body">
                                                                  <form class="form-horizontal" role="form" action="<?php echo base_url();?>user_settings/chanagepassword" method="POST"  >

                                                                    
                                                                                                                                     
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('old_password');?></label>
										<div class="col-sm-7">
                                                                                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="<?php echo lang('old_password');?>" value="<?php echo isset($title) ? $title : set_value("old_password") ?>">
										
                                                                                   <span style="color:red"> <?php echo form_error('old_password'); ?></span>
											
										</div>
									</div>
                                                                      
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('new_password');?></label>
										<div class="col-sm-7">
                                                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="<?php echo lang('new_password');?>" value="<?php echo isset($title) ? $title : set_value("new_password") ?>">
										 <span style="color:red"> <?php echo form_error('new_password'); ?></span>										
										</div>
									</div>
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('confirm_password');?></label>
										<div class="col-sm-7">
                                                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="<?php echo lang('confirm_password');?>" value="<?php echo isset($title) ? $title : set_value("confirm_password") ?>">
										
                                                                                   <span style="color:red"> <?php echo form_error('confirm_password'); ?></span>	
										</div>
									</div>
                                                                   
                                                                     
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-10">
                                                                                    <div class="btn-toolbar"
											<div class="btn-group">
                                                                                             <input type="submit" name="submit" value="<?php echo lang('save');?>" class="btn btn-primary" />
												
												 <a href="<?php echo site_url("home"); ?>"><button style="margin-left: 10px;"type="button" class="btn  btn-warning"><?php echo lang('cancel');?></button></a>
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
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
<?php echo $footer;?>
 