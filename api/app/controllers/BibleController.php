<?php

class BibleController extends \BaseController {
    
    /**
	 * Returns list of books in bible
	 *
	 * @return Response
	 */
    public function getBibleBooks()
	{
        $arr = array();
        $bibleBooks = Bible::all();
        if(count($bibleBooks) == 0)
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Books not found';
            $arr['StatusCode'] = 404;
        }else{
            $arr['Success'] = true;
            $arr['Status'] = 'OK';
            $arr['StatusCode'] = 200;
            $i = 0;
            foreach($bibleBooks as $book)
            {
                $arr['Result'][$i]['dam_id'] = $book->dam_id; 
                $arr['Result'][$i]['number_of_chapters'] = $book->number_of_chapters; 
                
                
                $arr['Result'][$i]['chapters'] = $book->chapters; 
                $arr['Result'][$i]['bible_name'] = $book->bible_name; 
                $arr['Result'][$i]['bible_type'] = $book->bible_type; 
                $arr['Result'][$i]['book_id'] = $book->book_id; 
                $arr['Result'][$i]['book_name'] = $book->book_name; 
                $arr['Result'][$i]['book_order'] = $book->book_order; 
                $arr['Result'][$i]['language'] = $book->language; 
                $i++;
            }
        }
        return Response::json($arr);
                 
	}

    /**
     * Returns book verses (offline)
     *
     * @return Response
     */
    public function getOfflineVerses()
    {
        $arr = array();
        $bibleverses = BibleOffline::all();
        if(count($bibleverses) == 0)
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Verse not found';
            $arr['StatusCode'] = 404;
        }else{
            $arr['Success'] = true;
            $arr['Status'] = 'OK';
            $arr['StatusCode'] = 200;
            $i = 0;
            foreach($bibleverses as $verse)
            {
                $arr['Result'][$i]['bible_type'] = $verse->bible_type; 
                $arr['Result'][$i]['book_name'] = $verse->book_name; 
                $arr['Result'][$i]['chapter'] = $verse->chapter; 
                $arr['Result'][$i]['verse'] = $verse->verse; 
                $arr['Result'][$i]['verse_text'] = $verse->verse_text; 
                $i++;
            }
        }
        return Response::json($arr);
                 
    }

    /**
     * Returns bible verses
     *
     * @return Response
     */
    public function getBibleVerses()
    {

        $arr = array();
        $bibleVerses = BibleVerse::all();
        if(count($bibleVerses) == 0)
        {
            $arr['Success'] = false;
            $arr['Status'] = 'Verse not found';
            $arr['StatusCode'] = 404;
        }else{
            $arr['Success'] = true;
            $arr['Status'] = 'OK';
            $arr['StatusCode'] = 200;
            $i = 0;
            foreach($bibleVerses as $verse)
            {
                $arr['Result'][$i]['book_order'] = $verse->book_order; 
                $arr['Result'][$i]['chapter'] = $verse->chapter; 
                $arr['Result'][$i]['verse'] = $verse->verse; 
                $arr['Result'][$i]['bible_name'] = $verse->bible_name; 
                $arr['Result'][$i]['language'] = $verse->language; 
                $i++;
            }
        }
        return Response::json($arr);
                 
    }

    
   
}
