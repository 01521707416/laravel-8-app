@extends('layouts.dashboard')
@Section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Inventory</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

<div class="row">
    <div class="col-lg-8"></div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Inventory</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="mt-3">
                        <input type="text" readonly class="form-control" value="{{$product_info->product_name}}">
                    </div>
                    <div class="mt-3">
                        <select name="color_id" id="" class="form-control">
                            <option value="">-- Select Color --</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <select name="size_id" id="" class="form-control">
                            <option value="">-- Select Size --</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <input type="text" class="form-control" name="quantity" value="Quantity">
                    </div>
                    <div class="mt-3">
                       <button class="btn btn-sm btn-outline-success" type="submit">Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection