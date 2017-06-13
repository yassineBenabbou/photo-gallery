@extends('admin.layouts.master')

@section('title', 'Photos')
@section('header', 'Photos')
@section('glyphicon', 'picture')

@section('headIncludes')

@endsection

@section('bodyIncludes')

@endsection


@section('content')


<form class="form-horizontal" method="POST" id="myForm" action="{{ route('photos.store') }}" onclick='upload_image();' enctype="multipart/form-data">
<fieldset>
{{ csrf_field() }}
<!-- Form Name -->
<legend>Upload a photo</legend>

<!-- Select Basic -->
<div class="form-group required">
  <label class="col-md-4 control-label" for="selectbasic">Album</label>
  <div class="col-md-4">
    <select id="selectbasic" name="section_id" class="form-control">
      @foreach ($sections as $section)
        <option value="{{ $section->id }}">{{ $section->title }}</option>
      @endforeach
    </select>
  </div>
</div>

<!-- File Button --> 
<div class="form-group required">
  <label class="col-md-4 control-label" for="filebutton">Photo(s)</label>
  <div class="col-md-4">
    <input id="filebutton" name="photos[]" class="input-file" type="file" multiple>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Caption</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="textarea" name="description"></textarea>
  </div>
</div>



       

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary upload-image">Upload</button>
  </div>
</div>

@include ('layouts.errors')

</fieldset>
</form>


@endsection