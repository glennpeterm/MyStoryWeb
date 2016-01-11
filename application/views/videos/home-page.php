<!DOCTYPE html>
<html lang="en-US">
<head>

<title><?php echo lang('page_title');?> | <?php echo lang('home_page_title');?></title>

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="google-site-verification" content="NjiLoe3Au7E-i8TDyHMqVdk4NkYXEaLPTbZHUpJDh7c" />
<link rel="icon" href="<?php echo base_url();?>assets/img/splash_screen_logo.ico">
<link href="<?php echo base_url();?>assets/css/my-story.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url();?>assets/plugins/jquery-2.1.0.min.js"></script>

<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!--/fonts-->
<!--sticky header-->

<!--/sticky header-->
<!--header search-->
<script src="<?php echo base_url();?>assets/js/modernizr.custom.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/component.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.bxslider.css" />
<!--/header search-->

</head>
<body>
<?php

$fv =  $featured_videos_array;
$sv = $normal_videos_array;


// sort in reverse order according to key index
krsort($fv);
krsort($sv);

?>
<!--Video banner-->
<section id="home" class="home">
    <!-- Home Slider -->
<div class="banner_holder">

 
<div id="container" style="background:black;">
    <ul class="bxslider" id ="bxsliId" >
        <?php 
       if(count($banner_videos)==0)
       {?>
             <li  style="background:black;">
		<div id="maindiv1" class="maindi">
			<div class="content_holder" >
		        <div class="content_image_holder">
		          	<img src="<?php echo base_url();?>assets/img/logo.png">
		        </div>		    	
    		</div>	
		</div>
	    </li>
       
       <?php 
       }
       elseif(count($banner_videos)>0)
       {
       foreach($banner_videos as $res){?>
        
        <li  style="background:black;">
		<div id="maindiv<?php echo $res->video_id;?>" class="maindi">
        <a style="cursor:pointer;" onclick="change('<?php echo $res->video_id;?>','<?php echo $res->video_youtube_id;?>')">
			<div class="content_holder" >
		        <div class="content_image_holder">
		        	<div class="banner_playbutton">
		        		<img  src="<?php echo base_url();?>assets/img/YouTube-icon-full_color.png" style="width:80px; height:65px;">
		        	</div>
		        	<img src="https://i.ytimg.com/vi/<?php echo $res->video_youtube_id;?>/sddefault.jpg">
		        </div>
		    	<div class="content_text_holder">
		        	<H2><?php echo $res->video_title;?></H2>
                             <?php
                             $dot ='......';
                            $desc= substr($res->video_desc,0,220);
                            if(strlen($res->video_desc)>220)
                            {
                            $desc= substr($res->video_desc,0,220).$dot;

                            }
                          ?>
                                
		            <p><?php echo $desc;?></p>
		        </div>
    		</div>	
            </a>
		</div>
		<div id="div<?php echo $res->video_id;?>" class="divc">
		</div>
     </li>
       <?php } } ?>

    </ul>
  </div>
</div>
    <!-- Home Slider end -->
</section>
<!--/Video banner-->

<!--Nav header holder-->
<section style="position:relative; z-index:2;">
    <!-- Navigation -->
    
    <!--mobile header-->
    <div class="mobile_header">
    	<div class="mobileheader_logo"><a class="external" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.png"></a></div>
        <div class="mobile_menulist">
            <select class="drplist" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                    <option value="<?php echo base_url();?>home#home">HOME</option>
                    <option value="<?php echo base_url();?>home#app">APP</option>
                    <option value="<?php echo base_url();?>home#watch">VIDEOS</option>
                    <option value="<?php echo base_url();?>aboutus">ABOUT</option>
                    <option value="<?php echo base_url();?>contactus">CONTACT</option>                  
             
            </select>
        </div>
        <div class="mobile_search_holder">
            
            <form action="<?php echo site_url(); ?>videos/search/" id="form_search" method="get"  onsubmit="return search_check();">
                    <input class="search" placeholder="<?php echo lang('search_field_placeholder');?>" type="text" value="" name="search" id="search">
                    <input class="home_search_button" type="submit" value="">
                    
                </form>
