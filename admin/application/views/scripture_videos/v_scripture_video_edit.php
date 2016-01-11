<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2-bootstrap.css">
<style>
    html, body, iframe {
    height: 100%;
    width: 100%;
}
body { overflow: hidden;}
</style>
<?php echo $menu;?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('scripture_videos_view');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                         <li ><a href="<?=site_url('scripture_videos/index');?>"><?=lang('scripture_video_list');?></a></li>
                                        <li class="active"><?=lang('txt_edit');?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			<?php 
                         $message=$this->session->flashdata('message');
                         if($message!=''): ?>
                            <div class="alert alert-success">

                            <?php  echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?>  
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
					<!-- BEGIN BASIC ELEMENTS -->
					
                                                         <div class="col-md-12">
							<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title"><?php echo  $video_title;?></span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								
                                
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <div class="col no-padding"><span>
                                        	
                                                <div style="height:250px; background:#373737;">
                                                  <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $video_youtube_id; ?>?showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe>
                                                </div>
                                        </span></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                        <p><strong><?php echo lang('youtube_likes_count');?> : </strong><?php echo $youtube_likes_count;?></p>
                                        <p><strong><?php echo lang('youtube_views_count');?> : </strong><?php echo $youtube_views_count;?></p>
                                        <p><strong><?php echo lang('twitter_share');?> : </strong><?php echo $twitter_share;?></p>
                                        <!-- 
                                        <p><strong><?php echo lang('total_likes');?></strong><?php echo $total_likes_count;?></p>
                                        <p><strong><?php echo lang('facebook');?></strong> <?php echo $fb_likes_count;?></p>
                                        <p><strong><?php echo lang('youtube');?></strong> <?php echo $youtube_likes_count;?></p>
                                        <p><strong><?php echo lang('total_share');?></strong> 0</p>
                                        <p><strong><?php echo lang('facebook');?></strong> 0</p>
                                        <p><strong><?php echo lang('twitter');?></strong> 0</p>
                                        <p><strong><?php echo lang('email');?></strong> 0</p> -->
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                
							</div>
						</div>
                        
						
							
				<div class="grid-body">
                                <section class="content">
				<div class="row">
					<!-- BEGIN BASIC ELEMENTS -->
					<div class="col-md-12">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title"></span>
								
							</div>
							<div class="grid-body">
                  <form class="form-horizontal" role="form" action="<?php echo base_url();?>scripture_videos/add/<?php echo $id;?>" method="POST"  onsubmit="return form_err_chk()">

                                                                    
                                                                                                                                     
									<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_title');?></label>
										<div class="col-sm-7">
                        <input type="text" class="form-control" id="video_title" name="video_title" placeholder="<?php echo lang('video_title');?>" value="<?php echo isset($video_title) ? $video_title : set_value("video_title") ?>">
                        <span style="color:red"> <?php echo form_error('video_title'); ?></span>
                        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
											
										</div>
									</div>
                    <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_desc');?></label>
										<div class="col-sm-7">
											<textarea id="video_desc" name="video_desc" class="form-control" rows="10"><?php echo isset($video_desc) ? $video_desc : set_value("video_desc") ?></textarea>
                                                                                         <span style="color:red"> <?php echo form_error('video_desc'); ?></span>
										</div>
								   </div>
                    <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_short_desc');?></label>
										<div class="col-sm-7">
											<textarea id="video_short_desc" name="video_short_desc" class="form-control"  rows="2" maxlength="50"><?php echo isset($video_short_desc) ? $video_short_desc : set_value("video_short_desc") ?></textarea>
                       <span style="color:red"> <?php echo form_error('video_short_desc'); ?></span>
                       <div id="characterLeft"></div>
										</div>
								    </div>
                      
                      
                                  <div class="form-group">
                                    
                                   
                                        <label class="col-sm-3 control-label"> <?php echo lang('bookname');?> </label>
                                   
                                        <div class="col-sm-7" >
                                            <select name="bible_books" class="form-control bookname bible_books" >
                                              <option value=''><?php echo lang('select');?></option>
                                                <?php                                                
                                             
                                                
                                                foreach($bible_book_names as $bookname){?>
                                                    <option value="<?php echo $bookname->book_id;?>" <?php if(isset($db_bible_book_id)&& ($db_bible_book_id)!=''){if($bookname->book_id==$db_bible_book_id){?> selected="selected"<?php } }?> > <?php echo $bookname->book_name;?></option>
                                                <?php }?>  
                                            </select>
                                              <span style="color:red"> <?php echo form_error('bible_books'); ?></span>
                                              <span style="color:red" id="bible_books_err"> </span>
                                    </div>
                                  </div>
                                
                                     <div id="chapter">     
                                   
                                        <?php
                                        
                                        if(isset($chapter))
                                        {
                                            
                                            $selectedval = '';
                                            if(($db_bible_book_id!=''))
                                            {
                                                if(isset($chapter_array)){
                                                if($chapter_array!=''){?>
                                                <div class="form-group">
                                                <label class="col-sm-3 control-label" ><?php echo lang('chapter');?></label>
                                                 <div class="col-sm-7" >
                                                <select class='form-control chapterno'  name="chapterno" onchange='showverse(this);'>
                                                    <option value=''><?php echo lang('select');?></option>
                                                    <?php foreach($chapter_array as $val){                                                       
                                                        ?>
                                                    <option value="<?php echo $val;?>" <?php  if($val == $chapter){ echo   $selectedval ='selected="selected"' ;                                                          
                                                        }else {echo $selectedval = '';}?>><?php echo $val;?></option>
                                                    <?php }?>
                                                </select>
                                                 <span style="color:red" id="bible_chapter_err"> </span>
                                                 <span style="color:red"> <?php echo form_error('chapterno'); ?></span></div></div>
                                            <?php
                                            
                                            }}
                                            
                                            }
                                            
                                        }
                                            ?>
                                    
                                     </div>
                                    <div id="verse">
                                   
                                       <?php if(isset($verse))
                                        {
                                            
                                            $selectedval = '';
                                            if($chapter!='')
                                           {
                                               if(isset($verse_array)){
                                                if($verse_array!=''){?>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"><?php echo lang('verse');?> </label>
                                                 <div class="col-sm-7" >
                                                <select class='form-control verseno' name="verseno" onchange='showtext(this);'>
                                                    <option value=''><?php echo lang('select');?></option>
                                                    <?php foreach($verse_array as $val){                                                       
                                                        ?>
                                                    <option value="<?php echo $val->verse;?>" <?php  if($val->verse == $verse){ echo   $selectedval ='selected="selected"' ;                                                          
                                                        }else {echo $selectedval = '';}?>><?php echo $val->verse;?></option>
                                                    <?php }?>
                                                </select>
                                                 <span style="color:red" id="bible_verse_err"> </span>
                                                 <span style="color:red"> <?php echo form_error('verseno'); ?></span></div> </div>
                                            <?php
                                            
                                               }}
                                            
                                            }
                                            
                                        }
                                            ?>     
                                                                      
                                    </div>
                                 
                      
                      <input type="hidden" name="bible_book_name" id="bible_book_name" >
                                   <input type="hidden" name="bibile_book_key" id="bibile_book_key" >
                                   
