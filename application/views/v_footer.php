
<!--Footer-->
<?php
        $ci =& get_instance();
        $ci->load->helper('footer_videos');
        $featured_result =  featured_videos();
        $recent_stories  = recentStories();
               
?>
<div id="footer">
	<ul>
             <?php if(count($recent_stories)>0) {?>
    	<li class="recent_story">
          <div class="heading"><?php echo lang('recent_stories');?></div>
            <?php foreach($recent_stories as $res){?>
          <p><a href="<?php echo base_url();?>videos/video_details/<?php echo $res->video_id;?>">
              <?php 
              
              echo ucfirst(substr($res->video_title,0,25));
            
              ?>
              
              </a></p>
            <?php }?>
        </li>
         <?php }?>
        <?php if(count($featured_result)>0) {?>
        <li class="featured_story">
        	<div class="heading"><?php echo lang('featured_stories');?></div>
                <?php 
                
                foreach($featured_result as $res){?>
                <p><a href="<?php echo base_url();?>videos/video_details/<?php echo $res->video_id;?>"><img src="https://i.ytimg.com/vi/<?php echo $res->video_youtube_id;?>/sddefault.jpg">
                    <?php
                    
                    echo ucfirst(substr($res->video_title,0,17));
                    ?>
                    
                    </a></p>
                <?php }?>

        </li>
        <?php }?>
        <div class="clear"></div>
    </ul>
</div>
<!--/Footer-->
<!--copyright-->
<div class="copyright_holder">
<div class="container-fluid" style="max-width:1000px; margin:0px auto; padding:0px 20px;">
     <div class="row-fluid">
       <div class="span12 footer-span">
         <div style="float:left;"><a href="https://plus.google.com/+MystoryBuzz/videos" rel="publisher" target="_blank"><img src="<?php echo base_url();?>assets/img/google+.png"></a></div>
         <p style="float:right;">©2015 All Rights Reserved.</p>
         
         <div class="clear"></div>
       </div>
     </div>
   </div></div>
<!--/copyright-->
<!--HEADER SEARCH-->
<script src="<?php echo base_url();?>assets/js/classie.js"></script>
<script src="<?php echo base_url();?>assets/js/uisearch.js"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
</script>
<script>

function removepopup()
{
    $("#pop1").html('');
}

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
</script>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-65549723-1', 'auto');
ga('send', 'pageview');

</script>

<!--/HEADER SEARCH-->
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
