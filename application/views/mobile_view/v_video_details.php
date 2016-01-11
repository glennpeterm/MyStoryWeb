<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>video_details</title>
<meta content="en_US" property="og:locale">
<meta content="article" property="og:type">
<meta content="<?php echo ucfirst($video_details[0]->video_title);?>" property="og:title">
<meta content="<?php echo str_replace('"', '', $video_details[0]->video_desc);?>" property="og:description">
<meta content="<?php echo base_url();?>videos/video_details/<?php echo $video_details[0]->video_id;?>" property="og:url">
<meta content="My Story" property="og:site_name">
<meta content="https://i.ytimg.com/vi/<?php echo $video_details[0]->video_youtube_id; ?>/hqdefault.jpg" property="og:image">


<link href="<?php echo base_url();?>assets/css/movile_html_view.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400' rel='stylesheet' type='text/css'>




<script src="<?php echo base_url();?>assets/plugins/jquery-2.1.0.min.js"></script>

</head>
<style>
     iframe {
    height: 100%;
    width: 100%;
}
body { overflow: hidden;}
</style>
<body id="bodytag">

 <!--heading-->
 <?php

    if(isset($lang))
    {
       if(isset($userid))
       {
           $back_url = base_url().'mobile_view/mystory/'.$userid.'/'.$lang;
       }
       else
       {
           $back_url = base_url().'mobile_view/videos_listing/'.$lang;
       }
    }
    else
    {
        $back_url = '#'; 
    }

 /*if(isset( $_SERVER['HTTP_REFERER']))
    {
        $back_url = $_SERVER['HTTP_REFERER'];
    }
    else
    {
        $back_url = '#'; 
    }*/
     ?>


<div class="details_heading"><a href="<?php echo $back_url;?>"><span style="margin-right:10px;"><img src="<?php echo base_url();?>assets/img/video_details_back.png"></span></a><?php echo $video_details[0]->video_title;?></div>
<!--/ heading-->
<!--video holder-->
<div class="video_holder"><iframe type='text/html' src='http://www.youtube.com/embed/<?php echo $video_details[0]->video_youtube_id;?>?rel=0&modestbranding=1&showinfo=0'  frameborder='0' allowfullscreen='true'/></iframe></div>
<!--/ video holder-->


<!--scripture-->
<div class="scripture_holder"><?php 


    $bookvals = "";
    if($video_details[0]->book_name!='' && $video_details[0]->chapter!='' && $video_details[0]->verse!='' )
        {
            $bookvals = $video_details[0]->book_name." ".$video_details[0]->chapter." : ".$video_details[0]->verse." -  ";
        }
    echo $bookvals. $video_details[0]->scripture_text;?></div>
<!--/ scripture-->
<!--social media holder-->
<div class="pop_social_media_holder" style="float:none;"> 
    <ul>
        <li style="margin:0px;"><a id="fb" href="https://facebook.com/sharer/sharer.php?u=<?php echo base_url();?>videos/video_details/<?php echo $video_details[0]->video_id;?>&amp;t=<?php echo htmlentities(ucfirst($video_details[0]->video_title),ENT_QUOTES);?>" target="_blank"><img title="Share on Facebook" alt="Share on Facebook" class="nopin" src="<?php echo base_url();?>assets/img/facebook_icon.png"></a>    <!--<li><a href="#"><img src="<?php echo base_url();?>assets/img/share_facebook.png"></a></li>-->

        <li><a id="tw" href="https://twitter.com/share?url=<?php echo base_url();?>videos/video_details/<?php echo $video_details[0]->video_id;?>&amp;text=<?php echo htmlentities(ucfirst($video_details[0]->video_title),ENT_QUOTES);?>" target="_blank"><img src="<?php echo base_url();?>assets/img/twitter_icon.png"></a></li>
        <li><a id="em" href="mailto:?subject=<?php echo $video_details[0]->video_title;?>&body=<?php echo base_url();?>videos/video_details/<?php echo $video_details[0]->video_id;?>"><img src="<?php echo base_url();?>assets/img/email_icon.png"></a></li>
        <li style="float:right"><a onclick="flagVideoPop('<?php echo $video_details[0]->video_id;?>')"><img src="<?php echo base_url();?>assets/img/flag-mobile.png"></a></li>


        
        <div class="clear"></div>
    </ul>
</div>
 <div id="pop1" class="flagPopup"></div>

<!--/ social media holder-->
<!--discripion-->
<div class="discripton_holder">
    <?php echo $video_details[0]->video_desc;?>

<br><br><br>
<!--/ discripion-->
</div>
<script src="<?php echo base_url();?>assets/js/jquery.simplePopup.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
 <script>
    function popitup(url) {
    newwindow=window.open(url,'_parent','height=500,width=650');
    if (window.focus) {newwindow.focus()}
    return false;
}

function flagVideoPop(id)
{

  var baseurl = "<?php echo base_url(); ?>";    

  $.ajax({
    'url':baseurl+'videos/flagVideo/',
    'type':'post',
    'data': {video_id: id},
    success:function(data){

    $('.flagPopup').html(data); 
    $('#pop1').simplePopup();
window.scrollTo(0, 0);

    }
  });

}
function removepopup()
{
    $("#pop1").html('');
}
    </script>
</body>
</html>
