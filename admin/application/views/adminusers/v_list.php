<?=$header;?>
<?=$menu;?>
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/switchery/switchery.min.css">
<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-file-o"></i>
				<span><?=lang('admin_users');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?=lang('home');?></a></li>
                    <li class="active"><?=lang('admin_users');?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
					<!-- BEGIN BASIC DATATABLES -->
                     <?php 
                         $message=$this->session->flashdata('message');
                         if($message!=''): ?>
                            <div class="alert alert-success">

                            <?php  echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?> 
                                        
                    <div class="alert alert-danger" style="display:none;">
                        
					</div>
                    <div class="alert alert-success" style="display:<?php
                    if(isset($msg) && ($msg != '')){
                        echo 'block';
                    }else{
                        echo 'none';
                    }
                    ?>;">
                    <?php
                    if(isset($msg) && ($msg != '')){
                        echo $msg;
                    }
                    ?>
					</div>
                                
					<div class="col-md-12">
						<div class="grid no-border">
							<div class="grid-header">
								<i class="fa fa-table"></i>
								<span class="grid-title"><?=lang('list');?></span>
								<button class="btn btn-primary" type="button" style="float:right;" id="btnAdd"><?php echo lang('add');?></button>

							</div>
							<div class="grid-body">
								<table id="dataTables1" class="table table-hover display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
                                            <th>Status</th>
                                            <th data-defaultsort='disabled' style="background:none;">Action</th>
                                            
										</tr>
									</thead>

									<tbody>
                                        <?php
                                        if(count($adminUsers) > 0){
                                            foreach($adminUsers as $adm){
                                                
                                                $statusChecked = '';
                                                if(isset($adm->status) && ($adm->status == 'active')){
                                                    $statusChecked = ' checked';
                                                }
                                        ?>
                                                <tr id="row_<?=$adm->id;?>">
                                                    <td><?=ucfirst($adm->first_name);?></td>
                                                    <td><?=ucfirst($adm->last_name);?></td>
                                                    <td><?=$adm->email;?></td>
                                                    <td>
                                                    <span style="display:none;"><?=$adm->status;?></span>
                                                    <input type="checkbox" class="js-switch xsmall" id="<?=$adm->id;?>" <?=$statusChecked;?> onchange="changeStatus(<?=$adm->id;?>,'<?=$adm->status;?>')"/>
                                                    </td>
                                                    <td>
                                                        <a href="<?=base_url();?>adminusers/edit/<?=$adm->id;?>" title="<?=lang('txt_edit');?>">
                                                            <i class="fa fa-pencil bg-blue action"></i>
                                                        </a>
                                                        <a onclick=deleteAdmin(<?=$adm->id;?>); href="javascript:void(0);" id="<?=$adm->id;?>" class="deleteIcon" title="<?=lang('txt_delete');?>">
                                                            <i class="fa fa-times bg-red action"></i>
                                                        </a>
                                                        <a href="<?=base_url();?>adminusers/resetUserPassword/<?=$adm->id;?>"  title="<?=lang('reset_password');?>">
                                                            <i class="fa  fa-key bg-orange action"></i>
                                                        </a>
                                                         
                                                    </td>
                                                    
                                                </tr>
										<?php
                                            }
                                        }
                                        ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END BASIC DATATABLES -->
				</div>
				
			</section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
                 <script>
   var pageName = 'user';
   </script>
<?=$footer;?>
<script src="<?=base_url()?>assets/plugins/jquery-datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>assets/js/datatables.js"></script>
<script src="<?=base_url()?>assets/plugins/switchery/switchery.js"></script>
<script>
var delete_failed = '<?=lang('delete_failed');?>';
var deleted = '<?=lang('deleted');?>';
var delete_confirm = '<?=lang('delete_confirm');?>';
$(document).ready(function() {
    
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
$('.switchery').attr('title', txt_status);
    $('#btnAdd').bind('click',function(){
        window.location.href = baseurl+'adminusers/edit';
    });
  
});
 function changeStatus(chkid,chkstatus)
{
     stat = 'inactive';
    if(chkstatus=='active'){
        stat = 'inactive'
    }else{
        stat = 'active'
    } 
    $.ajax({
        url: baseurl+'adminusers/setstatus',
        type: 'POST', 
        data: 'id='+chkid+'&status='+stat,
        success: function(res){
            location.reload();
        }});
}
function deleteAdmin(id){
    if(confirm(delete_confirm)){
        $.ajax({
            url: baseurl+'adminusers/delete',
            type: 'POST', 
            data: 'id='+id,
            success: function(res){
                if(res == 'success'){
                    $('#row_'+id).remove();
                    $('.alert-success').html(deleted);
                    $('.alert-success').show();
                    $('.alert-danger').hide();
                    $('.alert-danger').html('');
                }else{
                    $('.alert-success').html('');
                    $('.alert-success').hide();
                    $('.alert-danger').html(delete_failed);
                    $('.alert-danger').show();
                }
                var posDiv = $('.content-header');
                var scrollPos = posDiv.offset().top;
                $(window).scrollTop(scrollPos);
            }
       });
    }
   
}
    
</script>
