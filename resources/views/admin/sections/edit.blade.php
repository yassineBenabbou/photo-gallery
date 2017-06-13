@extends('admin.layouts.master')

@section('title', 'Albums')
@section('header', 'Albums')
@section('glyphicon', 'list-alt')

@section('content')


<form class="form-horizontal" method="POST" action="{{ route('sections.update', $section->id) }}">
<fieldset>
{{ csrf_field() }}
{{ method_field('PATCH') }}
<!-- Form Name -->
<legend>Add a new album</legend>

<!-- Text input-->
<div class="form-group required">
  <label class="col-md-4 control-label" for="textinput">Album's title</label>  
  <div class="col-md-4">
  <input id="textinput" name="title" placeholder="" value="{{ $section->title }}" class="form-control input-md" type="text" required>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="submit" class="btn btn-primary">Update</button>
  </div>
</div>

@include ('layouts.errors')
</fieldset>

</form>



@endsection