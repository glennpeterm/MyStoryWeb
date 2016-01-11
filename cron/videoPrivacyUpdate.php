<?php
/*
#cron job file to update youtube video status to db
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


$qry = mysql_query("select * from videos");

while ($res = mysql_fetch_assoc($qry))
{
	$getVideoData=0;
	$getVideoData = $youtubeApi->youtubeVideoDetailsAPI($res['video_youtube_id'],$config['youtube_clientId'],$config['youtube_clientSecret'],$config['youtube_refreshToken']);
	$videoId 	= $res['video_id'];
	if($getVideoData!=0)
	{
		
		
		$privacyStatus = $getVideoData['status']->privacyStatus;
		if($privacyStatus=='private')
		{
			$videoStatusVal = 0;
			$videoPrivacyVal = $privacyStatus;
		}
		else
		{
			$videoStatusVal = 1;
			$videoPrivacyVal = 'unlisted';
		}

	//echo "update videos set video_status='".$videoStatusVal."',video_youtube_status = '".$videoPrivacyVal."' where video_id = '".$videoId."'";
	     //  echo "update videos set video_status='".$videoStatusVal."',video_youtube_status = '".$videoPrivacyVal."' where video_id = '".$videoId."'";echo "<br>";
	mysql_query("update videos set video_status='".$videoStatusVal."',video_youtube_status = '".$videoPrivacyVal."' where video_id = '".$videoId."'");
		
	}
	else
	{
		$videoLikes = 0;
		$videoCount = 0;
		
	}



	
	
}




?>

