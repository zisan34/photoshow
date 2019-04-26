@extends('layouts.app')

@section('content')


{{-- {{$album_user_id}}
{{$album_id}} --}}
<div class="panel-heading"><h3>Upload Photo <span><a href="/albums/{{$album_id}}" class="btn btn-primary pull-right">Back</a></span></h3></div>
<div class="panel-body">
{!!Form::open(['action'=>'PhotosController@store','method'=>'POST','enctype'=>'multipart/form-data'])!!}

{{Form::bsText('title','',['placeholder'=>'Photo Title'])}}
{{Form::bsTextArea('description','',['placeholder'=>'Photo Description'])}}
{{Form::file('photo')}}

{{Form::hidden('album_id',$album_id)}}
{{Form::hidden('user_id',$album_user_id)}}


<br>
{{Form::bsSubmit('submit')}}


{!! Form::close() !!}


</div>
@endsection