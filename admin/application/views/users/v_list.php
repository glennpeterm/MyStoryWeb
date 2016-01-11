<?=$header;?>
<?=$menu;?>
<?php
$photo_url = $this->config->item('front_base_url').'uploads/';
?>
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/switchery/switchery.min.css">
<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-file-o"></i>
				<span><?=lang('users');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?=lang('home');?></a></li>
                    <li class="active"><?=lang('users');?></li>
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
                    if($this->session->flashdata('msg') && ($this->session->flashdata('msg') != '')){
                        echo 'block';
                    }else{
                        echo 'none';
                    }
                    ?>;">
                    <?php
                    if($this->session->flashdata('msg') && ($this->session->flashdata('msg') != '')){
                        echo $this->session->flashdata('msg');
                    }
                    ?>
					</div>
                                
					<div class="col-md-12">
						<div class="grid no-border">
							<div class="grid-header">
								<i class="fa fa-table"></i>
								<span class="grid-title"><?=lang('list');?></span>
								
							</div>
							<div class="grid-body">
                                <form class="form-horizontal" role="form">
								<table id="dataTables1" class="table table-hover display" cellspacing="0" width="100%">
									<thead>
										<tr>
											
                                            <th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th data-defaultsort='disabled' style="background:none;">Action</th>
                                            
										</tr>
									</thead>

									<tbody>
                                        <?php
                                        if(count($users) > 0){
                                            foreach($users as $usr){
                                                $photo = ' <img src="'. site_url().'assets/img/photo.png" width="50" height="50" class="img-circle" alt="">';
                                                if($usr->photo != ''){
                                                    $photo = '<img src="'.$photo_url.$usr->photo.'" width="50" height="50">';
                                                }
                                                $statusChecked = '';
                                                if(isset($usr->status) && ($usr->status == 'active')){
                                                    $statusChecked = ' checked';
                                                }
                                        ?>
                                                <tr id="row_<?=$usr->id;?>">
                                                    
                                                    <td><span class="list_profilepic"><?=$photo;?></span><?=ucfirst($usr->first_name);?></td>
                                                    <td><?=ucfirst($usr->last_name);?></td>
                                                    <td><?=$usr->email;?></td>
                                                    <td><?=$usr->date_created;?></td>
                                                    <td>
                                                    <span id="user-status-<?=$usr->id;?>" style="display:none;"><?=$usr->status;?></span>
                                                    <input type="checkbox" class="js-switch xsmall" id="<?=$usr->id;?>" <?=$statusChecked;?> onchange="changeStatus(<?=$usr->id;?>,'<?=$usr->status;?>')"/>
                                                    </td>
                                                    <td>
                                                        <a href="<?=base_url();?>users/view/<?=$usr->id;?>" class="" title="<?=lang('txt_view');?>">
                                                            <i class="fa fa-eye bg-yellow action"></i>
                                                        </a>
                                                        <a href="<?=base_url();?>users/edit/<?=$usr->id;?>" title="<?=lang('txt_edit');?>">
                                                            <i class="fa fa-pencil bg-blue action"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="deleteIcon" onclick="deleteUser(<?=$usr->id;?>);" title="<?=lang('txt_delete');?>">
                                                        
                                                            <i class="fa fa-times bg-red action"></i>
                                                        </a>
                                                        
                                                        <!--<a href="<?=base_url();?>users/resetUserPassword/<?=$usr->id;?>"  title="<?=lang('reset_password');?>">
                                                            <i class="fa  fa-key bg-orange action"></i>
                                                        </a>-->
                                                       
                                                    </td>
                                                </tr>
										<?php
                                            }
                                        }
                                        ?>
									</tbody>
								</table>
                                </form>
							</div>
						</div>
					</div>
					<!-- END BASIC DATATABLES -->
				</div>
				
			</section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
        <form action="setstatus" method="POST" name="changeStatusForm" id="changeStatusForm">
        <input type="hidden" name="status" id="status">
        <input type="hidden" name="id" id="id">
        </form>
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
var status_changed = '<?=lang('status_changed');?>';
var status_change_error = '<?=lang('status_change_error');?>';

    $('#btnAdd').bind('click',function(){
        window.location.href = baseurl+'users/edit';
    });
        
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
elems.forEach(function(html) {
  var switchery = new Switchery(html);
});

var clickCheckbox = document.querySelector('.js-switch'),clickButton = document.querySelector('.switchery');
var stat = '';

      
$('.switchery').attr('title', txt_status);    
    
      


function changeStatus(chkid,chkstatus)
{
     stat = 'inactive';
    if(chkstatus=='active'){
        
        $('#user-status-'+chkid).html('inactive');
        stat = 'inactive'
    }else{
         $('#user-status-'+chkid).html('active');
        stat = 'active'
    }

    $('#status').val(stat);
    $('#id').val(chkid);
    changeStatusForm.submit();
   
}

function deleteUser(id){
    if(confirm(delete_confirm)){
        $.ajax({
            url: baseurl+'users/delete',
            type: 'POST', 
            data: 'id='+id,
            success: function(res){
                if(res == 1){
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
