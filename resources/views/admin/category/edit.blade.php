@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Edit Categories</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/category/update')}}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="hidden" name="id" value="{{$category_info->id}}">
                            <input type="text" class="form-control" name="category_name" value="{{$category_info->category_name}}">
                            @error('category_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-primary">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection