<?php

class LangController extends \BaseController {
    
    /**
	 * Display list of languages
	 * POST /languagelist
	 *
	 * @return Response
	 */
     public function languageList()
	{
        $arr = array();
        $langs = Language::all();
	    $arr = array();
	    if(count($langs) > 0)
	    {
	        $arr['Success'] = true;
	        $arr['Status'] = 'OK';
	        $arr['StatusCode'] = 200;
	        $arr['Result'] = array();
	        $i = 0;
	        foreach($langs as $lang)
	        {
	            $arr['Result'][$i]['code'] = $lang->code; 
	            $arr['Result'][$i]['language'] = $lang->language; 
	            $arr['Result'][$i]['native_name'] = $lang->native_name; 
	            $arr['Result'][$i]['right_to_left'] = $lang->right_to_left; 
	            $arr['Result'][$i]['bible_version'] = $lang->bible_version; 
	            $i++;
	        }
	        }else
	        {
	            $arr['Success'] = false;
	            $arr['Status'] = 'Language not found';
	            $arr['StatusCode'] = 404;
	        }
        return Response::json($arr);
	}
    
}