<!--        	<div style="position: absolute;right: 0;margin-top: -15px;"><img src="http://localhost/kms/assets/img/mobile-Search.png"></div>-->
        	
                
                
        </div>
		<div class="clear"></div>
    </div>
    <!--/mobile header-->
    
    <nav class="navbar">
    <div class="navbar-inner">
        <div class="main-nav">
            <ul class="nav" style="background:#fff;">
                <div class="logo"><a class="external" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.png"></a></div>
                
                <li style="width:60px; z-index:1; position:relative;">
                <div id="sb-search" class="sb-search" style="position:absolute; margin-top:-20px;">
                    <form action="<?php echo site_url(); ?>videos/search/" id="form_search1" method="get" onsubmit="return search_check1();">
                    <input class="sb-search-input" placeholder="<?php echo lang('search_field_placeholder');?>" type="text" value="" name="search" id="search1">
                    <input class="sb-search-submit" type="submit" value="">
                    <span class="sb-icon-search"></span>
                </form>
                </div>
                </li>
                <li style="padding:0px;">
                    <ul class="nav">
                        <li class="active"><a href="<?php echo base_url();?>home#home"><?php echo lang('home');?></a></li>
                        <li><a href="<?php echo base_url();?>home#app"><?php echo lang('app');?></a></li>
                        <li><a href="<?php echo base_url();?>home#watch"><?php echo lang('videos');?></a></li>
                        <li><a class="external" href="<?php echo base_url();?>aboutus"><?php echo lang('about');?></a></li>
                        <li><a class="external" href="<?php echo base_url();?>contactus"><?php echo lang('contact');?></a></li>
                        
                        <div class="clear"></div>
                    </ul>
                </li>
                <div class="clear"></div>
            </ul>                
        </div>
    </div>
    </nav>
    <!-- Navigation end -->
</section>
<div id="main-content">   
<!--/Nav header holder-->
<section id="app" class="how_it_works">
    <div class="container-fluid">
        <div class="container">
<!--App share holder-->
<div class="app_holder">
    
    <div class="app_content_holder">
    
        <div class="app_title_holder">
            <div class="app_title"><?php echo lang('share_ur_story');?></div>
        </div>
        
        <div class="app_details_holder">
            <div class="app_img"><img src="<?php echo base_url();?>assets/img/hand_app.png"></div>
            <div class="app_text">
                <h3><?php echo lang('mobile_app_title');?></h3>
                <p><?php echo lang('mobile_app_desc');?></p>
                <div class="app_store_holder">
                    <ul>
                        <li><a target="_blank" href="https://itunes.apple.com/sb/app/mystory/id990162296?mt=8"><img src="<?php echo base_url();?>assets/img/app_store.png"></a></li>
                        <li><a target="_blank" href="https://play.google.com/store/apps/details?id=net.onehope.mystory"><img src="<?php echo base_url();?>assets/img/play_store.png"></a></li>                    
                    </ul>
                </div>
            </div>
            
            <div class="clear"></div>
        </div>
            
         </div>
    
    
</div>
<!--/App share holder-->
        </div>
    </div> 
</section>
<!--video Listing HOlder-->
<section id="watch" class="pricing">
    <div class="container-fluid">
      <div class="container">
