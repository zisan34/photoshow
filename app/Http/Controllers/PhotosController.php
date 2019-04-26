<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Album;

use App\Photo;

use Auth;

use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    //

    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function create($album_id)
    {

    	$album=Album::where('id',$album_id)->get();
    	
    	$album_user_id=$album[0]->user_id;

    	$user_id=Auth::id();

    	// return $album_user_id;
    	if($user_id==$album_user_id)
    	{
    	return view('photos.create')->with('album_id',$album_id)
    		->with('album_user_id',$album_user_id);
    	} 	
    	else{
    		return redirect('/albums');
    	}
    }

    public function store(Request $request)
    {
    	$this->validate($request,['title'=>'required','description'=>'required','photo'=>'image|max:1999']);


    	// $user_id=Auth::id();

    	$fileNameWithExt= $request->file('photo')->getClientOriginalName();

    	$fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);

    	$extention=$request->file('photo')->getClientOriginalExtension();

    	$fileNameToStore=$fileName.'_'.time().'_'.$request->input('album_id').'_'.$request->input('user_id').'.'.$extention;


    	$path=$request->file('photo')->storeAs('public/photos/'.$request->input('album_id'),$fileNameToStore);

    	// return $path;
    	$photo=new Photo;
    	$photo->album_id=$request->input('album_id');
    	
    	$photo->user_id=$request->input('user_id');

    	$photo->photo=$fileNameToStore;

    	$photo->title=$request->input('title');

    	$photo->size=$request->file('photo')->getClientSize();

    	$photo->description=$request->input('description');



    	$photo->save();

    	return redirect('/albums/'.$request->input('album_id'))->with('success','Photo Uploaded');

    }

    public function show($id)
    {
    	$photo=Photo::find($id);
    	return view('photos.show')->with('photo',$photo);
    }

    public function destroy($id)
    {
    	$photo=Photo::find($id);


    	$user_id=Auth::id();
    	if($user_id==$photo->user_id)
    	{
    		if(Storage::delete('/public/photos/'.$photo->album_id.'/'.$photo->photo))
    		{
    			$photo->delete();

    			return redirect('/')->with('success','Photo Deleted');
    		}
    	}	
    	else{
    		return redirect('/albums');
    	}
    }
}
