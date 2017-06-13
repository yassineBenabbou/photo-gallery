@extends('admin.layouts.master')

@section('title', 'Photos')
@section('header', 'Photos')
@section('glyphicon', 'picture')

@section('content')


<form class="form-horizontal" method="POST" action="{{ route('photos.update', $photo->id) }}" enctype="multipart/form-data">
<fieldset>
{{ csrf_field() }}
{{ method_field('PATCH') }}
<!-- Form Name -->
<legend>Upload a photo</legend>

<!-- Select Basic -->
<div class="form-group required">
  <label class="col-md-4 control-label" for="selectbasic">Album</label>
  <div class="col-md-4">
    <select id="selectbasic" name="section_id" class="form-control">
      @foreach ($sections as $section)
        <option value="{{ $section->id }}"
        @if ($section->id == $photo->section_id)
          selected 
        @endif
        >{{ $section->title }}</option>
      @endforeach
    </select>
  </div>
</div>

<!-- File Button --> 
<div class="form-group required">
  <label class="col-md-4 control-label" for="filebutton">Photo</label>
  <div class="col-md-4">
    <img src="{{ Storage::url($photo->directory . '/web_' . $photo->filename) }}" width="360px" />
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Caption</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="textarea" name="description">{{ $photo->description }}</textarea>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Update</button>
  </div>
</div>

@include ('layouts.errors')

</fieldset>
</form>



@endsection