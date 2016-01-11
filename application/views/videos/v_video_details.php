<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo lang('page_title');?>  | <?php echo ucfirst($video_details->video_title);?></title>
<meta content="en_US" property="og:locale">
<meta content="article" property="og:type">
<meta content="<?php echo ucfirst($video_details->video_title);?>" property="og:title">
<meta content="<?php echo str_replace('"', '', $video_details->video_desc);?>" property="og:description">
<meta content="<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>" property="og:url">
<meta content="Know My Story" property="og:site_name">
<meta content="https://i.ytimg.com/vi/<?php echo $video_details->video_youtube_id; ?>/hqdefault.jpg" property="og:image">
<link rel="icon" href="<?php echo base_url();?>assets/img/splash_screen_logo.ico">
<link href="<?php echo base_url();?>assets/css/my-story.css" rel="stylesheet" type="text/css">


  <!-- END CSS FRAMEWORK -->
  


</head>

<body class="fonts">
<div id="fb-root"></div>
<script src="<?php echo base_url();?>assets/plugins/jquery-2.1.0.min.js"></script>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php echo $header;?>
<!--video-->
<style type="text/css">

</style>
<div class="video_banner">
	<iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $video_details->video_youtube_id; ?>?showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe>

 <?php //echo html_entity_decode($video_details->video_embed);?>
</div>
<!--/video-->
<!--content wrapper-->
<div class="content_wrapper">
	<!--title and youtube like-->
    <div class="title_holder">
        <div class="title"><?php echo ucfirst($video_details->video_title);?></div>
        <div class="report_views"><a style="cursor:pointer;" onclick="flagVideoPop('<?php echo $video_details->video_id;?>')">Report</a></div> 
        <div class="youtube_views"><?php echo $video_details->video_youtube_view_count;?><span>  <?php echo lang('youtube_views');?></span></div>
        <div class="youtube_views" style="background:none !important"><div style="display:block !important; margin-right:10px; margin-top:-12px;" class="fb-like" data-href="<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></div>
        
        <div class="clear"></div>
    </div>
    <!--/title and youtube like-->
    <!--Description-->
    <div class="video_discription"><pre><?php echo $video_details->video_desc;?></pre>
	</div>
    <!--/Description-->
    <!--video scripture-->
    <?php if($video_details->scripture_text!=''){?>
    <a target="_blank" href="https://www.bible.com/bible/59/jhn.1.esv"><div class="scripture_holder">
        <?php 
        $bookvals = "";
        if($video_details->book_name!='' && $video_details->chapter!='' && $video_details->verse!='' )
            {
                $bookvals = $video_details->book_name." ".$video_details->chapter." : ".$video_details->verse." -  ";
            }
        echo $bookvals.$video_details->scripture_text;?></div></a>
    <?php }?>
    
    <!--/video scripture-->
    <!--related tags-->

        <?php 
        $topic_count = count($topics_array);
       
        $conent = '';
        for($i=0;$i<$topic_count;$i++){
            
            $conent1 ='<span><a href="'. $topics_array[$i]['key'].'" target="_blank" >'. $topics_array[$i]['value'].'</a></span>';
            if(($topic_count != 1) && ($i != ($topic_count-1))){
               
                $conent .=$conent1.',';
           }
           
           elseif(($i == ($topic_count-1))&&($topic_count>1) )
               
           { 
               $conent = rtrim( $conent,',');
               $conent .=' and '.$conent1;
           }
           else 
           {
                $conent .= $conent1;
            }
       

         }?>
      
        
         <?php if($conent!=''){?>
    <div class="familer_tags"><?php echo lang('topic_content');?><?php echo strtolower($conent);?>.</div>
    <?php } ?>

    <!--/related tags-->
    <!--social media holder-->
    <div class="social_media_holder">
    	<ul>
            <li><a id="fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>&amp;t=<?php echo htmlentities(ucfirst($video_details->video_title),ENT_QUOTES);?>" target="_blank"><img title="Share on Facebook" alt="Share on Facebook" class="nopin" src="<?php echo base_url();?>assets/img/share_facebook.png"></a>    <!--<li><a href="#"><img src="<?php echo base_url();?>assets/img/share_facebook.png"></a></li>-->

            <li><a id="tw" href="https://twitter.com/share?url=<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>&amp;text=<?php echo htmlentities(ucfirst($video_details->video_title),ENT_QUOTES);?>" target="_blank"><img src="<?php echo base_url();?>assets/img/share_twitter.png"></a></li>
            <li><a id="em" href="mailto:?subject=<?php echo $video_details->video_title;?>&body=<?php echo base_url();?>videos/video_details/<?php echo $video_details->video_id;?>"><img src="<?php echo base_url();?>assets/img/share_email.png"></a></li>
            
            
            <div class="clear"></div>
        </ul>
    </div>
    <div id="pop1" class="flagPopup"></div>
    <!--/social media holder-->
    <!--video tags-->
    <div class="video_tags">
        
      
         <?php 
        $hash_count = count($hashtag_array);
       
        $hash_content = '';
        for($i=0;$i<$hash_count;$i++){
            
            $conent1 ='<a href="'. base_url().'videos/tag_search/'.$hashtag_array[$i]['key'].'" >'. $hashtag_array[$i]['value'].'</a>';
            if(($hash_count != 1) && ($i != ($hash_count-1))){
               
                $hash_content .=$conent1.',';
           }
           
           else 
           {
                $hash_content .= $conent1;
            }
       

         }?>
         <?php echo $hash_content;?>

    
    </div>
    <!--/video tags-->
    <!--comments holder-->
    <div class="comments_holder">
		<div id="disqus_thread"></div>
		<script type="text/javascript">
			/* * * CONFIGURATION VARIABLES * * */
			var disqus_shortname = 'mystorymovement';
			
			/* * * DON'T EDIT BELOW THIS LINE * * */
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
    </div>
    <!--/comments holder-->
</div>


<!--/content wrapper-->
    <?php echo $footer;?>  

    <script>
    function popitup(url) {
    newwindow=window.open(url,'_parent','height=500,width=650');
    if (window.focus) {newwindow.focus()}
    return false;
}
    </script>

<script>
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>
<script src="<?php echo base_url();?>assets/js/jquery.simplePopup.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  
<script type="text/javascript">


$(document).ready(function(){
 
   function getUrlParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) 
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) 
            {
                return sParameterName[1];
            }
        }
    }  
    var type = getUrlParameter('typ');
    if(type == 'fb') 
   {
        $('#fb')[0].click();
   }
   else if(type == 'tw') 
   {
        $('#tw')[0].click();
   }else if(type == 'em') 
   {
        $("#em")[0].click()
   }
    
});
function flagVideoPop(id)
{

  var baseurl = "<?php echo base_url(); ?>";    

  $.ajax({
    'url':baseurl+'videos/flagVideo/',
    'type':'post',
    'data': 'video_id='+id,
    success:function(data){

    $('.flagPopup').html(data); 
    $('#pop1').simplePopup();

    }
  });

}
</script>


