@extends('layouts.app')

@section('content')

<h3>Albums <a href="/albums/create" class="btn btn-primary pull-right">Create Album</a>
</h3>
<br>

<?php
$colcount=count($albums);
$i=1;
?>

<div class="row">
@foreach($albums as $album)
<div class="col-xs-12 col-sm-4 text-center">
	<div class="thumbnail">
	<a href="/albums/{{$album->id}}">
		<img style="max-height: 200px;"  src="storage/album_covers/{{$album->cover_image}}">
	{{$album->name}}
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
@endsection