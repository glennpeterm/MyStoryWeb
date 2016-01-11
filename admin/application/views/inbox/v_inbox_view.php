<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck/skins/square/blue.css">
<?php echo $menu;?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-envelope-o"></i>
				<span>INBOX VIEW</span>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li class="active">Email</li>
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
								<span class="grid-title">View</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								<form class="form-horizontal" role="form">
                                                                   
									<div class="form-group">
										<label class="col-sm-3 control-label">Name</label>
										<div class="col-sm-7">
											<?php echo $message[0]->inbox_name;?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Email Address</label>
										<div class="col-sm-7">
											<?php echo $message[0]->inbox_email;?>
										</div>
									</div>
                                                                    <div class="form-group">
										<label class="col-sm-3 control-label">Message</label>
										<div class="col-sm-7">
											<?php echo $message[0]->inbox_message ;?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Date</label>
										<div class="col-sm-7">
											<?php echo $message[0]->added_date;?>
										</div>
									</div>
                                                                    <div class="form-group">
										<label class="col-sm-3 control-label"></label>
										<div class="col-sm-7">
											<a href="<?php echo site_url("inbox/index/"); ?>"><button type="button" class="btn  btn-warning result_form_cancel">Cancel</button></a>
										</div>
									</div>
									
									
								</form>
							</div>
						</div>
					</div>
					<!-- END BASIC ELEMENTS -->
				</div>
<?php echo $footer;?>