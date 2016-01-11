<?php echo $header;?>

<?php echo $menu;
$breadcrumb_title = lang('add');
if($id > 0){    
    $breadcrumb_title = lang('common_edit');    
}

?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('add_explnatory_video');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li ><a href="<?=site_url('explanatory_video/index');?>"><?=lang('explanatory_video_list');?></a></li>
                                         <li class="active"><?=$breadcrumb_title;?></li>
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
								<span class="grid-title"><?php echo ucfirst($breadcrumb_title);?></span>
								
							</div>
							<div class="grid-body">
                                                                  <form class="form-horizontal" role="form" action="<?php echo base_url();?>explanatory_video/add/<?php echo $id;?>" method="POST"  >

                                                                    
                                                                                                                                     
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_title');?></label>
										<div class="col-sm-7">
                                                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Video Title" value="<?php echo isset($title) ? $title : set_value("title") ?>">
										
                                                                                  <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
											
										</div>
									</div>
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('desc');?></label>
										<div class="col-sm-7">
											<textarea id="desc" name="desc" class="form-control" rows="2"><?php echo isset($desc) ? $desc : set_value("desc") ?></textarea>
                                                                                         <span style="color:red"> <?php echo form_error('desc'); ?></span>
										</div>
								   </div>
									
                                                                    <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('embed_youtube_video');?></label>
										<div class="col-sm-7">
											<textarea id="embedcode" name="embedcode" class="form-control" rows="5"><?php echo isset($embedcode) ? $embedcode : set_value("embedcode") ?></textarea>
                                                                                         <span style="color:red"> <?php echo form_error('embedcode'); ?></span>
										</div>
								   </div>
                                                                   	<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('txt_status');?></label>
										<div class="col-sm-7">
                                                                                    <?php
                                                                                     $inactive_checked = ' checked="checked" ';
                                                                                     $active_checked = '';
                                                                                    if(isset($video_status) && $video_status == '1'){
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
												
												 <a href="<?php echo site_url("explanatory_video"); ?>"><button style="margin-left: 10px;"type="button" class="btn  btn-warning"><?php echo lang('cancel');?></button></a>
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
 <script type="text/javascript">
    /* ICHECK */
    $('.icheck').iCheck({
        
        radioClass: 'iradio_square-blue',
        increaseArea: '10%' // optional
    });
</script>