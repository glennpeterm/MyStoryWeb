<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo base_url();?>assets/img/splash_screen_logo.ico">
<title><?php echo lang('contactus_tiltle');?></title>
<link rel="icon" href="<?php echo base_url();?>assets/img/splash_screen_logo.ico">
<link href="<?php echo base_url();?>assets/css/my-story.css" rel="stylesheet" type="text/css">
</head>

<body>

<!--header-->
<?php echo $header;?>
<!--/header-->

<!--content wrapper-->
<div class="content_wrapper">
	<!--title-->
    <div class="contact_title_holder">
    	<div class="contact_title"><?php echo lang('contactus_heading');?></div>
        <div class="clear"></div>
    </div>
    <!--/title-->
    <!--Description-->
    <div class="contact_discription"><?php echo lang('contact_page_discription_1');?>
</br></br>
	</div>
    <!--/Description-->
   
    <!--form holder-->
    <?php 
        $message=$this->session->flashdata('message');
        if($message!=''): ?>
           <div id="succes_message">

           <?php  echo $this->session->flashdata('message'); ?>
           </div>
       <?php endif; ?>  
    <div class="form_wrapper">
      <form class="form-horizontal" role="form" action="<?php echo base_url();?>contactus" method="POST" >
      	<!--<span class="form_validation"><?php echo form_error('contact_name'); ?></span>-->
    	  <input type="text" id="contact_name" name="contact_name" class="form_signeline contact-form" placeholder="<?php echo lang('name');?>" value="<?php echo isset($contact_name) ? $contact_name : set_value("contact_name") ?>">
        
        
       <!-- <span class="form_validation"><?php echo form_error('contact_email'); ?></span>-->
        <input type="text" id="contact_email" name="contact_email" class="form_signeline contact-form" placeholder="<?php echo lang('email');?>"  value="<?php echo isset($contact_email) ? $contact_email : set_value("contact_email") ?>">
        
        <!--<span class="form_validation"><?php echo form_error('contact_message'); ?></span>-->
        <textarea id="contact_message" name="contact_message" class="form_multyline contact-form" placeholder="<?php echo lang('message');?>"><?php echo isset($contact_message) ? $contact_message : set_value("contact_message") ?></textarea>
        
       
        <input onclick=" return validate()" type="submit" id="submit" name="submit" value="<?php echo lang('message_send_button');?>" class="send_btn" />
<!--        <input type="button" value="Send Message" class="send_btn">-->
      </form>
    </div>
    <!--/form holder-->
</div>
<!--/content wrapper-->

<script type="text/javascript">

function validate()
{
    var flag=0;
    $("#contact_name").removeClass("form_validation_style");
    $("#contact_email").removeClass("form_validation_style");
    $("#contact_message").removeClass("form_validation_style");

    if($("#contact_name").val()=='')
    {
      $("#contact_name").addClass("form_validation_style");
      var flag=1;
      
    }



    if($("#contact_email").val()=='')
    {
      $("#contact_email").addClass("form_validation_style");
      var flag=1;
      
    }


    if(!validateEmail($("#contact_email").val()))
    {
      $("#contact_email").addClass("form_validation_style");
      var flag=1;
      
    }


    if($("#contact_message").val()=='')
    {
      $("#contact_message").addClass("form_validation_style");
      var flag=1;
      
    }

    if(flag==1)
    {
     


    return false;
    }
    else
    {

      return true;
    }

}
function validateEmail(sEmail) {
var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
if (filter.test(sEmail)) {
return true;
}
else {
return false;
}
}

</script>
<!--Footer--> 
    <?php echo $footer;?>  