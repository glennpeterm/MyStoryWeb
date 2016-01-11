

<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/switchery/switchery.min.css">
<?php echo $menu;?><aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->	
                        
                        
			<section class="content-header">
				<i class="fa fa-table"></i>
				<span><?php echo lang('explnatory_videos');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li class="active"><?=lang('explanatory_video_list');?></li>                                     
			
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
								
							</div>
                                                     <a href="<?php echo site_url("explanatory_video/add"); ?>"><button style="float:right"type="button" class="btn btn-primary"><?php echo lang('common_add');?></button></a>
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
										
                                                                           <?php if(isset($expln_videos))
                                                                                { 

                                                                                    foreach ($expln_videos as $results):?>
                                                                            
												
                                                                           
										<tr id="<?php echo $results->exvideo_id;?>" >
                                                                                <td><?php echo $results->exvideo_title ;?> </td>
                                                                                <td><?php echo $results->exvideo_desc;?></td>
                                                                                <td><?php echo $results->exvideo_added_date;?></td>
                                                                                
										<?php 
                                                                                        
                                                                                $statusChecked = '';
                                                                                if(isset($results->exvideo_status) && ($results->exvideo_status == 1)){
                                                                                    $statusChecked = ' checked';
                                                                                }
                                                                                    ?>
                                                                                <td><input type="checkbox" class="js-switch xsmall" id="<?php echo $results->exvideo_id;?>" <?php echo $statusChecked;?> onchange="changeStatus(<?php echo $results->exvideo_id;?>,'<?php echo $results->exvideo_status;?>')"/></td>	
                                                                                                              
                                                                                <td>                                                            
                                                                                    <a href="<?php echo base_url();?>explanatory_video/view/<?php echo $results->exvideo_id;?>" title="<?=lang('txt_view');?>" class="deleteIcon" >
                                                                                    <li class="fa fa-eye bg-yellow action"></li>
                                                                                    </a>
                                                                                    <a href="<?php echo base_url();?>explanatory_video/add/<?php echo $results->exvideo_id;?>" title="<?=lang('txt_edit');?>" class="deleteIcon" >
                                                                                    <li class="fa fa-pencil bg-blue action"></li> </a>
                                                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $results->exvideo_id;?>)" title="<?=lang('txt_delete');?>" class="deleteIcon" >
                                                                                    <li class="fa fa-times bg-red action"></li>
                                                                                    </a>
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
              
function confirmDelete(id) {
  if (confirm("Are you sure you want to delete")) {
      
       window.location = baseurl+'explanatory_video/delete/'+id;
      
  }
   else
      return false;
}
</script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/datatables.js"></script>
    <script src="<?=base_url()?>assets/plugins/switchery/switchery.js"></script>
    <script>
    $(document).ready(function() {
    
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
});


    function changeStatus(chkid,chkstatus)
    {
        stat = 0;
       if(chkstatus==1){
           stat = 0;
       }else{
           stat = 1;
       }
      
       $.ajax({
           url: baseurl+'explanatory_video/setstatus',
           type: 'POST', 
           data: 'id='+chkid+'&status='+stat,
           success: function(res){               

           }});
    }
        </script>
 