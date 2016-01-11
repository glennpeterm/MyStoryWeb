
<!--header search-->
<script src="<?php echo base_url();?>assets/js/modernizr.custom.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-2.1.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/component.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<!--/header search-->
<!--header-->
<div id="fixed_navbar">

    <!--mobile header-->
    <div class="mobile_header">
    	<div class="mobileheader_logo"><img src="<?php echo base_url();?>assets/img/logo.png"></div>
        <div class="mobile_menulist">
           
            <select id="mobile_dropdown" class="drplist" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                    <option value="<?php echo base_url();?>home#home">HOME</option>
                    <option value="<?php echo base_url();?>home#app">APP</option>
                    <option value="<?php echo base_url();?>home#watch">VIDEOS</option>
                    <option value="<?php echo base_url();?>aboutus">ABOUT</option>
                    <option value="<?php echo base_url();?>contactus">CONTACT</option>                  
             
            </select>
        </div>
        <div class="mobile_search_holder">
        	 <form action="<?php echo site_url(); ?>videos/search/" id="form_search1" method="get"  onsubmit="return search_check1();">
                    <input class="search" placeholder="<?php echo lang('search_field_placeholder');?>" type="text" value="" name="search" id="search1">
                    <input class="home_search_button" type="submit" value="">
                    
                </form>
        </div>
		<div class="clear"></div>
    </div>
    <!--/mobile header-->


	<div class="nav_holder">
    	<ul>
        	<div class="logo"><a href="<?php echo site_url(); ?>home/"><img src="<?php echo base_url();?>assets/img/logo.png"></a></div>
            <!--search-->
            <li style="width:60px; z-index:1;">
            <div id="sb-search" class="sb-search" style="position:absolute; margin-top:-20px;">
               
                <form action="<?php echo site_url(); ?>videos/search/" id="form_search" method="get"  onsubmit="return search_check();">
                    <input class="sb-search-input" placeholder="<?php echo lang('search_field_placeholder');?>" type="text" value="" name="search" id="search">
                    <input class="sb-search-submit" type="submit" value="">
                    <span class="sb-icon-search"></span>
                </form>
            </div>
            </li>
            <!--/search-->
            <?php
                       
               $urlLastKey = count($this->uri->segment_array());
               $current_apge=$this->uri->segment($urlLastKey);

               $active_tab ='';
               $active_tab1 ='';
               $active_tab2 ='';
               if($current_apge == 'contactus')
               {
                   $active_tab = 'class="active"';
               }
               if($current_apge == 'aboutus' || $current_apge == 'wholestory' || $current_apge == 'quizes')
               {
                   $active_tab1 = 'class="active"';
               }
               if(in_array('video_details', $this->uri->segment_array())||in_array('search', $this->uri->segment_array()))
               {
                  $active_tab2 = 'class="active"';
               }
              
            ?>
            <a href="<?php echo base_url();?>contactus"><li <?php echo $active_tab;?> ><?php echo lang('contact');?></li></a>
            <a href="<?php echo base_url();?>aboutus"><li <?php echo $active_tab1;?>><?php echo lang('about');?></li></a>
            <a href="<?php echo base_url();?>home#watch"><li <?php echo $active_tab2;?>><?php echo lang('videos');?></li></a>
            <a href="<?php echo base_url();?>home#app"><li><?php echo lang('app');?></li></a>
            <a href="<?php echo base_url();?>home"><li><?php echo lang('home');?></li></a>
            
                         
            
            <div class="clear"></div>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function(){        
        var location = window.location.href;        
        if(location.indexOf("search") > -1) {
            
            var baseurl = "<?php echo base_url(); ?>";         
            var newurl = baseurl+'home#watch';
            
               $('#mobile_dropdown').val(newurl);
        }
        else
        {
            $('#mobile_dropdown').val(window.location.href);
        }
    })
  
</script>
<!--/header-->
