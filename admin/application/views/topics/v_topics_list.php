

<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/switchery/switchery.min.css">
<?php echo $menu;?><aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->	
                        
                        
			<section class="content-header">
				<i class="fa fa-table"></i>
				<span><?php echo lang('topics');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                        <li class="active"><?=lang('topics_list');?></li>  
					
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
								<span class="grid-title"><?php echo lang('topics_list');?></span>
								<a href="<?php echo site_url("topics/add"); ?>"><button style="float:right"type="button" class="btn btn-primary"><?php echo lang('add');?></button></a>
							</div>
                                                     
							<div class="grid-body">
								<table id="dataTables1" class="table table-hover display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><?php echo lang('topic_name');?></th>											
											<th><?php echo lang('date');?></th>
                                                                                        <th><?php echo lang('txt_status');?></th>
                                                                                        
											 <th data-defaultsort='disabled' style="background:none;"><?php echo lang('action');?></th>
										</tr>
									</thead>

									<tbody>
										
                                                                           <?php if(isset($topics))
                                                                                { 

                                                                                    foreach ($topics as $results):?>
                                                                            
												
                                                                           
										<tr id="<?php echo $results->topic_id;?>" >
                                                                                <td><?php echo $results->topic_name ;?> </td>                                                                               
                                                                                <td><?php echo $results->added_date;?></td>
											
                                                                                  <?php 
                                                                                        
                                                                                $statusChecked = '';
                                                                                if(isset($results->topic_status) && ($results->topic_status =='active')){
                                                                                    $statusChecked = ' checked';
                                                                                }
                                                                                    ?>
                                                                                    <td>
                                                                                    <span style="display:none;"><?=$results->topic_status;?></span>
                                                                                    <input type="checkbox" class="js-switch xsmall" id="<?=$results->topic_id;?>" <?=$statusChecked;?> onchange="changeStatus(<?=$results->topic_id;?>,'<?=$results->topic_status;?>')"/>
                                                                                    </td>                                                                                 	
                                                                                  
                                                                                  <td>
                                                                                  
<!--                                                                                    <a href="<?php //echo base_url();?>topics/view/<?php// echo $results->topic_id;?>" title="<?=lang('txt_view');?>" >
                                                                                    <li class="fa fa-eye bg-yellow action"></li>
                                                                                    </a>-->
                                                                                    <a href="<?php echo base_url();?>topics/add/<?php echo $results->topic_id;?>" title="<?=lang('txt_edit');?>" >
                                                                                    <li class="fa fa-pencil bg-blue action"></li> 
                                                                                    </a>
                                                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $results->topic_id;?>)" title="<?=lang('txt_delete');?>" >
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

                   window.location = baseurl+'topics/delete/'+id;

              }
               else
                  return false;
            }
</script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/datatables.js"></script>
    <script src="<?=base_url()?>assets/plugins/switchery/switchery.js"></script>
     <script type="text/javascript">
		$(document).ready(function(){
                   
                 var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function(html) {
                var switchery = new Switchery(html);
                });
              });

    // changing video status
        function changeStatus(chkid,chkstatus)
        {
            stat = 'inactive';
            if(chkstatus=='active'){
            stat = 'inactive'
            }else{
            stat = 'active'
            } 
            $.ajax({
            url: baseurl+'topics/setstatus',
            type: 'POST', 
            data: 'id='+chkid+'&status='+stat,
            success: function(res){
              location.reload();
            }});
        }
//            stat = 0;
//           if(chkstatus==1){
//               stat = 0;
//           }else{
//               stat = 1;
//           }
//
//           $.ajax({
//               url: baseurl+'topics/setstatus',
//               type: 'POST', 
//               data: 'id='+chkid+'&status='+stat,
//               success: function(res){
//                   location.reload();
//                   /*alert(res);
//                   $('#test_res_'+chkid).html(res);
//                   $('#test_'+chkid).html(stat);
//                  */
//               }});
//        }
        </script>
 