

<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatables/css/dataTables.bootstrap.css">
<style type="text/css">
        pre {
    white-space: -moz-pre-wrap; /* Mozilla, supported since 1999 */
    white-space: -pre-wrap; /* Opera */
    white-space: -o-pre-wrap; /* Opera */
    white-space: pre-wrap; /* CSS3 - Text module (Candidate Recommendation) http://www.w3.org/TR/css3-text/#white-space */
    word-wrap: break-word; /* IE 5.5+ */
    font-family: 'PT Sans', sans-serif;
    font-size: 14px;
}
</style>
<?php echo $menu;?><aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->	
                        
                        
			<section class="content-header">
				<i class="fa fa-envelope-o"></i>
				<span><?php echo lang('inbox');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
					 <li class="active"><?=lang('inbox');?></li>
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
								<span class="grid-title"><?php echo lang('inbox_details');?></span>
								
							</div>
							<div class="grid-body">
								<table id="dataTables2" class="table table-hover display" cellspacing="0" width="100%">
									<thead>
                                                                            
                                                                            <tr>
                                                                                    
                                                                                        <th>Status</th>
											<th><?php echo lang('name');?></th>
											
											<th><?php echo lang('message');?></th>
                                                                                        <th data-defaultsort='disabled' style="background:none;display: none;" ></th>
                                                                                        
                                                                                        <th><?php echo lang('email');?></th>
											<th><?php echo lang('date');?></th>
                                                                                        <th data-defaultsort='disabled' style="background:none;"><?php echo lang('action');?></th>
                                                                                       
											
										</tr>
									</thead>

									<tbody>
                                                                        
                                                                           <?php if(isset($inbox_mails))
                                                                                { 

                                                                                    foreach ($inbox_mails as $results):?>
                                                                             <?php  if($results->status==0)
                                                                                    {
                                                                                    $style='class="mailread"';
                                                                                    $status_label = 'New';
                                                                                    $status_label_class = 'label label label-primary';
                                                                                    }
                                                                                    elseif($results->status==1) 
                                                                                    {
                                                                                     $style='class=" "';
                                                                                     $status_label = 'Read';
                                                                                     $status_label_class = 'label label-warning';
                                                                                    
                                                                                    }
                                                                                    elseif($results->status==2) 
                                                                                    {
                                                                                     $style='class=" "';
                                                                                     $status_label = 'Replied';
                                                                                     $status_label_class = 'label label-success';
                                                                                     
                                                                                    }

                                                                                                ?>
												
                                                                           
										<tr <?php echo $style;?> id="<?php echo $results->inbox_id;?>" >
                                                                                 
                                                                                    <td> <span id="mail_status_<?php echo $results->inbox_id;?>" class="<?php echo $status_label_class;?>" style="font-size:0.7em; font-weight: bold"><?php echo $status_label;?></span> </td>
                                                                                    
											<td>
                                                                                          <?php echo $results->inbox_name ;?> </td>
											
                                                                                        
                                                                                        <td id="msg_<?php echo $results->inbox_id;?>"><?php echo substr($results->inbox_message,0,20); if(strlen($results->inbox_message)>20) {?> .....<?php }?></td>
                                                                                        <td style="display: none;"><pre><?php echo $results->inbox_message;?></pre></td>
											
                                                                                        <td><a href="mailto:<?php echo $results->inbox_email;?>?Subject=Reply" target="_top"><?php echo $results->inbox_email;?></a></td>
                                                                                        <td><?php echo $results->added_date;?></td>
                                                                                        <input type="hidden" class="inboxid" name="inboxid_<?php echo $results->inbox_id;?>">
                                                                                   	<td > 
                                                                                            
                                                                                            <?php $url=  site_url('inbox/delete/'.$results->inbox_id);?>
                    
                                                                                            <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $results->inbox_id;?>)"  class="deleteIcon" >
                                                                                            <li class="fa fa-times bg-red action"></li> </a>                                                     
                                                        
                                                                                       
                                                                                        </td>
<!--                                                                                        <td> <a style="color: #fff" class="btn btn-block btn-primary" onclick="reply_popup('<?php echo $results->inbox_name;?>','<?php echo $results->inbox_email;?>')" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;REPLY</a></td>-->
											
										</tr>
										<?php  endforeach; } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                                    

					<!-- END ROW DETAILS -->
				</div>
                            </section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
             <?php echo $footer;?>   
                
         <script>
             
             
             var baseurl = "<?php echo base_url(); ?>";
              //delete function for inbox mail
            function confirmDelete(id) 
            {
              if (confirm(delete_confirmation)) {

                   window.location = baseurl+'inbox/delete/'+id;

              }
               else
                  return false;
            }
</script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/inbox_datatables.js"></script>
    <script>
        //functin for changing mailbox status
        function mailboxread(inboxid)
        {
            
            var formData = {id:inboxid}; 
            $.ajax({
            type: "POST",
            url: baseurl+'inbox/mailboxread',
            data: formData,

            success: function(result)
                    {
                
                        if(result==0)
                        {
                            $('#emailcount').text('');
                        }
                        else{
                        $('#emailcount').text(result);
                        }

                        $("#"+inboxid).removeClass("mailread");
                        if( $( "#mail_status_"+inboxid ).hasClass( "label label label-primary" ))
                        {

                        $( "#mail_status_"+inboxid ).removeClass( "label label label-primary" );
                        $( "#mail_status_"+inboxid ).addClass( "label label-warning" );               
                        $( "#mail_status_"+inboxid ).text('Read');
                        }
           
            
                    }
            }); 
            
        }
       /* function reply_popup(inboxname,inboxemail)
        {            
            
            $('#inbox_name').val(inboxname);
            $('#email_to').text(inboxemail);
        }
        */
     
   

    $('#submit').click(function() {
      
       var email_message = $('#email_message').val();
       if(email_message=='')
       {
           $('#emaiil_val').text('Please Fill The Message Field');
           return false;
       }
       else
       {          
          $("#replyform").submit();
         
       }
       
       
    });

        </script>