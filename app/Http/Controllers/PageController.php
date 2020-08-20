<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $title="Welcome to YoutubeAPI Demo";
        return view('pages.index')->with('title',$title);
    }

    public function about(){
        $title="About Us";
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        $data=array(
            'title'=>'Services',
            'services'=>['Web Design','Programming','Testing']
        );
        return view('pages.services')->with($data);
    }
}
