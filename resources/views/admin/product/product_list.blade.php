@extends('layouts.dashboard')
@Section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Products List</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Products List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>After Discount</th>
                                <th>Short Desp</th>
                                <th>Long Desp</th>
                                <th>Preview</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_products as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_price}}</td>
                                <td>{{$product->discount.'%'}}</td>
                                <td>{{$product->after_discount}}</td>
                                <td>{{$product->short_desp}}</td>
                                <td>{{$product->long_desp}}</td>
                                <td><img class="img-thumbnail" src="{{asset('/uploads/products/preview')}}//{{$product->preview}}" alt=""></td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <a href="{{route('inventory')}}" class="btn btn-outline-primary shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-box-open"></i>
                                        </a>
                                    <br>
                                        <a href="" class="btn btn-outline-danger shadow btn-xs sharp ml-1">
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
    </div>

@endsection