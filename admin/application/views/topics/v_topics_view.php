<?php echo $header;?>

<?php echo $menu;?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('topics_view');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                         <li ><a href="<?=site_url('topics/index');?>"><?=lang('topics_list');?></a></li>
                                        <li class="active"><?=lang('txt_view');?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
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
										<label class="col-sm-3 control-label"><?php echo lang('topic_name');?></label>
										<div class="col-sm-7">
											<?php echo $topic_details->topic_name;?>
										</div>
									</div> 
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-10">
                                                                                    <div class="btn-toolbar"
											<div class="btn-group">
                                                                                             
												
												 <a href="<?php echo site_url("topics"); ?>"><button style="margin-left: 10px;"type="button" class="btn  btn-warning"><?php echo lang('cancel');?></button></a>
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