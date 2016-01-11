<?=$header;?>
<?=$menu;?>
<?php
$title = lang('add');
if(isset($id) && $id > 0){
    $title = lang('txt_edit');
}

$action = $this->input->post('action');
$first_name = (isset($details->first_name) && $details->first_name != '') ? $details->first_name : '';
$last_name = (isset($details->last_name) && $details->last_name != '') ? $details->last_name : '';
$gender = (isset($details->gender) && $details->gender != '') ? $details->gender : '';
$address = (isset($details->address) && $details->address != '') ? $details->address : '';
$phone = (isset($details->phone) && $details->phone != '') ? $details->phone : '';
$email = (isset($details->email) && $details->email != '') ? $details->email : '';
$dob = (isset($details->dob) && $details->dob != '') ? $details->dob : '';
if(isset($details->country) && $details->country != '') { $country =$details->country ;};
$state = (isset($details->state) && $details->state != '') ? $details->state : '';
$city = (isset($details->city) && $details->city != '') ? $details->city : '';
$zipcode = (isset($details->zipcode) && $details->zipcode != '') ? $details->zipcode : '';
if($dob =='0000-00-00')
{
    $dob = '';
}

if(isset($action) && ($action == 'save')){
    $first_name = set_value('first_name');
    $last_name = set_value('last_name');
    $gender = set_value('gender');
    $address = set_value('address');
    $phone = set_value('phone');
    $email = set_value('email');
    $dob = set_value('dob');
    $country = set_value('country');
    $state = set_value('state');
    $city = set_value('city');
    $zipcode = set_value('zipcode');
    
}

?> 
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2.css">
<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-file-o"></i>
				<span><?=lang('users');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?=lang('home');?></a></li>
                    <li><a href="<?=site_url('users');?>"><?=lang('users');?></a></li>
                    <li class="active"><?=$title;?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
                    <?php
                    if(isset($errorMsg) && ($errorMsg != '')){
                        echo '<div class="alert alert-danger">'.$errorMsg.'</div>';
                    }
                    ?>
					<!-- BEGIN BASIC ELEMENTS -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title"><?=$title;
