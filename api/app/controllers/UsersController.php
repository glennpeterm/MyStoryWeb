<?php

class UsersController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 * POST /adduser
	 *
	 * @return Response
	 */
	public function store()
	{
		$arr = array();
        $res  = User::where('email', Input::get('email'))->get(array('id'))->first();
        if($res){
            //user exists,update users details and return details along with token(for login)
            $missingParam = '';
            if(Input::get('first_name') == '')$missingParam .= 'first_name,';
          //  if(Input::get('last_name') == '')$missingParam .= 'last_name,';
            if(Input::get('email') == '')$missingParam .= 'email';
            if(Input::get('language') == '')$missingParam .= 'language,';
            if(Input::get('provider') == '')$missingParam .= 'provider,';
            if(Input::get('provider_info') == '')$missingParam .= 'provider_info,';
            if($missingParam != '')
            {
                $arr['Success'] = false;
                $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
                $arr['StatusCode'] = 400;
            }else{
                $user = User::whereEmail(Input::get('email'))->first();
                if($user) {
                    $user->language = Input::get('language'); 
                    $user->first_name = Input::get('first_name');
                    $user->last_name = Input::get('last_name');
                    $user->gender = (Input::get('gender') != '' && Input::get('gender') != 'null') ? Input::get('gender') : '';
                    $user->address = (Input::get('address') != '' && Input::get('address') != 'null') ? Input::get('address') : '';
                    $user->city = (Input::get('city') != '' && Input::get('city') != 'null') ? Input::get('city') : '';
                    $user->state = (Input::get('state') != '' && Input::get('state') != 'null') ? Input::get('state') : '';
                    $user->country = (Input::get('country') != '' && Input::get('country') != 'null') ? Input::get('country') : '';
                    $user->zipcode = (Input::get('zipcode') != '' && Input::get('zipcode') != 'null') ? Input::get('zipcode') : '';
                    $user->phone = (Input::get('phone') != '' && Input::get('phone') != 'null') ? Input::get('phone') : '';
                    $user->dob = (Input::get('dob') != '' && Input::get('dob') != 'null') ? Input::get('dob') : '';
                    $user->provider = (Input::get('provider') != '' && Input::get('provider') != 'null') ? Input::get('provider') : '';
                    $user->provider_info = (Input::get('provider_info') != '' && Input::get('provider_info') != 'null') ? Input::get('provider_info') : '';

                    $photoName = '';
                    if(Input::get('photo')){
                        $photoString = Input::get('photo'); 
                        $photoDecode = base64_decode($photoString); // Decode image
                         try{
                            $im = imagecreatefromstring($photoDecode);
                        }
                        catch(Exception $e)
                        {
                            $arr['Success'] = false;
                            $arr['Status'] = ' Empty string or invalid image';
                            $arr['StatusCode'] = 400;
                            return Response::json($arr);
                           
                        }
                        if ($im !== false) 
                        {
                            // Saves an image to specific location
                            $photoName = time().'.png';
                            $resp = imagepng($im, Config::get('app.upload_folder').'/'.$photoName);
                            // Frees image from memory
                            imagedestroy($im);
                        }
                        else 
                        {
                            $arr['Success'] = false;
                            $arr['Status'] = 'Failed to upload image';
                            $arr['StatusCode'] = 400;
                        }
                        $user->photo = $photoName; 
                    }
                    $status = $user->status;
                    $user->save();
                    $userData = User::whereEmail(Input::get('email'))->first();
                    $arr['Success'] = true;
                    $arr['Status'] = 'OK';
                    $arr['StatusCode'] = 200;
                    $arr['language'] = Input::get('language');
                    $arr['Result']['firstName'] = $userData->first_name;
                    $arr['Result']['lastName'] = $userData->last_name;
                    $arr['Result']['gender'] = $userData->gender;
                    $arr['Result']['address'] = $userData->address;
                    $arr['Result']['phone'] = $userData->phone;
                    $arr['Result']['email'] = $userData->email;
                    $arr['Result']['dob'] = $userData->dob;
                    $arr['Result']['city'] = $userData->city;
                    $arr['Result']['state'] = $userData->state;
                    $arr['Result']['country'] = $userData->country;
                    $arr['Result']['zipcode'] = $userData->zipcode;
                    if($photoName != ''){
                        $arr['Result']['photo'] = Config::get('app.photo_url').'/'.$photoName;
                    }
                    $arr['Result']['provider'] = $userData->provider;
                    $arr['Result']['provider_info'] = $userData->provider_info;
                    $arr['Result']['authToken'] = Config::get('app.persistent-api-key');
                    $arr['Result']['isactive'] = $userData->status;
                     
                }else{
                    $arr['Success'] = false;
                    $arr['Status'] = 'Failed to login';
                    $arr['StatusCode'] = 404;
                }
            }
        }else{

            //Add new user
            $missingParam = '';
            if(Input::get('first_name') == '')$missingParam .= 'first_name,';
            //if(Input::get('last_name') == '')$missingParam .= 'last_name,';
            if(Input::get('email') == '')$missingParam .= 'email,';
            if(Input::get('language') == '')$missingParam .= 'language,';
            if(Input::get('provider') == '')$missingParam .= 'provider,';
            if(Input::get('provider_info') == '')$missingParam .= 'provider_info,';
            if($missingParam != '')
            {
                $arr['Success'] = false;
                $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
                $arr['StatusCode'] = 400;
            }else{
                $user = new User;
                if(Input::get('language')){
                    $user->language = Input::get('language'); 
                }else{
                    $user->language = ''; 
                }
                $user->email = Input::get('email');
                $user->dob = Input::get('dob');
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');

                $user->gender = (Input::get('gender') != '' && Input::get('gender') != 'null') ? Input::get('gender') : '';
                $user->address = (Input::get('address') != '' && Input::get('address') != 'null') ? Input::get('address') : '';
                $user->city = (Input::get('city') != '' && Input::get('city') != 'null') ? Input::get('city') : '';
                $user->state = (Input::get('state') != '' && Input::get('state') != 'null') ? Input::get('state') : '';
                $user->country = (Input::get('country') != '' && Input::get('country') != 'null') ? Input::get('country') : '';
                $user->zipcode = (Input::get('zipcode') != '' && Input::get('zipcode') != 'null') ? Input::get('zipcode') : '';
                $user->phone = (Input::get('phone') != '' && Input::get('phone') != 'null') ? Input::get('phone') : '';
                $user->dob = (Input::get('dob') != '' && Input::get('dob') != 'null') ? Input::get('dob') : '';
                $user->provider = (Input::get('provider') != '' && Input::get('provider') != 'null') ? Input::get('provider') : '';
                $user->provider_info = (Input::get('provider_info') != '' && Input::get('provider_info') != 'null') ? Input::get('provider_info') : '';
                
                 $photoName = '';
                if(Input::get('photo')){
                        $photoString = Input::get('photo'); 
                        $photoDecode = base64_decode($photoString); // decode image
                        try{
                            $im = imagecreatefromstring($photoDecode);
                        }
                        catch(Exception $e)
                        {
                            $arr['Success'] = false;
                            $arr['Status'] = ' Empty string or invalid image';
                            $arr['StatusCode'] = 400;
                            return Response::json($arr);

                        }
                        
                        if ($im !== false) 
                        {
                            // Saves an image to specific location
                            $photoName = time().'.png';
                            $resp = imagepng($im, Config::get('app.upload_folder').'/'.$photoName);
                            // Frees image from memory
                            imagedestroy($im);
                        }
                        else 
                        {
                            $arr['Success'] = false;
                            $arr['Status'] = 'Failed to upload image';
                            $arr['StatusCode'] = 400;
                            return Response::json($arr);
                        }
                        $user->photo = $photoName; 
                }
                $status = $user->status;
                $user->save();
                $insertedId = $user->id;
                $userData = User::whereEmail(Input::get('email'))->first();
                if($insertedId > 0){
                    $arr['Success'] = true;
                    $arr['Status'] = 'OK';
                    $arr['StatusCode'] = 200;
                    $arr['language'] = Input::get('language');
                    $arr['Result']['firstName'] = $userData->first_name;
                    $arr['Result']['lastName'] = $userData->last_name;
                    $arr['Result']['gender'] = $userData->gender;
                    $arr['Result']['address'] = $userData->address;
                    $arr['Result']['phone'] = $userData->phone;
                    $arr['Result']['email'] = $userData->email;
                    $arr['Result']['dob'] = $userData->dob;
                    $arr['Result']['city'] = $userData->city;
                    $arr['Result']['state'] = $userData->state;
                    $arr['Result']['country'] = $userData->country;
                    $arr['Result']['zipcode'] = $userData->zipcode;
                     if($photoName != ''){
                        $arr['Result']['photo'] = Config::get('app.photo_url').'/'.$photoName;
                     }
                     $arr['Result']['provider'] = $userData->provider;
                     $arr['Result']['provider_info'] = $userData->provider_info;
                     $arr['Result']['authToken'] = Config::get('app.persistent-api-key');
                     $arr['Result']['isactive'] = $userData->status;
                }else{
                     $arr['Success'] = false;
                     $arr['Status'] = 'Failed to create user';
                     $arr['StatusCode'] = 404;
                }
            }
        }
        return Response::json($arr);
	}

    /**
	 * Update the specified resource in storage.
	 * POST /updateuser
	 *
	 * @return Response
	 */
	public function updateUser()
	{
       
        $arr = array();
        $missingParam = '';
        if(Input::get('first_name') == '')$missingParam .= 'first_name,';
        //if(Input::get('last_name') == '')$missingParam .= 'last_name,';
        if(Input::get('email') == '')$missingParam .= 'email,';
        if(Input::get('language') == '')$missingParam .= 'language,';
        if(Input::get('provider') == '')$missingParam .= 'provider,';
        if(Input::get('provider_info') == '')$missingParam .= 'provider_info,';
        if($missingParam != '')
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
            $arr['StatusCode'] = 400;
        }else{
            $user = User::whereEmail(Input::get('email'))->first();
            if($user) {
                $user->language = Input::get('language'); 
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->gender = (Input::get('gender') != '' && Input::get('gender') != 'null') ? Input::get('gender') : '';
                $user->address = (Input::get('address') != '' && Input::get('address') != 'null') ? Input::get('address') : '';
                $user->city = (Input::get('city') != '' && Input::get('city') != 'null') ? Input::get('city') : '';
                $user->state = (Input::get('state') != '' && Input::get('state') != 'null') ? Input::get('state') : '';
                $user->country = (Input::get('country') != '' && Input::get('country') != 'null') ? Input::get('country') : '';
                $user->zipcode = (Input::get('zipcode') != '' && Input::get('zipcode') != 'null') ? Input::get('zipcode') : '';
                $user->phone = (Input::get('phone') != '' && Input::get('phone') != 'null') ? Input::get('phone') : '';
                $user->dob = (Input::get('dob') != '' && Input::get('dob') != 'null') ? Input::get('dob') : '';
                $user->provider = (Input::get('provider') != '' && Input::get('provider') != 'null') ? Input::get('provider') : '';
                $user->provider_info = (Input::get('provider_info') != '' && Input::get('provider_info') != 'null') ? Input::get('provider_info') : '';
                $photoName = '';
                if(Input::get('photo')){
                        $photoString = Input::get('photo'); 
                        $photoDecode = base64_decode($photoString); // decode image
                         try{
                            $im = imagecreatefromstring($photoDecode);
                        }
                        catch(Exception $e)
                        {
                            $arr['Success'] = false;
                            $arr['Status'] = ' Empty string or invalid image';
                            $arr['StatusCode'] = 400;
                            return Response::json($arr);
                           
                        }
                        if ($im !== false) 
                        {
                            // saves an image to specific location
                            $photoName = time().'.png';
                            $resp = imagepng($im, Config::get('app.upload_folder').'/'.$photoName);
                            // frees image from memory
                            imagedestroy($im);
                        }
                        else 
                        {
                            $arr['Success'] = false;
                            $arr['Status'] = 'Failed to upload image';
                            $arr['StatusCode'] = 400;
                        }
                        $user->photo = $photoName; 
                    }
                $user->save();
                $userData = User::whereEmail(Input::get('email'))->first();
                $arr['Success'] = true;
                $arr['Status'] = 'OK';
                $arr['StatusCode'] = 200;
                $arr['language'] = Input::get('language');
                $arr['Result']['firstName'] = $userData->first_name; 
                $arr['Result']['lastName'] = $userData->last_name; 
                $arr['Result']['gender'] = $userData->gender; 
                $arr['Result']['address'] = $userData->address; 
                $arr['Result']['city'] = $userData->city; 
                $arr['Result']['state'] = $userData->state; 
                $arr['Result']['country'] = $userData->country; 
                $arr['Result']['zipcode'] = $userData->zipcode;
                $arr['Result']['phone'] = $userData->phone;
                $arr['Result']['email'] = $userData->email;
                $arr['Result']['dob'] = $userData->dob;
                $arr['Result']['provider'] = $userData->provider;
                $arr['Result']['provider_info'] = $userData->provider_info;
                if($photoName != ''){
                    $arr['Result']['photo'] = Config::get('app.photo_url').'/'.$photoName;
                }
                $arr['Result']['authToken'] = Config::get('app.persistent-api-key');
                $arr['Result']['isactive'] = $userData->status;
            }else{
                $arr['Success'] = false;
                $arr['Status'] = 'User not found';
                $arr['StatusCode'] = 404;
            }
        }
        return Response::json($arr);
	}
    
    /**
	 * Return user details
	 * POST /viewuser
	 *
	 * @return Response
	 */
	public function viewUser()
	{
        $arr = array();
        $missingParam = '';
        if(Input::get('email') == '')$missingParam .= 'email,';
        if(Input::get('language') == '')$missingParam .= 'language,';
        if($missingParam != '')
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
            $arr['StatusCode'] = 400;
        }else{
            $user = User::where('email', '=', Input::get('email'))->first();
            if($user) {
                $arr['Success'] = true;
                $arr['Status'] = 'OK';
                $arr['StatusCode'] = 200;
                $arr['language'] = Input::get('language');
                $arr['Result']['firstName'] = $user->first_name;
                $arr['Result']['lastName'] = $user->last_name;
                $arr['Result']['gender'] = $user->gender;
                $arr['Result']['dob'] = $user->dob;
                $arr['Result']['address'] = $user->address;
                $arr['Result']['city'] = $user->city;
                $arr['Result']['state'] = $user->state;
                $arr['Result']['country'] = $user->country;
                $arr['Result']['zipcode'] = $user->zipcode;
                $arr['Result']['phone'] = $user->phone;
                $arr['Result']['provider'] = $user->provider;
                $arr['Result']['provider_info'] = $user->provider_info;
                $arr['Result']['photo'] = '';
                if($user->photo != ''){
                    $arr['Result']['photo'] = Config::get('app.photo_url').'/'.$user->photo;
                }
                $arr['Result']['isactive'] = $user->status;
            }else{
                $arr['Success'] = false;
                $arr['Status'] = 'User not found';
                $arr['StatusCode'] = 404;
            }
        }
        return Response::json($arr);
	}
    
	/**
	 * Update the specified resource in storage.
	 * PUT /updateuser
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
        $email = Input::get('email'); 
        $user = User::find($email);
        $user->language = Input::get('language'); 
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->gender = Input::get('gender');
        $user->address = Input::get('address');
        $user->city = Input::get('city');
        $user->state = Input::get('state');
        $user->country = Input::get('country');
        $user->phone = Input::get('phone');
        if(Input::get('photo')){
            $user->photo = Input::get('photo'); 
        }
        $user->save();
	}
    
}
