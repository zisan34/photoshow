@extends('layouts.app')

@section('content')
<a class="btn btn-secondary" href="/albums">Go Back</a>
<h1>{{$album->name}} <a href="/photos/upload/{{$album->id}}" class="btn btn-primary pull-right">Upload Photo to Album</a> </h1>


@if(count($album->photos)>0)
<?php
$colcount=count($album->photos);
$i=1;
?>

<div class="row">
@foreach($album->photos as $photo)
<div class="col-xs-12 col-sm-4 text-center">
	<div class="thumbnail">
	<a href="/photos/{{$photo->id}}">
		<img style="max-height: 200px;"  src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}">
	{{$photo->title}}
	</a>
	</div>
</div>

<?php
if($i%3==0||$i==$colcount)
{?>
</div>
<div class="row">
<?php
}
$i++;
?>

@endforeach
</div>



@else


@endif

@endsection