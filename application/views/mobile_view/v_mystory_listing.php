<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>mystory_listing</title>
<link href="<?php echo base_url();?>assets/css/movile_html_view.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.min.css">

<script src="<?php echo base_url();?>assets/plugins/jquery-2.1.0.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400' rel='stylesheet' type='text/css'>

</head>

<body>
<div class="header_wrapper">
<!--heading-->
<div class="heading_holder">MY STORIES</div>
<!--/ heading-->
</div>
<!--container-->
<div class="contaier_list_holder_mystory">
    <?php 
         
                                                                          
        if(isset($selfie_videos))
        { 

            if(count($selfie_videos)>0)
            {
            foreach ($selfie_videos as $results):?>
    
	<div class="list_holder">
          
  <?php
  $newPrivacyVal = ($results->video_youtube_status=='private')?'unlisted':'private';
  ?>
          
    <a onclick="assignId(<?php echo  $results->video_id ;?>)"  class="delet_button"></a>
	<?php
	if($results->video_youtube_upload_status!='uploaded')
	{
		if($newPrivacyVal=='private')
		{
		?>
			<a onclick="updatePrivacySettings(<?php echo  $results->video_id ;?>,'<?php echo $newPrivacyVal;?>','private')"  class="publish_button"></a>
		<?php
		}
		else
		{
		?>
			<a onclick="updatePrivacySettings(<?php echo  $results->video_id ;?>,'<?php echo $newPrivacyVal;?>','unlisted')"  class="unpublish_button"></a>
		<?php
		}
	}
	?>
    
 <a href="<?php echo base_url().'mobile_view/video_details/'.$results->video_id.'/'.$lang.'/'.$userid;?>" style="text-decoration: none">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td width="7%" align="left" valign="top"><div class="list_img"><img src="<?php echo $results->video_thumbnail_url;?>"></div></td>
            <td width="93%" style="padding-right:30px;">
           	  	<h2><?php echo  $results->video_title ;?></h2>
            	<h3><?php echo substr($results->video_desc,0,65);if(strlen($results->video_desc)>65) {?> .....<?php }?></h3>
                <?php
		if($results->video_youtube_upload_status!='uploaded')
		{
			if($results->video_status==1) 
                        {
                            $status= 'Public';
                        }
                        else {
                             $status= 'Private';
                        }
                            
		}
		else
		{
			$status = 'Processing';
		}
		?>
            	<h4><?php echo $status;?></h4>
            </td>
          </tr>
        </table>
           </a>
           
    </div>
    <?php  endforeach; } else{?>
    <div id="no_result">No Results</div>
        <?php } }?>
        
    </div>
 

    <div style="display:none;" id="dialog-confirm" title="Are you sure?">This will permanently delete this video everywhere it appears. It will be gone forever.</div>
    <div style="display:none;" id="dialog-confirm-update-private" title="Are you sure?">This will hide your video from the My Story website. You could re-publish it if you change your mind.</div>
    <div style="display:none;" id="dialog-confirm-update-unlisted" title="Are you sure?">This will publish your video on the My Story website. You could hide it if you change your mind.</div>


    <input type="hidden" name="deleteId" id="deleteId">
<!--/ container-->
<form id="formVal" >
  <input type="hidden" value="<?php echo $userid;?>" name="">
</form>
</body>
                
<script>
   
    var baseurl = "<?php echo base_url(); ?>";
    // function for topic deletion 


    function assignId(id)
    {
    
      $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:175,
      width:'80%',
      modal: true,
      buttons: {
       
        'No, go back.': function() {
          $( this ).dialog( "close" );
        }, "Yes, Delete it.": function() {
          $( this ).dialog( "close" );
          var userid = '<?php echo $userid;?>';
          var lang = '<?php echo $lang;?>'
          window.location = baseurl+'mobile_view/my_story_delete/'+id+'/'+userid+'/'+lang;
        }
      }
    });
}
function updatePrivacySettings(id,privacyVal,type)
{
  if(type=='private')
  {
    $( "#dialog-confirm-update-private" ).dialog({
    resizable: false,
    height:190,
      width:'80%',
    modal: true,
    buttons:
      {
     
        'No, go back.': function() {
          $( this ).dialog( "close" );
        }, "Yes, Hide it.": function() {
          $( this ).dialog( "close" );
          var userid = '<?php echo $userid;?>';
          var lang = '<?php echo $lang;?>'
           window.location = baseurl+'mobile_view/myStoryPrivacyUpdate/'+id+'/'+userid+'/'+lang+'/'+privacyVal;
        }
      }
    });
  }
  else
  {
    $( "#dialog-confirm-update-unlisted" ).dialog({
    resizable: false,
    height:190,
      width:'80%',
    modal: true,
    buttons:
      {
     
        'No, go back.': function() {
          $( this ).dialog( "close" );
        }, "Yes, Publish it.": function() {
          $( this ).dialog( "close" );
          var userid = '<?php echo $userid;?>';
          var lang = '<?php echo $lang;?>'
           window.location = baseurl+'mobile_view/myStoryPrivacyUpdate/'+id+'/'+userid+'/'+lang+'/'+privacyVal;
        }
      }
    });
  }
  

}

  
</script>
</html>
