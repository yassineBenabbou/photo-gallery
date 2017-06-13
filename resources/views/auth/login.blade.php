@extends('layouts.master')

@section('title', 'Login')
@section('headIncludes')
    <link rel="stylesheet" type="text/css" href="{{ url('css/button-social.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.css') }}">
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/login/facebook') }}" class="btn btn-facebook btn-lg btn-block btn-social"><i class="fa fa-facebook"></i> Sign in with Facebook</a>
                                <a href="{{ url('/login/twitter') }}" class="btn btn-twitter btn-lg btn-block btn-social"><i class="fa fa-twitter"></i> Sign in with Twitter</a>
                                <a href="{{ url('/login/google') }}" class="btn btn-google btn-lg btn-block btn-social"><i class="fa fa-google"></i> Sign in with Google</a>
                            </div>
                        </div>                                           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
