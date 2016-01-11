<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Youtubeapi {

	
	public function youtubeVideoDetailsAPI($videoId)
	{

			$CI =& get_instance();
    		//--------------
    		$CI->load->model('M_Configuration');  //<-------Load the Model first


    		$configYoutubeClientId          = $CI->M_Configuration->getConfigurationDetails('youtube_clientId');
            $configYoutubeClientSecret      = $CI->M_Configuration->getConfigurationDetails('youtube_clientSecret');
            $configYoutubeRefreshToken      = $CI->M_Configuration->getConfigurationDetails('youtube_refreshToken');

    		$OAUTH2_CLIENT_ID = $configYoutubeClientId->configuration_data;//'919260237447-jjnto4png7g8qmjapfmes7spefhcvdmt.apps.googleusercontent.com';
			$OAUTH2_CLIENT_SECRET = $configYoutubeClientSecret->configuration_data;//'2FA0T6wRdTR_S45Eh4T94RcT';
			$refreshTokenVal	=	$configYoutubeRefreshToken->configuration_data;//'1/5J2s5AJMUNZHMFGAe7Ugn25pQW6nLmZLWezDl6IXUhIMEudVrK5jSpoR30zcRFq6';
			try
			{
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
			    
			 

			    $listResponse = $youtube->videos->listVideos("id, snippet,player, statistics, status",
			        array('id' => $videoId));
                            /*echo '<pre>';
			   print_r($listResponse);
                           echo '</pre>';
                           exit;*/
			    if(!empty($listResponse['items']))
			    {
			    	$videoStatus = $listResponse['items'][0]['status']['privacyStatus'];
				    $videoEmbedCode = $listResponse['items'][0]['player']['embedHtml']; 
				    $videoLikes = $listResponse['items'][0]['statistics']['likeCount'];
                                    $videoThumbnail = $listResponse['items'][0]['snippet']['thumbnails']['default']['url']; 
				    $videoDetails = array('status'=>$videoStatus,'embedCode'=>$videoEmbedCode,'videoLikes'=>$videoLikes,'videoThumbnail'=>$videoThumbnail);                                   
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
		catch (Exception $e)
		{
		  //  print "Caught Google service Exception ".$e->getCode(). " message is ".$e->getMessage();
		   // print "Stack trace is ".$e->getTraceAsString();
		}
	}

	public function deleteYoutubeVideo($videoId)
	{

            $CI =& get_instance();
            //--------------
            $CI->load->model('M_Configuration');  //<-------Load the Model first


    	    $configYoutubeClientId          = $CI->M_Configuration->getConfigurationDetails('youtube_clientId');
            $configYoutubeClientSecret      = $CI->M_Configuration->getConfigurationDetails('youtube_clientSecret');
            $configYoutubeRefreshToken      = $CI->M_Configuration->getConfigurationDetails('youtube_refreshToken');

            $OAUTH2_CLIENT_ID = $configYoutubeClientId->configuration_data;//'919260237447-jjnto4png7g8qmjapfmes7spefhcvdmt.apps.googleusercontent.com';
            $OAUTH2_CLIENT_SECRET = $configYoutubeClientSecret->configuration_data;//'2FA0T6wRdTR_S45Eh4T94RcT';
            $refreshTokenVal	=	$configYoutubeRefreshToken->configuration_data;//'1/5J2s5AJMUNZHMFGAe7Ugn25pQW6nLmZLWezDl6IXUhIMEudVrK5jSpoR30zcRFq6';

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
            try 
            {
                $res = $youtube->videos->delete($videoId);
                  // print_r($res);
                //print_r(json_encode($res));
            } 
            catch (Google_ServiceException $e) {
               // print_r(htmlspecialchars($e->getMessage()));
               
            } 
            catch (Google_Exception $e) {
                //return(htmlspecialchars($e->getMessage()));
             
                
                }
           
        }

    public function updateYoutubeVideoDetailsAPI($videoId,$privacyValue)
	{


			$CI =& get_instance();
    		//--------------
    		$CI->load->model('M_Configuration');  //<-------Load the Model first


    	    $configYoutubeClientId          = $CI->M_Configuration->getConfigurationDetails('youtube_clientId');
            $configYoutubeClientSecret      = $CI->M_Configuration->getConfigurationDetails('youtube_clientSecret');
            $configYoutubeRefreshToken      = $CI->M_Configuration->getConfigurationDetails('youtube_refreshToken');

    		$OAUTH2_CLIENT_ID = $configYoutubeClientId->configuration_data;//'919260237447-jjnto4png7g8qmjapfmes7spefhcvdmt.apps.googleusercontent.com';
			$OAUTH2_CLIENT_SECRET = $configYoutubeClientSecret->configuration_data;//'2FA0T6wRdTR_S45Eh4T94RcT';
			$refreshTokenVal	=	$configYoutubeRefreshToken->configuration_data;//'1/5J2s5AJMUNZHMFGAe7Ugn25pQW6nLmZLWezDl6IXUhIMEudVrK5jSpoR30zcRFq6';
			
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
			    
			 

			    $listResponse = $youtube->videos->listVideos("id, status",
			        array('id' => $videoId));
                            /*echo '<pre>';
			   print_r($listResponse);
                           echo '</pre>';
                           exit;*/
			    if(!empty($listResponse['items']))
			    {
			    	$videoStatus = $listResponse['items'][0]['status']['privacyStatus'];
				   
					$video = $listResponse['items'][0];
					$videoSnippet = $video['status'];
					$privacyStatus = $videoSnippet['privacyStatus'];

					// Set the tags array for the video snippet
					$videoSnippet['privacyStatus'] = $privacyValue;

					// Update the video resource by calling the videos.update() method.
					$updateResponse = $youtube->videos->update("status", $video);

			 
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