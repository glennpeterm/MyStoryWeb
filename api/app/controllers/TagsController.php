<?php

class TagsController extends \BaseController {

	
	/**
	 * Store a new tag in storage.
	 * POST /addtag
	 *
	 * @return Response
	 */
	public function store()
	{
		$arr = array();
		$missingParam = '';
		if(Input::get('tag') == '')$missingParam .= 'tag,';
        if(Input::get('language') == '')$missingParam .= 'language,';
        if($missingParam != '')
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
            $arr['StatusCode'] = 400;
        }else {
	        $res  = Tag::where('hash_name', Input::get('tag'))->get(array('hash_id'))->first();
	        if($res){
	        	//Tag exists, show error 
	        	$arr['Succcess'] = false;
	            $arr['Status'] = 'Tag already exists';
	            $arr['StatusCode'] = 400;
	        }else{
	        	//Add tag
	        	$tg = new Tag;
	        	$tg->hash_name = Input::get('tag');
	        	$tg->hash_language 	 = Input::get('language');
	        	$tg->save();
	            $insertedId = $tg->id;
	            $tagData = Tag::wherehashId($insertedId )->first();
	            if($insertedId > 0){
	            	$arr['Success'] = true;
	                $arr['Status'] = 'OK';
	                $arr['StatusCode'] = 200;
	                $arr['language'] = $tagData->hash_language;
	                $arr['Result']['id'] = $tagData->hash_id;
	                $arr['Result']['name'] = ucfirst($tagData->hash_name);
	            }
	        }
    	}
        return Response::json($arr);
	}

/**
	 * Suggest tags
	 * POST /suggesttags
	 *
	 * @return Response
	 */
	public function suggestTags()
	{
		$arr = array();
		$missingParam = '';
		$keyword = trim(Input::get('keyword'));
		if($keyword == '')$missingParam .= 'keyword,';
        if(Input::get('language') == '')$missingParam .= 'language,';
        if($missingParam != '')
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
            $arr['StatusCode'] = 400;
        }else{
        	if(strlen($keyword) < 3){
        		$arr['Success'] = false;
            	$arr['Status'] = 'No Matches found';
            	$arr['StatusCode'] = 404;
        	}else{
        		$tags = Tag::where('hash_name', 'LIKE', "%$keyword%")->get();
	        	if(count($tags) > 0){
	        		$arr['Success'] = true;
			        $arr['Status'] = 'OK';
			        $arr['StatusCode'] = 200;
			        $arr['language'] = Input::get('language'); 
			        $arr['Result'] = array();
			        $i = 0;
			        foreach($tags as $tg)
			        {
			            $arr['Result'][$i]['id'] = $tg->hash_id; 
			            $arr['Result'][$i]['name'] = ucfirst($tg->hash_name); 
			            $i++;
			        }
	        	}else{
	        		$arr['Success'] = false;
	            	$arr['Status'] = 'No matches found';
	            	$arr['StatusCode'] = 404;

	        	}
        	}
        }
        return Response::json($arr);
	}

}
