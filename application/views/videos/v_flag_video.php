	  <!-- BEGIN CSS TEMPLATE -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins.css">
  <!-- END CSS TEMPLATE -->
	  <section class="content">
		<div class="row">
			<!-- BEGIN FORM WIZARD -->
			<form>
			<div class="col-md-12">
				<div class="grid">
					<div class="grid-header">
						<i class="fa fa-align-left"></i>
						<span class="grid-title">Report this video</span>
						<div class="pull-right grid-tools">
							<a id="remove-popup" data-widget="remove" title="Remove" class="popupClose"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="grid-body">
						<div id="rootwizard">
							
							<div class="tab-content" style="margin-top: 0px; padding-bottom:0px;">
								<!-- BEGIN BASIC INFO -->
								<div class="tab-pane active" id="tab1">
								<div style="margin-bottom:15px;">Need to report the video?</div>
								<div style="margin-bottom:10px;">Please provide your contact information</div>
									<div class="form-horizontal">
										<div class="form-group">
											<div class="col-sm-6 no-padding">
												<input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6 no-padding">
												<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6 no-padding">
												<input type="text" name="email" id="email" class="form-control" placeholder="Email">
											</div>
										</div>
									</div>
								</div>
								<!-- END BASIC INFO -->
								<!-- BEGIN PROFILE DETAIL -->
								<div class="tab-pane" id="tab2">
									<div class="form-horizontal">
										<div class="form-group">
											<div class="clear" style="margin-bottom:10px;">What is the issue?</div>
											<div class="col-sm-7 no-padding">
												<select class="form-control" onchange="showTextArea(this.value)" name="issueType" id="issueType">
													<option value="">Select Any Issue</option>
													<?php
													//print_r($issues);
													foreach($issues as $issues)
													{?>
														<option value="<?php echo $issues->flag_id;?>"><?php echo $issues->flag_issue;?></option>
														<?php
														
													}?>
												</select>
											</div>
										</div>
										<div id="additional_details" style="display:none;" class="form-group">
											<div style="margin-bottom:10px;">Please provide additional details about this issue.</div>
                                           
											<div class="col-sm-7  no-padding">
												<textarea maxlength="100" name="addilCmts" id="addilCmts"   rows="2" class="form-control"></textarea>
											</div>
											<div id="countdown" style="clear:both;">characters remaining</div>
											
										</div>
										
									</div>
								</div>
								<div id="tab4"></div>
								<!-- END PROFILE DETAIL -->
								<div class="tab-pane" id="tab3">
									<div class="finish">
										<h3 class="clear" style="margin-top: 10px; margin-bottom: 26px;">Thank you for submitting your report. Here is the information we received from you.</h3>
										<h4 style="color:rgb(235, 122, 0)">Contact Information:</h4>
										<div><span id="finish_firstname"></span>&nbsp;<span id="finish_lastname"></span></div>
										<div><span id="finish_email"></span></div>
										<h4 style="color:rgb(235, 122, 0)">Issue Reported:</h4>
										<div><span id="finish_issue"></span></div>
										<div><span id="finish_cmts"></span></div>

									</div>
								</div>
								<div id="flag-message" style="padding-top: 15px;font-size: 14px;line-height: 25px;">Flagged videos are reviewed by My Story team to determine whether they violate our Terms and Conditions. Videos found to be violeting our guidelines are either unpublished or deleted from the My Story website and Youtube depending on the severity of the reported issue.</div>
								
								<!-- BEGIN WIZARD NAVIGATION -->
								<ul class="pager wizard no-padding" style="margin-bottom: 0px;">
									<li class="next pop-next" ><a>Next</a></li>
									<li class="next pop-submit" style="display:none;"  ><a>Submit</a></li>
								</ul>
								<input type="hidden" name="video_id" id="video_id" value="<?php echo $id;?>">
								<!-- END WIZARD NAVIGATION -->
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- END FORM WIZARD -->
		</div>
	</section>
	<script type="text/javascript">
	
	$(".pop-submit").on("click", function (event) {
		
         
		var baseurl = "<?php echo base_url(); ?>"; 
		flag = 0;
		var video_id = $('#video_id').val();
		var fname = $('#firstname').val();
        var lname = $('#lastname').val();
        var email = $('#email').val();
		var issueTypeVal = $('#issueType').val();
		var addilCmts = $('#addilCmts').val();
		if (issueTypeVal == '')
        {
            $('#issueType').addClass('validate_error');
            flag = 1;
        }
        else
        {
            $('#issueType').removeClass('validate_error');
        }


         if(flag == 1)
        {

        	return false;
        }
        else
        {
var wi = $(window).width(); 
        if(wi < 700)
        {
window.scrollTo(0, 0);
}
        	$('#tab2').removeClass('active');
		$('#flag-message').hide('');
		$(".pop-submit").hide();
		$('#tab4').html('<div style="min-height:150px; text-align:center; margin:20px auto;"><img src="<?php echo base_url();?>assets/img/loading002.gif"></div>');
        	 $.ajax({
	            type: 'post',
	            url: baseurl+'videos/addflag',
	            data: { 
	            		video_id: video_id,
	            		fname: fname,
	            		lname: lname,
	            		email: email,
	            		issueTypeVal: issueTypeVal,
	            		addilCmts: addilCmts
	            		  },
	            success: function(results) {

	            	$('#finish_firstname').text(fname);
	            	$('#finish_lastname').text(lname);
	            	$('#finish_email').text(email);
	            	$('#finish_issue').text($( "#issueType option:selected" ).text());
	            	$('#finish_cmts').text(addilCmts);

	            	$('#tab4').html('');
	            	$('#flag-message').show('');
	            	$('#tab3').addClass('active');
		        	$(".pop-submit").hide();
		        	
		        	
	            }
	        }); // end ajax
        }


	});

	$(".pop-next").on("click", function (event) {

			flag = 0;
    	var fname = $('#firstname').val();
        var lname = $('#lastname').val();
        var email = $('#email').val();
        var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    	if (fname == '')
        {
            $('#firstname').addClass('validate_error');
            flag = 1;
        }
        else
        {
            $('#firstname').removeClass('validate_error');
        }

        if (lname == '')
        {
            $('#lastname').addClass('validate_error');
            flag = 1;
        }
        else
        {
            $('#lastname').removeClass('validate_error');
        }

        if (email == '')
        {
            $('#email').addClass('validate_error');
            flag = 1;
        }
        else
        {
            if (!pattern.test(email))
            {
                $('#email').addClass('validate_error');
                flag = 1;
            }
            else
            {
                $('#email').removeClass('validate_error');
            }
        }

        if(flag == 1)
        {

        	return false;
        }
        else
        {
var wi = $(window).width(); 
		if(wi < 700)
        {
window.scrollTo(0, 0);
}
        	$('#tab1').removeClass('active');
        	$('#tab2').addClass('active');
        	$(".pop-next").hide();
        	$(".pop-submit").show();
        }
	});


var text_max = 100;
$('#countdown').html(text_max + ' characters remaining');

$('#addilCmts').keyup(function() {
var text_length = $('#addilCmts').val().length;
var text_remaining = text_max - text_length;

$('#countdown').html(text_remaining + ' characters remaining');
});


$("#remove-popup").on("click", function (event) {

$("#pop1").html('');
});


function showTextArea(type)
{

if(type!='')
{
	$("#additional_details").show();

}
else
{
	$("#additional_details").hide();
}

}

</script>

