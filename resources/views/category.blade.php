@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if(count($ringtones) > 0)
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
                            <a href="{{route('ringtones.show', [$ringtone->id,$ringtone->slug])}}">Info and Download</a>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="card my-4">
                        <div class="card-header">No Ringtone available for <strong>{{$category->name}}</strong> ringtones</div>
                        <div class="card-body">
                            <h3 class="text-center text-muted">No Result Found</h3>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4 my-4">
                <div class="card-header">Categories</div>
                @foreach(App\Category::all() as $singlecategory)
                    <div class="card-header @if($singlecategory->id === $category->id) bg-light @else bg-secondary @endif"><a class=" @if($singlecategory->id === $category->id) text-secondary @else text-white @endif" href="{{route('ringtones.category', $singlecategory->id)}}">{{$singlecategory->name}}</a></div>
                @endforeach
            </div>
            {{$ringtones->links()}}
        </div>
    </div>
@endsection
