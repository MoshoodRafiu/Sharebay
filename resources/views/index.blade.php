@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($ringtones as $ringtone)
                <div class="card my-4">
                    <div class="card-header">{{$ringtone->title}}</div>
                    <div class="card-body">
                        <audio controls controlsList="nodownload" onplay="pauseOthers(this)">
                            <source src="{{asset('/audio')}}/{{$ringtone->file}}" type="audio/ogg">
                            Your browser does not support this element
                        </audio>
                    </div>
                    <div class="card-footer">
                        <a href="">Info and Download</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-4 my-4">
                <div class="card-header">Categories</div>
                @foreach(App\Category::all() as $category)
                    <div class="card-header" style="background-color: #ccc">{{$category->name}}</div>
                @endforeach
            </div>
            {{$ringtones->links()}}
        </div>
    </div>
@endsection
