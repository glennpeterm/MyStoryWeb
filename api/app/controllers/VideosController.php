<?php

class VideosController extends \BaseController {

	/**
	 * Return tutorial video url
	 * POST /tutorialvideo
	 * 
	 * @return Response
	 */
	public function tutorialVideo()
	{
        $language = Input::get('language'); 
        if($language == '')
        {
             $arr['Success'] = false;
             $arr['Status'] = 'Parameter missing: language';
             $arr['StatusCode'] = 400;
        }else{
             $arr = array();
             $res  = TutorialVideo::where('configuration_name', 'tutorial_video')
                                    ->where('configuration_language',$language)
                                    ->get(array('configuration_data','configuration_language'))
                                    ->first();
             if($res)
             {
                 $arr['Success'] = true;
                 $arr['Status'] = 'OK';
                 $arr['StatusCode'] = 200;
                 $arr['language'] = $language;
                 $arr['Result']['url'] = '';
                 if(isset($res->configuration_data) && ($res->configuration_data != ''))
                 {
                     $arr['Result']['url'] = $res->configuration_data;
                 }
             }else{
                 $arr['Success'] = false;
                 $arr['Status'] = 'Video not found';
                 $arr['StatusCode'] = 404;
             }
        }
        return Response::json($arr);
	}
    
    /**
	 * Return all selfie videos of user
	 * POST /selfievideos
	 * Param email
	 * @return Response
	 */
	public function selfieVideos()
	{
         $email = Input::get('email'); 
         $language = Input::get('language'); 
         $arr = array();
         $missingParam = '';
         if($email == '')$missingParam .= 'email,';
         if($language == '')$missingParam .= 'language,';
         if($missingParam != '')
         {
             $arr['Success'] = false;
             $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
             $arr['StatusCode'] = 400;
         }else{
             $user = User::whereEmail($email)->first();
             if($user){
                 $userId = $user->id;
                 $selfies  = Video::where('user_id', $userId)
                                        // ->where('video_language', $language)
                                         ->get(array('video_id as id','video_title as title','video_desc as description','video_youtube_id as youtube_id','video_embed as embed','video_url as url','video_thumbnail_url as thumbnail_url','scripture_text','video_language as language','video_country as country','video_status as status'));
                 if(count($selfies) == 0)
                 {
                     $arr['Success'] = false;
                     $arr['Status'] = 'Video not found';
                     $arr['StatusCode'] = 404;
                 }else{
                     $arr['Success'] = true;
                     $arr['Status'] = 'OK';
                     $arr['StatusCode'] = 200;
                     $arr['language'] = $language;
                     $url = Config::get('app.selfie_web_view_url');
                     $url = str_replace('{userId}', $userId, $url);
                     $url = str_replace('{language}', $language, $url);
                     $arr['url'] = $url;
                     /*$i = 0;
                    foreach($selfies as $selfie)
                    {
                        $arr['Result'][$i]['id'] = $selfie->id; 
                        $arr['Result'][$i]['title'] = $selfie->title; 
                        $arr['Result'][$i]['description'] = $selfie->description; 
                        $arr['Result'][$i]['video_short_desc'] = $selfie->description; 
                        $arr['Result'][$i]['youtubeId'] = $selfie->youtube_id; 
                        $arr['Result'][$i]['youtubeUrl'] = $selfie->url;  
                        $arr['Result'][$i]['youtubeThumbnailUrl'] = $selfie->thumbnail_url;  
                        $arr['Result'][$i]['scripture_text'] = $selfie->scripture_text;  
                        $arr['Result'][$i]['embedCode'] = $selfie->embed;  
                        $arr['Result'][$i]['status'] = $selfie->status; 
                        $i++;
                    }*/
                 }
            }else{
                $arr['Success'] = false;
                $arr['Status'] = 'User with this email does not exist';
                $arr['StatusCode'] = 404;

            }
        }
        return Response::json($arr);
	}
    
