<?php echo $header;?>

<?php echo $menu;

?>
		<aside class="right-side">			
                        <!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-user"></i>
				<span><?php echo lang('user_profile');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>					
					<li class="active"><?php echo lang('user_profile');?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
		
                         <?php 
                         $error=$this->session->flashdata('error');
                         if($error!=''): ?>
                            <div class="alert alert-danger">

                            <?php  echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>  
                        			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
                            
				<div class="row">
					<!-- BEGIN USER PROFILE -->
					<div class="col-md-12">
						<div class="grid profile">
							<div class="grid-header">
								
								<div class="col-xs-7">
									<h3><?php echo $userdetails[0]->first_name?></h3>
									
								</div>
								
							</div>
							<div class="grid-body">
								<ul class="nav nav-tabs">
									
									<li class="active"><a href="#timeline" data-toggle="tab"><?php echo lang('account');?></a></li>
								</ul>
								<div class="tab-content">
									<!-- BEGIN PROFILE -->
									
									<div class="tab-pane active" id="timeline">
										<p class="lead"><?php echo lang('my_account');?></p>
										<hr>
										<div class="grid-body">
								
                                                                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>user_settings/accountsettings" method="POST" enctype="multipart/form-data" >
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php echo lang('first_name');?></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="first_name" name="first_name" placeholder="<?php echo lang('first_name');?>" value="<?php echo isset($userdetails[0]->first_name) ? $userdetails[0]->first_name : set_value("first_name") ?>">
										
                                                                                 <span style="color:red"> <?php echo form_error('first_name'); ?></span>
                                                                                </div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php echo lang('last_name');?></label>
										<div class="col-sm-10">
                                                                                   <input type="text" class="form-control" id="lastname" name="last_name" placeholder="<?php echo lang('last_name');?>" value="<?php echo isset($userdetails[0]->last_name) ? $userdetails[0]->last_name : set_value("last_name") ?>">
										
                                                                                 <span style="color:red"> <?php echo form_error('last_name'); ?></span>
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-sm-2 control-label"><?php echo lang('email_add');?></label>
										<div class="col-sm-10">
                                                                                    <input type="text" class="form-control" id="email_add" name="email_add" placeholder="<?php echo lang('email_add');?>" value="<?php echo isset($userdetails[0]->email) ? $userdetails[0]->email : set_value("email_add") ?>">
										
                                                                                 <span style="color:red"> <?php echo form_error('email_add'); ?></span>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
                                                                                    <div class="btn-toolbar"
											<div class="btn-group">
                                                                                             <input type="submit" name="submit" value="Save" class="btn btn-primary" />
												
												 <a href="<?php echo site_url("home"); ?>"><button style="margin-left: 10px;"type="button" class="btn  btn-warning">Cancel</button></a>
											</div>
                                                                                </div>
									</div>
                                                                            
                                                                            </form>
									</div>
                                                                        
                                                                        
								
							</div>
									</div>
									<!-- END PROFILE -->
									
								</div>
							</div>
						</div>
					</div>
                                         </section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
<?php echo $footer;?>

