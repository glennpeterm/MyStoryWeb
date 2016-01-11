

<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jRating.jquery.css">
<?php echo $menu;?><aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->	
                        
                        
			<section class="content-header">
				<i class="fa fa-table"></i>
				<span><?php echo lang('video_rating');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                         <li ><a href="<?=site_url('scripture_videos/index');?>"><?=lang('scripture_list');?></a></li>
                                        <li class="active"><?=lang('video_rating_list');?></li>                                     
			
				</ol>
			</section>
			<!-- END CONTENT HEADER -->                   
			
                        		
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
                                    <!-- BEGIN ROW DETAILS -->
	<div class="col-md-12">
						<div class="grid no-border">
							<div class="grid-header">
								<i class="fa fa-table"></i>
								<span class="grid-title"><?php echo lang('rating_listing');?></span>
								
							</div>
                                                     
							<div class="grid-body">
								<table id="dataTables1" class="table table-hover display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><?php echo lang('username');?></th>	
                                                                                        <th><?php echo lang('date');?></th>	
                                                                                        <th  data-defaultsort='disabled' style="background:none;"><?php echo lang('rating');?></th>
                                                                                        
										</tr>
									</thead>

									<tbody>
										
                                                                           <?php 
                                                                          
                                                                           if(isset($rating_details))
                                                                                {                                                                                  
                                                                                    foreach ($rating_details as $results):?>
										<tr id="<?php echo $results->scripture_video_user_rating_id;?>" >
                                                                                <td><?php echo $results->first_name ;?> </td>   
                                                                                <td><?php echo $results->user_rating_addeddate ;?> </td>   
                                                                                <td><div class="exemple4" data-average="<?php echo $results->user_rating_val;?>" data-id="5"></div></td>
                                                                                	
										</tr>
										<?php  endforeach; } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END BASIC DATATABLES -->
					<!-- END ROW DETAILS -->
				</div>
                            </section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
		 	<script>
		   var pageName = 'video';
		   </script>

             <?php echo $footer;?>   
                
       
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/datatables.js"></script>
    <script src="<?php echo base_url();?>assets/js/jRating.jquery.js"></script>
    <script type="text/javascript">
		$(document).ready(function(){
                    $('.exemple4').jRating({
                                
				isDisabled : true
                                 //rateMax: 1

			});
                });
 </script>