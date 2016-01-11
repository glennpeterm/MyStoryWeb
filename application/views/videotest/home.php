<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Responsive Grid</title>
</head>

<style>

* {padding:0px; margin:0px; vertical-align:top;}
.clear{clear:both;}
.wrapper {max-width:1000px; margin:0px auto; text-align:center;}
.large_video{width:480px; height:360px; float:left; margin-left:15px; margin-bottom:15px;}

.large_video ul	{margin:0px; padding:0px; list-style:none;}
.large_video ul li	{margin:0px; padding:0px; list-style:none;}
.large_video ul li img{width:232px; height:173px;}
.large_video ul li:nth-child(odd/*specific child gets the style*/){width:232px; height:173px;  float:left; margin-right:16px; margin-bottom:15px;}
.large_video ul li:nth-child(even/*specific child gets the style*/){width:232px; height:173px;   float:left;}

.large_video_nomargin{width:480px; height:360px;  display:inline-block;}
.small_video{width:232px; height:173px;  float:left; margin-right:16px; margin-bottom:15px;}
.small_video_nomargin{width:232px; height:173px;   float:left;}
.smalgrid{ height:173px !important; float:left; margin-left:15px; margin-bottom:0px !important;}
.smallgrid_holder{margin: 0px auto;max-width:10000px;}
.smallgrid_holder ul {margin:0px; padding:0px; list-style:none; height: 173px !important;float: left;margin-left: 15px;width: 480px;margin-bottom: 15px;}
.smallgrid_holder ul li {margin:0px; padding:0px; list-style:none;}
.smallgrid_holder ul li img{width:232px; height:173px}
.smallgrid_holder ul li:nth-child(odd/*specific child gets the style*/){width:232px; height:173px;  float:left; margin-right:16px; margin-bottom:15px;}
.smallgrid_holder ul li:nth-child(even/*specific child gets the style*/){width:232px; height:173px;   float:left;}

.large_video img{width:480px; height:360px;}
.large_video_nomargin img{width:480px; height:360px; }
.small_video img{width:232px; height:173px; }
.small_video_nomargin img{width:232px; height:173px;}

@media screen and (max-width:999px) {
.wrapper {max-width:681px}
.large_video{width:320px; height:240px;}

.large_video ul li img{width:152px; height:112px;;}
.large_video ul li:nth-child(odd/*specific child gets the style*/){width:152px; height:112px;}
.large_video ul li:nth-child(even/*specific child gets the style*/){width:152px; height:112px;}

.large_video_nomargin{width:320px; height:240px;}
.small_video{width:152px; height:112px;}
.small_video_nomargin{width:152px; height:112px;}
.smalgrid{ height:112px !important; float:left; margin-left:15px; margin-bottom:0px !important;}
.smallgrid_holder{margin: 0px auto;max-width:681px;}
.smallgrid_holder ul {margin:0px; padding:0px; list-style:none; height: 112px !important;float: left;margin-left: 15px; width: 320px;margin-bottom: 15px;}
.smallgrid_holder ul li {margin:0px; padding:0px; list-style:none;}
.smallgrid_holder ul li img{width:152px; height:112px}
.smallgrid_holder ul li:nth-child(odd/*specific child gets the style*/){width:152px; height:112px;  float:left; margin-right:16px;}
.smallgrid_holder ul li:nth-child(even/*specific child gets the style*/){width:152px; height:112px;   float:left;}

.large_video img{width:320px; height:240px;}
.large_video_nomargin img {width:320px; height:240px;}
.small_video img{width:152px; height:112px;}
.small_video_nomargin img{width:152px; height:112px;}
}
@media screen and (max-width:690px) {
.wrapper {max-width:342px}
.smalgrid{ height:112px !important; display:inline-block; margin-left:15px;}
.smallgrid_holder{margin: 0px auto;max-width:342px; text-align:center;}
.smallgrid_holder ul {margin:0px; padding:0px; list-style:none; height: 112px !important;float: left;margin-left: 15px; width: 320px;margin-bottom: 15px;}
}
</style>

