@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                @endif
                <div class="card">
                    <div class="card-header">All Photos
                        <span class="float-right"><a class="btn btn-primary" href="{{route('photos.create')}}">Add Photo</a></span>
                    </div>

                    <div class="card-body mx-auto" style="width: 100%; overflow-x: auto">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Format</th>
                            <th>Size</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </thead>
                            <tbody>
                            @if(count($photos) > 0)
                                @foreach($photos as $key=>$photo)
                                    <tr>
                                        <td><img src="{{asset('/uploads')}}/{{$photo->file}}" width="80px" alt=""></td>
                                        <td>{{$photo->title}}</td>
                                        <td>{{$photo->description}}</td>
                                        <td>{{$photo->format}}</td>
                                        <td>{{$photo->size}}bytes</td>
                                        <td>
                                            <a href="{{route('photos.edit', $photo->id)}}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$photo->id}}">Delete</button>
                                            <div class="modal fade" id="deleteModal{{$photo->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$photo->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{$photo->id}}">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this photo?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <form action="{{route('photos.destroy', $photo->id)}}" method="post">
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
                                <td class="mx-auto bg-white">No photos to display</td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
