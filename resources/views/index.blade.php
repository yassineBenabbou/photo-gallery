@extends('layouts.master')

@section('title', 'Wedding Gallery')


@section('headIncludes')
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

            .full-height {
                height: 96vh;
            }
            .content {
            }
            .container {
                text-align: center;
            }
            .position-ref {
                position: relative;
            }
            .title {
                font-family: 'Raleway', sans-serif;
                font-size: 8vh;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .thumbnail.with-caption {
            display: inline-block;
            background: #f5f5f5;
            }
            .thumbnail.with-caption img {
                height:240px;
                width: 240px;
            background-image: url('{{ url('img/widget-loading.gif') }}');
            background-repeat: no-repeat;
            background-position: center;                
            }
            .thumbnail.with-caption p {
            margin: 0;
            padding-top: 0.5em;
            }
            .thumbnail.with-caption small:before {
            content: '\2014 \00A0';
            }
            .thumbnail.with-caption small {
            width: 100%;
            text-align: right;
            display: inline-block;
            color: #999;
            }
            .thumbnail.with-caption small span {
            margin-left: 4px;
            }  
        </style>


@endsection


@section('bodyIncludes')
    <script type="text/javascript" src="{{ url('js/thumbnails.js') }}"></script>
@endsection    


@section('content')
<div class="container">
            <div class="content">
                <div class="title m-b-md">
                    Wedding Albums
                </div>

                <div class="sections">
                    @foreach ($sections as $section)
                        @if ($section->notEmtpy())
                        <a href="sections/{{ $section->slug }}">
                            <div class="thumbnail with-caption">
                                <img src="{{ $thumb = $section->thumbnails()->src('thumb') }}" data-cover="{{ $thumb }}" data-thumbnails='[
                                    @foreach($section->thumbnails(5) as $thumbnail)
                                        "{{ $thumbnail->src('thumb') }}"
                                        @if(!$loop->last)
                                        ,
                                        @endif
                                    @endforeach
                                ]' class="mss" />
                                <p><h2>{{ $section->title }}</h2><small>{{ $section->photos->count() }}<span class="glyphicon glyphicon-picture"></span></small></p>
                              </div>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
            </div>
@endsection