@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header">{{$ringtone->title}}</div>

                    <div class="card-body">
                        <audio controls controsList="nodownload">
                            <source src="{{asset('/audio')}}/{{$ringtone->file}}" type="audio/ogg">
                            Your browser does not support this element
                        </audio>
                    </div>
                    <div class="card-footer">
                        <form action="{{route('ringtones.download', $ringtone->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">Download</button>
                        </form>
                    </div>
                </div>
                <table class="table mt-4">
                    <tr>
                        <th>Name</th>
                        <td>{{$ringtone->title}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{$ringtone->description}}</td>
                    </tr>
                    <tr>
                        <th>Format</th>
                        <td>{{$ringtone->format}}</td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td>{{$ringtone->size}}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{$ringtone->category->name}}</td>
                    </tr>
                    <tr>
                        <th>Downloads</th>
                        <td>{{$ringtone->downloads}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 my-4">
                <div class="card-header">Categories</div>
                @foreach(App\Category::all() as $category)
                    <div class="card-header" style="background-color: #ccc">{{$category->name}}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
