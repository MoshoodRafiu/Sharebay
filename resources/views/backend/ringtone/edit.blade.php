@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                @endif
                <div class="card">
                    <div class="card-header">Update Ringtone</div>

                    <div class="card-body">
                        <form action="{{route('ringtones.update', $ringtone->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{$ringtone->title}}">
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea name="description" id="desc" class="form-control @error('description') is-invalid @enderror">{{$ringtone->description}}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept="audio/*">
                                @error('file')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                    <option value="">---Select Category---</option>
                                    @foreach(App\Category::all() as $category)
                                        <option value="{{$category->id}}" @if($ringtone->category_id === $category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
