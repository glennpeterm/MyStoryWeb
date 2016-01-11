<?php

class InitController extends \BaseController {
    
    /**
	 * Returns a token when initialising the app in current date(Datewise token for public data)
	 *
	 * @return Response
	 */
    public function init()
	{
		
        $unauthToken = $this->getUnauthToken();
        $arr = array();
        if($unauthToken){
             $arr['Success'] = true;
             $arr['Status'] = 'OK';
             $arr['StatusCode'] = 200;
             $arr['Result']['token'] = $unauthToken;
             return Response::json($arr);
        }
        $arr['Success'] = false;
        $arr['Status'] = 'Failed to generate token';
        $arr['StatusCode'] = 406;
        return Response::json($arr);
	}

    /**
	 * Returns a token
	 *
	 * @return Response
	 */
    public function getUnauthToken()
    {
        //check for token in the current date, if found return it
        $results = DB::select('select token from unauth_token where date_created = ? limit 1', array(date('Y-m-d')));
        if($results){
            $unauthToken = $results[0]->token;
            return $unauthToken;
        }
        //if token not exists for the current date then create one and return
        $unauthToken = hash('sha256',Str::random(10),false);
        $id = DB::table('unauth_token')->insertGetId(
            array('date_created' => date('Y-m-d'), 'token' => $unauthToken)
        );
        //delete token in old date if any
        DB::delete("delete from  unauth_token where id != '$id'");
        if($unauthToken){
            return $unauthToken;
        }
        return false;
    }
   
}
