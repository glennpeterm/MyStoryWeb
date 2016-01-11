<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Channels_listing</title>
<link href="<?php echo base_url();?>assets/css/movile_html_view.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400' rel='stylesheet' type='text/css'>
<script src="<?php echo base_url();?>assets/plugins/jquery-2.1.0.min.js"></script>

</head>

<body>
<div class="header_wrapper">
<!--heading-->
<div class="heading_holder">Watch</div>
<!--/ heading-->
<!--filter-->

<div class="filter_holder">
    
    <div class="filter_form_holder">
        <div class="newhalfborder">
<div>
<div class="select-style">
 <select id="topics" onchange="keywordserach();">
   <option value="all">All Topics</option>
           <?php foreach($topics as $topic) {?>
            <option  value="<?php echo $topic->topic_id;?>"><?php echo $topic->topic_name;?></option>
           <?php }?>
 </select>
</div>
</div>
</div>
<!--           <div class="halfborder">
            <div>
                <div id="dd" class="wrapper-dropdown-2" tabindex="1" ><span id="drp_val">Choose Channels</span>
                    <ul class="dropdown">
                         <li onclick="filtering('all','All')">All</li>
                         <?php //foreach($topics as $topic) {?>
                        <li onclick="filtering(<?php //echo $topic->topic_id;?>,'<?php //echo $topic->topic_name;?>')"><?php //echo $topic->topic_name;?></li>                       
                           <?php //}?>
                        
                    </ul>
                </div>
            </div>
        </div>-->
    </div>
<!--    <div class="filter_form_holder"><select style="width:100%"></select></div>-->
    <div class="filter_form_holder">
      <div class="halfborder">
            <div class="textareaKeeper"><textarea id="keyword" wrap="off" style="overflow:hidden;" onkeyup="keywordserach();" placeholder="Search keyword"></textarea></div>
        </div>  
<!--        <input id="keyword" onkeyup="keywordserach(this.value);" type="text" style="width:100%; border:none; border-left:1px solid #cbcbcb; border-right:1px solid #cbcbcb; border-bottom:1px solid #cbcbcb;padding:0px 5px 5px 5px; outline:none;">-->
    </div>
    <input type="hidden" id="search_keyword">
        <input type="hidden" id="filter_topic_id">
        <input type="hidden" id="result_count">
    <div class="clear"></div>
    
</div>
<!--/ filter-->
</div>
<!--container-->
<div class="contaier_list_holder">
	<!--list holder-->
       
	<!--/ list holder-->
    </div>
<!--/ container-->
</body>
<script type="text/javascript">
    
   
    //variable initialization 
    var current_page	=	1;
    var loading		=	false;
    var oldscroll       =	0;
    var total_pages	=	<?php echo $total_pages; ?>;
    var baseurl = "<?php echo base_url(); ?>";
    var lang = "<?php echo $lang; ?>";

$(document).ready(function(){
  
  $.ajax({
		'url':baseurl+'mobile_view/listing/',
		'type':'POST',
		'data': 'p='+current_page+'&lang='+lang+'&type=start',
		success:function(data){
                   // alert(data);
                        var data	=	$.parseJSON(data);
			$(data.html).hide().appendTo('.contaier_list_holder').fadeIn(1000);
			current_page++;
                        $('#result_count').val(data.count);  
		}
	});
      });    
        


    
    function keywordserach()
    {
      
             current_page	=	1;
            var loading		=	false;
            var oldscroll	=	0;
            var baseurl = "<?php echo base_url(); ?>";
            var lang = "<?php echo $lang; ?>";
            
         // if(keyword != '')
         //   {
                 var topic_id = $("#topics").val();
                 var keyword = $("#keyword").val();

                $.ajax({
                   url: baseurl+'mobile_view/listing/',
                   type: 'POST', 
                   data: 'p='+current_page+'&keyword='+keyword+'&lang='+lang+'&topic_id='+topic_id,
                   success: function(data){ 

                       var data	=	$.parseJSON(data);

                       $('.contaier_list_holder').html(data.html);
                       $('#search_keyword').val(keyword);
                       $('#filter_topic_id').val(topic_id);
                       $('#result_count').val(data.count);                    
                        current_page++;


                   }
               });
           // }
       }
       
     $(window).scroll(function() 
     {
            
          var topicid= $('#filter_topic_id').val();
          var keyword= $('#search_keyword').val();
          var total_pages =  $('#result_count').val();  
      
        
         var ajax_data = 'p='+current_page+'&lang='+lang+'&keyword='+keyword+'&topic_id='+topicid;

		if( $(window).scrollTop() > oldscroll ){ //if we are scrolling down
			if( ($(window).scrollTop() + $(window).height() >= $(document).height()  ) && (current_page <= total_pages) ) {
				   if( ! loading ){
                                       
                                      // alert('hh');
                                      // console.log('topicid'+topicid);
                                       
                                        //console.log('data'+ajax_data);
						loading = true;
						//setTimeout(function() {
						     $('.contaier_list_holder').addClass('loading');
						//}, 500);
						
						$.ajax({
							'url':baseurl+'mobile_view/listing/',
							'type':'post',
							'data': ajax_data,
							success:function(data){
                                                                
                                                                //console.log(data);
								var data	=	$.parseJSON(data);
               	$(data.html).hide().appendTo('.contaier_list_holder').fadeIn(1000);
								current_page++;
								$('.contaier_list_holder').removeClass('loading');
								loading = false;
							}
						});	
				   }
			}
		}
	});
  
    </script>
   <script type="text/javascript">

			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-2').removeClass('active');
				});

			});

		</script>

</body>
</html>
