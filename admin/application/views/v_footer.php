	<div class="scroll-to-top"></div>
		<!-- END SCROLL TO TOP -->
	</div>

	<!-- BEGIN JS FRAMEWORK -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-2.1.0.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- END JS FRAMEWORK -->
	
	<!-- BEGIN JS PLUGIN -->
	<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-totemticker/jquery.totemticker.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-resize/jquery.ba-resize.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-blockui/jquery.blockUI.min.js"></script>
	<!-- END JS PLUGIN -->

	<!-- BEGIN JS TEMPLATE -->
	<script src="<?php echo base_url();?>assets/js/main.js"></script>
	<script src="<?php echo base_url();?>assets/js/skin-selector.js"></script>
	<!-- END JS TEMPLATE -->
    
    <script src="<?php echo base_url();?>assets/plugins/icheck/icheck.min.js"></script>
    <!-- BEGIN JS COMMONS -->
    <script src="<?php echo base_url();?>js/common.js"></script>
     <script>
       
$(document).ready( function()
    {

    	if (typeof pageName != 'undefined') 
    	{
        	$('#'+pageName+'-leftmenu').addClass("active");
        	$('#'+pageName+'-leftmenu .sub-menu').slideToggle();
        }	

    });
</script>
</body>
</html>
