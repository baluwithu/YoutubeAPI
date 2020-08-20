<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function post(Request $request){
        $response=$this->getResults($request->search_string);
        return $response;        
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
        $content='';
        if(count($value) > 0){
            for ($i = 0; $i < 20; $i++) { 
                $videoId = !isset($value['items'][$i]['id']['videoId']) ? $value['items'][$i]['id']['playlistId'] : $videoId=$value['items'][$i]['id']['videoId'];            
                $title = !isset($value['items'][$i]['snippet']['title']) ? "" :$value['items'][$i]['snippet']['title'];  
                $content .= '<div class="column"><div class="card">'; 
                $content .='<iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/'.$videoId.'" data-autoplay-src="//www.youtube.com/embed/'.$videoId.'?autoplay=1"></iframe><p>'.$title.'</p>';
                $content .= '</div></div>';            
            }
        }
        return $content;
    }

}
