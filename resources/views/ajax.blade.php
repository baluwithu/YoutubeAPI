@extends('layouts.app')
@section('content')
    <div class="form-group">
        <input class="search_content form-control"></input>
    </div>
    <button class="search_button btn btn-primary">Search</button>
    <div class="row">
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        getResults("");
        $(".search_button").click(function() {
            var search_string = $(".search_content").val();
            $(".row").empty();
            getResults(search_string);
        });

        function getResults(search_string) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/postajax',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    search_string: search_string
                },
                success: function(data) {
                    $(".row").append(data);
                }
            });
        }
    });

</script>
