<?php echo $header;?>

<?php echo $menu;
$title = lang('txt_edit');   
?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('edit_hashtag');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li ><a href="<?=site_url('hashtag/index');?>"><?=lang('hashtag_list');?></a></li>
                                         <li class="active"><?=lang('txt_edit');?></li>
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
					<!-- BEGIN BASIC ELEMENTS -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title"><?php echo ucfirst($title);?></span>
								
							</div>
							<div class="grid-body">
                                                                  <form class="form-horizontal" role="form" action="<?php echo base_url();?>hashtag/add/<?php echo $id;?>" method="POST"  >

                                                                    
                                                                                                                                     
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('hashtag_name');?></label>
										<div class="col-sm-7">
                                                                                    <input type="text" class="form-control" id="hashtag_name" name="hashtag_name" placeholder="Hashtag Name" value="<?php echo isset($hashtag_name) ? $hashtag_name : set_value("hashtag_name") ?>">
                                                                                    <span style="color:red"> <?php echo form_error('hashtag_name'); ?></span>
                                                                                    <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
											
										</div>
									</div>
                                                                     
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-10">
                                                                                    <div class="btn-toolbar"
											<div class="btn-group">
                                                                                             <input type="submit" name="submit" value="<?php echo lang('save');?>" class="btn btn-primary" />
												
												 <a href="<?php echo site_url("hashtag"); ?>"><button style="margin-left: 10px;"type="button" class="btn  btn-warning"><?php echo lang('cancel');?></button></a>
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