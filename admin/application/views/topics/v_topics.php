<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2-bootstrap.css">
<?php echo $menu;
$title = lang('add');
if($id > 0){    
    $title = lang('txt_edit');    
}

?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('add_topics');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li ><a href="<?=site_url('topics/index');?>"><?=lang('topics_list');?></a></li>
                                         <li class="active"><?=$title;?></li>
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
                                                                  <form class="form-horizontal" role="form" action="<?php echo base_url();?>topics/add/<?php echo $id;?>" method="POST"  >

                                                                    
                                                                                                                                     
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('topic_name');?></label>
										<div class="col-sm-7">
                                                                                    <input type="text" class="form-control" id="topic_name" name="topic_name" placeholder="<?php echo lang('topic_name');?>" value="<?php echo isset($topic_name) ? $topic_name : set_value("topic_name") ?>">
                                                                                    <span style="color:red"> <?php echo form_error('topic_name'); ?></span>
                                                                                    <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
											
										</div>
									</div>
                                                                     <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('topic_title');?></label>
										<div class="col-sm-7">
                                                                                    <input type="text" class="form-control" id="topic_title" name="topic_title" placeholder="<?php echo lang('topic_title');?>" value="<?php echo isset($topic_title) ? $topic_title : set_value("topic_title") ?>">
                                                                                    <span style="color:red"> <?php echo form_error('topic_title'); ?></span>                                                                                   										
										</div>
									</div>
						
                                    <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('topic_link');?></label>
										<div class="col-sm-7">
											<div class="input-group">
												<span class="input-group-addon">http://</span>
												<input type="text" class="form-control" id="topic_link" name="topic_link" value="<?php echo isset($topic_link) ? $topic_link : set_value("topic_link") ?>">
												
											</div>
											<span style="color:red"> <?php echo form_error('topic_link'); ?></span>
                                            <!-- <input type="text" class="form-control" id="topic_link" name="topic_link" value="<?php echo $topic_link; ?>"> -->
                                            
                                        </div>
									</div>
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('txt_status');?></label>
										<div class="col-sm-7">
                                                                                    <?php
                                                                                     $inactive_checked = ' checked="checked" ';
                                                                                     $active_checked = '';
                                                                                    if(isset($topic_status) && $topic_status == 'active'){
                                                                                            $active_checked = ' checked="checked" ';
                                                                                            $inactive_checked = '';
                                                                                        }
                                                                                    ?>
											<input type="radio" name="status" class="icheck" value="1" <?php echo $active_checked;?> > <?php echo lang('active');?>
											<input type="radio" name="status" class="icheck" value="0" <?php echo $inactive_checked;?> > <?php echo lang('inactive');?>
                                                                                        <span style="color:red"> <?php echo form_error('status'); ?></span>
                                                                                </div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-10">
                                                                                    <div class="btn-toolbar"
											<div class="btn-group">
                                                                                             <input type="submit" name="submit" value="<?php echo lang('save');?>" class="btn btn-primary" />
												
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
<script src="<?php echo base_url();?>assets/plugins/select2/select2.js"></script>
        <script>
           
            
            /* ICHECK */
            $('.icheck').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '10%' // optional
            });
</script>