    /**
     * Return all unpublished and unviewed selfie videos of user
     * POST /unpublishedselfievideos
     * Param email
     * @return Response
     */
    public function unpublishedSelfieVideos()
    {
         $email = Input::get('email'); 
         $language = Input::get('language'); 
         $arr = array();
         $missingParam = '';
         if($email == '')$missingParam .= 'email,';
         if($language == '')$missingParam .= 'language,';
         if($missingParam != '')
         {
             $arr['Success'] = false;
             $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
             $arr['StatusCode'] = 400;
         }else{
             $user = User::whereEmail($email)->first();
             if($user){
                 $userId = $user->id;
                 $selfies  = Video::where('user_id', $userId)
                                        //->where('video_language', $language)
                                        ->where('isunpublishedview_video', 0)
                                        ->where('video_status', 0)
                                        ->get(array('video_id as id','video_title as title','video_desc as description','video_youtube_id as youtube_id','video_embed as embed','video_url as url','video_thumbnail_url as thumbnail_url','scripture_text','video_language as language'));
                 if(count($selfies) == 0)
                 {
                     $arr['Success'] = false;
                     $arr['Status'] = 'Video not found';
                     $arr['StatusCode'] = 404;
                 }else{
                     $arr['Success'] = true;
                     $arr['Status'] = 'OK';
                     $arr['StatusCode'] = 200;
                     $arr['language'] = $language;
                     $i = 0;
                    foreach($selfies as $selfie)
                    {
                        $arr['Result'][$i]['id'] = $selfie->id; 
                        $arr['Result'][$i]['title'] = $selfie->title; 
                        $arr['Result'][$i]['description'] = $selfie->description; 
                        $arr['Result'][$i]['youtubeId'] = $selfie->youtube_id; 
                        $arr['Result'][$i]['youtubeUrl'] = $selfie->url;  
                        $arr['Result'][$i]['youtubeThumbnailUrl'] = $selfie->thumbnail_url;  
                        $arr['Result'][$i]['scripture_text'] = $selfie->scripture_text;  
                        $arr['Result'][$i]['embedCode'] = $selfie->embed;  
                        $i++;
                    }
                 }
            }else{
                $arr['Success'] = false;
                $arr['Status'] = 'User with this email does not exist';
                $arr['StatusCode'] = 404;

            }
        }
        return Response::json($arr);
    }

