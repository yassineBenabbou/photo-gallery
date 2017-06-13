@extends('layouts.master')

@section('title', 'Wedding Gallery')


@section('headIncludes')

    <link type="text/css" rel="stylesheet" href="{{ url('/css/lightgallery.css') }}" /> 
    <link type="text/css" rel="stylesheet" href="{{ url('/css/lg-transitions.min.css') }}" /> 
    <link type="text/css" rel="stylesheet" href="{{ url('/css/lg-fb-comment-box.css') }}" /> 
    <style type="text/css">
        .thumbnail {
            margin: 2px 0px;
            border: 1px #bbb solid;
            display: inline-block;
        }

        .thumbnail:hover {
            border: 1px #888 solid ;
        }
        #lightgallery {
            padding-bottom: 50px;
        }
        #lightgallery a:hover{  
            text-decoration: none;
        }
    </style>


@endsection


@section('bodyIncludes')

    <script src="{{ url('/js/lightgallery.min.js') }}"></script>    

    <!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

    <!-- lightgallery plugins -->
    <script src="{{ url('/js/lg-thumbnail.min.js') }}"></script>
    <script src="{{ url('/js/lg-fullscreen.min.js') }}"></script>
    <script src="{{ url('/js/lg-autoplay.min.js') }}"></script>
    <script src="{{ url('/js/lg-zoom.min.js') }}"></script>
    <script src="{{ url('/js/lg-hash.min.js') }}"></script>
    <script src="{{ url('/js/lg-pager.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var $commentBox = $('#lightgallery');
             
            $commentBox.lightGallery({         
                appendSubHtmlTo: '.lg-item',
                addClass: 'fb-comments',
                mode: 'lg-fade',
                thumbnail: false,
                enableDrag: false,
                enableSwipe: false,
            });


        });
    </script>

@endsection



@section('content')


                <div class="container">
                    <h1 class="page-header"><a href="{{ url('/') }}">Albums</a> <small>></small> {{ $section->title }}</h1>
                </div>

                    @if ($agent->isMobile())
                        <div class="container" align="center">
                        @foreach ($photos as $photo)
                            <a  href="{{ url('photos/'.$photo->id) }}">
                                <img class="thumbnail" src="{{ $photo->src('thumb') }}" />                         
                            </a>
                        @endforeach
                        </div> 

                    @else

                        <div id="lightgallery"  class="container" align="center">
                        @foreach ($photos as $photo)
                            <a index="{{ $photo->id }}" href="{{ $photo->src('web') }}" data-download-url="{{ $photo->src() }}" 
                                data-sub-html='<iframe class="fb-comments" src="{{ url('/photos/'.$photo->id.'/comments?album='.$section->id.'&slide='.$loop->index)}}" ><p>Your browser does not support iframes.</p></iframe>' >
                                <img class="thumbnail" src="{{ $photo->src('thumb') }}" />                         
                            </a>
                        @endforeach
                        </div>

                    @endif                


@endsection