<?=$header;?>
<?=$menu;?>
<?php
$title = lang('add');
if($id > 0){
    $title = lang('txt_edit');
}
$action = $this->input->post('action');
$first_name = (isset($details->first_name) && $details->first_name != '') ? $details->first_name : '';
$last_name = (isset($details->last_name) && $details->last_name != '') ? $details->last_name : '';
$email = (isset($details->email) && $details->email != '') ? $details->email : '';
if(isset($action) && ($action == 'save')){
    $first_name = set_value('first_name');
    $last_name = set_value('last_name');
    $email = set_value('email');
}
?> 
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-file-o"></i>
				<span><?=lang('admin_users');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?=lang('home');?></a></li>
                    <li><a href="<?=site_url('adminusers');?>"><?=lang('admin_users');?></a></li>
                    <li class="active"><?=$title;?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
                    <?php
                    if(isset($errorMsg) && ($errorMsg != '')){
                        echo '<div class="alert alert-danger">'.$errorMsg.'</div>';
                    }
                    ?>
					<!-- BEGIN BASIC ELEMENTS -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title"><?=$title;?></span>
							</div>
							<div class="grid-body">
								<form id="frmAdminEdit" role="form" class="form-horizontal" method="post" action="<?=site_url('adminusers/save');?>">
                                    <input type="hidden" name="language" value="<?=$this->config->item('language');?>">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="hidden"  name="action" value="save">
									<div class="form-group">
										<label class="col-sm-3 control-label"><?=lang('first_name');?></label>
										<div class="col-sm-7">
											<input type="text" placeholder="<?=lang('first_name');?>" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>">
                                            <?php
                                            if(form_error('first_name') != ''){
                                            ?>
                                                <label class="error"><?php echo form_error('first_name'); ?></label>
                                            <?php
                                            }
                                            ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><?=lang('last_name');?></label>
										<div class="col-sm-7">
											<input type="text" placeholder="<?=lang('last_name');?>" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name; ?>">
                                            <?php
                                            if(form_error('last_name') != ''){
                                            ?>
                                                <label class="error"><?php echo form_error('last_name'); ?></label>
                                            <?php
                                            }
                                            ?>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label"><?=lang('email');?></label>
										<div class="col-sm-7">
											<input type="text" placeholder="<?=lang('email');?>" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                                            <?php
                                            if(form_error('email') != ''){
                                            ?>
                                                <label class="error"><?php echo form_error('email'); ?></label>
                                            <?php
                                            }
                                            ?>
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label">&nbsp;</label>
										<div class="col-sm-7">
											<div class="btn-group">
                                                <button class="btn btn-primary" name="submit" type="submit"><?=lang('save');?></button>
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
		 <script>
   var pageName = 'user';
   </script>

<?=$footer;?>
<script>
//validation messages    
var first_name_err = '<?=lang('first_name_err');?>';
var last_name_err = '<?=lang('last_name_err');?>';
var email_err = '<?=lang('email_err');?>';
var password_err = '<?=lang('password_err');?>';
var cpassword_err = '<?=lang('cpassword_err');?>';
</script>
<script src="<?=base_url()?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?=base_url()?>assets/js/admin-validation.js"></script>
