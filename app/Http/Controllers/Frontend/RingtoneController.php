<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ringtone;
use Illuminate\Support\Facades\Response;

class RingtoneController extends Controller
{
    public function index(){
        $ringtones = Ringtone::paginate(20);
        return view('index', compact('ringtones'));
    }
    public function show($id, $slug){
        $ringtone = Ringtone::where('id', $id)->where('slug', $slug)->first();
        return view('show', compact('ringtone'));
    }
    public function download($id){
        $ringtone = Ringtone::find($id);
        $ringtonePath = $ringtone->file;
        $filePath = public_path('audio/').$ringtonePath;
        $ringtone->increment('downloads');
        $ringtone->save();
        return Response::download($filePath);
    }
}
