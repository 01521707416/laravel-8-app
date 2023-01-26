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
                <form action="{{route('mark_del_sub')}}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><input id="checkAll" type="checkbox"> Mark All</th>
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
                                <td><input type="checkbox" name='mark[]' value="{{$sub->id}}"></td>
                                <td>{{$key+1}}</td>
                                <td>
                                    @php
                                        if(App\Models\Category::where('id', $sub->category_id)->exists()){
                                            echo $sub->rel_to_category->category_name;
                                        }
                                        else {
                                            echo "Uncategorized";
                                        }
                                    @endphp
                                </td>
                                <td>{{$sub->subcategory_name}}</td>
                                <td>{{$sub->created_at->diffForHumans()}}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <a href="{{route('edit.subcategory', $sub->id)}}" class="btn btn-outline-primary shadow btn-xs mr-1">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    
                                        <a href="{{route('subcategory.soft_delete', $sub->id)}}" class="btn btn-outline-danger shadow btn-xs ml-1">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-outline-danger shadow">Delete marked</button>
                </form>
            </div>
        </div>
        {{-- Subcategories list table ends --}}
        {{-----------------------------------}}
        {{-- Subcategory trash table starts --}}
        <div class="card mt-5">
            <div class="card-header bg-info shadow">
                <h3 class="text-light">Trash Subcategories List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
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
                        @foreach ($trash_subcategories as $key=>$trash_sub)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @php
                                    if(App\Models\Category::where('id', $trash_sub->category_id)->exists()){
                                        echo $trash_sub->rel_to_category->category_name;
                                    }
                                    else{
                                        echo "Uncategorized";
                                    }
                                @endphp
                            </td>
                            <td>{{$trash_sub->subcategory_name}}</td>
                            <td>{{$trash_sub->created_at->diffForHumans()}}</td>
                            <td>
                                <div class="d-flex flex-row">
                                    <a class="btn btn-xs btn-outline-success text-center mr-1 shadow" href="{{route('subcategory.restore', $trash_sub->id)}}"><i class="fa-solid fa-trash-arrow-up"></i></a>
                            
                                    <a href="{{route('subcategory.hard_delete', $trash_sub->id)}}" class="btn btn-xs btn-outline-danger ml-1 shadow"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </td>
                        
                        </tr>
                            @endforeach
                    </tbody>
            </table>
        </div>
    </div>
    {{-- Subcategory trash table ends --}}
</div>
    

    {{-- Subcategory Add Section starts --}}
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
                            <strong class="text-danger mt-2">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Sub Category Name</label>
                        <input type="text" class="form-control" name="subcategory_name">

                        @error('subcategory_name')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror

                        @if(session('exist'))
                        <strong class="text-danger mt-2">{{session('exist')}}</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-outline-success shadow" type="submit">Add Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Subcategory Add Section ends --}}
</div>

@endsection

@section('footer_script')

@if(session('success'))
<script>
    const Toast = Swal.mixin({
  toast: true,
  position: 'bottom-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Subcategory added successfully'
})
</script>
@endif

@if(session('mark_delete'))
<script>
    Swal.fire(
      'Deleted!',
      '{{session('mark_delete')}}',
      'success'
    )
</script>
@endif

@if(session('delete'))
<script>
    Swal.fire(
      'Deleted!',
      '{{session('delete')}}',
      'success'
    )
</script>
@endif

@if(session('hard_delete'))
<script>
    Swal.fire(
      'Deleted!',
      '{{session('hard_delete')}}',
      'success'
    )
</script>
@endif

@if(session('restore'))
<script>
    Swal.fire(
      'Restored!',
      '{{session('restore')}}',
      'success'
    )
</script>
@endif

@endsection