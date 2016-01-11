<?php

class ExampleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//?token=1234
        //$token = Input::get('token');
       // echo $token.' check';exit;
       echo Config::get('app.unauth-api-key');exit;
       
        //
	}
    
    public function init()
	{
		$unauthToken = $this->getUnauthToken();
        if($unauthToken){
            return Response::json(array('unauthToken' => $unauthToken));
        }
       return Response::json(array('unauthToken' => 'Invalid'));
	}

    public function getnews()
    {
       return Response::json(array('news' => 'Here is the news'));
    }

    public function getUnauthToken()
    {
        $results = DB::select('select token from unauth_token where date_created = ? limit 1', array(date('Y-m-d')));
        if($results){
            $unauthToken = $results[0]->token;
            return $unauthToken;
        }
        $unauthToken = hash('sha256',Str::random(10),false);
        $res = DB::insert('insert into unauth_token (date_created, token) values (?, ?)', array(date('Y-m-d'), $unauthToken));
        if($res){
            return $unauthToken;
        }
        return false;
    }
    
    public function checkUnauthToken($unauthTokenReceived='')
    {
        $results = DB::select('select token from unauth_token where date_created = ? limit 1', array(date('Y-m-d')));
        if($results){
            $unauthToken = $results[0]->token;
            if($unauthToken == $unauthTokenReceived){
                return true;
            }
        }
        
        return false;
    }
    
    public function providecontent(){
        echo 'here is the requested content';exit;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
