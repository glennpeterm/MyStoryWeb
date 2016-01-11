<?php echo $header;?>

<?php echo $menu;
$title = lang('add');


?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('add_config');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li class="active"><?=$title;?></li>
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
				<!-- BEGIN BASIC ELEMENTS -->
				<div class="col-md-12">
					<div class="grid">
						<div class="grid-header">
							<i class="fa fa-align-left"></i>
							<span class="grid-title"><?php echo ucfirst($title);?></span>

						</div>
						<div class="grid-body">
							<form class="form-horizontal" role="form" action="<?php echo base_url();?>configuration/index" method="POST"  >


							

							<div class="form-group">
								<label class="col-sm-3 control-label"><?php echo lang('youtubeClientId');?></label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="youtubeClientId" name="youtubeClientId" value="<?php echo isset($youtubeClientId) ? $youtubeClientId : set_value("youtubeClientId") ?>">
									<span style="color:red"> <?php echo form_error('youtubeClientId'); ?></span>
										</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"><?php echo lang('youtubeClientSecret');?></label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="youtubeClientSecret" name="youtubeClientSecret" value="<?php echo isset($youtubeClientSecret) ? $youtubeClientSecret : set_value("youtubeClientSecret") ?>">
									<span style="color:red"> <?php echo form_error('youtubeClientSecret'); ?></span>
									
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"><?php echo lang('youtubeRefreshToken');?></label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="youtubeRefreshToken" name="youtubeRefreshToken" value="<?php echo isset($youtubeRefreshToken) ? $youtubeRefreshToken : set_value("youtubeRefreshToken") ?>">
									<span style="color:red"> <?php echo form_error('youtubeRefreshToken'); ?></span>
									
								</div>
								<a onclick='return popitup("<?php echo base_url();?>getRefreshToken")'>Get New Refresh Token</a>
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
		   <script>
    function popitup(url) {
    newwindow=window.open(url,'name','height=500,width=650');
    if (window.focus) {newwindow.focus()}
    return false;
}
    </script>
		<!-- END CONTENT -->
<?php echo $footer;?>