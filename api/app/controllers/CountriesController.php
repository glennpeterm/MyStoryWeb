<?php

class CountriesController extends \BaseController {
    
    /**
	 * Display a list countries
	 * POST /countrylist
	 *
	 * @return Response
	 */
     public function countryList()
	{
        $arr = array();
        $countries = Country::all();
	    $arr = array();
	    if(count($countries) > 0)
	    {
	        $arr['Success'] = true;
	        $arr['Status'] = 'OK';
	        $arr['StatusCode'] = 200;
	        $arr['Result'] = array();
	        $i = 0;
	        foreach($countries as $country)
	        {
	            $arr['Result'][$i]['id'] = $country->country_id; 
	            $arr['Result'][$i]['name'] = ucfirst($country->name); 
	            $i++;
	        }
	        }else
	        {
	            $arr['Success'] = false;
	            $arr['Status'] = 'Country not found';
	            $arr['StatusCode'] = 404;
	        }
        return Response::json($arr);
	}
    
}
