@extends('layouts.app')
@section('content')
    <div class="form-group">
        <input class="search_content form-control"></input>
    </div>
    <button class="search_button btn btn-primary">Search</button>
    <div class="row">
    </div> <br> <br>
    <iframe src=""></iframe>
    <h3>Video Title</h3>
    <p class="description">Video Description
    <p>
    @endsection
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            getVideo("");
            $(".search_button").click(function() {
                var search_string = $(".search_content").val();
                getVideo(search_string);
            });
            function getVideo(search_string) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo env('YOUTUBE_API_URL'); ?>",
                    data: {
                        key: "<?php echo env('YOUTUBE_API_KEY'); ?>",
                        q: search_string,
                        part: "snippet",
                        maxResults: 1,
                        type: "video",
                        videoEmbeddable: true,
                    },
                    success: function(data) {
                        embedVideo(data)
                    },
                    error: function(response) {
                        console.log("Request Failed");
                    }
                });
            }
            function embedVideo(data) {
                $('iframe').attr('src', 'https://www.youtube.com/embed/' + data.items[0].id.videoId);
                $('h3').text(data.items[0].snippet.title);
                $('.description').text(data.items[0].snippet.description);
            }
        });

    </script>
