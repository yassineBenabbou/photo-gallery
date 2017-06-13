@extends('admin.layouts.master')

@section('title', 'Photos')

@section('header')
    @if(isset($section))
        <a href="{{ route('sections.index') }}">Albums</a> > {{ $section->title }}
    @else
        All Photos
    @endif
@endsection

@section('glyphicon', 'picture')

@section('content')




<a href="{{ url('admin/photos/create') }}"><button id="singlebutton" class="btn btn-primary btn-lg">Upload photo(s)</button></a>


<div class="table-responsive">
@if ($photos->isEmpty())
No photos.
@else
    <table class="table product-table">
        <!--Table head-->
        <thead>
            <tr>
                <th></th>
                <th>Album</th>
                <th>Comments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!--/Table head-->

        <!--Table body-->
        <tbody>

            @foreach ($photos as $photo)
            <tr>
                <th scope="row">
                    <img src="{{ Storage::url($photo->directory) . '/thumb_' . $photo->filename }}" alt="" class="img-fluid" height="120px">
                </th>
                <td>
                    <h5><strong>{{ $photo->section->title }}</strong></h5>
                    <p class="text-muted">{{ $photo->created_at->toFormattedDateString() }}</p>
                </td>
                <td><a href="{{ route('commentsByPhoto', $photo->id) }}">{{ $photo->comments->count() }}</a></td>
                <td>
                	<a href="{{ route('photos.edit', $photo->id) }}" class="glyphicon glyphicon-edit"></a>
                	<a href="" class="glyphicon glyphicon-remove" onclick="event.preventDefault(); 
                                                                            var conf = confirm('Are you sure ?'); 
                                                                           if( conf == true) {  document.getElementById('delete-form').submit(); }"></a>
                        <form id="delete-form" action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form> </a>
                </td>
            </tr>
            @endforeach



        </tbody>
        <!--/Table body-->
    </table>
    @if(!isset($section))
    <div align="center">
        {{ $photos->links() }}
    </div>
    @endif
@endif    
</div>



@endsection