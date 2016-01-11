<?=$header;?>
<?=$menu;?>

<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-file-o"></i>
				<span><?=lang('users');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?=lang('home');?></a></li>
                    <li><a href="<?=site_url('users');?>"><?=lang('users');?></a></li>
                    <li class="active"><?=lang('view');?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
					<!-- BEGIN USER PROFILE -->
					<div class="col-md-12">
						<div class="grid profile">
							<div class="grid-header">
								<div class="col-xs-2">
                                                                    <?php if($details->photo!= ''){?>
									<img src="<?php echo $this->config->item('front_base_url');?>uploads/<?=$details->photo;?>" class="img-circle" alt="">
                                                                    <?php } else{?>
                                                                        
                                                                       
                                                                        <img src="<?php echo site_url()?>assets/img/photo.png" class="img-circle" alt="">
                                                                    <?php } ?>
                                                                </div>
								<div class="col-xs-7">
									<h3><?=ucfirst($details->first_name).' '.ucfirst($details->last_name);?></h3>
									<p><?=$details->email;?></p>
								</div>
							</div>
							<div class="grid-body">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
									
								</ul>
								<div class="tab-content">
									<!-- BEGIN PROFILE -->
									<div class="tab-pane active" id="profile">
										<p class="lead">Profile</p>
										<hr>
										<div class="row">
											<div class="col-md-6">
												<p><strong><?php echo lang('email')?>:</strong> <a href="mailto:<?=$details->email;?>"><?=$details->email;?></a></p>
												<p><strong><?php echo lang('date_of_join')?>:</strong> <?=$details->date_created;?></p>
											</div>
											<div class="col-md-6">
												<p><strong><?php echo lang('address')?>:</strong> <?=$details->address;?></p>
												<p><strong><?php echo lang('phone')?>:</strong> <?=$details->phone;?></p>
											</div>
                                                                                    <div class="col-md-6">
												<p><strong><?php echo lang('gender')?>:</strong> <?=$details->gender;?></p>
                                                                                                <p><strong><?php echo lang('dob')?>:</strong>
                                                                                                 <?php 
                                                                                                                                                                                               
                                                                                                 if($details->dob != '0000-00-00')
                                                                                                        {                                                                                                            
                                                                                                           $dob = date("d-m-Y", strtotime($details->dob));
                                                                                                        }
                                                                                                        else 
                                                                                                        {
                                                                                                            $dob = '';
                                                                                                        }  
                                                                                                        echo $dob;
                                                                                                         ?>
                                                                                                </p>
											</div>
											
                                                                                    
                                                                                    <div class="col-md-6">
												<p><strong><?php echo lang('country')?>:</strong> <?=$details->country;?></p>
												<p><strong><?php echo lang('state')?>:</strong> <?=$details->state;?></p>
											</div>
											<div class="col-md-6">
												<p><strong><?php echo lang('city')?>:</strong> <?=$details->city;?></p>
												<p><strong><?php echo lang('zipcode')?>:</strong> <?=$details->zipcode;?></p>
											</div>
                                                                                    </div>
                                                                                    
										</div>
										
									</div>
									<!-- END PROFILE -->
									
									
									
								</div>
							</div>
						</div>
					</div>
					<!-- END USER PROFILE -->
				</div>
			</section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
				 <script>
   var pageName = 'user';
   </script>
<?=$footer;?>
