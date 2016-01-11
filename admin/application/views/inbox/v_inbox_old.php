<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck/skins/square/blue.css">
<?php echo $menu;?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-envelope-o"></i>
				<span>Email</span>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li class="active">Email</li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
					<!-- BEGIN INBOX -->
					<div class="col-md-12">
						<div class="grid email">
							<div class="grid-body">
								<div class="row">
									<!-- BEGIN INBOX MENU -->
									<div class="col-md-3">
										<h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox</h2>
										

										<hr>

										<div>
											<ul class="nav nav-pills nav-stacked">
												<li class="header">Folders</li>
												<li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox ( <?php echo $unreadmails_count;?> )</a></li>												
												
												
											</ul>
										</div>
									</div>
									<!-- END INBOX MENU -->
									
									<!-- BEGIN INBOX CONTENT -->
									<div class="col-md-9">
										<div class="row">
											<div class="col-sm-6">
												<label style="margin-right: 8px;">
													<input type="checkbox" id="check-all" class="icheck" />
												</label>
												<div class="btn-group">
													<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
														Action <span class="caret"></span>
													</button>
													<ul class="dropdown-menu" role="menu">
														
														<li><a href="#">Delete</a></li>
													</ul>
												</div>
											</div>

											<div class="col-md-6 search-form">
											<form action="" class="text-right" method="POST">	
													<div class="input-group">
														<input type="text" id="keyword" name="keyword" class="form-control input-sm" placeholder="Search"  value="<?php if(isset($search_item)){ echo $search_item; } ?>">
														<span class="input-group-btn">
                                                                                                                    
				<input type="button" id="serach_submit" value="search" name="search"  class="btn btn-primary btn-sm search"><i class="fa fa-search"></i></button></span>
													</div>			 
                                                                                        </form>	
											</div>
										</div>
										
										<div class="padding"></div>
										
										<div class="table-responsive">
											<table class="table">
                                                                                            
                                                                                            <?php 
                                                                                             $page_links	= $this->pagination->create_links();?>
                                                                                             <?php echo (count($inbox_mails) < 1)?'<tr><td style="text-align:center;" colspan="2">No Results</td></tr>':'';
                                                                                                  
                                                                                            if(isset($inbox_mails))
                                                                                            { 
                                                                                                
                                                                                                foreach ($inbox_mails as $results):?>
                                                                                            <?php  if($results->status==1)
                                                                                                {
                                                                                                  $style='class="read"';
                                                                                                }
                                                                                                else 
                                                                                                {
                                                                                                 $style='class=""';
                                                                                                }
                                                                                                ?>
												<tr <?php echo $style;?>>
													<td class="action"><input type="checkbox" class="icheck" /></td>
													<td class="name"><a href="#"><?php echo $results->inbox_name ;?></a></td>
                                                                                                       	<td class="subject"><a href="#"><?php echo $results->inbox_message;?></a></td>
													<td class="time"><?php echo $results->added_date;?></td>
                                                                                                        
                                                                                                        <td><a href="<?php echo base_url();?>inbox/view/<?php echo $results->inbox_id;?>"><input type="button" class="btn btn-primary" value="View"></a></td>
<!--                                                                                                        <td><a style="color: #fff" class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;REPLY</a></td>-->
												</tr>
												
                                                                                            <?php  endforeach; }
                                                                                            if($page_links != ''):?>
                                                                                            <tr><td colspan="7" style="text-align:center"><?php echo $page_links;?></td></tr>
                                                                                         <?php endif;?>
                                                                                            
											</table>
										</div>
                                                                                    
															
									</div>
									<!-- END INBOX CONTENT -->
									
								
								</div>
							</div>
						</div>
					</div>
					<!-- END INBOX -->
				</div>
			</section>
			<!-- END MAIN CONTENT -->
		</aside>
		
	<?php echo $footer;?>
	 <script src="<?php echo base_url();?>assets/plugins/icheck/icheck.min.js"></script>
	<script type="text/javascript">
		/* ICHECK */
		$('.icheck').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
		
		$("#check-all").on('ifUnchecked', function(event) {
			$("input[type='checkbox']").iCheck("uncheck");
		});
		$("#check-all").on('ifChecked', function(event) {
			$("input[type='checkbox']").iCheck("check");
		});
	</script>
       
        <script type="text/javascript">
            
var baseurl = "<?php //echo base_url(); ?>";

$("#serach_submit").click(function(){
    
   var keyword=$( "#keyword" ).val();
 
    var dataString = 'searchitem='+ keyword; 
    
    $.ajax({
   type: "POST",
   url: 'http://localhost/kms/admin/inbox/index',
   data: dataString,
  
   success: function(result){
  // alert(result);
  //console.log(result);
   $(".table-responsive").html(result);
   }
   });   
    
});

</script>
	