<div class="video_listing_holder">

    <!--title-->
    <div class="video_listing_title_holder">
        <div class="video_listing_title"><?php echo lang('watch');?></div>
        
        <div class="clear"></div>
    </div>
    <!--/title-->
    
    <!--filter holder-->
    <div class="video_listing_filter_holder">
        <ul>
            <li>           
                <label>    
                <select class="drplist" id="topics" onchange="condtn_based_filtring(this.value);">
                    <option value="all"><?php echo lang('all_topics');?></option>
                    <?php foreach($topics as $topic) {?>
                        <option  value="<?php echo $topic->topic_id;?>"><?php echo $topic->topic_name;?></option>
                    <?php }?>
                </select>
                </label>
               
            </li>
            <li>     
                <label>          
                <select class="drplist" id="lang_list" onchange="condtn_based_filtring(this.value);">
                    <option value="all"><?php echo lang('all_lang');?></option>
                    <?php foreach($all_languages as $lang_val) {?>
                        <option  value="<?php echo $lang_val->code;?>"><?php echo $lang_val->language;?></option>
                    <?php }?>
                </select>
                </label>
            </li>
            <li>
                <label>
                <select class="drplist" id="country_list" onchange="condtn_based_filtring(this.value);">
                    <option value="all"><?php echo lang('all_countries');?></option>
                    <?php foreach($all_countries as $country_val) {?>
                        <option  value="<?php echo $country_val->video_country;?>"><?php echo $country_val->video_country;?></option>
                    <?php }?>
                </select>
                </label>
            </li>
            <li style="margin-right:0px;">
            <label>
                <select class="drplist" id="count_list" onchange="condtn_based_filtring(this.value);">
                        <option value="all"><?php echo lang('sort_by');?></option>
                        <option value="1"><?php echo lang('youtube_likes');?></option>
                        <option value="2"><?php echo lang('youtube_view_count');?></option>
                        <option value="3"><?php echo lang('twitter_share');?></option>
                        <option value="4"><?php echo lang('recent_videos');?></option>
                </select>
                </label>
            </li>

            <div class="clear"></div>
        </ul>
    </div>
    <!--/filter holder-->
    
    <!--Video grid list-->
    <input type="hidden" id="featured_current_limit" value="<?php echo count($fv);?>">
    <input type="hidden" id="normal_current_limit" value="<?php echo count($sv);?>">
    <input type="hidden" id="total_feat" value="<?php echo $featured_videos_array_count;?>">
    <input type="hidden" id="total_norml" value="<?php echo $normal_videos_array_count;?>">
    
    <input type="hidden" id="filter_topic_id">
    <input type="hidden" id="filter_lang_code">
    <input type="hidden" id="filter_country_code">
    <input type="hidden" id="filter_count_type">
    <input type="hidden" id="loading_val" value="false">
    <div id="pop1" class="simplePopup"></div>
  
 
    <div class="video_wrapper">
         
        <?php

