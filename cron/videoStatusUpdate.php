<?php
/*
#cron job file to update the video upload status
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

$qry = mysql_query("select * from videos where video_youtube_upload_status = 'uploaded' ");

while ($res = mysql_fetch_assoc($qry))
{
	$getVideoData=0;
	$getVideoData = $youtubeApi->youtubeVideoDetailsAPI($res['video_youtube_id'],$config['youtube_clientId'],$config['youtube_clientSecret'],$config['youtube_refreshToken']);
//echo "<pre>";
	//print_r($getVideoData);

	$videoId 	= $res['video_id'];
	if($getVideoData!=0)
	{
		echo $videoStatus = $getVideoData['status']->uploadStatus;
		if($videoStatus == 'processed')
		{
			//mysql_query("update videos set video_status= '1', video_youtube_upload_status = 'processed' where video_id = ".$videoId."");
			mysql_query("update videos set video_status= '1',video_youtube_status = 'public', video_youtube_upload_status = 'processed' where video_id = ".$videoId."");
		}
		
	}
	
}




?>

