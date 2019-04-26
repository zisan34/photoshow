<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Album;

class AlbumsController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth');
    }
    //
    public function index()
    {
    	$user_id=Auth::id();
    	$albums=Album::with('Photos')->where('user_id',$user_id)->get();
    	return view('albums.index')->with('albums',$albums);
    }

    public function create()
    {
    	return view('albums.create');
    }
    public function store(Request $request)
    {
    	$this->validate($request,['name'=>'required','cover_image'=>'image|max:1999']);


    	$user_id=Auth::id();

    	$fileNameWithExt= $request->file('cover_image')->getClientOriginalName();

    	$fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);

    	$extention=$request->file('cover_image')->getClientOriginalExtension();

    	$fileNameToStore=$fileName.'_'.time().'_'.$user_id.'.'.$extention;


    	$path=$request->file('cover_image')->storeAs('public/album_covers',$fileNameToStore);


    	$album=new Album;
    	$album->name=$request->input('name');
    	$album->description=$request->input('description');
    	$album->cover_image=$fileNameToStore;
    	$album->user_id=$user_id;
    	$album->save();

    	return redirect('/albums')->with('success','Album Created');

    }
    public function show($id)
    {
    	$user_id=Auth::id();
    	$album=Album::with('Photos')->find($id);
    	if($user_id==$album->user_id)
    	{ 
    		return view('albums.show')->with('album',$album);
    	}	
    	else{
    		return redirect('/albums');
    	}
    }
}





// $query->where([
//     ['column_1', '=', 'value_1'],
//     ['column_2', '<>', 'value_2'],
//     [COLUMN, OPERATOR, VALUE],
//     ...
// ])