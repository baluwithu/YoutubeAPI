@extends('layouts.app')
@section('content')
    <h1>{{$title}}</h1>
    {!! Form::open(['action' => 'PostController@search', 'method'=>'GET']) !!}
        <div class="form-group">
            {{Form::text('title','',['class'=>'form-control','placeholder'=>'search text'])}}
        </div>
        {{Form::submit('Search',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    <br><br>
    <div class="row">
    <?php 
    if(count($value) > 0){
        for ($i = 0; $i < 20; $i++) { 
            $videoId = !isset($value['items'][$i]['id']['videoId']) ? $value['items'][$i]['id']['playlistId'] : $videoId=$value['items'][$i]['id']['videoId'];            
            $title = !isset($value['items'][$i]['snippet']['title']) ? "" :$value['items'][$i]['snippet']['title'];
    ?>       
                <div class="column">
                    <div class="card">
                        <iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/<?php echo $videoId; ?>" 
                            data-autoplay-src="//www.youtube.com/embed/<?php echo $videoId; ?>?autoplay=1"></iframe>
                        <p><?php echo $title; ?></p>
                    </div>
                </div>            
    <?php 
        } 
    }
    ?>
    </div>
@endsection
