@extends('admin.layouts.master')

@section('title', 'Users')
@section('header', 'Users')
@section('glyphicon', 'user')

@section('content')

<table class="table">
     <thead class="thead-inverse">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Provider</th>
            <th>Comments</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->provider }}</td>
            <td><a href="{{ route('commentsByUser', $user->id) }}"> {{ $user->comments->count() }}</a></td>
        </tr>
    @endforeach

    </tbody>
</table>

@endsection