

<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jRating.jquery.css">
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/switchery/switchery.min.css">

<?php echo $menu;?><aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->	
                        
                        
			<section class="content-header">
				<i class="fa fa-table"></i>
				<span><?php echo lang('testimonial_videos');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li class="active"><?=lang('testimonial_video_list');?></li>                                     
			
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
                                    <!-- BEGIN ROW DETAILS -->
	<div class="col-md-12">
						<div class="grid no-border">
							<div class="grid-header">
								<i class="fa fa-table"></i>
								<span class="grid-title"><?php echo lang('listing');?></span>
								 <a href="<?php echo site_url("testimonial_videos/add"); ?>"><button style="float:right"type="button" class="btn btn-primary"><?php echo lang('add');?></button></a>
							</div>
                                                    
							<div class="grid-body">
								<table id="dataTables1" class="table table-hover display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><?php echo lang('title');?></th>
											<th><?php echo lang('desc');?></th>
											<th><?php echo lang('date');?></th>
                                                                                        <th><?php echo lang('txt_status');?></th>
                                                                                        <th data-defaultsort='disabled' style="background:none;"><?php echo lang('action');?></th>
										</tr>
									</thead>

									<tbody>
										
                                                                           <?php 
                                                                          
                                                                           if(isset($testimonial_details))
                                                                                { 
                                                                                 
                                                                                    foreach ($testimonial_details as $results):?>
                                                                            
												
                                                                           
										<tr id="<?php echo $results->video_id;?>" >
                                                                                <td><?php echo $results->video_title ;?> </td>
                                                                                <td>
                                                                                     <?php echo substr($results->video_desc,0,30);if(strlen($results->video_desc)>30) {?> .....<?php }?>
                                                                                   
                                                                                </td>
                                                                                <td><?php echo $results->video_added_date;?></td>
                                                                                
											
                                                                                  <?php 
                                                                                        
                                                                                $statusChecked = '';
                                                                                if(isset($results->video_status) && ($results->video_status == 1)){
                                                                                    $statusChecked = ' checked';
                                                                                }
                                                                                    ?>
                                                                                  <td>
                                                                                       <span style="display:none;"><?=$results->video_status;?></span>
                                                                                    <input type="checkbox" class="js-switch xsmall" id="<?php echo $results->video_id;?>" <?php echo $statusChecked;?> onchange="changeStatus(<?php echo $results->video_id;?>,'<?php echo $results->video_status;?>')"/></td>	
                                                                                   
                                                                                <td>
                                                                                    <a href="<?php echo base_url();?>testimonial_videos/view/<?php echo $results->video_id;?>" title="<?=lang('txt_view');?>" >
                                                                                    <li class="fa fa-eye bg-yellow action"></li>
                                                                                    </a>
                                                                                    <a href="<?php echo base_url();?>testimonial_videos/add/<?php echo $results->video_id;?>" title="<?=lang('txt_edit');?>" >
                                                                                    <li class="fa fa-pencil bg-blue action"></li> 
                                                                                    </a>
                                                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $results->video_id;?>)" title="<?=lang('txt_delete');?>" >
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
     <script>
   var pageName = 'video';
   </script>

             <?php echo $footer;?>   
                
         <script>
             var baseurl = "<?php echo base_url(); ?>";
             // function for topic deletion 
            function confirmDelete(id) {
              if (confirm(delete_confirmation)) {

                   window.location = baseurl+'testimonial_videos/delete/'+id;

              }
               else
                  return false;
            }
</script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/datatables.js"></script>
    <script src="<?php echo base_url();?>assets/js/jRating.jquery.js"></script>
    <script src="<?=base_url()?>assets/plugins/switchery/switchery.js"></script>
    <script type="text/javascript">
		
                    $('.exemple4').jRating({
                                
				isDisabled : true 

			});
                 var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function(html) {
                var switchery = new Switchery(html);
                });
             
 </script>
 <script>
    // changing video status
        function changeStatus(chkid,chkstatus)
        {

            stat = 0;
           if(chkstatus==1){
               stat = 0;
           }else{
               stat = 1;
           }

           $.ajax({
               url: baseurl+'testimonial_videos/setstatus',
               type: 'POST', 
               data: 'id='+chkid+'&status='+stat,
               success: function(res){               
                   location.reload();
               }});
        }
        </script>
 