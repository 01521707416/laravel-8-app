@extends('layouts.dashboard')
@Section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Products</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Product</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/product/insert')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-level">Category</label>
                                <select name="category_id" class="form-control" id="category">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-level">Subcategory</label>
                                <select name="subcategory_id" class="form-control" id="subcategory">
                                    <option value="">-- Select Subcategory --</option>
                                    
                                </select>
                            </div>
                        </div>
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-level">Product Name</label>
                                <input type="text" name="product_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-level">Product Price</label>
                                <input type="number" name="product_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-level">Discount %</label>
                                <input type="number" name="discount" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-level">Short Description</label>
                                <input type="text" name="short_desp" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="" class="form-level">Long Description</label>
                                <textarea name="long_desp" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="" class="form-level">Product Preview</label>
                                <input type="file" name="preview" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-outline-success mr-4 mt-2" type="submit">Add Product</button>
                                <button class="btn btn-sm btn-outline-danger ml-4 mt-2" type="reset">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
    <script>
        $('#category').change(function(){
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'/getSubcategory',
                data:{'category_id': category_id},
                success:function(data){
                    $('#subcategory').html(data);
                }
            });

        });
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{session('success')}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

@endsection

