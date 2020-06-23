<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ringtone;

class RingtoneController extends Controller
{
    public function index(){
        $ringtones = Ringtone::paginate(20);
        return view('index', compact('ringtones'));
    }
}
