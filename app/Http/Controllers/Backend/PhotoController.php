<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Photo;
use Illuminate\Support\Str;
use Image;
class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('backend.photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:300',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $fileName = $image->hashName();
        $format = $request->image->getClientOriginalExtension();
        $size = $request->image->getSize();
        $path = 'uploads/'.$fileName;
        $path1 = 'uploads/1280x1024/'.$fileName;
        $path2 = 'uploads/316x255/'.$fileName;
        $path3 = 'uploads/118x95/'.$fileName;

        Image::make($image->getRealPath())->resize(800,600)->save($path);
        Image::make($image->getRealPath())->resize(1280,1024)->save($path1);
        Image::make($image->getRealPath())->resize(316,255)->save($path2);
        Image::make($image->getRealPath())->resize(118,95)->save($path3);

        $photo = new Photo;
        $photo->title = Str::of($request->get('title'))->replace('-',' ');
        $photo->description = $request->get('description');
        $photo->file = $fileName;
        $photo->format = $format;
        $photo->size = $size;
        $photo->save();

        return redirect()->route('photos.index')->with('message', 'Image uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('backend.photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:300',
        ]);

        $photo = Photo::find($id);
        $fileName = $photo->file;
        $format = $photo->format;
        $size = $photo->size;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = $image->hashName();
            $format = $request->image->getClientOriginalExtension();
            $size = $request->image->getSize();
            $path = 'uploads/'.$fileName;
            $path1 = 'uploads/1280x1024/'.$fileName;
            $path2 = 'uploads/316x255/'.$fileName;
            $path3 = 'uploads/118x95/'.$fileName;

            Image::make($image->getRealPath())->resize(800,600)->save($path);
            Image::make($image->getRealPath())->resize(1280,1024)->save($path1);
            Image::make($image->getRealPath())->resize(316,255)->save($path2);
            Image::make($image->getRealPath())->resize(118,95)->save($path3);

            unlink('/uploads/'.$photo->file);
            unlink('/uploads/1280x1024/'.$photo->file);
            unlink('/uploads/316x255/'.$photo->file);
            unlink('/uploads/118x95/'.$photo->file);
        }
        $photo->title = Str::of($request->get('title'))->replace('-',' ');
        $photo->description = $request->get('description');
        $photo->file = $fileName;
        $photo->format = $format;
        $photo->size = $size;
        $photo->save();

        return redirect()->route('photos.index')->with('message', 'Image updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        unlink('/uploads/'.$photo->file);
        unlink('/uploads/1280x1024/'.$photo->file);
        unlink('/uploads/316x255/'.$photo->file);
        unlink('/uploads/118x95/'.$photo->file);
        return redirect()->route('photos.index')->with('message', 'Image deleted successfully');
    }
}
