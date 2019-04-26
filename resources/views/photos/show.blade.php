@extends('layouts.app')

@section('content')
<a href="/albums/{{$photo->album_id}}" class="btn btn-secondary">Go back</a>

<h3>{{$photo->title}}</h3>
<h4>{{$photo->description}}</h4>
<img style="max-height: 800px; max-width: 1000px;" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}">


<br>
<small>Size: {{$photo->size}}</small>
<br>


{!!Form::open(['action'=>['PhotosController@destroy',$photo->id],'method'=>'POST', 'onsubmit'=>'return confirm("Are you sure?")'])!!}
{{Form::hidden('_method','DELETE')}}
{{Form::submit('Delete Photo',['class'=>'btn btn-danger'])}}

{!!Form::close()!!}

<br>
@endsection