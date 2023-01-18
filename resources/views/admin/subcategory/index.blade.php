@extends('layouts.dashboard')
@section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Subcategory</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

<div class="row">

    {{-- Subcategories list table starts --}}
    <div class="col-lg-8">
        <div class="card">
        <div class="card-header bg-info shadow">
            <h3 class="text-light">Subcategories List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Category Name</th>
                        <th>Subcategory Name</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $key=>$sub)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$sub->rel_to_category->category_name}}</td>
                        <td>{{$sub->subcategory_name}}</td>
                        <td>{{$sub->created_at->diffForHumans()}}</td>
                        <td>
                            <div class="d-flex flex-row">
                            <a href="{{route('edit.subcategory', $sub->id)}}" class="btn btn-outline-primary shadow btn-xs mr-2"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="" class="btn btn-outline-danger shadow btn-xs ml-2"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    {{-- Subcategories list table ends --}}


    {{-- Sub Category Add Section starts --}}
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
    {{-- Sub Category Add Section ends --}}
</div>

@endsection