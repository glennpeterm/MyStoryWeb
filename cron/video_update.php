<?php
/*
#cron job file to update video likes aand view count from youtube and twitter share count
*/

$dbhost = 'mystory.cjhjmf4v0hmh.eu-central-1.rds.amazonaws.com';
$dbuser = 'mystoryffdbadm';
$dbpass = '9w23SoKfHnoc';
$db = 'mystory';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($db);



include("Youtubeapi.php");
require_once 'google/src/Google/Client.php';
$youtubeApi = new Youtubeapi();

$getConfigQry = mysql_query("select * from configuration");

while ($getConfig = mysql_fetch_assoc($getConfigQry))
{
	$config[$getConfig['configuration_name']] = $getConfig['configuration_data'];
}


$qry = mysql_query("select * from videos where video_status = 1 ");

while ($res = mysql_fetch_assoc($qry))
{
	$getVideoData=0;
	$getVideoData = $youtubeApi->youtubeVideoDetailsAPI($res['video_youtube_id'],$config['youtube_clientId'],$config['youtube_clientSecret'],$config['youtube_refreshToken']);
	//print_r($getVideoData);
	$videoId 	= $res['video_id'];
	if($getVideoData!=0)
	{
		
		// echo "Video : ".$res['video_id'];
		// echo "<br>";
		// echo "Likes : ".$getVideoData['videoLikes']->likeCount;
		// echo "<br>";
		// echo "Views : ".$getVideoData['videoLikes']->viewCount;
		// echo "<br>";echo "<br>";echo "<br>";
		
		$videoLikes = $getVideoData['videoLikes']->likeCount;
		$videoCount = $getVideoData['videoLikes']->viewCount;
		
	}
	else
	{
		$videoLikes = 0;
		$videoCount = 0;
		
	}

	//get the twitter share count of url
	$file = file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=http://kms.fingent.net/videos/video_details/".$videoId."");
	$file = json_decode($file);
	$twitterCount = $file->count;


	mysql_query("update videos set video_youtube_likes= ".$videoLikes.", video_youtube_view_count=".$videoCount.",video_twitter_share = ".$twitterCount." where video_id = ".$videoId."");
	
}




?>

