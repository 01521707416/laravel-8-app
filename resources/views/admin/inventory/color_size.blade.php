@extends('layouts.dashboard')
@Section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Color & Size</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Colors List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Sl No.</th>
                                <th>Color Name</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($colors as $key=>$color)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$color->color_name}}</td>
                                <td><span class="text-center" style="padding: 10px 20px; background-color:#{{$color->color_code}}"></span></td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <a href="" class="btn btn-outline-danger shadow btn-xs sharp ml-2">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Sizes List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Sl No.</th>
                                <th>Size Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($sizes as $key=>$size)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$size->size_name}}</td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <a href="" class="btn btn-outline-danger shadow btn-xs sharp ml-2">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Add Color Table Starts --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Color</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/insert/color')}}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <label for="" class="form-label">Color Name</label>
                            <input type="text" name="color_name" class="form-control">
                            @error('quantity')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Color Code</label>
                            <input type="text" name="color_code" class="form-control">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-outline-success shadow">Add Color</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3>Add Size</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/insert/size')}}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <label for="" class="form-label">Size Name</label>
                            <input type="text" name="size_name" class="form-control">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-outline-success shadow">Add Size</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Add Color Table Ends --}}
    </div>
</div>

@endsection