?></span>
							</div>
							<div class="grid-body">
								<form id="frmUserEdit" role="form" class="form-horizontal" method="post" action="<?=site_url('users/save');?>" enctype='multipart/form-data'>
                                    <input type="hidden" name="language" value="<?=$this->config->item('language');?>">
                                    <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{echo 0;} ?>">
                                    <input type="hidden"  name="action" value="save">
									<div class="form-group">
										<label class="col-sm-3 control-label"><?=lang('first_name');?></label>
										<div class="col-sm-7">
											<input type="text" placeholder="<?=lang('first_name');?>" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>">
                                            <?php
                                            if(form_error('first_name') != ''){
                                            ?>
                                                <label class="error"><?php echo form_error('first_name'); ?></label>
                                            <?php
                                            }
                                            ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><?=lang('last_name');?></label>
										<div class="col-sm-7">
											<input type="text" placeholder="<?=lang('last_name');?>" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name; ?>">
                                            <?php
                                            if(form_error('last_name') != ''){
                                            ?>
                                                <label class="error"><?php echo form_error('last_name'); ?></label>
                                            <?php
                                            }
                                            ?>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label"><?=lang('email');?></label>
										<div class="col-sm-7">
											<input type="text" placeholder="<?=lang('email');?>" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                                            <?php
                                            if(form_error('email') != ''){
                                            ?>
                                                <label class="error"><?php echo form_error('email'); ?></label>
                                            <?php
                                            }
                                            ?>
										</div>
									</div>
                                    <?php
                                    $male_checked = ' checked="checked" ';
                                    $female_checked = '';
                                    if(isset($gender) && $gender == 'female'){
                                        $female_checked = ' checked="checked" ';
                                        $male_checked = '';
                                    }
                                    ?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label"><?=lang('gender');?></label>
										<div class="col-sm-7">
											<label class="radio-inline"><input type="radio" name="gender" class="icheck" value="male" <?=$male_checked;?>> <?=lang('male');?></label>
											<label class="radio-inline"><input type="radio" name="gender" class="icheck" value="female" <?=$female_checked;?>> <?=lang('female');?></label>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label"><?=lang('address');?></label>
										<div class="col-sm-7">
											<input type="text" placeholder="<?=lang('address');?>" class="form-control" name="address" id="address" value="<?php echo $address; ?>">
                                            <?php
                                            if(form_error('address') != ''){
                                            ?>
                                                <label class="error"><?php echo form_error('address'); ?></label>
                                            <?php
                                            }
                                            ?>
										</div>
									</div>
                                            <div class="form-group">
                                                           <label class="col-sm-3 control-label"><?=lang('phone');?></label>
                                                           <div class="col-sm-7">
                                                                   <input type="text" placeholder="<?=lang('phone');?>" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>">
                                                                   <?php
                                                                   if(form_error('phone') != ''){
                                                                   ?>
                                                                       <label class="error"><?php echo form_error('phone'); ?></label>
                                                                   <?php
                                                                   }
                                                                   ?>
                                                           </div>
                                                   </div>
                                    

                                             <div class="form-group">
                                                  <label class="col-sm-3 control-label"><?=lang('dob');?></label>
                                                
                                                  <div class="col-sm-7">
                                                          <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3">
                                                             
                                                              <?php if($dob!='')
                                                              {
                                                                  $dob= date('d-m-Y', strtotime($dob)); 
                                                              }
                                                              else{
                                                                   $dob= '';
                                                              }
                                                              ?>
                                                              <input type="text" class="form-control" value="<?php echo $dob; //echo date('d-m-Y', strtotime($dob)); ?>">
                                                              <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                                      </div>
                                                      <input type="hidden" name="dob" id="dtp_input3" value="<?php echo $dob;?>" />
                                                       <?php
                                                        if(form_error('dob') != ''){
                                                        ?>
                                                            <label class="error"><?php echo form_error('dob'); ?></label>
                                                        <?php
                                                        }
                                                        ?>
                                                  </div>
                                          </div>
                                  
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?=lang('country');?></label>
                                        
                                        <div class="col-sm-7">
                                            
                                        <select id="e1" name="country" id="country">
                                             <option value="select">Select Country</option>
                                            <?php foreach ($country_list as $list) {
                                                 $selected = "";
                                                if(isset($country)&& ($country!=''))
                                                {
                                                    if($country ==$list->country_id )
                                                    {
                                                    $selected = "selected";
                                                    }
                                                }
                                              ?>
                                            <option value="<?php echo $list->country_id;?>" <?php echo $selected;?>><?php echo $list->name;?></option>
                                            
                                              
                                                                                                        
                                            <?php }?>
                                            
                                                
                                        </select>
                                            <br>
                                       <?php
                                        if(form_error('country') != ''){
                                        ?>
                                            <label class="error"><?php echo form_error('country'); ?></label>
                                        <?php
                                        }
                                        ?>
                                        </div>
				</div>
                                      <div class="form-group">
                                                  <label class="col-sm-3 control-label"><?=lang('state');?></label>
                                    <div class="col-sm-7">
                                        <input type="text" placeholder="<?=lang('state');?>" class="form-control" name="state" id="state" value="<?php echo $state; ?>">
                                        <?php
                                        if(form_error('state') != ''){
                                        ?>
                                         <label class="error"><?php echo form_error('state'); ?></label>
                                        <?php
                                        }
                                        ?>
                                      </div>
                                     </div>
                                     <div class="form-group">
                                                  <label class="col-sm-3 control-label"><?=lang('city');?></label>
                                     <div class="col-sm-7">
                                        <input type="text" placeholder="<?=lang('city');?>" class="form-control" name="city" id="city" value="<?php echo $city; ?>">
                                        <?php
                                        if(form_error('city') != ''){
                                        ?>
                                         <label class="error"><?php echo form_error('city'); ?></label>
                                        <?php
                                        }
                                        ?>
                                      </div>
                                                  </div>
                                    <div class="form-group">
                                                  <label class="col-sm-3 control-label"><?=lang('zipcode');?></label>
                                    <div class="col-sm-7">
                                        <input type="text" placeholder="<?=lang('zipcode');?>" class="form-control" name="zipcode" id="zipcode" value="<?php echo $zipcode; ?>">
                                        <?php
                                        if(form_error('zipcode') != ''){
                                        ?>
                                         <label class="error"><?php echo form_error('zipcode'); ?></label>
                                        <?php
                                        }
                                        ?>
                                      </div>
                                                       </div>
                                    
                                   
                                    <div class="form-group">
                                                <label class="col-sm-3 control-label"><?=lang('photo');?></label>
                                                <div class="col-sm-7">
                                                        <input type="file" name="userfile" id="photo" value="">
                                                </div>
                                        </div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label">&nbsp;</label>
										<div class="col-sm-7">
											<div class="btn-group">
                                                <button class="btn btn-primary" name="submit" type="submit"><?=lang('save');?></button>
                                                <?php
                                                if(isset($id) && $id == 0){
                                                ?>
                                                    &nbsp;<button class="btn btn-primary" name="submit_notify" type="submit"><?=lang('save_notify');?></button>
                                                <?php
                                                }
                                                ?>
                                            </div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- END BASIC ELEMENTS -->
				</div>
				
			</section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
                 <script>
   var pageName = 'user';
   </script>
<?=$footer;?>
<script>
   
//validation messages    
var first_name_err = '<?=lang('first_name_err');?>';
var last_name_err = '<?=lang('last_name_err');?>';
var email_err = '<?=lang('email_err');?>';
</script>
<script src="<?=base_url()?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?=base_url()?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url()?>assets/plugins/select2/select2.js"></script>
<script src="<?=base_url()?>assets/js/user-validation.js"></script>
<script>
$(document).ready(function() { $("#e1").select2(); });
</script>
<script type="text/javascript">
    /* ICHECK */
    $('.icheck').iCheck({
        
        radioClass: 'iradio_square-blue',
        increaseArea: '10%' // optional
    });
    /* DATE PICKER  */
	$('.form_date').datetimepicker({
                 maxDate: 0 ,
                defaultDate: new Date(),
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
                 
	});
	
  
</script>
