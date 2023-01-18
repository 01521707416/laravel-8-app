@extends('layouts.dashboard')

@section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Subcategory Edit</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

<div class="col-lg-4">
    <div class="card">
        <div class="card-header bg-info shadow">
            <h3 class="text-white">Add Subcategory</h3>
        </div>
        <div class="card-body">
            <form action="{{url('/add.subcategory/insert')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Select Category</label>
                    <select name="category_id" id="" class="form-control">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <span class="text-danger mt-2">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Sub Category Name</label>
                    <input type="text" class="form-control" name="subcategory_name">

                    @error('subcategory_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    @if(session('exist'))
                    <span class="text-danger mt-2">{{session('exist')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-outline-success shadow" type="submit">Add Subcategory</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection