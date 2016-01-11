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
	
	<title>Kertas &ndash; Form Components</title>
	
	<link rel="icon" href="assets/img/favicon.ico">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<!-- BEGIN CSS FRAMEWORK -->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css">
	<!-- END CSS FRAMEWORK -->
	
	<!-- BEGIN CSS PLUGIN -->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/pace/pace-theme-minimal.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/icheck/skins/square/blue.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/switchery/switchery.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap-slider/css/slider.css">
	<!-- END CSS PLUGIN -->
	
	<!-- BEGIN CSS TEMPLATE -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/skins.css">
	<!-- END CSS TEMPLATE -->
</head>

<body class="skin-dark">
	<!-- BEGIN HEADER -->
	<header class="header">
		<!-- BEGIN LOGO -->
		<a href="index.html" class="logo">
			<img src="assets/img/logo.png" alt="Kertas" height="20">
		</a>
		<!-- END LOGO -->
		<!-- BEGIN NAVBAR -->
		<nav class="navbar navbar-static-top" role="navigation">
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="fa fa-bars fa-lg"></span>
			</a>
			
			<!-- BEGIN NEWS TICKER -->
			<div class="ticker">
				<strong>News:</strong>
				<ul>
					<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</li>
					<li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
					<li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </li>
					<li>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
				</ul>
			</div>
			<!-- END NEWS TICKER -->
			
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown navbar-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bookmark fa-lg"></i>
							<span class="badge">4</span>
						</a>
						<ul class="dropdown-menu box task">
							<li><div class="up-arrow"></div></li>
							<li>
								<p>You have 4 pending tasks</p>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="task-desc">Database Migration</div>
										<div class="task-percent">20%</div>
									</div>
									<div class="progress">
										<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
											<span class="sr-only">20% Complete</span>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="task-desc">Mobile Development</div>
										<div class="task-percent">45%</div>
									</div>
									<div class="progress">
										<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
											<span class="sr-only">45% Complete</span>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="task-desc">App Deployment</div>
										<div class="task-percent">80%</div>
									</div>
									<div class="progress progress-striped active">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
											<span class="sr-only">80% Complete</span>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="task-desc">Server Upgrade</div>
										<div class="task-percent">90%</div>
									</div>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
											<span class="sr-only">90% Complete</span>
										</div>
									</div>
								</a>
							</li>
							<li class="footer">
								<a href="#">See all tasks</a>
							</li>
						</ul>
					</li>
					<li class="dropdown navbar-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-envelope fa-lg"></i>
							<span class="badge">3</span>
						</a>
						<ul class="dropdown-menu box inbox">
							<li><div class="up-arrow"></div></li>
							<li>
								<p>You have 3 new messages</p>
							</li>
							<li>
								<a href="#">
									<span class="photo"><img src="assets/img/user/avatar02.png" alt="User Image"></span>
									<span class="subject">
										<span class="from">Elaine Hernandez</span>
										<span class="time">1 min</span>
										<span class="message">Hey, are you there?</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="photo"><img src="assets/img/user/avatar03.png" alt="User Image"></span>
									<span class="subject">
										<span class="from">Larry Gardner</span>
										<span class="time">5 mins</span>
										<span class="message">Have you finished your work?</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="photo"><img src="assets/img/user/avatar04.png" alt="User Image"></span>
									<span class="subject">
										<span class="from">Tanya Mackenzie</span>
										<span class="time">2 hrs</span>
										<span class="message">Don't forget to attend today's...</span>
									</span>
								</a>
							</li>
							<li class="footer">
								<a href="#">See all messages</a>
							</li>
						</ul>
					</li>
					<li class="dropdown navbar-menu">
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
					</li>
					<li class="dropdown profile-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-cog fa-lg"></i>
							<span class="username">Me</span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu box profile">
							<li><div class="up-arrow"></div></li>
							<li class="border-top">
								<a href="pages-user.html"><i class="fa fa-user"></i>My Account</a>
							</li>
							<li>
								<a href="pages-calendar.html"><i class="fa fa-calendar"></i>My Calendar</a>
							</li>
							<li>
								<a href="email.html"><i class="fa fa-inbox"></i>My Inbox &nbsp;<span class="badge">3</span></a>
							</li>
							<li>
								<a href="lockscreen.html"><i class="fa fa-lock"></i>Lock Screen</a>
							</li>
							<li>
								<a href="login.html"><i class="fa fa-power-off"></i>Log Out</a>
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
		<!-- BEGIN SIDEBAR -->
		<aside class="left-side sidebar-offcanvas">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="assets/img/user/avatar01.png" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>Jeffrey <strong>Williams</strong></p>
						<a href="#"><i class="fa fa-circle text-green"></i> Online</a>
					</div>
				</div>
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="search" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
				<ul class="sidebar-menu">
					<li>
						<a href="index.html">
							<i class="fa fa-home"></i><span>Dashboard</span>
						</a>
					</li>
					<li class="menu">
						<a href="#">
							<i class="fa fa-laptop"></i><span>UI Elements</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="ui-general.html">General</a></li>
							<li><a href="ui-buttons.html">Buttons</a></li>							
							<li><a href="ui-grid.html">Grid</a></li>
							<li><a href="ui-group-list.html">Group List</a></li>
							<li><a href="ui-icons.html">Icons</a></li>
							<li><a href="ui-messages.html">Messages & Notifications</a></li>
							<li><a href="ui-modals.html">Modals</a></li>
							<li><a href="ui-tabs.html">Tabs & Accordions</a></li>
							<li><a href="ui-typography.html">Typography</a></li>
						</ul>
					</li>
					<li class="menu active">
						<a href="#">
							<i class="fa fa-align-left"></i><span>Forms</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="forms-components.html">Components</a></li>
							<li><a href="forms-masks.html">Input Masks</a></li>
							<li><a href="forms-validation.html">Validation</a></li>
							<li><a href="forms-wizard.html">Wizard</a></li>
							<li><a href="forms-wysiwyg.html">WYSIWYG Editor</a></li>
							<li><a href="forms-upload.html">Multi Upload</a></li>
						</ul>
					</li>
					<li class="menu">
						<a href="#">
							<i class="fa fa-table"></i><span>Tables</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="tables-basic.html">Basic Tables</a></li>
							<li><a href="tables-datatables.html">Data Tables</a></li>
						</ul>
					</li>
					<li class="menu">
						<a href="#">
							<i class="fa fa-map-marker"></i><span>Maps</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="maps-google.html">Google Map</a></li>
							<li><a href="maps-vector.html">Vector Map</a></li>
						</ul>
					</li>
					<li>
						<a href="charts.html">
							<i class="fa fa-bar-chart-o"></i><span>Charts</span>
						</a>
					</li>
					<li class="menu">
						<a href="#">
							<i class="fa fa-archive"></i><span>Pages</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="404.html">404 Page</a></li>
							<li><a href="500.html">500 Page</a></li>
							<li><a href="pages-blank.html">Blank Page</a></li>
							<li><a href="pages-blank-header.html">Blank Page Header</a></li>
							<li><a href="pages-calendar.html">Calendar</a></li>
							<li><a href="pages-code.html">Code Editor</a></li>
							<li><a href="pages-gallery.html">Gallery</a></li>
							<li><a href="pages-invoice.html">Invoice</a></li>
							<li><a href="lockscreen.html">Lock Screen</a></li>
							<li><a href="login.html">Login</a></li>
							<li><a href="register.html">Register</a></li>
							<li><a href="pages-search.html">Search Result</a></li>
							<li><a href="pages-support.html">Support Ticket</a></li>
							<li><a href="pages-timeline.html">Timeline</a></li>
							<li><a href="pages-user.html">User Profile</a></li>
						</ul>
					</li>
					<li>
						<a href="email.html">
							<i class="fa fa-envelope"></i><span>Email</span><small class="badge pull-right bg-blue">12</small>
						</a>
					</li>
					<li>
						<a href="../frontend/index.html">
							<i class="fa fa-flag"></i><span>Frontend</span>
						</a>
					</li>
					<li class="menu">
						<a href="#">
							<i class="fa fa-folder-open"></i><span>Menu Levels</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="#">Level 1</a></li>
							<li class="menu">
								<a href="#">
									<span>Level 2</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="sub-menu">
									<li><a href="#">Sub Menu</a></li>
									<li><a href="#">Sub Menu</a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</section>
		</aside>
		<!-- END SIDEBAR -->
		
		<!-- BEGIN CONTENT -->
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-align-left"></i>
				<span>Form Components</span>
				<ol class="breadcrumb">
					<li><a href="index.html">Forms</a></li>
					<li><a href="">Pages</a></li>
					<li class="active">Components</li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
					<!-- BEGIN BASIC FORM -->
					<div class="col-md-6">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Basic Form</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form role="form">
									<div class="form-group">
										<label>Email address</label>
										<input type="email" class="form-control" placeholder="Enter email">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" placeholder="Password">
									</div>
									
									<div class="checkbox">
										<label><input type="checkbox" class="icheck"> Check me out</label>
									</div>
									
									<div class="btn-group">
										<button type="submit" class="btn btn-primary">Submit</button>
										<button type="submit" class="btn btn-default">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END BASIC FORM -->
					<!-- BEGIN HORIZONTAL FORM -->
					<div class="col-md-6">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Horizontal Form</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" placeholder="Email">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" placeholder="Password">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<div class="checkbox">
												<label><input type="checkbox" class="icheck"> Remember me</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<div class="btn-group">
												<button type="submit" class="btn btn-primary">Sign in</button>
												<button type="submit" class="btn btn-default">Cancel</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END HORIZONTAL FORM -->
				</div>
				<div class="row">
					<!-- BEGIN BASIC ELEMENTS -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Basic Elements</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label">Input Text</label>
										<div class="col-sm-7">
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Input Password</label>
										<div class="col-sm-7">
											<input type="password" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Placeholder</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" placeholder="Placeholder">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Disabled Input</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" placeholder="Disabled Input" disabled>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Readonly Input</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" placeholder="Readonly Input" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Textarea</label>
										<div class="col-sm-7">
											<textarea class="form-control" rows="2"></textarea>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END BASIC ELEMENTS -->
				</div>
				<div class="row">
					<!-- BEGIN SELECT & OPTION -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Select & Option Elements</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label">Basic Select</label>
										<div class="col-sm-7">
											<select class="form-control">
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Multiple Select</label>
										<div class="col-sm-7">
											<select multiple class="form-control">
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Checkbox</label>
										<div class="col-sm-7">
											<div class="checkbox">
												<label><input type="checkbox" class="icheck"> Checkbox 1</label>
											</div>
											<div class="checkbox">
												<label><input type="checkbox" class="icheck" checked> Checkbox 2</label>
											</div>
											<div class="checkbox">
												<label><input type="checkbox" class="icheck" disabled> Disabled</label>
											</div>
											<div class="checkbox">
												<label><input type="checkbox" class="icheck" checked disabled> Disabled & Checked</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Inline Checkbox</label>
										<div class="col-sm-7">
											<label class="checkbox-inline"><input type="checkbox" class="icheck"> Checkbox 1</label>
											<label class="checkbox-inline"><input type="checkbox" class="icheck" checked> Checkbox 2</label>
											<label class="checkbox-inline"><input type="checkbox" class="icheck" disabled> Disabled</label>
											<label class="checkbox-inline"><input type="checkbox" class="icheck" checked disabled> Disabled & Checked</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Radio</label>
										<div class="col-sm-7">
											<div class="radio">
												<label><input type="radio" name="radio1" class="icheck"> Radio 1</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="radio1" class="icheck" checked> Radio 2</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="radio1" class="icheck" disabled> Disabled</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="radio1" class="icheck" checked disabled> Disabled & Checked</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Inline Radio</label>
										<div class="col-sm-7">
											<label class="radio-inline"><input type="radio" name="radio2" class="icheck"> Radio 1</label>
											<label class="radio-inline"><input type="radio" name="radio2" class="icheck" checked> Radio 2</label>
											<label class="radio-inline"><input type="radio" name="radio2" class="icheck" disabled> Disabled</label>
											<label class="radio-inline"><input type="radio" name="radio2" class="icheck" checked disabled> Disabled & Checked</label>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END SELECT & OPTION -->
				</div>
				<div class="row">
					<!-- BEGIN INPUT GROUPS -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Input Groups</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label">Input Text</label>
										<div class="col-sm-7">
											<div class="input-group">
												<span class="input-group-addon">@</span>
												<input type="text" class="form-control" placeholder="Username">
											</div>
											<br>
											<div class="input-group">
												<input type="text" class="form-control">
												<span class="input-group-addon">.00</span>
											</div>
											<br>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="text" class="form-control">
												<span class="input-group-addon">.00</span>
											</div>
										</div>
									</div>
									<br>
									<div class="form-group">
										<label class="col-sm-3 control-label">Sizing</label>
										<div class="col-sm-7">
											<div class="input-group input-group-lg">
												<span class="input-group-addon">@</span>
												<input type="text" class="form-control" placeholder="Username">
											</div>
											<br>
											<div class="input-group">
												<span class="input-group-addon">@</span>
												<input type="text" class="form-control" placeholder="Username">
											</div>
											<br>
											<div class="input-group input-group-sm">
												<span class="input-group-addon">@</span>
												<input type="text" class="form-control" placeholder="Username">
											</div>
										</div>
									</div>
									<br>
									<div class="form-group">
										<label class="col-sm-3 control-label">Checkboxes & Radio Addons</label>
										<div class="col-sm-7">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox">
												</span>
												<input type="text" class="form-control">
											</div>
											<br>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="radio">
												</span>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
									<br>
									<div class="form-group">
										<label class="col-sm-3 control-label">Button Addons</label>
										<div class="col-sm-7">
											<div class="input-group">
												<span class="input-group-btn">
													<button class="btn btn-primary" type="button">Go!</button>
												</span>
												<input type="text" class="form-control">
											</div>
											<br>
											<div class="input-group">
												<input type="text" class="form-control">
												<span class="input-group-btn">
													<button class="btn btn-primary" type="button">Go!</button>
												</span>
											</div>
										</div>
									</div>
									<br>
									<div class="form-group">
										<label class="col-sm-3 control-label">Buttons with Dropdowns</label>
										<div class="col-sm-7">
											<div class="input-group">
												<div class="input-group-btn">
													<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
													<ul class="dropdown-menu">
														<li><a href="#">Action</a></li>
														<li><a href="#">Another action</a></li>
														<li><a href="#">Something else here</a></li>
														<li class="divider"></li>
														<li><a href="#">Separated link</a></li>
													</ul>
												</div>
												<input type="text" class="form-control">
											</div>
											<br>
											<div class="input-group">
												<input type="text" class="form-control">
												<div class="input-group-btn">
													<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
													<ul class="dropdown-menu">
														<li><a href="#">Action</a></li>
														<li><a href="#">Another action</a></li>
														<li><a href="#">Something else here</a></li>
														<li class="divider"></li>
														<li><a href="#">Separated link</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="form-group">
										<label class="col-sm-3 control-label">Segmented Buttons</label>
										<div class="col-sm-7">
											<div class="input-group">
												<div class="input-group-btn">
													<button type="button" class="btn btn-primary" tabindex="-1">Action</button>
													<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" tabindex="-1">
														<span class="caret"></span>
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu">
														<li><a href="#">Action</a></li>
														<li><a href="#">Another action</a></li>
														<li><a href="#">Something else here</a></li>
														<li class="divider"></li>
														<li><a href="#">Separated link</a></li>
													</ul>
												</div>
												<input type="text" class="form-control">
											</div>
											<br>
											<div class="input-group">
												<input type="text" class="form-control">
												<div class="input-group-btn">
													<button type="button" class="btn btn-primary" tabindex="-1">Action</button>
													<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" tabindex="-1">
														<span class="caret"></span>
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu">
														<li><a href="#">Action</a></li>
														<li><a href="#">Another action</a></li>
														<li><a href="#">Something else here</a></li>
														<li class="divider"></li>
														<li><a href="#">Separated link</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END INPUT GROUPS -->
				</div>
				<div class="row">
					<!-- BEGIN SWITCHERY -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Switchery</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label">Switch Size</label>
										<div class="col-sm-7">
											<input type="checkbox" class="js-switch xsmall" checked />
											<input type="checkbox" class="js-switch small" checked />
											<input type="checkbox" class="js-switch" checked />
											<input type="checkbox" class="js-switch large" checked />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Switch Checked</label>
										<div class="col-sm-7">
											<input type="checkbox" class="js-switch" />
											<input type="checkbox" class="js-switch" checked />
											<input type="checkbox" class="js-switch" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Disabled Switch</label>
										<div class="col-sm-7">
											<input type="checkbox" class="js-switch-disabled" />
											<input type="checkbox" class="js-switch-disabled-opacity" checked />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Colored Switch</label>
										<div class="col-sm-7">
											<input type="checkbox" class="js-switch-blue" checked />
											<input type="checkbox" class="js-switch-pink" checked />
											<input type="checkbox" class="js-switch-teal" checked />
											<input type="checkbox" class="js-switch-red" checked />
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END SWITCHERY -->
				</div>
				<div class="row">
					<!-- BEGIN DATETIME PICKER -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">DateTime Picker</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label">Default</label>
										<div class="col-sm-3">
											<div class="input-group date form_datetime" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii" data-link-field="dtp_input1">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input1" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Read Only</label>
										<div class="col-sm-3">
											<div class="input-group date form_datetime" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii" data-link-field="dtp_input2">
												<input type="text" class="form-control" readonly>
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input2" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Date Only</label>
										<div class="col-sm-3">
											<div class="input-group date form_date" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input3" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Time Only</label>
										<div class="col-sm-3">
											<div class="input-group date form_time" data-date="2014-06-14T05:25:07Z" data-date-format="HH:ii" data-link-field="dtp_input4">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input4" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Decade Year View</label>
										<div class="col-sm-3">
											<div class="input-group date form_decade" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii" data-link-field="dtp_input5">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input5" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Year View</label>
										<div class="col-sm-3">
											<div class="input-group date form_year" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii" data-link-field="dtp_input6">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input6" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Month View</label>
										<div class="col-sm-3">
											<div class="input-group date form_month" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii" data-link-field="dtp_input7">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input7" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Day View</label>
										<div class="col-sm-3">
											<div class="input-group date form_day" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii" data-link-field="dtp_input8">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input8" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Hour View</label>
										<div class="col-sm-3">
											<div class="input-group date form_hour" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii" data-link-field="dtp_input9">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input9" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Day View Meridian</label>
										<div class="col-sm-3">
											<div class="input-group date form_daymeridian" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii p" data-link-field="dtp_input10">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input10" value="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Hour View Meridian</label>
										<div class="col-sm-3">
											<div class="input-group date form_hourmeridian" data-date="2014-06-14T05:25:07Z" data-date-format="dd-mm-yyyy HH:ii p" data-link-field="dtp_input11">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa fa-th"></i></span>
											</div>
											<input type="hidden" id="dtp_input11" value="" />
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END DATETIME PICKER -->
				</div>
				<div class="row">
					<!-- BEGIN COLOR PICKER -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Color Picker</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label">Default</label>
										<div class="col-sm-3">
											<input type="text" class="form-control cp_input1" value="#5367ce">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">As a Component</label>
										<div class="col-sm-3">
											<div class="input-group cp_input1">
												<input type="text" class="form-control">
												<span class="input-group-addon"><i class="fa"></i></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Horizontal Mode</label>
										<div class="col-sm-3">
											<input type="text" class="form-control cp_input2" data-horizontal="true" value="#8fff00">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Inline Mode</label>
										<div class="col-sm-3">
											<div class="cp_inline inl-bl" data-container="true" data-color="rgba(150,216,62,0.55)" data-inline="true"></div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END COLOR PICKER -->
				</div>
				<div class="row">
					<!-- BEGIN SELECT2 -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Select2</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label">Basic</label>
										<div class="col-sm-5">
											<select id="source" class="form-control" style="width:300px">
												<optgroup label="Alaskan/Hawaiian Time Zone">
													<option value="AK">Alaska</option>
													<option value="HI">Hawaii</option>
												</optgroup>
												<optgroup label="Pacific Time Zone">
													<option value="CA">California</option>
													<option value="NV">Nevada</option>
													<option value="OR">Oregon</option>
													<option value="WA">Washington</option>
												</optgroup>
												<optgroup label="Mountain Time Zone">
													<option value="AZ">Arizona</option>
													<option value="CO">Colorado</option>
													<option value="ID">Idaho</option>
													<option value="MT">Montana</option><option value="NE">Nebraska</option>
													<option value="NM">New Mexico</option>
													<option value="ND">North Dakota</option>
													<option value="UT">Utah</option>
													<option value="WY">Wyoming</option>
												</optgroup>
												<optgroup label="Central Time Zone">
													<option value="AL">Alabama</option>
													<option value="AR">Arkansas</option>
													<option value="IL">Illinois</option>
													<option value="IA">Iowa</option>
													<option value="KS">Kansas</option>
													<option value="KY">Kentucky</option>
													<option value="LA">Louisiana</option>
													<option value="MN">Minnesota</option>
													<option value="MS">Mississippi</option>
													<option value="MO">Missouri</option>
													<option value="OK">Oklahoma</option>
													<option value="SD">South Dakota</option>
													<option value="TX">Texas</option>
													<option value="TN">Tennessee</option>
													<option value="WI">Wisconsin</option>
												</optgroup>
												<optgroup label="Eastern Time Zone">
													<option value="CT">Connecticut</option>
													<option value="DE">Delaware</option>
													<option value="FL">Florida</option>
													<option value="GA">Georgia</option>
													<option value="IN">Indiana</option>
													<option value="ME">Maine</option>
													<option value="MD">Maryland</option>
													<option value="MA">Massachusetts</option>
													<option value="MI">Michigan</option>
													<option value="NH">New Hampshire</option>
													<option value="NJ">New Jersey</option>
													<option value="NY">New York</option>
													<option value="NC">North Carolina</option>
													<option value="OH">Ohio</option>
													<option value="PA">Pennsylvania</option>
													<option value="RI">Rhode Island</option>
													<option value="SC">South Carolina</option>
													<option value="VT">Vermont</option>
													<option value="VA">Virginia</option>
													<option value="WV">West Virginia</option>
												</optgroup>
											</select>
										</div>
									</div>									
									<div class="form-group">
										<label class="col-sm-3 control-label">Default Select2</label>
										<div class="col-sm-5">
											<select id="e1" class="populate" style="width:300px"></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Multi-Value Select Boxes</label>
										<div class="col-sm-5">
											<select multiple id="e2" class="populate" style="width:300px"></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Multi-Value Tagging Boxes</label>
										<div class="col-sm-5">
											<input type="hidden" id="e3" value="brown, red, green" style="width:300px;">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END SELECT2 -->
				</div>
				<div class="row">
					<!-- BEGIN SLIDER -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Slider</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label">Default</label>
										<div class="col-sm-5">
											<div class="slider-primary">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="40">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Range</label>
										<div class="col-sm-5">
											<div class="slider-primary">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="[20,60]">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Colored</label>
										<div class="col-sm-5">
											<div class="slider-default">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="20">
											</div>
											<div class="slider-primary">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="40">
											</div>
											<div class="slider-success">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="60">
											</div>
											<div class="slider-info">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="80">
											</div>
											<div class="slider-warning">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="60">
											</div>
											<div class="slider-danger">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="40">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Vertical</label>
										<div class="col-sm-5">
											<div class="slider-primary">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="40" data-slider-orientation="vertical">
											</div>
											<div class="slider-primary">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="20" data-slider-orientation="vertical">
											</div>
											<div class="slider-primary">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="70" data-slider-orientation="vertical">
											</div>
											<div class="slider-primary">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="80" data-slider-orientation="vertical">
											</div>
											<div class="slider-primary">
												<input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50" data-slider-orientation="vertical">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END SLIDER -->
				</div>
			</section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
		
		<!-- BEGIN SCROLL TO TOP -->
		<div class="scroll-to-top"></div>
		<!-- END SCROLL TO TOP -->
	</div>

	<!-- BEGIN JS FRAMEWORK -->
	<script src="assets/plugins/jquery-2.1.0.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- END JS FRAMEWORK -->
	
	<!-- BEGIN JS PLUGIN -->
	<script src="<?=base_url()?>assets/plugins/pace/pace.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-totemticker/jquery.totemticker.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-resize/jquery.ba-resize.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-blockui/jquery.blockUI.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/icheck/icheck.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/switchery/switchery.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/select2/select2.js"></script>
	<script src="<?=base_url()?>assets/plugins/bootstrap-slider/js/bootstrap-slider.js"></script>
	<script src="<?=base_url()?>assets/js/form.js"></script>
	<!-- END JS PLUGIN -->

	<!-- BEGIN JS TEMPLATE -->
	<script src="<?=base_url()?>assets/js/main.js"></script>
	<script src="<?=base_url()?>assets/js/skin-selector.js"></script>
	<!-- END JS TEMPLATE -->
</body>
</html>