    /**
     * Update view status of selfie video
     * POST /updateselfieviewstatus
     * Param video_id
     * @return Response
     */
    public function updateSelfieViewStatus()
    {
        $arr = array();
        $videoId = Input::get('video_id'); 
        if($videoId == '')
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Parameter missing: video_id';
            $arr['StatusCode'] = 400;
        }else{
            $selfie = Video::find($videoId);
            if($selfie){
                $selfie->isunpublishedview_video = 1;
                $selfie->save();
                $arr['Success'] = true;
                $arr['Status'] = 'OK';
                $arr['StatusCode'] = 200;
                $arr['Result']['id'] = $videoId; 
                $arr['Result']['isunpublishedview_video'] = 1;
            }else{
                $arr['Success'] = false;
                $arr['Status'] = 'Video not found';
                $arr['StatusCode'] = 404;
            }
            
        }
        return Response::json($arr);
    }
    
    
    /**
	 * Return videos based on search keyword/selected channel/topic
	 * POST /videos
     * @param  string  $channel(scripture,selfie or testimonial)
	 * @return Response
	 */
	public function videos()
	{
		$arr = array();
        $channel = Input::get('channel'); //(selfie/testimonial/scripture)
        $topic = Input::get('topic');
        $keyword = trim(Input::get('keyword'));
        $language = trim(Input::get('language'));
        $bindArr = array();
        if($language == '')
        {
             $arr['Success'] = false;
             $arr['Status'] = 'Parameter missing: language';
             $arr['StatusCode'] = 400;
        }else{
            if($channel == '' && $topic == '' && $keyword == '')
             {
                //If parameters are not specified, show featured videos in all channels
                $qry = "SELECT video_id as id,video_title as title,
                                              video_desc as description,video_youtube_id as youtube_id,
                                              video_embed as embedcode,video_url as url,scripture_text,
                                              video_status as status,video_type as type
                                       FROM  videos  
                                       WHERE `video_highlight` = 1";
             }else{
                //List videos based on topics or keyword
                $conStart = 'AND (';
                $conEnd = ')'; 
                $condition = '';
                $prefix = '';
                if($topic != ''){
                    $topic = "%{$topic}%";
                    $condition .= ' t.topic_name LIKE ? ';
                    array_push($bindArr,$topic);
                } 
                if($keyword != ''){
                    $keyword = "%{$keyword}%";
                    if($condition != '')$prefix = 'OR';
                    $condition .= " $prefix t.topic_name LIKE ? OR v.video_title LIKE ? OR v.video_desc LIKE ? ";
                    array_push($bindArr,$topic,$topic,$topic);
                } 
                if($condition != ''){
                    $condition = $conStart.$condition.$conEnd;
                }
                $Where = '';
                if($channel != ''){
                     $Where .= " AND v.`video_type` = '$channel'";
                }
                if($topic != '' || $keyword != ''){
                     $Where .= ' AND (v.`video_id` = vt.`video_id` OR v.`video_id` = vh.`video_id`)';
                }
                $qry = "SELECT v.video_id as id,v.video_title as title,
                            v.video_desc as description,v.video_youtube_id as youtube_id,
                            v.video_embed as embedcode,v.video_url as url,v.scripture_text,
                            v.video_status as status,v.video_type as type
                        FROM videos v 
                        LEFT JOIN video_topic_relation vt ON v.video_id = vt.video_id 
                        LEFT JOIN video_hash_relation vh ON v.video_id = vh.video_id 
                        LEFT JOIN topic t ON vt.topic_id = t.topic_id  
                        WHERE  $Where $condition";
             }   
             $videos = DB::select($qry,$bindArr);
             if(count($videos) == 0)
             {
                 $arr['Success'] = false;
                 $arr['Status'] = 'Video not found';
                 $arr['StatusCode'] = 404;
             }else{
                 $arr['Success'] = true;
                 $arr['Status'] = 'OK';
                 $arr['StatusCode'] = 200;
                 $arr['language'] = $language;
                 $arr['Result'] = array();
                 $i = 0;
                foreach($videos as $video)
                {
                    $arr['Result'][$i]['id'] = $video->id; 
                    $arr['Result'][$i]['title'] = $video->title; 
                    $arr['Result'][$i]['description'] = $video->description; 
                    $arr['Result'][$i]['youtubeId'] = $video->youtube_id; 
                    $arr['Result'][$i]['url'] = $video->url;
                    $arr['Result'][$i]['scripture_text'] = $video->scripture_text;  
                    $arr['Result'][$i]['status'] = $video->status; 
                    if($channel != ''){
                        $arr['Result'][$i]['type'] = $channel;  
                    }else{
                        $arr['Result'][$i]['type'] = $video->type; 
                    }
                    $i++;
                }
             }
         }
        return Response::json($arr);
	}


    /**
     * Return all videos
     * POST /allvideos
     * @param  string  $language
     * @return Response
     */
    public function allVideos()
    {
        $arr = array();
        $language = trim(Input::get('language'));
        if($language == '')
        {
             $arr['Success'] = false;
             $arr['Status'] = 'Parameter missing: language';
             $arr['StatusCode'] = 400;
        }else{
           // $videos  = Video::where('video_language', $language)
           //                   ->get(array('video_id as id'));

            $videos = Video::all();
                 
             if(count($videos) == 0)
             {
                 $arr['Success'] = false;
                 $arr['Status'] = 'Video not found';
                 $arr['StatusCode'] = 404;
             }else{
                 $arr['Success'] = true;
                 $arr['Status'] = 'OK';
                 $arr['StatusCode'] = 200;
                 $arr['language'] = $language;
                 $url = Config::get('app.channel_videos_web_view_url');
                 $url = str_replace('{language}', $language, $url);
                 $arr['url'] = $url;
             }
         }
        return Response::json($arr);
    }
    
    
    /**
     * Add selfie video to backend
     * POST /adduselfievideo
     *
     * @return Response
     */
    public function addSelfieVideo()
    {
        $arr = array();
        $missingParam = '';
        if(Input::get('title') == '')$missingParam .= 'title,';
        if(Input::get('youtube_id') == '')$missingParam .= 'youtube_id,';
        if(Input::get('youtube_url') == '')$missingParam .= 'youtube_url,';
        if(Input::get('language') == '')$missingParam .= 'language,';
        if(Input::get('email') == '')$missingParam .= 'email,';
        if(Input::get('scripture_text') == '')$missingParam .= 'scripture_text,';        
        if(Input::get('book_name') == '')$missingParam .= 'book_name,';        
        if(Input::get('chapter') == '')$missingParam .= 'chapter,';
        if(Input::get('verse') == '')$missingParam .= 'verse,';      
        if(Input::get('country') == '')$missingParam .= 'country,';
        if(Input::get('topics') == '')$missingParam .= 'topics,';
        if($missingParam != '')
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
            $arr['StatusCode'] = 400;
        }else{
            $user = User::whereEmail(Input::get('email'))->first();
            if($user) {
                //Save video
                $userId = $user->id;
                $video = new Video;
                $video->video_title = Input::get('title');
                $video->video_desc = Input::get('description');
                $video->video_short_desc = Input::get('description');
                $video->video_youtube_id = Input::get('youtube_id');

                $embedCode = "<iframe type='text/html' src='http://www.youtube.com/embed/".Input::get('youtube_id')."' width='640' height='360' frameborder='0' allowfullscreen='true'/></iframe>";
                $video->video_embed = $embedCode;
                $video->video_url = Input::get('youtube_url');
                $video->video_thumbnail_url = Input::get('youtube_thumbnail_url');
                $video->scripture_text = Input::get('scripture_text');
                $video->book_id = Input::get('book_id');
                $video->book_name = Input::get('book_name');
                $video->book_order = Input::get('book_order');
                $video->chapter = Input::get('chapter');
                $video->verse = Input::get('verse');
                $video->bible_name = Input::get('bible_name');
                $video->video_language = Input::get('language');
                $video->user_id = $userId;
                $video->video_type = 'selfie';
                $video->video_status = '0';
                $video->video_youtube_upload_status = 'uploaded';
                $video->video_country = Input::get('country');
                $video->save();
                $videoId = $video->video_id;
                //Video Tags
                if(Input::get('tags') != ''){
                    $tags = Input::get('tags');
                    if (strpos($tags, ',') !== FALSE){
                        //Split by comma
                        $tagList = explode(',', $tags);
                        if(count($tagList) > 0){
                            foreach($tagList as $tagName){
                                $tagDetails = Tag::wherehashName($tagName)->first();
                                //Tag exists, then save it
                                if($tagDetails){
                                    $tagId = $tagDetails->hash_id;
                                }else{
                                    //Tag not exists, then add it and return id
                                    $tg = new Tag;
                                    $tg->hash_name = $tagName;
                                    $tg->hash_language   = Input::get('language');
                                    $tg->save();
                                    $tagId = $tg->id;  
                                }
                                if($tagId > 0){
                                    $videoh = new VideoHash;
                                    $videoh->video_id = $videoId;
                                    $videoh->hash_id = $tagId;
                                    $videoh->push();
                                }
                            }
                        }
                    }else{
                        //Tag doesn't contain comma
                        $tagDetails = Tag::wherehashName($tags)->first();
                        //Tag exists, then save it
                         if($tagDetails){
                            $tagId = $tagDetails->hash_id;
                        }else{
                            //Tag not exists, then add it and return id
                            $tg = new Tag;
                            $tg->hash_name = $tags;
                            $tg->hash_language   = Input::get('language');
                            $tg->save();
                            $tagId = $tg->id;  
                        }
                        if($tagId > 0){
                            $videoh = new VideoHash;
                            $videoh->video_id = $videoId;
                            $videoh->hash_id = $tagId;
                            $videoh->push();
                        }

                    }
                }

                //Topics
                if(Input::get('topics') != ''){
                    $topics = Input::get('topics');
                    if (strpos($topics, ',') !== FALSE)
                    {
                        //Split by comma
                        $topicList = explode(',', $topics);
                        if(count($topicList) > 0){
                            foreach($topicList as $topicId){
                                $videotopic = new VideoTopic;
                                $videotopic->video_id = $videoId;
                                $videotopic->topic_id = $topicId;
                                $videotopic->push();
                            }
                            
                        }
                    }
                    else
                    {
                        $videotopic = new VideoTopic;
                        $videotopic->video_id = $videoId;
                        $videotopic->topic_id = Input::get('topics');
                        $videotopic->push();
                    }


                }
                
                //Get saved video details
                $addedSelfie = Video::wherevideoId($videoId)->first();
                $arr['Success'] = true;
                $arr['Status'] = 'OK';
                $arr['StatusCode'] = 200;
                $arr['language'] = Input::get('language');
                $arr['Result']['email'] = Input::get('email');
                $arr['Result']['video_id'] = $videoId;
                $arr['Result']['title'] = $addedSelfie->video_title;
                $arr['Result']['description'] = $addedSelfie->video_desc;
                $arr['Result']['video_short_desc'] = $addedSelfie->video_desc;
                $arr['Result']['youtube_id'] = $addedSelfie->video_youtube_id;
                $arr['Result']['embedcode'] = $addedSelfie->video_embed;
                $arr['Result']['youtube_url'] = $addedSelfie->video_url;
                $arr['Result']['youtube_thumbnail_url'] = $addedSelfie->video_thumbnail_url;
                $arr['Result']['scripture_text'] = $addedSelfie->scripture_text;
                $arr['Result']['book_id'] = $addedSelfie->book_id;
                $arr['Result']['book_name'] = $addedSelfie->book_name;
                $arr['Result']['book_order'] = $addedSelfie->book_order;
                $arr['Result']['chapter'] = $addedSelfie->chapter;
                $arr['Result']['verse'] = $addedSelfie->verse;
                $arr['Result']['bible_name'] = $addedSelfie->bible_name;                                
                $arr['Result']['country'] = $addedSelfie->video_country;
            }else{
                $arr['Success'] = false;
                $arr['Status'] = 'User not found';
                $arr['StatusCode'] = 404;
            }
        }
        return Response::json($arr);
    }
    /**
     * Update selfie video
     * POST /updateselfievideo
     *
     * @return Response
     */
    public function updateSelfieVideo()
    {
        $arr = array();
        $missingParam = '';
        if(Input::get('title') == '')$missingParam .= 'title,';
        if(Input::get('youtube_id') == '')$missingParam .= 'youtube_id,';
        if(Input::get('youtube_url') == '')$missingParam .= 'youtube_url,';
        if(Input::get('language') == '')$missingParam .= 'language,';
        if(Input::get('email') == '')$missingParam .= 'email,';
        if(Input::get('video_id') == '')$missingParam .= 'video_id,';
        if(Input::get('scripture_text') == '')$missingParam .= 'scripture_text,';
        if(Input::get('country') == '')$missingParam .= 'country,';
        if(Input::get('topics') == '')$missingParam .= 'topics,';
        if($missingParam != '')
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Parameter missing: '.rtrim($missingParam,',');
            $arr['StatusCode'] = 400;
        }else{
            $user = User::whereEmail(Input::get('email'))->first();
            if($user) {
                $video = Video::whereVideoId(Input::get('video_id'))->first();
                if($video){
                    //save video
                    $userId = $user->id;
                    $video->video_title = Input::get('title');
                    $video->video_desc = Input::get('description');
                    $video->video_short_desc = Input::get('description');
                    $video->video_youtube_id = Input::get('youtube_id');

                    $embedCode = "<iframe type='text/html' src='http://www.youtube.com/embed/".Input::get('youtube_id')."' width='640' height='360' frameborder='0' allowfullscreen='true'/></iframe>";
                    
                    $video->video_embed = $embedCode;
                    $video->video_url = Input::get('youtube_url');
                    $video->video_thumbnail_url = Input::get('youtube_thumbnail_url');
                    $video->scripture_text = Input::get('scripture_text');
                    $video->video_language = Input::get('language');
                    $video->video_country = Input::get('country');
                    $video->user_id = $userId;
                    $video->save();
                    //Video Tags
                    if(Input::get('tags') != ''){
                        $tags = Input::get('tags');
                        if (strpos($tags, ',') !== FALSE){
                            //Split by comma
                            $tagList = explode(',', $tags);
                            if(count($tagList) > 0){
                                foreach($tagList as $tagName){
                                    $tagDetails = Tag::wherehashName($tagName)->first();
                                    //Tag exists, then save it
                                    if($tagDetails){
                                        $tagId = $tagDetails->hash_id;
                                    }else{
                                        //Tag not exists, then add it and return id
                                        $tg = new Tag;
                                        $tg->hash_name = $tagName;
                                        $tg->hash_language   = Input::get('language');
                                        $tg->save();
                                        $tagId = $tg->id;  
                                    }
                                    if($tagId > 0){
                                        //Check if the relation already exists,if not add 
                                        $count = VideoHash::where('video_id', '=', Input::get('video_id'))
                                                            ->where('hash_id', '=', $tagId)
                                                            ->count();
                                        if($count == 0) {
                                            $videoh = new VideoHash;
                                            $videoh->video_id = Input::get('video_id');
                                            $videoh->hash_id = $tagId;
                                            $videoh->push();

                                        }                   
                                    }
                                }
                            }
                        }else{
                            //Tag doesn't contain comma
                            $tagDetails = Tag::wherehashName($tags)->first();
                            //Tag exists, then save it
                             if($tagDetails){
                                $tagId = $tagDetails->hash_id;
                            }else{
                                //Tag not exists, then add it and return id
                                $tg = new Tag;
                                $tg->hash_name = $tags;
                                $tg->hash_language   = Input::get('language');
                                $tg->save();
                                $tagId = $tg->id;  
                            }
                            if($tagId > 0){
                                //Check if the relation already exists,if not add 
                                $count = VideoHash::where('video_id', '=', Input::get('video_id'))
                                                            ->where('hash_id', '=', $tagId)
                                                            ->count();
                                if($count == 0) {
                                    $videoh = new VideoHash;
                                    $videoh->video_id = Input::get('video_id');
                                    $videoh->hash_id = $tagId;
                                    $videoh->push();
                                } 
                            }
                        }
                    }

                    //Topics
                if(Input::get('topics') != ''){
                    $topics = Input::get('topics');
                    if (strpos($topics, ',') !== FALSE){
                        //Split by comma
                        $topicList = explode(',', $topics);
                        if(count($topicList) > 0){
                            foreach($topicList as $topicId){
                                //Check if the relation already exists,if not add 
                                $countTopic = VideoTopic::where('video_id', '=', Input::get('video_id'))
                                                            ->where('topic_id', '=', $topicId)
                                                            ->count();
                                if($countTopic == 0) {
                                    $videotopic = new VideoTopic;
                                    $videotopic->video_id = $videoId;
                                    $videotopic->topic_id = $topicId;
                                    $videotopic->push();
                                }
                            }
                            
                        }
                    }
                }else{
                    $countTopic = VideoTopic::where('video_id', '=', Input::get('video_id'))
                                                            ->where('topic_id', '=', Input::get('topics'))
                                                            ->count();
                    if($countTopic == 0) {
                        $videotopic = new VideoTopic;
                        $videotopic->video_id = $videoId;
                        $videotopic->topic_id = $Input::get('topics');
                        $videotopic->push();
                    }
                }

                    //Get saved video details
                    $updatedSelfie = Video::wherevideoId(Input::get('video_id'))->first();
                    $arr['Success'] = true;
                    $arr['Status'] = 'OK';
                    $arr['StatusCode'] = 200;
                    $arr['language'] = Input::get('language');
                    $arr['Result']['email'] = Input::get('email');
                    $arr['Result']['video_id'] = Input::get('video_id');
                    $arr['Result']['title'] = $updatedSelfie->video_title;
                    $arr['Result']['description'] = $updatedSelfie->video_desc;
                    $arr['Result']['video_short_desc'] = $updatedSelfie->video_desc;
                    $arr['Result']['youtube_id'] = $updatedSelfie->video_youtube_id;
                    $arr['Result']['embedcode'] = $updatedSelfie->video_embed;
                    $arr['Result']['youtube_url'] = $updatedSelfie->video_url;
                    $arr['Result']['youtube_thumbnail_url'] = $updatedSelfie->video_thumbnail_url;
                    $arr['Result']['scripture_text'] = $updatedSelfie->scripture_text;
                    $arr['Result']['country'] = $updatedSelfie->video_country;
                }else{
                    $arr['Success'] = false;
                    $arr['Status'] = 'Video not found';
                    $arr['StatusCode'] = 404;
                }
            }else{
                $arr['Success'] = false;
                $arr['Status'] = 'User with this email does not exist';
                $arr['StatusCode'] = 404;
            }
        }
        return Response::json($arr);
    }

}
