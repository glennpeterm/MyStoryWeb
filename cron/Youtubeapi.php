<?php 
class Youtubeapi {

	
	public function youtubeVideoDetailsAPI($videoId,$youtube_clientId,$youtube_clientSecret,$youtube_refreshToken)
	{


    		$OAUTH2_CLIENT_ID = $youtube_clientId;//'919260237447-jjnto4png7g8qmjapfmes7spefhcvdmt.apps.googleusercontent.com';
			$OAUTH2_CLIENT_SECRET = $youtube_clientSecret;//'2FA0T6wRdTR_S45Eh4T94RcT';
			$refreshTokenVal	=	$youtube_refreshToken;//'1/5J2s5AJMUNZHMFGAe7Ugn25pQW6nLmZLWezDl6IXUhIMEudVrK5jSpoR30zcRFq6';
			
			$client = new Google_Client();
			$client->setClientId($OAUTH2_CLIENT_ID);
			$client->setClientSecret($OAUTH2_CLIENT_SECRET);
			$client->refreshToken($refreshTokenVal);
			$client->setScopes('https://www.googleapis.com/auth/youtube');
			$client->setAccessType("offline");
			$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
			  FILTER_SANITIZE_URL);
			$client->setRedirectUri($redirect);

			// Define an object that will be used to make all API requests.
			$youtube = new Google_Service_YouTube($client);

			if (isset($_GET['code'])) {
			  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
			    die('The session state did not match.');
			  }

			  $client->authenticate($_GET['code']);
			  $_SESSION['token'] = $client->getAccessToken();
			  header('Location: ' . $redirect);
			}

			if (isset($_SESSION['token'])) {
			  $client->setAccessToken($_SESSION['token']);
			}

			// Check to ensure that the access token was successfully acquired.
			if ($client->getAccessToken())
			{
			  try
			  {
			    // Call the channels.list method to retrieve information about the
			    // currently authenticated user's channel.
			    
			 

			    $listResponse = $youtube->videos->listVideos("id,statistics, status",
			        array('id' => $videoId));
                           // echo '<pre>';
			   //print_r($listResponse);
                   //        echo '</pre>';
                   //        exit;
			    if(!empty($listResponse['items']))
			    {
			    	$videoStatus = $listResponse['items'][0]['status'];
				    $videoLikes = $listResponse['items'][0]['statistics'];
                    $videoDetails = array('status'=>$videoStatus,'videoLikes'=>$videoLikes);                                   
				    return $videoDetails;
			    }
			    else
			    {
			    	return 0;
			    }
			   
			  }
			  catch (Google_ServiceException $e)
			  {
			  	return 0;
			    //$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
			    //htmlspecialchars($e->getMessage()));
			  }
			  catch (Google_Exception $e)
			  {
			  	return 0;
			   // $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
			   // htmlspecialchars($e->getMessage()));
			  }

			  $_SESSION['token'] = $client->getAccessToken();
			}
			else
			{
				return 0;
			}
			

	}
}