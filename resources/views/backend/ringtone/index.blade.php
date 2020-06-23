@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                @endif
                <div class="card">
                    <div class="card-header">All Ringtone
                        <span class="float-right"><a class="btn btn-primary" href="{{route('ringtones.create')}}">Add Ringtone</a></span>
                    </div>

                    <div class="card-body mx-auto">
                        <table class="table table-striped table-responsive">
                            <thead>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File</th>
                                <th>Category</th>
                                <th>Downloads</th>
                                <th>Size</th>
                                <th>Edit</th>
                            </thead>
                            <tbody>
                            @foreach($ringtones as $key=>$ringtone)
                                <td>{{$key+1}}</td>
                                <td>{{$ringtone->title}}</td>
                                <td>{{$ringtone->description}}</td>
                                <td class="d-flex align-items-center">
                                    <div>
                                        <audio controls>
                                            <source src="{{asset('/audio')}}/{{$ringtone->file}}" type="audio/ogg">
                                            Your browser does not support this element
                                        </audio>
                                    </div>
                                </td>
                                <td>{{$ringtone->category->name}}</td>
                                <td>{{$ringtone->downloads}}</td>
                                <td>{{$ringtone->size}}bytes</td>
                                <td>
                                    <a href="{{route('ringtones.edit', $ringtone->id)}}" class="btn btn-primary">Edit</a>
                                </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