// check is any featured videos available
if (count($fv) > 0) {
    $order = 'left';    // feature video is in left align or right align
    $sv_row = false; 
        // checking 4 sv in a row needed
    while (count($fv) > 0) { // read each featured videos
            


        // PRINT FEATURED VIDEO - LEFT ALIGN
        if ($order == 'left') {
                  $frst_array =  array_pop($fv);
                  
                    
                  ?><div class="large_video mobile_responsive">
                      <div onclick="assignId(<?php echo $frst_array['video_id'];?>)"><img src="https://i.ytimg.com/vi/<?php echo $frst_array['video_youtube_id'];?>/sddefault.jpg">
                        <div class="featured_video_sign"></div>
                          <div class="details">
                            
                            <?php
                             $dot ='......';
                            $desc= substr($frst_array['video_short_desc'],0,50);
                            if(strlen($frst_array['video_short_desc'])>50)
                            {
                            $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                            }

                            $title = substr($frst_array['video_title'],0,20);
                            if(strlen($frst_array['video_title'])>20)
                            {
                            $title= substr($frst_array['video_title'],0,20).$dot;

                            }
                            ?>
                            <h3><?php echo $title;?></h3>
                            <p><?php echo $desc;?></p>
                        </div>
                      </div>
                  </div><?php
        }
        
        // PRINT NON-FEATURED VIDEO - LEFT/RIGHT ALIGN
        $cnt = 1;
        if ((count($sv) >= 4) or (count($fv) <= 0 and count($sv) > 0)) {
            ?><div class="large_video"><ul><?php    
                      
                while (count($sv) > 0 and $cnt <= 4) { // read next 4 non-featured videos
                                    
                                    $frst_array =  array_pop($sv);
                                    ?><li>
                                        <div class="search_video_list" onclick="assignId(<?php echo $frst_array['video_id'];?>)">
                                            <img src="https://i.ytimg.com/vi/<?php echo $frst_array['video_youtube_id'];?>/sddefault.jpg">
                                       
                                            <div class="vdetails">                            
                                            <?php
                                            $dot ='......';
                                            $desc= substr($frst_array['video_short_desc'],0,50);
                                            if(strlen($frst_array['video_short_desc'])>50)
                                            {
                                            $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                            }

                                            $title = substr($frst_array['video_title'],0,18);
                                            if(strlen($frst_array['video_title'])>18)
                                            {
                                            $title= substr($frst_array['video_title'],0,18).$dot;

                                            }
                                            ?>
                                            <h3><?php echo $title;?></h3>
                                            <p><?php echo $desc;?></p>
                                         </div>
                                        </div></li><?php
                    $cnt++;
                                      
                }
            ?></ul></div><?php
        }

        // check non-featured videos row is possible
        if (((count($fv) + 1) * 4 <= count($sv)) and $sv_row == false) {
            // PRINT 4 NON-FEATURED VIDEOS IN A ROW                 
            ?><div class="smallgrid_holder">
                <ul>
                    <?php   $cnt = 1;
                                         
                    while (count($sv) > 0 and $cnt <= 4) {                  
                        if ($cnt % 2 != 0 and $cnt != 1) { ?></ul><ul><?php } 
                                                  $frst_array =  array_pop($sv);
                                                ?>
                                                    <li>
                                                        <div class="search_video_list" onclick="assignId(<?php echo $frst_array['video_id'];?>)">
                                                            <img src="https://i.ytimg.com/vi/<?php echo $frst_array['video_youtube_id'];?>/sddefault.jpg">
                                                             <div class="vdetails">                            
                                                                <?php
                                                                $dot ='......';
                                                                $desc= substr($frst_array['video_short_desc'],0,50);
                                                                if(strlen($frst_array['video_short_desc'])>50)
                                                                {
                                                                $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                                }

                                                                $title = substr($frst_array['video_title'],0,18);
                                                                if(strlen($frst_array['video_title'])>18)
                                                                {
                                                                $title= substr($frst_array['video_title'],0,18).$dot;

                                                                }
                                                                ?>
                                                                <h3><?php echo $title;?></h3>
                                                                <p><?php echo $desc;?></p>
                                                            </div>
                                                        </div></li>
                        <?php $cnt++;
                    } ?>
                </ul>
            </div><?php
            $sv_row = true;
        }

        // PRINT FEATURED VIDEO - RIGHT ALIGN
        if ($order == 'right') {
                     $frst_array =  array_pop($fv);
                     ?><div class="large_video mobile_responsive">
                         <div onclick="assignId(<?php echo $frst_array['video_id'];?>)">
                             <img src="https://i.ytimg.com/vi/<?php echo $frst_array['video_youtube_id'];?>/sddefault.jpg">
                                <div class="featured_video_sign"></div>
                             <div class="details">                            
                                    <?php
                                    $dot ='......';
                                    $desc= substr($frst_array['video_short_desc'],0,50);
                                    if(strlen($frst_array['video_short_desc'])>50)
                                    {
                                    $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                    }

                                    $title = substr($frst_array['video_title'],0,18);
                                    if(strlen($frst_array['video_title'])>18)
                                    {
                                    $title= substr($frst_array['video_title'],0,18).$dot;

                                    }
                                    ?>
                                    <h3><?php echo $title;?></h3>
                                    <p><?php echo $desc;?></p>
                                </div>
                         </div></div><?php
        }

        $order = $order == 'left' ? 'right' : 'left';
               
                
        
    } // end featured videos loop

    // check any more non-featured videos available
    if (count($sv) > 0) {?>
        <div class="smallgrid_holder">
            <ul>
                <?php   $cnt = 1;
                while (count($sv) > 0) {
                    if ($cnt % 2 != 0 and $cnt != 1) { ?></ul><ul><?php } 
                                        $frst_array =  array_pop($sv);
                                        ?>
                                            <li>
                                                <div class="search_video_list" onclick="assignId(<?php echo $frst_array['video_id'];?>)">
                                                    <img src="https://i.ytimg.com/vi/<?php echo $frst_array['video_youtube_id'];?>/sddefault.jpg">
                                                        <div class="vdetails">                            
                                                            <?php
                                                            $dot ='......';
                                                            $desc= substr($frst_array['video_short_desc'],0,50);
                                                            if(strlen($frst_array['video_short_desc'])>50)
                                                            {
                                                            $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                            }

                                                            $title = substr($frst_array['video_title'],0,18);
                                                            if(strlen($frst_array['video_title'])>18)
                                                            {
                                                            $title= substr($frst_array['video_title'],0,18).$dot;

                                                            }
                                                            ?>
                                                            <h3><?php echo $title;?></h3>
                                                            <p><?php echo $desc;?></p>
                                                        </div>
                                                </div></li>
                    <?php $cnt++;
                } ?>
            </ul>
        </div> <?php
    }
}elseif (count($sv) > 0) { // check only non-featured videos are available ?>
    <div class="smallgrid_holder">
        <ul>
            <?php   $cnt = 1;
            while (count($sv) > 0) {
                if ($cnt % 2 != 0 and $cnt != 1) { ?></ul><ul><?php }                                     
                                       $frst_array =  array_pop($sv);
                                       
                                       ?>
                                    <li>
                                        <div class="search_video_list" onclick="assignId(<?php echo $frst_array['video_id'];?>)">
                                            <img src="https://i.ytimg.com/vi/<?php echo $frst_array['video_youtube_id'];?>/sddefault.jpg">
                                                <div class="vdetails">                            
                                                    <?php
                                                    $dot ='......';
                                                    $desc= substr($frst_array['video_short_desc'],0,50);
                                                    if(strlen($frst_array['video_short_desc'])>50)
                                                    {
                                                    $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                    }

                                                    $title = substr($frst_array['video_title'],0,18);
                                                    if(strlen($frst_array['video_title'])>18)
                                                    {
                                                    $title= substr($frst_array['video_title'],0,18).$dot;

                                                    }
                                                    ?>
                                                    <h3><?php echo $title;?></h3>
                                                    <p><?php echo $desc;?></p>
                                                </div>
                                        </div></li>
                <?php $cnt++;
            } ?>
        </ul>
    </div><?php
}else{?>
     <div id="no_result"><?php echo lang('no_results');?></div>
<?php }
?>


<div class="clear"></div>
   </div>
    <!--/Video grid list-->
    
    </div>
    <!--/video Listing HOlder-->
      </div>
    </div> 
</section>
</div>
<!-- Video Loading -->
<div class="videobuffring">
<img src="<?php echo base_url();?>assets/img/loading002.gif">
</div>
<!-- /Video Loading -->

<!--coypright holder-->
<footer>
  <section id="homefooter" class="homefooter">
    <div class="container-fluid" style="max-width:1000px; margin:0px auto; padding:0px 20px;">
      <div class="row-fluid">
        <div class="span12 footer-span">
          <div style="float:left;"><a href="https://plus.google.com/+MystoryBuzz/videos" rel="publisher" target="_blank"><img src="<?php echo base_url();?>assets/img/google+.png"></a></div>
          <p  style="float:right;">&copy;2015 All Rights Reserved.</p>
          
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </section>
</footer>
<!--/coypright holder-->

<!--VIDEO POPUPs-->
<script src="<?php echo base_url();?>assets/js/jquery.simplePopup.js" type="text/javascript"></script>


<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-65549723-1', 'auto');
ga('send', 'pageview');

</script>
<!--/VIDEO POPUPs-->

<!--HEADER SEARCH-->
<script src="<?php echo base_url();?>assets/js/classie.js"></script>
<script src="<?php echo base_url();?>assets/js/uisearch.js"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
</script>
<!--/HEADER SEARCH-->


