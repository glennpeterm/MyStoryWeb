<?php

class TopicsController extends \BaseController {
    
    /**
	 * Display a list topics
	 * POST /topiclist
	 *
	 * @return Response
	 */
     public function topicList()
	{
        $language = Input::get('language'); 
        if($language == '')
        {
             $arr['Success'] = false;
             $arr['Status'] = 'Parameter missing: language';
             $arr['StatusCode'] = 400;
        }else{
	        $topics = Topic::whereTopicLanguage($language)->get();
	        $arr = array();
	        if(count($topics) > 0)
	        {
	            $arr['Success'] = true;
	            $arr['Status'] = 'OK';
	            $arr['StatusCode'] = 200;
	            $arr['language'] = $language; 
	            $arr['Result'] = array();
	            $i = 0;
	            foreach($topics as $topic)
	            {
	                $arr['Result'][$i]['id'] = $topic->topic_id; 
	                $arr['Result'][$i]['name'] = ucfirst($topic->topic_name); 
	                $i++;
	            }
	        }else
	        {
	            $arr['Success'] = false;
	            $arr['Status'] = 'Topic not found';
	            $arr['StatusCode'] = 404;
	        }
    	}
        return Response::json($arr);
	}
  
}
