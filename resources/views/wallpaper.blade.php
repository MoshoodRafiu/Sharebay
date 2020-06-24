@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($wallpapers as $wallpaper)
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header">{{$wallpaper->title}}</div>

                    <div class="card-body">
                        <p>{{$wallpaper->description}}</p>
                        <div>
                            <img src="{{asset('/uploads')}}/{{$wallpaper->file}}" class="img img-fluid" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-4">
                <form action="" method="post">
                    @csrf
                    <button class="btn btn-primary w-100 my-1">Download 1280x1024</button>
                </form>
                <form action="" method="post">
                    @csrf
                    <button class="btn btn-primary w-100 my-1">Download 800x600</button>
                </form>
                <form action="" method="post">
                    @csrf
                    <button class="btn btn-primary w-100 my-1">Download 316x255</button>
                </form>
                <form action="" method="post">
                    @csrf
                    <button class="btn btn-primary w-100 my-1">Download 118x95</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
@endsection
