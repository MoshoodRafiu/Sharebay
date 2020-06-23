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
        //
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
            'file' => 'required|mimes:mpga,wav|max:5000'
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

        return redirect()->back()->with('message', 'Ringtone has been added successfully');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
