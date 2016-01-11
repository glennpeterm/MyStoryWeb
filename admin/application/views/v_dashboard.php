

<?php echo $header;?>


<?php echo $menu;?><aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->	
                        
                        
			<section class="content-header">
				<i class="fa fa-home"></i>
				<span><?php echo lang('testimonial_videos');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li class="active"><?=lang('dashboard');?></li>                                     
			
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
					<!-- BEGIN WIDGET -->
					<div class="col-sm-12">
						<div class="row">
							<div class="col-lg-2 col-md-4 col-sm-6">
								<div class="grid widget bg-light-blue">
									<div class="grid-body">
										<span class="title">VISITS</span>
										<span class="value">18,722</span>
										<span class="stat1 chart">&nbsp;</span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6">
								<div class="grid widget bg-green">
									<div class="grid-body">
										<span class="title">CLIENTS</span>
										<span class="value">94,263</span>
										<span class="stat2 chart">&nbsp;</span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6">
								<div class="grid widget bg-purple">
									<div class="grid-body">
										<span class="title">SALES</span>
										<span class="value">5,420</span>
										<span class="stat3 chart">&nbsp;</span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6">
								<div class="grid widget bg-red">
									<div class="grid-body">
										<span class="title">PROFIT</span>
										<span class="value">$8,270</span>
										<span class="stat4 chart">&nbsp;</span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6">
								<div class="grid widget bg-orange">
									<div class="grid-body">
										<span class="title">ORDERS</span>
										<span class="value">184</span>
										<span class="stat5 chart">&nbsp;</span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6">
								<div class="grid widget bg-teal">
									<div class="grid-body">
										<span class="title">TICKETS</span>
										<span class="value">1,899</span>
										<span class="stat6 chart">&nbsp;</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END WIDGET -->
				</div>
                            </section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
             <?php echo $footer;?>   
        