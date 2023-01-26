@extends('layouts.dashboard')
@Section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('product.list')}}">Products List</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Inventory</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Inventories Information</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Sl No.</th>
                            <th>Product Name</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($inventories as $key=>$inventory)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$inventory->rel_to_product->product_name}}</td>
                            <td><span class="text-center" style="padding: 10px 20px; background-color:#{{$inventory->rel_to_color->color_code}}"></span></td>
                            <td>{{$inventory->rel_to_size->size_name}}</td>
                            <td>{{$inventory->quantity}}</td>
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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Inventory</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/inventory/insert')}}" method="POST">
                    @csrf
                    <div class="mt-3">
                        <input type="text" readonly class="form-control" value="{{$product_info->product_name}}">
                        <input type="hidden" name="product_id" class="form-control" value="{{$product_info->id}}">
                    </div>
                    <div class="mt-3">
                        <select name="color_id" id="" class="form-control">
                            <option value="">-- Select Color --</option>
                            @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                        </select>
                        @error('color_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <select name="size_id" id="" class="form-control">
                            <option value="">-- Select Size --</option>
                            @foreach ($sizes as $size)
                                <option value="{{$size->id}}">{{$size->size_name}}</option>
                            @endforeach
                        </select>
                        @error('size_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <input type="text" class="form-control" name="quantity" placeholder="Quantity">
                        @error('quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                       <button class="btn btn-sm btn-outline-success shadow" type="submit">Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection