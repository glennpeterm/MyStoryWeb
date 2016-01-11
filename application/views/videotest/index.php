<?php
if(isset($_GET['v1']))
{
	$v1 = $_GET['v1'];
}
else
{
	$v1 = 'FCiUfXiXJSE';
}
if(isset($_GET['h']))
{
	$h = $_GET['h'];
}
else
{
	$h = '600';
}
?>
<!-- jQuery library (served from Google) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="jquery.bxslider.js"></script>
<!-- bxSlider CSS file -->
<link href="jquery.bxslider.css" rel="stylesheet" />

<style>
*							{margin:0px; padding:0px;}
.font1						{font-family: 'PT Sans', sans-serif;}
.font2						{font-family: 'Abel', sans-serif;}
.banner_holder				{width:100%; height:478px; background:black;}
.content_holder				{max-width:1000px; height:478px;; margin:0px auto; position:relative; overflow:hidden;}
.content_image_holder		{-webkit-background-size: auto 100%;-webkit-font-smoothing: antialiased;background-position: 50% 50%;background-repeat: no-repeat;background-size: auto 100%;box-sizing: border-box;color: rgb(255, 255, 255);display: block;font-size: 14px;font-weight: normal;left: 620px;line-height: 21px;margin-left: -274px;position: absolute;top: 0px; }
.content_image_holder img	{height:478px;}
.content_image_holder::before {content:'';position:absolute; height:100%; background-image: -moz-linear-gradient(left, #000000 50%,rgba(0,0,0,0));
background-image: -o-linear-gradient(left, #000000 50%,rgba(0,0,0,0));
background-image: -webkit-linear-gradient(left, #000000 50%,rgba(0,0,0,0));
background-image: linear-gradient(to right, #000000 45%,rgba(0,0,0,0));
left: -160px;
width: 360px;;}
.content_image_holder::after {content:''; position:absolute; height:100%; background-image: -moz-linear-gradient(left, rgba(0,0,0,0),#000000);
background-image: -o-linear-gradient(left, rgba(0,0,0,0),#000000);
background-image: -webkit-linear-gradient(left, rgba(0,0,0,0),#000000);
background-image: linear-gradient(to right, rgba(0,0,0,0),#000000);
right: 0;
top:0;
width: 210px}
.content_text_holder		{-webkit-background-clip: border-box;-webkit-background-origin: padding-box;-webkit-background-size: auto;-webkit-font-smoothing: antialiased;background-attachment: scroll;background-clip: border-box;background-color: rgba(0, 0, 0, 0);background-image: none;background-origin: padding-box;background-size: auto;box-sizing: border-box;color: rgb(255, 255, 255);display: block;font-weight: normal;height: 296px;left: 0px;padding-bottom: 20px;padding-left: 40px;padding-right: 20px;padding-top: 20px;pointer-events: none;
position: absolute;text-shadow: rgba(0, 0, 0, 0.4) 0px -1px 0px;top: 30%;width:500px;}
.content_text_holder h2		{font-size: 50px; text-transform:uppercase;line-height: 50px;font-family: 'Abel', sans-serif;}
.content_text_holder p		{ line-height:24px; margin-top:20px;font-family: 'PT Sans', sans-serif; color:rgba(201,201,201,1.00); font-size:15px;}

.banner_playbutton {width:80px; position: absolute; top: 50%; left: 50%; margin-top: -46px; margin-left: -50px; cursor:pointer; z-index:500;}
</style>
<div id="container" style="background:black;">
<ul class="bxslider" id ="bxsliId" >
   <li  style="background:black;">
		<div id="maindiv1" class="maindi">
			<div class="content_holder" >
		        <div class="content_image_holder">
		        	<div class="banner_playbutton">
		        		<img onclick="change('1','RO-b9oiccc8')" src="YouTube-icon-full_color.png" style="width:80px; height:65px;">
		        	</div>
		        	<img src="https://i.ytimg.com/vi/RO-b9oiccc8/sddefault.jpg">
		        </div>
		    	<div class="content_text_holder">
		        	<H2>Paige's Story</H2>
		            <p>"No, despite all these things, overwhelming victory is ours through Christ, who loved us."And I am convinced that nothing can ever separate us from God's love. Neither death nor life, neither angels nor demons, neither our fears for...</p>
		        </div>
    		</div>	
		</div>
		<div id="div1" class="divc" >
		</div>
   </li>

   	<li  style="background:black;">
		<div id="maindiv2" class="maindi">
			<div class="content_holder" >
		        <div class="content_image_holder">
		        	<div class="banner_playbutton">
		        		<img onclick="change('2','PLCQM0445CQ')" src="YouTube-icon-full_color.png" style="width:80px; height:65px;">
		        	</div>
		        	<img src="https://i.ytimg.com/vi/PLCQM0445CQ/sddefault.jpg">
		        </div>
		    	<div class="content_text_holder">
		        	<H2>Jess' Story</H2>
		            <p>Jess’ life has been transformed because of the forgiveness she has received. Jess has learned the freedom of living in the truth and now lives to share that good news with others. She knows that others can find peace, joy, healing and much...</p>
		        </div>
    		</div>


		</div>
		<div id="div2" class="divc">
		</div>
	</li>

   	<li  style="background:black;">
		<div id="maindiv3" class="maindi">
			<div class="content_holder" >
		        <div class="content_image_holder">
		        	<div class="banner_playbutton">
		        		<img onclick="change('3','H4E93RH-JBA')" src="YouTube-icon-full_color.png" style="width:80px; height:65px;">
		        	</div>
		        	<img src="https://i.ytimg.com/vi/H4E93RH-JBA/sddefault.jpg">
		        </div>
		    	<div class="content_text_holder">
		        	<H2>Jim's Story</H2>
		            <p>"The night before Peter was to be placed on trial, he was asleep, fastened with two chains between two soldiers. Others stood guard at the prison gate. Suddenly, there was a bright light in the cell, and an angel of the Lord stood before Peter...</p>
		        </div>
    		</div>



		</div>
		<div id="div3" class="divc">
		</div>
   	</li>

   	<li  style="background:black;">
		<div id="maindiv4" class="maindi">			
			<div class="content_holder" >
		        <div class="content_image_holder">
		        	<div class="banner_playbutton">
		        		<img onclick="change('4','nAW21FCseKQ')" src="YouTube-icon-full_color.png" style="width:80px; height:65px;">
		        	</div>
		        	<img src="https://i.ytimg.com/vi/nAW21FCseKQ/sddefault.jpg">
		        </div>
		    	<div class="content_text_holder">
		        	<H2>Lisa's Story </H2>
		            <p>Ever feel like you're just not good enough? Many of us do. There are nearly seven billion people on this planet, and if we look hard enough, we'll always find someone who is smarter than us, prettier than us, more athletic than us, and so on.So who is nd...</p>
		        </div>
    		</div>


		</div>
		<div id="div4" class="divc">
		</div>
   	</li>


</ul>
</div>
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
	$("#div"+snum).html('<iframe width="100%" height="100%" src="https://www.youtube.com/embed/'+vid+'?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe>');

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