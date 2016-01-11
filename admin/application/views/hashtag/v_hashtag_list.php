

<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<?php echo $menu;?><aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->	
                        
                        
			<section class="content-header">
				<i class="fa fa-table"></i>
				<span><?php echo lang('hashtags');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li class="active"><?=lang('hashtag_list');?></li>  
					
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
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
                                    <!-- BEGIN ROW DETAILS -->
	<div class="col-md-12">
						<div class="grid no-border">
							<div class="grid-header">
								<i class="fa fa-table"></i>
								<span class="grid-title"><?php echo lang('hashtag_list');?></span>
								
							</div>
                                                     
							<div class="grid-body">
								<table id="dataTables1" class="table table-hover display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><?php echo lang('hashtag_name');?></th>	
                                            <th   data-defaultsort="disabled" style="background:none;" width="65%"></th>										
											<th data-defaultsort='disabled' style="background:none; text-align:right;"><?php echo lang('action');?></th>
										</tr>
									</thead>

									<tbody>
										
                                                                           <?php if(isset($hashtags))
                                                                                { 

                                                                                    foreach ($hashtags as $results):?>
                                                                            
												
                                                                           
										<tr id="<?php echo $results->hash_id;?>" >
                                                                                <td><?php echo $results->hash_name ;?> </td>                                                                               
                                                                                      <td>&nbsp;</td>                      
                                                                                   <td style="text-align:right;">
<!--                                                                                    <a href="<?php// echo base_url();?>hashtag/view/<?php// echo $results->hash_id;?>"  >
                                                                                    <li class="fa fa-eye bg-yellow action"></li>
                                                                                    </a>-->
                                                                                    <a href="<?php echo base_url();?>hashtag/add/<?php echo $results->hash_id;?>" title="<?=lang('txt_edit');?>" >
                                                                                    <li class="fa fa-pencil bg-blue action"></li> 
                                                                                    </a>
                                                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $results->hash_id;?>)" title="<?=lang('txt_delete');?>" >
                                                                                     <li class="fa fa-times bg-red action"></li></a>
                                                                                </td>     
                                                                                
                                                                                
											
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
             <?php echo $footer;?>   
                
         <script>
             var baseurl = "<?php echo base_url(); ?>";
             // delete function for topic deletion 
            
            function confirmDelete(id) 
            {
              if (confirm(delete_confirmation)) {

                   window.location = baseurl+'hashtag/delete/'+id;

              }
               else
                  return false;
            }
</script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/datatables.js"></script>
 