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
	
		<title>Know My Story</title>
	
	<link rel="icon" href="<?php echo base_url();?>assets/img/favicon.ico">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<!-- BEGIN CSS FRAMEWORK -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
	
	<!-- END CSS FRAMEWORK -->
	
	<!-- BEGIN CSS PLUGIN -->

	<!-- END CSS PLUGIN -->
	
	<!-- BEGIN CSS TEMPLATE -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
	<!-- END CSS TEMPLATE -->
</head>

<body class="login">
	<div class="outer">
		<div class="middle">
			<div class="inner">
				<div class="row">
					<!-- BEGIN BOX REGISTER -->
					<div class="col-lg-12">
						<h3 class="text-center login-title"><?php echo lang('reset_pwd');?></h3>
						<div class="account-wall">
                                                    <?php if ($this->session->flashdata('error')): ?>
                                                    <div class="alert alert-danger">

                                                    <?php echo $this->session->flashdata('error'); ?>
                                                    </div>
                                                    <?php endif; ?>


                                                    <?php if($this->session->flashdata('message')): ?>
                                                    <div class="alert alert-success">

                                                    <?php echo $this->session->flashdata('message'); ?>
                                                    </div>
                                                    <?php endif; ?>
							
							<!-- BEGIN REGISTER FORM -->
							<form name="register" action="<?php echo base_url();?>login/forgotpassword" method="post" class="form-login" role="form">
								   
                                                                 <input type="text" id="email"  name="email" class="form-control" placeholder="<?php echo  lang('email');?>" value="<?php echo isset($email) ? $email : set_value("email") ?>">
                                                                <span class="error"> <?php echo form_error('email'); ?></span>
                                                                
                                                                                                                              
								 <input class="btn btn-lg btn-primary btn-block"  type="submit" name="submit" value="<?php echo  lang('submit');?>" >
								
								<label class="pull-left"></label>
                                                                <a href="<?php echo base_url();?>login" class="pull-right need-help"><?=lang('login');?></a><span class="clearfix"></span>
								
							</form>
							<!-- END REGISTER FORM -->
						</div>
						
					</div>
					<!-- END BOX REGISTER -->
				</div>
			</div>
		</div>
	</div>

	<!-- BEGIN JS FRAMEWORK -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-2.1.0.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- END JS FRAMEWORK -->
	
	<!-- BEGIN JS PLUGIN -->
	<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
	<!-- END JS PLUGIN -->
</body>
</html>