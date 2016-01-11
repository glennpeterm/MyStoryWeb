<!doctype html>
<html><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo base_url();?>assets/img/splash_screen_logo.ico">
<title><?php echo lang('page_title');?> | <?php echo lang('search_page_title');?></title>
<link href="<?php echo base_url();?>assets/css/my-story.css" rel="stylesheet" type="text/css">
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->


</head>

<body>
<?php echo $header;?>

<!--content wrapper-->
<div class="content_wrapper">
	<!--title-->
    <div class="search_title_holder">
    	<div class="search_title"><?php echo lang('search_title_tags');?> <span><?php echo '"'.$tagname.'"';?></span></div>
         <?php
         if($result_count>0){
          ?>
        <div class="search_no"><?php echo $result_count;?> <?php echo lang('results');?></div>
        <?
        }?>
        <div class="clear"></div>
    </div>
        <input type="hidden" id="result_count" value="<?php echo $total_pages;?>">
        <input type="hidden" id="keyword" value="<?php echo $keyword;?>">
    <!--/title-->
    <!--search list holder-->
    <div class="search_video_list_holder">
    	
            
            <div id="pop1" class="simplePopup">

            </div>

        <!--/list video-->
        <!--list video-->
        <div class="list_holder">
        <?php 
        if($result_count>0){
                      
        foreach($result_videos as $results){
        ?>
        <div class="search_video_list" onclick="assignId(<?php echo  $results->video_id ;?>)">
        	<div><img src="https://i.ytimg.com/vi/<?php echo $results->video_youtube_id;?>/sddefault.jpg"></div>
        	      <div class="vdetails">
                    <h3><?php echo substr($results->video_title,0,10);if(strlen($results->video_title)>10) {?> .....<?php }?></h3>
                    <p><?php echo substr($results->video_short_desc ,0,20);if(strlen($results->video_short_desc )>20) {?> .....<?php }?></p>
                </div>
            </div>
        <?php } }else{?>
            <div id="no_result"><?php echo lang('no_results');?></div>
        <?php } ?>
        <!--/list video-->
        </div>
        
        <div class="clear"></div>
    </div>
    <!--/search list holder-->

</div>
<!--/content wrapper-->
<!-- Video Loading -->
<div class="videobuffring">
<img src="<?php echo base_url();?>assets/img/loading002.gif">
</div>
<!-- /Video Loading -->
<?php echo $footer;?>  
<!--VIDEO POPUPs-->
<script src="<?php echo base_url();?>assets/js/jquery.simplePopup.js" type="text/javascript"></script>
<script type="text/javascript">
    var current_page    = 2;
    var loading		=	false;
    var oldscroll	=	0;
            $(window).scroll(function() {
           var baseurl = "<?php echo base_url(); ?>";
           var keyword= $('#keyword').val();
          var total_pages =  $('#result_count').val();  
         
              var ajax_data = 'p='+current_page+'&keyword='+keyword;
        		if( $(window).scrollTop() > oldscroll ){ //if we are scrolling down
			if( ($(window).scrollTop() + $(window).height() >= $(document).height()  ) && (current_page <= total_pages) ) {
				   if( ! loading ){
                                                                              
                                                                          
						loading = true;
						$('.videobuffring').show();							
						$.ajax({
							'url':baseurl+'videos/tag_based_video_listing/',
							'type':'post',
							'data': ajax_data,
							success:function(data){
                                                                
								var data	=	$.parseJSON(data);
                                                                $(data.html).hide().appendTo('.list_holder').delay(500).fadeIn(2000);
								current_page++;								
                                                                $('.videobuffring').delay(500).fadeOut( 400 );
								loading = false;
								
							}
						});	
                                                
				   }
			}
		}
                
  
	});
  function assignId(id)
    {
        
        var baseurl = "<?php echo base_url(); ?>";    
        var wi = $(window).width(); 
        if(wi < 700)
        {
            window.location = baseurl+'videos/video_details/'+id;           
        }
        else
        {
            $.ajax({
                    'url':baseurl+'videos/video_popup/',
                    'type':'post',
                    'data': 'video_id='+id,
                    success:function(data){
                      //alert(data);
                            $('.simplePopup').html(data); 
                            $('#pop1').simplePopup();

                    }
            });	
        }                                         
             
    } 
</script>


<!--/VIDEO POPUPs-->

