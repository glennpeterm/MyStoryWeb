//variable initialization 
var current_page	=	1;
var loading		=	false;
var oldscroll		=	0;
$(document).ready(function(){
 var baseurl = "<?php echo base_url(); ?>";
  var lang = "<?php echo $lang; ?>";
  alert(baseurl);
	$.ajax({
		'url':'get_data.php',
		'type':'post',
		'data': 'p='+current_page,
		success:function(data){
			var data	=	$.parseJSON(data);
			$(data.html).hide().appendTo('#messages-list').fadeIn(1000);
			current_page++;
		}
	});
	
	$(window).scroll(function() {
		if( $(window).scrollTop() > oldscroll ){ //if we are scrolling down
			if( ($(window).scrollTop() + $(window).height() >= $(document).height()  ) && (current_page <= total_pages) ) {
				   if( ! loading ){
						loading = true;
						//setTimeout(function() {
						     $('#messages-list').addClass('loading');
						//}, 500);
						
						$.ajax({
							'url':'get_data.php',
							'type':'post',
							'data': 'p='+current_page,
							success:function(data){
								var data	=	$.parseJSON(data);
								$(data.html).hide().appendTo('#messages-list').fadeIn(1000);
								current_page++;
								$('#messages-list').removeClass('loading');
								loading = false;
							}
						});	
				   }
			}
		}
	});
	
});