<script type="text/javascript">
    function search_check()
 {
    var serch_val   =$("#search" ).val();
    if(serch_val=='')
    {   
        return false;
    }
    else 
    {
       return true;
    }
  }
  function search_check1()
 {
    var serch_val   =$("#search1" ).val();
    if(serch_val=='')
    {   
        return false;
    }
    else 
    {
       return true;
    }
  }
    function condtn_based_filtring(topicsid)
    {
          
        var langcode     = $('#lang_list').val();
        var countrycode  = $('#country_list').val();
        var count_type   = $('#count_list').val(); 
        var topicid      = $("#topics").val();
        
        var current_page    =   1;
        loading             =   false;
        var oldscroll       =   0;
        var baseurl = "<?php echo base_url(); ?>";  
                 
         var imgval =''
         
         $('.video_wrapper').html('<div style="max-width:1000px;min-height:800px; text-align:center; margin:20px auto;"><img src="<?php echo base_url();?>assets/img/loading002.gif"></div>');
         
        var ajax_data = 'p='+current_page+'&topic_id='+topicid+'&langcode='+langcode+'&countrycode='+countrycode+'&count_type='+count_type; 
            $.ajax({
               url: baseurl+'home/condtn_based_listing/',
               type: 'POST', 
               //data: 'p='+current_page+'&topic_id='+topicsid,
               data: ajax_data,
               success: function(data){                  
                    
                            var data    =   $.parseJSON(data);                            
                           // console.log(data);
                            $('.video_wrapper').html(data.html);                           
                            
                            $('#filter_topic_id').val(topicid);
                            $('#filter_lang_code').val(langcode);
                            $('#filter_country_code').val(countrycode);
                            $('#filter_count_type').val(count_type);
                               
                            $('#total_feat').val(parseInt(data.total_feat));                                                                
                            $('#total_norml').val(parseInt(data.total_norml));
                            
                            current_page++;
                            $('#featured_current_limit').val(parseInt(data.featured_offset));                                                                
                            $('#normal_current_limit').val(parseInt(data.normal_offset));

                            if(data.featured_offset==0 && data.normal_offset==0 )
                            {
                                var htmlval= '<div id="no_result">No Results</div>';
                                $('.video_wrapper').html(htmlval);

                            }
                                
                        }
                 });
        
    }
    var current_page    = 1;
    var loading     =   false;
    var oldscroll   =   0;
    $(window).scroll(function() 
    {
        
        var baseurl = "<?php echo base_url(); ?>";         
        var  featured_current_limit = $('#featured_current_limit').val();
        var normal_current_limit = $('#normal_current_limit').val();        
          
        
        if( $(window).scrollTop() > oldscroll )
        { 
                   
                    
                var langcode = $('#lang_list').val();
                var countrycode = $('#country_list').val();
                var count_type = $('#count_list').val(); 
                var topicid = $("#topics").val();

                var ajax_data = 'p='+current_page+'&featured_current_limit='+featured_current_limit+'&normal_current_limit='+normal_current_limit+'&topic_id='+topicid+'&langcode='+langcode+'&countrycode='+countrycode+'&count_type='+count_type; 

                //console.log(ajax_data);
                var total_feat =  $('#total_feat').val();                                                                
                var total_norml =  $('#total_norml').val();
                var total_video = parseInt(total_feat)+parseInt(total_norml);
                var current_total =  parseInt(featured_current_limit)+parseInt(normal_current_limit);
              
                if( ($(window).scrollTop() + $(window).height() >= $(document).height()  ) ) 
                {

                       if (current_total == total_video)
                       {
                           loading = true;
                       }
                       if( ! loading)
                       {   

                             //console.log('feat'+featured_current_limit,'norml'+normal_current_limit,'totl'+total_video,'curnttotl'+current_total);

                             loading = true;                        
                            // $('.video_wrapper').addClass('loadingq');
                             $('.videobuffring').show();

                            $.ajax({
                                'url':baseurl+'home/home_listing/',
                                'type':'post',
                                'data': ajax_data,
                                success:function(data){


                                                var data    =   $.parseJSON(data);
                                                // console.log(data);

                                                $(data.html).hide().appendTo('.video_wrapper').delay(500).fadeIn(2000);
                                                           // $(data.html).appendTo('.video_wrapper');
                                                current_page++;
                                               // $('.video_wrapper').removeClass('loadingq');
                                                $('.videobuffring').delay(500).fadeOut( 400 );;
                                                $('#featured_current_limit').val(parseInt(featured_current_limit)+parseInt(data.featured_offset));

                                                $('#normal_current_limit').val(parseInt(normal_current_limit)+parseInt(data.normal_offset));
                                                loading = false;

                                                if(data.featured_offset==0 && data.normal_offset==0 )
                                                {
                                                    loading = true;
                                                }

                                        }
                                }); 
                                                
                        }
                }
        }
                
  
    });
    function assignId(id)
    {
        stopPlayer();
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

                         $('.simplePopup').html(data); 
                         $('#pop1').simplePopup();

                 }
            });
       }
         
    }

        </script>
        
        



