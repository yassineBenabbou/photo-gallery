@extends('admin.layouts.master')

@section('title', 'Albums')
@section('header', 'Albums')
@section('glyphicon', 'list-alt')

@section('content')


<a href="{{ url('admin/sections/create') }}"><button id="singlebutton" class="btn btn-primary btn-lg">New album</button></a>

<div class="table-responsive">
@if ($sections->isEmpty())
No albums.
@else
<table class="table">
     <thead class="thead-inverse">
        <tr>
            <th>#</th>
            <th width="70%">Title</th>
            <th>Photos</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sections as $section)
        <tr>
            <th scope="row">{{ $section->id }}</th>
            <td><a href="{{ route('sections.show', $section->id) }}">{{ $section->title }}</a></td>
            <td><a href="{{ route('sections.show', $section->id) }}"> {{ $section->photos->count() }}</a></td>
            <td>
                <a href="{{ url('sections/'.$section->slug) }}" target="_blank" class="glyphicon glyphicon-zoom-in"></a>
                <a href="{{ route('sections.edit', $section->id) }}" class="glyphicon glyphicon-edit"></a>
                    <a href="" class="glyphicon glyphicon-remove" onclick="event.preventDefault(); 
                                                                            var conf = confirm('Are you sure ?'); 
                                                                           if( conf == true) {  document.getElementById('delete-form').submit(); }"></a>
                        <form id="delete-form" action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form> </a>
            </td>            
        </tr>
    @endforeach

    </tbody>
</table>
@endif
</div>

@endsection