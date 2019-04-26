@extends('layouts.app')

@section('content')

<div class="panel-heading"><h3>Create Albums <span><a href="/albums" class="btn btn-primary pull-right">Back</a></span></h3></div>
<div class="panel-body">
{!!Form::open(['action'=>'AlbumsController@store','method'=>'POST','enctype'=>'multipart/form-data'])!!}

{{Form::bsText('name','',['placeholder'=>'Album Name'])}}
{{Form::bsTextArea('description','',['placeholder'=>'Album Description'])}}
{{Form::file('cover_image')}}
<br>
{{Form::bsSubmit('submit')}}


{!! Form::close() !!}


</div>
@endsection