<script type="text/javascript">
    function removepopup()
{
    $("#pop1").html('');
}

    
    $('body').css('height','auto');
        
        $(window).scroll(function() {
            $('body').css('height','auto');
        })

	</script>
        <script>
$(document).ready(function(){
  $('.bxslider').bxSlider();
  


  myVar = setInterval(function(){ myTimer() }, 5000);
  jQuery('.bx-clone div').removeAttr('id');
  jQuery('.bx-clone img').removeAttr('id');
  jQuery('.bx-clone embed').removeAttr('id');

});




function myTimer()
{
	$( ".bx-next" ).trigger( "click" );
}

function change(snum,vid)
{
   
        clearInterval(myVar);
	$("#maindiv"+snum).css("display", "none")
	$("#maindiv"+snum).css("position", "absolute")
	$("#div"+snum).html('<iframe width="100%" height="100%" src="https://www.youtube.com/embed/'+vid+'?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1" frameborder="0"></iframe>')
        $("#div"+snum).css("height", "480px");
}

function stopPlayer()
{

	$(".divc").html('');
	$(".maindi").css("display", "")
	$(".maindi").css("position", "")
	$(".maindi").css("z-index", "")
	clearInterval(myVar);
	myVar = setInterval(function(){ myTimer() }, 5000);
	
}

</script>

<!--/Parellax-->
<script type='text/javascript' src='<?php echo base_url();?>assets/js/grid.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.nav.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.scrollTo.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.sticky.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/scripts.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.bxslider.js'></script>
<script type="text/javascript">
 var _mfq = _mfq || [];
 (function() {
 var mf = document.createElement("script"); mf.type = "text/javascript"; mf.async = true;
 mf.src = "//cdn.mouseflow.com/projects/6f8d4469-39bf-4fe0-b5f1-17004e243b7d.js";
 document.getElementsByTagName("head")[0].appendChild(mf);
 })();
</script>
</body>
</html>
