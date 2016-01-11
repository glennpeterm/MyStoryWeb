<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//class for configuration handling
class GetRefreshToken extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('google');
        $this->load->model('M_Configuration', '', TRUE);
             
    }
   
    
     //   configuration add  action       
    public function index()
    {
	ini_set("display_errors",1);
        $youtubeClientIdAry    = $this->M_Configuration->getConfigurationDetails('youtube_clientId');
        $youtubeClientSecretAry    = $this->M_Configuration->getConfigurationDetails('youtube_clientSecret');

       $OAUTH2_CLIENT_ID = $youtubeClientIdAry->configuration_data;  
       $OAUTH2_CLIENT_SECRET = $youtubeClientSecretAry->configuration_data;  

    if (isset($_GET['code']))
    {
        $url = 'https://accounts.google.com/o/oauth2/token';
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($ch, CURLOPT_FAILONERROR, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 


        $code = $_GET['code'];
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'code=' . $code . '&' .
        'client_id=' . $OAUTH2_CLIENT_ID . '&' .
        'client_secret=' . $OAUTH2_CLIENT_SECRET . '&' .
        'redirect_uri=' . urlencode('http://mystory.buzz/admin/getRefreshToken') . '&' .
        'grant_type=' . 'authorization_code'
        ); 

        $output = curl_exec($ch);
       

        curl_close($ch);

        echo $output;
        $obj = json_decode($output);
        $token = $obj->{'refresh_token'};
        $insertVal = array('youtube_refreshToken' => $token);
        $result =$this->M_Configuration->saveDetails($insertVal);

        exit;

    }




    $client = new Google_Client();
    $client->setClientId($OAUTH2_CLIENT_ID);
    //$client->setClientSecret($OAUTH2_CLIENT_SECRET);
    //$client->refreshToken('1/ZniNI97r2y14HXQzW15JC-3VeaMCjVFXIbOCFRjVPEUMEudVrK5jSpoR30zcRFq6');
    $client->setScopes('https://gdata.youtube.com');
    $client->setAccessType('offline');
    $client->setApprovalPrompt('force');

    $redirect = filter_var('http://mystory.buzz/admin/getRefreshToken',
    FILTER_SANITIZE_URL);
    $client->setRedirectUri($redirect);


    // If the user hasn't authorized the app, initiate the OAuth flow
    $state = mt_rand();
    $client->setState($state);
    $_SESSION['state'] = $state;

    $authUrl = $client->createAuthUrl();
   
    $data['authUrl'] = $authUrl;

    $this->load->view('configuration/v_refreshToken',$data);
    }
    
    //    End of configuration add  action
    
    
    
}
