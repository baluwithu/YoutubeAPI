<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){       
        $data=$this->getResults("");
        return view('youtube.index')->with($data);
    }

    public function search(Request $request){  

        $keyword = $request->input('title'); 
        $data=$this->getResults($keyword);    
        return view('youtube.index')->with($data);
        
    }

    public function getResults($keyword){
        $apikey = env("YOUTUBE_API_KEY"); 
        $googleApiUrl = env("YOUTUBE_API_URL").'?part=snippet&q=' . $keyword . '&maxResults=20&key=' . $apikey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);
        $value = json_decode(json_encode($data), true);
        $data=array(
            'title'=>'Searching Content using YouTube Data API | Exploring YouTube Data API',
            'value'=>$value
        );
        return $data;
    }
}
