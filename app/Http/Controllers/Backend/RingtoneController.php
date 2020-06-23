<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ringtone;
use Illuminate\Support\Str;

class RingtoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ringtones = Ringtone::latest()->get();
        return view('backend.ringtone.index', compact('ringtones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ringtone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:500',
            'category' => 'required',
            'file' => 'required|mimes:mpga,wav|max:7000'
        ]);
        $fileName = $request->file->hashName();
        $format = $request->file->getClientOriginalExtension();
        $size = $request->file->getSize();
        $request->file->move(public_path('audio'), $fileName);

        Ringtone::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'slug' => Str::slug($request->get('title')),
            'category_id' => $request->get('category'),
            'format' => $format,
            'size' => $size,
            'file' => $fileName,
        ]);

        return redirect()->route('ringtones.index')->with('message', 'Ringtone has been added successfully');

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
        $ringtone = Ringtone::find($id);
        return view('backend.ringtone.edit', compact('ringtone'));
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
        $this->validate($request,[
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:500',
            'category' => 'required',
        ]);

        $ringtone = Ringtone::find($id);
        $fileName = $ringtone->file;
        $format = $ringtone->format;
        $size = $ringtone->size;
        $downloads = $ringtone->downloads;
        if($request->hasFile('file')){
            $fileName = $request->file->hashName();
            $format = $request->file->getClientOriginalExtension();
            $size = $request->file->getSize();
            $downloads = 0;
            $request->file->move(public_path('audio'), $fileName);
            unlink(public_path('/audio/'.$ringtone->file));
        }
        $ringtone->title = $request->get('title');
        $ringtone->slug = Str::slug($request->get('title'));
        $ringtone->description = $request->get('description');
        $ringtone->category_id = $request->get('category');
        $ringtone->format = $format;
        $ringtone->size = $size;
        $ringtone->file = $fileName;
        $ringtone->downloads = $downloads;
        $ringtone->save();
        return redirect()->route('ringtones.index')->with('message', 'Ringtone has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ringtone = Ringtone::find($id);
        $ringtone->delete();
        unlink(public_path('/audio/'.$ringtone->file));
        return redirect()->back()->with('message', 'Ringtone has been updated successfully');
    }
}
