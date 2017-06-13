@extends('layouts.master')

@section('title', 'Wedding Gallery')

@section('headIncludes')
    <link href="{{ url("/css/comments.css") }}" rel="stylesheet">  
@endsection


@section('bodyIncludes')
    
    <script type="text/javascript">
    $(document).ready(function() { 

        $('#frm-comment').on('submit', function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var post = $(this).attr('method');
            var url = $(this).attr('action');

            $.ajax({
                type : post,
                url : url,
                data : data,
                success:function(data) {
                    readByAjax();
                }
            })

            $('#body').val('')

        })
        
        $(document).on("click", '.commentDelete', function(e){  
            e.preventDefault();       
            var conf = confirm('Are you sure ?'); 
            if( conf == true) {  
                var id = $(this).data('id');
                var token = $(this).data('token');
                var url = '{{ url('comments/')}}/'+id;
                $.ajax({
                    type : 'POST',
                    url : url,
                    dataType: 'JSON',
                    data: {
                        "_method" : 'DELETE',
                        "_token" : token
                    },
                    success:function(data) {
                        $("html, body").scrollTop($('#comments').offset().top);
                    }
                })

                setTimeout(readByAjax, 200);                 
            }   
        })

            function readByAjax() {
                $.ajax({
                    type : 'GET',
                    url : '{{ route('ajaxComments', $photo->id) }}',
                    datatype : 'html',
                    success: function(data) {
                        $('.responsive-list').html(data);
                    }
                })  
            }

    });
    </script>
@endsection
@section('content')
    <div class="container">

        <div class="row">

                <div class="container">
                    <h1 class="page-header"><a href="{{ url('/') }}">Albums</a> <small>></small> <a href="{{ url('/sections/'.$photo->section->slug) }}">{{ $photo->section->title }}</a></h1>
                    <small style="color:#666">Click to enlarge.</small>
                </div>
            <div class="">
                <a href="{{ $photo->src() }}"><img class="" src="{{ $photo->src('web') }}" alt="" style="width:50vh;"></a>                
                <h4>{{ $photo->description }}</h4>
            </div>
        </div>
        <div class="row">
        <hr>

        <legend>Comments</legend>
        @if (Auth::check())
            <form class="form-horizontal" style="margin-bottom:50px;" method="POST" id="frm-comment" action="/photos/{{ $photo->id }}/comments">
            <fieldset>
            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="textarea"></label>
              <div class="col-md-4">                     
                <textarea name="body" id="body" class="form-control"></textarea>
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="singlebutton"></label>
              <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Add</button>
              </div>
            </div>
            {{ csrf_field() }}
            </fieldset>
            </form>
        @else
            <div class="taskDescription caption"><a href="{{ route('login') }}" target="_top"><button id="singlebutton" class="btn btn-primary">Login to comment</button></a></div>        
        @endif          
        @include ('layouts.errors')
        </div>
      @include ('ajaxComments')
      @include ('layouts.errors')

        
     </div>   

@endsection