<body>
<?php
// featured videos array in key value
$fv = array(
                        '0' => '01.jpg', 
			/*'1' => '02.jpg', 
			'2' => '03.jpg', 
			'3' => '04.jpg', 
			'4' => '05.jpg', 
			'5' => '06.jpg',
			'6' => '07.jpg'*/
			);
// non-featured videos array in key value
$sv = array(
                        '0' => '01.jpg', 
			'1' => '02.jpg', 
			'2' => '03.jpg', 
			/*'3' => '04.jpg', 
			'4' => '05.jpg', 
			'5' => '06.jpg', 
			'6' => '07.jpg', 
			'7' => '08.jpg', 
			'8' => '09.jpg', 
			'9' => '10.jpg', 
			'10' => '11.jpg', 
			'11' => '12.jpg', 
			'12' => '13.jpg', 
			'13' => '14.jpg', 
			'14' => '15.jpg', 
			'15' => '16.jpg',
			/*'16' => '12.jpg', 
			'17' => '13.jpg', 
			'18' => '14.jpg', 
			'19' => '15.jpg',*/ 
			);

// sort in reverse order according to key index
krsort($fv);
krsort($sv);

?><div class="wrapper"><?php

// check is any featured videos available
if (count($fv) > 0) {
	$order = 'left';	// feature video is in left align or right align
	$sv_row = false; 	// checking 4 sv in a row needed
	while (count($fv) > 0) { // read each featured videos

		// PRINT FEATURED VIDEO - LEFT ALIGN
		if ($order == 'left') {		
			?><div class="large_video"><img src="<?=array_pop($fv)?>"></div><?php
		}
		
		// PRINT NON-FEATURED VIDEO - LEFT/RIGHT ALIGN
		$cnt = 1;
		if ((count($sv) >= 4) or (count($fv) <= 0 and count($sv) > 0)) {
			?><div class="large_video"><ul><?php		
				while (count($sv) > 0 and $cnt <= 4) { // read next 4 non-featured videos
					?><li><img src="<?=array_pop($sv)?>"></li><?php
					$cnt++;
				}
			?></ul></div><?php
		}

		// check non-featured videos row is possible
		if (((count($fv) + 1) * 4 <= count($sv)) and $sv_row == false) {
			// PRINT 4 NON-FEATURED VIDEOS IN A ROW					
			?><div class="smallgrid_holder">
				<ul>
					<?php	$cnt = 1;
					while (count($sv) > 0 and $cnt <= 4) {					
						if ($cnt % 2 != 0 and $cnt != 1) { ?></ul><ul><?php } ?>
						<li><img src="<?=array_pop($sv)?>"></li>
						<?php $cnt++;
					} ?>
				</ul>
			</div><?php
			$sv_row = true;
		}

		// PRINT FEATURED VIDEO - RIGHT ALIGN
		if ($order == 'right') {		
			?><div class="large_video"><img src="<?=array_pop($fv)?>"></div><?php
		}

		$order = $order == 'left' ? 'right' : 'left';
		
	} // end featured videos loop

	// check any more non-featured videos available
	if (count($sv) > 0) {?>
		<div class="smallgrid_holder">
			<ul>
				<?php	$cnt = 1;
				while (count($sv) > 0) {
					if ($cnt % 2 != 0 and $cnt != 1) { ?></ul><ul><?php } ?>
					<li><img src="<?=array_pop($sv)?>"></li>
					<?php $cnt++;
				} ?>
			</ul>
		</div> <?php
	}
}elseif (count($sv) > 0) { // check only non-featured videos are available ?>
	<div class="smallgrid_holder">
		<ul>
			<?php 	$cnt = 1;
			while (count($sv) > 0) {
				if ($cnt % 2 != 0 and $cnt != 1) { ?></ul><ul><?php } ?>
				<li><img src="<?=array_pop($sv)?>"></li>
				<?php $cnt++;
			} ?>
		</ul>
	</div><?php
}else{
	echo 'no videos';
}
?>
</div>
</body>
</html>
