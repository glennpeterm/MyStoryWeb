<!DOCTYPE html>
<?php
        
        $ci =& get_instance();
        $ci->load->helper('notification');
        isLogin();
        $unreadmailcount = unreadmailcount();
         $selfiescount = selfiesCount();
        
        ?>
<html lang="en">
<head>
    <script>
        var baseurl = '<?php echo base_url();?>';
        //common strings
        var no_data = '<?php echo lang('no_data');?>';
        var txt_status = '<?=lang('txt_status');?>';
        var switchery_confirmation = '<?=lang('switchery_confirmation');?>';
        var delete_confirmation = '<?=lang('delete_confirmation');?>';
    </script>
	<meta charset="utf-8">
        <!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo base_url();?>assets/img/splash_screen_logo.ico">

	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>My Story</title>
	
	<link rel="icon" href="<?php echo base_url();?><?php echo base_url();?>assets/img/favicon.ico">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<!-- BEGIN CSS FRAMEWORK -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">
	<!-- END CSS FRAMEWORK -->
	
	<!-- BEGIN CSS PLUGIN -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/pace/pace-theme-minimal.css">
	<!-- END CSS PLUGIN -->
	
	<!-- BEGIN CSS TEMPLATE -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck/skins/square/blue.css">
    
	<!-- END CSS TEMPLATE -->
</head>

<body class="skin-dark">
	<!-- BEGIN HEADER -->
	<header class="header">
		<!-- BEGIN LOGO -->
		<a href="<?=site_url('home');?>" class="logo"><img src="http://kms.fingent.net/assets/img/logo.png" style="height:60px;"></a>
		<!-- END LOGO -->
		<!-- BEGIN NAVBAR -->
		<nav class="navbar navbar-static-top" role="navigation">
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="fa fa-bars fa-lg"></span>
			</a>
			
			<!-- BEGIN NEWS TICKER -->
			
			<!-- END NEWS TICKER -->
			
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown navbar-menu">
						<a href="<?=site_url('inbox');?>" class="dropdown-toggle">
							<i title="Inbox" class="fa fa-envelope fa-lg"></i>
                                                        <?php if($unreadmailcount>0){?>
							<span class="badge" id="emailcount"><?php echo $unreadmailcount;?></span>
                                                        <?php }?>
						</a>
                                        </li>
                                        <li class="dropdown navbar-menu">
                                            <a href="<?=site_url('selfie_videos');?>" class="dropdown-toggle">
                                                        <i title="Selfies" class="fa fa-bell fa-lg"></i>
                                                        <?php if($selfiescount>0){?>
                                                        <span class="badge" id="selfies_count"><?php echo $selfiescount;?></span>
                                                        <?php }?>
                                                </a>
                                        </li>
<!--					<li class="dropdown navbar-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell fa-lg"></i>
							<span class="badge">4</span>
						</a>
						<ul class="dropdown-menu box notification">
							<li><div class="up-arrow"></div></li>
							<li>
								<p>You have 4 new notifications</p>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-user text-blue"></i> New user registered<span class="time pull-right">5 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-database text-green"></i> Database overloaded <span class="time pull-right">20 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-wrench text-yellow"></i> Application error <span class="time pull-right">1 hr</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-tasks text-red"></i> Server not responding <span class="time pull-right">5 hrs</span>
								</a>
							</li>
							<li class="footer">
								<a href="#">See all notifications</a>
							</li>
						</ul>
					</li>-->
					<li  class="dropdown profile-menu">
						<a title="settings" href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-cog fa-lg"></i>
							<span class="username"><?php echo ucwords($this->session->userdata('kms_ad_fname'));?></span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu box profile">
							<li><div class="up-arrow"></div></li>
							<li class="border-top">
								<a href="<?=site_url('user_settings/accountsettings');?>"><i class="fa fa-user"></i><?=lang('my_account');?></a>
							</li>
							
							<li>
								<a href="<?=site_url('inbox');?>"><i class="fa fa-inbox"></i><?=lang('my_inbox');?>&nbsp;<span class="badge"></span></a>
							</li>
                                                        <li>
								<a href="<?=site_url('user_settings/chanagepassword');?>"><i class="fa fa-lock"></i><?=lang('chanage_password');?></a>
							</li>
							
							<li>
								<a href="<?=site_url('login/dologout');?>"><i class="fa fa-power-off"></i><?=lang('logout');?></a>
							</li>
                                                        
                                                        
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<!-- END NAVBAR -->
	</header>
	<!-- END HEADER -->
	<div class="wrapper row-offcanvas row-offcanvas-left">
