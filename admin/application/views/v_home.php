

<?php echo $header;?>


<?php echo $menu;?><aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->	
                        
            <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dc.css">            
			<section class="content-header">
				<i class="fa fa-home"></i>
				<span><?php echo lang('dashboard');?></span>
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
										<span class="title"><?=lang('selfies_uploaded');?></span>
										<span class="value">
                                                                                    <?php 
                                                                                    
                                                                                    echo $selfies_status['upload_count'];
                                                                                    ?>
                                                                                 </span>
                                                                                    <span class="stat1 chart">&nbsp;</span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6">
								<div class="grid widget bg-green">
									<div class="grid-body">
										<span class="title"><?=lang('selfies_published');?></span>
										<span class="value"><?php echo  $selfies_status['publish_count'];?></span>
										<span class="stat2 chart">&nbsp;</span>
									</div>
								</div>
							</div>
							
							<div class="col-lg-2 col-md-4 col-sm-6">
								<div class="grid widget bg-red">
									<div class="grid-body">
										<span class="title"><?=lang('registered_users');?></span>
										<span class="value"><?php echo $users_count;?></span>
										<span class="stat4 chart">&nbsp;</span>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
					<!-- END WIDGET -->
				</div>

				<div class="row">
					<div class="col-md-6" id="dashboard-user-chart">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-bar-chart-o"></i>
								<span class="grid-title">Number of Registered Users</span>
								
							</div>
							<div class="grid-body">
								<div id="monthly-user-move-chart" style="width:100%; height:250px;"></div>
							</div>
						</div>
					</div>
				
					<div class="col-md-6" id="dashboard-selfie-chart">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-bar-chart-o"></i>
								<span class="grid-title">Number of Selfies</span>
								
							</div>
							<div class="grid-body">
								<div id="monthly-selfie-move-chart" style="width:100%; height:250px;"></div>
							</div>
						</div>
					</div>
				</div>
				
            </section>
			<!-- END MAIN CONTENT -->
		</aside>

		<!-- END CONTENT -->
		<script>

		</script>
		<script src="<?=base_url()?>js/d3.js"></script>
		<script src="<?=base_url()?>js/crossfilter.js"></script>
		<script src="<?=base_url()?>js/dc.js"></script>
		
        <?php echo $footer;?>   
        <script>
        var data = <?php echo $userDataForGraph;?>;
        var selfieData = <?php echo $selfieDataForGraph;?>;

        </script>
        <script src="<?=base_url()?>js/home.js"></script>
        