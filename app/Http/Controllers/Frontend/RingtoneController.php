<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ringtone;
use App\Category;
use Illuminate\Support\Facades\Response;

class RingtoneController extends Controller
{
    public function index(){
        $ringtones = Ringtone::paginate(5);
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
    public function category($id){
        $ringtones = Ringtone::where('category_id', $id)->paginate(5);
        $category = Category::find($id);
        return view('category', compact('ringtones', 'category'));
    }
}