<!--                                   <input type="hidden" name="chapterno" id="chapterno" >
                                   <input type="hidden" name="verseno" id="verseno" >-->
                                   
                                   <input type='hidden' id='bible_book_id' name='bible_book_id' <?php if(isset($db_bible_book_id)&& ($db_bible_book_id)!=''){ ?> value="<?php echo $db_bible_book_id;?>" <?php } ?>>
                                    <input type='hidden' id='bible_book_order' name='bible_book_order' <?php if(isset($db_bible_book_order)&& ($db_bible_book_order)!=''){ ?> value="<?php echo $db_bible_book_order;?>" <?php } ?>>
                                     <input type='hidden' id='bible_name' name='bible_name' <?php if(isset($bible_name)&& ($bible_name)!=''){ ?> value="<?php echo $bible_name;?>" <?php } ?>>

                     <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('scripture_text');?></label>
                    <div class="col-sm-7">
                      <textarea readonly id="verse_text"  name="scripture_text" class="form-control"  rows="2" ><?php echo isset($scripture_text) ? $scripture_text : set_value("scripture_text") ?></textarea>
                       <span style="color:red"> <?php echo form_error('scripture_text'); ?></span>
                       
                    </div>
                    </div>

									<?php
									if($type=='add')
									{
									?>
                    <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_id');?></label>
										<div class="col-sm-7">
                                        <input type="text" class="form-control" id="video_id" name="video_id" placeholder="<?php echo lang('video_id');?>">
                                        <span style="color:red"> <?php echo form_error('video_id'); ?></span>
                                                                                   
											
										</div>
                                    </div>
                                    <?php 
                                    }?>
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('topics');?></label>
										<div class="col-sm-7">
                                                                                   
                    <select class="form-control" name="topics[]" multiple="multiple" size="5">
                        
                      <?php foreach ($topics as $results)
                         { 
                          if(in_array($results->topic_id, $topics_array))
                           {
                               $sel= 'selected="selected"';
                            }
                            else 
                            {
                                 $sel= '';
                            }                                                                                          
                         
                          ?>
                        
                       
                        <option <?php echo $sel ;?>value="<?php echo $results->topic_id;?>"><?php echo $results->topic_name;?></option>
                        
                          <?php } ?>
                    </select>
                    
                    
                    <span style="color:red"> <?php echo form_error('topics'); ?></span>
                                                                                    
											
										</div>
                                                                   	</div>
                                                                      
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('video_tag');?></label>
										<div class="col-sm-7">
                                                                                    <input type="text" class="form-control" id="video_tag" name="video_tag" placeholder="<?php echo lang('video_tag');?>" value="<?php echo isset($hashtag_array) ? $hashtag_array : set_value("") ?>">
                                                                                    <span style="color:red"> <?php echo form_error('video_tag'); ?></span>
                                                                                    
											
										</div>
									</div>
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('highlight_video');?></label>
										<div class="col-sm-7">
                                                                                    <?php
                                                                                     
                                                                                     $highlight_checked = '';
                                                                                    if(isset($highlight_video) && $highlight_video == '1'){
                                                                                            $highlight_checked = ' checked="checked" ';
                                                                                          
                                                                                        }
                                                                                    ?>
											
											
										<input type="checkbox" class="icheck"  name="high_light_status" id="high_light_status" <?php echo $highlight_checked;?>> 
											
                                                                                        
                                                                                </div>
									</div>
                                                                      
                                                                      
                                                                      <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('banner_video');?></label>
										<div class="col-sm-7">
                      <?php
                       
                       $banner_checked = '';
                      if(isset($banner_checked) && $banner_video == '1'){
                              $banner_checked = ' checked="checked" ';
                            
                          }
                      ?>
                     

                      <input type="checkbox"  class="icheck check_banner_limit" name="banner_status" id="banner_status" <?php echo $banner_checked;?>> 
                      <br>
                       <span style="color:red"> <?php echo form_error('banner_status'); ?></span>
                      <span style="color:red" id="banner_err"> </span>	                                                                                        
                  </div>
									</div>
                                                                        <div class="form-group">
										<label class="col-sm-3 control-label"><?php echo lang('txt_status');?></label>
										<div class="col-sm-7">
                                                                                    <?php
                                                                                     $inactive_checked = ' checked="checked" ';
                                                                                     $active_checked = '';
                                                                                    if(isset($video_status) && $video_status == '1'){
                                                                                            $active_checked = ' checked="checked" ';
                                                                                            $inactive_checked = '';
                                                                                        }
                                                                                    ?>
											<input type="radio" name="status" class="icheck" value="1" <?php echo $active_checked;?> > <?php echo lang('active');?>
											<input type="radio" name="status" class="icheck" value="0" <?php echo $inactive_checked;?> > <?php echo lang('inactive');?>
                                                                                        <span style="color:red"> <?php echo form_error('status'); ?></span>
                                                                                </div>
									</div>
                                                                     
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-10">
                      <div class="btn-toolbar"
											<div class="btn-group">
                           <input type="submit" name="submit" value="<?php echo lang('save');?>" class="btn btn-primary" />

                          <?php 
                                  $cancel_url      = site_url("scripture_videos");
                                  $banner_page_url = site_url("banner_videos");
                                  $featured_page_url= site_url("featured_videos");

                                  $sessn_banner_url =  $this->session->userdata('banner_url');
                                  $sessn_featured_url =  $this->session->userdata('featured_url');

                                  if($sessn_banner_url==$banner_page_url)
                                  {
                                      $cancel_url = $banner_page_url;
                                  }
                                  elseif($sessn_featured_url==$featured_page_url)
                                  {
                                      $cancel_url = $featured_page_url;
                                  }
                       ?>
												 <a href="<?php echo $cancel_url; ?>"><button style="margin-left: 10px;"type="button" class="btn  btn-warning"><?php echo lang('cancel');?></button></a>
											</div>
                                                                                </div>
										</div>
									
									
								</form>
							</div>
						</div>
					</div>
					<!-- END BASIC ELEMENTS -->
				</div>
                                         </section>
                                
                                
			</div>
                                                    
                                                   
			

			</div>
					<!-- END BASIC ELEMENTS -->
				</div>
                                         </section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
   <script>
   var pageName = 'video';
    
   </script>
