<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>My Story</title>
	
	<link rel="icon" href="<?php echo base_url();?>assets/img/splash_screen_logo.ico">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<!-- BEGIN CSS FRAMEWORK -->
	<link rel="stylesheet" href="<?=site_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=site_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">
	<!-- END CSS FRAMEWORK -->
	
	<!-- BEGIN CSS PLUGIN -->
	<link rel="stylesheet" href="<?=site_url();?>assets/plugins/pace/pace-theme-minimal.css">
	<!-- END CSS PLUGIN -->
	
	<!-- BEGIN CSS TEMPLATE -->
	<link rel="stylesheet" href="<?=site_url();?>assets/css/main.css">
	<!-- END CSS TEMPLATE -->
</head>

<body class="login">
	<div class="outer">
		<div class="middle">
			<div class="inner">
				<div class="row">
					<!-- BEGIN LOGIN BOX -->
                                          <?php if($this->session->flashdata('message')): ?>
                                                    <div class="alert alert-success">

                                                    <?php echo $this->session->flashdata('message'); ?>
                                                    </div>
                                                    <?php endif; ?>
                                         <?php if ($this->session->flashdata('error')): ?>
                                                    <div class="alert alert-danger">

                                                    <?php echo $this->session->flashdata('error'); ?>
                                                    </div>
                                                    <?php endif; ?>
                    <?php
                    if(isset($errorMsg) && ($errorMsg != '')){
                        echo '<div class="alert alert-danger">'.$errorMsg.'</div>';
                    }
                    ?>
					<div class="col-lg-12">
						<h3 class="text-center login-title"><?=lang('login');?></h3>
						<div class="account-wall">
							<!-- BEGIN PROFILE IMAGE -->
							<img class="profile-img" src="<?=site_url();?>assets/img/admin_photo.png" alt="">
							<!-- END PROFILE IMAGE -->
							<!-- BEGIN LOGIN FORM -->
							<form name="frmLogin" name="frmLogin" method="post" action="<?=site_url('login/dologin');?>" class="form-login">
                                <input type="hidden" name="login" value="login">
								<input type="text" id="email" name="email" class="form-control" placeholder="<?=lang('email');?>" autofocus>
								<input type="password" id="password" name="password" class="form-control" placeholder="<?=lang('password');?>">
								<button class="btn btn-lg btn-primary btn-block" type="submit" onClick="return validate();"><?=lang('login');?></button>
								<label class="checkbox pull-left">
								</label>
								<a href="<?php echo base_url();?>login/forgotpassword/" class="pull-right need-help"><?=lang('forgot_password');?></a><span class="clearfix"></span>
							</form>
							<!-- END LOGIN FORM -->
						</div>
					</div>
					<!-- END LOGIN BOX -->
				</div>
			</div>
		</div>
	</div>

	<!-- BEGIN JS FRAMEWORK -->
	<script src="<?=site_url();?>assets/plugins/jquery-2.1.0.min.js"></script>
	<script src="<?=site_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- END JS FRAMEWORK -->
	
	<!-- BEGIN JS PLUGIN -->
	<script src="<?=site_url();?>assets/plugins/pace/pace.min.js"></script>
	<!-- END JS PLUGIN -->
</body>
</html>
<script>
function validate(){
    var error_flag = false;
    if($('#email').val() == ''){
        if($('#email_err_message').length == 0){
            $('#email').after('<span class="error" id="email_err_message"><?=lang('enter_email');?></span><br/>');
        }else{
            $('#email_err_message').html('<?=lang('enter_email');?>');
        }
        error_flag = true;
    }else if($('#email').val() != '' && (!(checkEmail($('#email').val())))  ){
        
        if($('#email_err_message').length == 0){
            $('#email').after('<span class="error" id="email_err_message"><?=lang('js_valid_email');?></span><br/>');
        }else{
            $('#email_err_message').html('<?=lang('js_valid_email');?>');
        }
        error_flag = true;
    }else{
        $('#email_err_message').remove();
    }
    
    if($('#password').val() == ''){
        if($('#password_err_message').length == 0){
            $('#password').after('<span class="error" id="password_err_message"><?=lang('enter_password');?></span><br/>');
        }else{
            $('#password_err_message').html('<?=lang('enter_password');?>');
        }
        error_flag = true;
    }else{
        $('#password_err_message').remove();
    }
    
    if(error_flag){
        return false;
    }else{
        $('#frmLogin').submit();
        return true;
    }
}
    
    
</script>
<script src="<?php echo base_url();?>js/common.js"></script>
