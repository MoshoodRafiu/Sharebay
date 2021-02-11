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

                    <div class="card-body mx-auto" style="width: 100%; overflow-x: auto">
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
                                <th>Delete</th>
                            </thead>
                            <tbody>
                            @if(count($ringtones) > 0)
                            @foreach($ringtones as $key=>$ringtone)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$ringtone->title}}</td>
                                    <td>{{$ringtone->description}}</td>
                                    <td class="d-flex align-items-center">
                                        <div>
                                            <audio controls onplay="pauseOthers(this)">
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
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$ringtone->id}}">Delete</button>
                                        <div class="modal fade" id="deleteModal{{$ringtone->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$ringtone->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{$ringtone->id}}">Confirm Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this ringtone?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{route('ringtones.destroy', $ringtone->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <td class="mx-auto bg-white">No ringtone to display</td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