<?php echo $footer;?>
<script src="<?php echo base_url();?>assets/plugins/select2/select2.js"></script>
        <script type="text/javascript">
             /* video tag listing */
             
            var res= [
                <?php foreach($hashtag as $tag){ 
                 echo "\" ".$tag->hash_name."\",";
                } ?>
            ];
            //console.log(res);
             $("#video_tag").select2({ 
                 tags:res,    
            tokenSeparators: [",", " "]});
            /* End of video tag listing */
            /* ICHECK */
            $('.icheck').iCheck({
             checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '10%' // optional
            });
            </script>
              <script type="text/javascript">
                  $( document ).ready(function() {
                     var form_err_flg = false;    
                  });
             
     $("select.bookname").change(function(){
           $('#verse_text').val('');
            $("#chapter").html('');
              $("#verse").html('');
        var bookid = $(".bookname option:selected").val();
        var bookname = $(".bookname option:selected").text();
        if(bookid == '')
        {
                        
              $("#chapter").html('');
              $("#verse").html('');
              //$('#bible_book_id').val('');
             // $('#bible_book_order').val('');
        }
        else{
        $('#bible_book_name').val(bookname);
        $('#bibile_book_key').val(bookid);
        $.ajax({
            type: "POST",
            url: baseurl+'scripture_videos/getchapters',
            data: { id : bookid } 
        }).done(function(data){
            
            var data    =   $.parseJSON(data);
            //console.log(data);
          $("#chapter").html(data.html);
          $('#bible_book_id').val(data.bible_book_id);
          $('#bible_book_order').val(data.bible_book_order);
          $('#bible_name').val(data.bible_name);
       
        });
        
      }
    });
    
    function showverse(chapterid)
    {
       
        $('#verse_text').val('');
        var chapterno = $(".chapterno option:selected").val();
        var bookorder =  $("#bible_book_order").val();        
        if(chapterno == ''){
            
            $("#verse").html('');
        }
         else{
        $.ajax({
            type: "POST",
            url: baseurl+'scripture_videos/getverse',
            data: { bookorder :bookorder,chapterno : chapterno } 
        }).done(function(data){
          //  console.log(data);
          $("#verse").html(data);
        });
     }
    }
    
    function showtext()
    {
        
       
        var chapterno = $(".chapterno option:selected").val();
        var bible_book_id =  $("#bible_book_id").val();
         var verseno = $(".verseno option:selected").val();
         if(verseno == '')
         {
          $('#verse_text').val('');
         }
         else
         {
          $('#chapterno').val(chapterno);
           $('#verseno').val(verseno);
        
        $.ajax({
            type: "POST",
            url: baseurl+'scripture_videos/getscripturetext',
            data: { bible_book_id :bible_book_id,chapterno : chapterno,verseno:verseno } 
        }).done(function(data){
            
            $('#verse_text').val(data);
           $('#verse_div').show();
            
        });
        
    }
    }         
             
             
             
             
             
             
               $('.check_banner_limit').on('ifChanged', function(event) {

                 var curnt_db_status = "<?php echo $banner_video;?>";
                var banner_video_err_msg = "<?php echo lang('banner_video_err_msg');?>";
               
                
            var isChecked = $('#banner_status').is(':checked');
                       
            if(curnt_db_status == 0 ){
              
              if(isChecked == true)
               {
                   
                $.ajax({
                    url: baseurl+'scripture_videos/banner_limit',
                    type: 'POST', 
                    data: 'id = 1',
                    async: true,
                    success: function(res){
                        
                        if(res>3)
                        {
                            form_err_flg = true;                     
                            $('#banner_err').html(banner_video_err_msg);
                        }
                    }
                });
            
              }
              else
              {
                  form_err_flg = false;  
                   $('#banner_err').html();
              }
            }
          });   
          
           
           
           function form_err_chk()
           {
              
               var bookname = $(".bible_books option:selected").val();    
                 /*if(bookname == 'select')
                 {
                     form_err_flg = true;
                     
                     return false;
                 }*/
                 var chapterno = $(".chapterno option:selected").val();
                 var verseno = $(".verseno option:selected").val();
                 if(chapterno == 'select')
                 {
                     form_err_flg = true;
                      $('#bible_chapter_err').html('select chapter');
                     return false;
                 }                               
                 else if(verseno == 'select')
                 {
                     form_err_flg = true;                     
                      $('#bible_verse_err').html('select verse');
                     return false;
                 }  
                 else
                 {
                     return true;
                 }
                    
               if(form_err_flg == false)
               {
                   return true;
               }
               else
               {
                   return false;
               }
               
           }
        var short_desc_limit        = "<?php echo lang('short_desc_notifctn');?>";
        var short_desc_notifctn     = "<?php echo lang('short_desc_notifctn');?>";
        var short_desc_charctr_left = "<?php echo lang('short_desc_charctr_left');?>";
           
        var shrt_desc=   $('#video_short_desc').val();
        if(shrt_desc == '')
        {
            $('#characterLeft').text(short_desc_notifctn);
        }
        
        $('#video_short_desc').keyup(function () {
        var max = 50;
        var len = $(this).val().length;
        if (len >= max) {
        $('#characterLeft').text(short_desc_limit);
        } else {
        var ch = max - len;
        $('#characterLeft').text(ch + short_desc_charctr_left);
        }
        });      
           
</script>