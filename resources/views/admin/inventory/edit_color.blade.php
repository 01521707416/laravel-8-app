@extends('layouts.dashboard')

@section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('add.color.size')}}">Color & Size</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit color</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Edit Color</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/color/update')}}" method="POST">
                    @csrf
                    <div class="mt-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="hidden" name="id" class="form-control" value="{{$color_info->id}}">
                        <input type="text" name="color_name" class="form-control" value="{{$color_info->color_name}}">
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="text" name="color_code" class="form-control" value="{{$color_info->color_code}}">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-sm btn-outline-success shadow">Edit Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection