@extends('admin.layouts.master')

@section('title', 'Comments')
@section('header')
@if(isset($photo))
    <img src="{{ $photo->src('thumb') }}" height="100px" />'s Comments
@elseif(isset($user))
    Comments by {{ $user->name}} <small>({{ $user->provider }})</small>
@else
    Comments
@endif
@endsection

@section('glyphicon', 'comment')

@section('content')

<div class="responsive-table">
@if($comments->isEmpty())
No comments.
@else
<table class="table">
     <thead class="thead-inverse">
        <tr>
            <th width="70%">Comment</th>
            <th>By</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($comments as $comment)
        <tr>
            <th scope="row">{{ $comment->body }}</th>
            <td>
            	{{ $comment->user->name }}
            	<p class="text-muted">{{ $comment->created_at->diffForHumans() }}</p>
            </td>
            <td>
            	<a href="" class="glyphicon glyphicon-remove" onclick="event.preventDefault(); 
                                                                            var conf = confirm('Are you sure ?'); 
                                                                           if( conf == true) {  document.getElementById('delete-form').submit(); }"></a>
                        <form id="delete-form" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: none;">
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