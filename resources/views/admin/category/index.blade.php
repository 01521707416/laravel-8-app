@extends('layouts.dashboard')
@section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

{{-- Table mother div starts --}}

    <div class="row">
        <div class="col-lg-8">
            {{-- Categories List table starts --}}
            <div class="card">
                <div class="card-header bg-dark shadow">
                    <h3 class="text-light shadow">Categories List</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/mark/delete')}}" method="POST">
                        @csrf
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th><input id="checkAll" type="checkbox"> Mark All</th>
                                <th>Sl No.</th>
                                <th>Added By</th>
                                <th>Category Name</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key=>$category)
                            <tr>
                                <td><input type="checkbox" name='mark[]' value="{{$category->id}}"></td>
                                <td>{{$key+1}}</td>
                                <td>
                                    @php
                                        if(App\Models\User::where('id', $category->user_id)->exists()){
                                            echo $category->relation_to_user->name;
                                        }
                                        else{
                                            echo "N/A";
                                        }
                                    @endphp
                                </td>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->created_at->diffForHumans()}}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <a href="{{route('category.edit', $category->id)}}" class="btn btn-outline-primary shadow btn-xs sharp mr-1">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    <br>
                                        <a href="{{route('category.soft_delete', $category->id)}}" class="btn btn-outline-danger shadow btn-xs sharp ml-1">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <button type="submit" class="btn btn-xs btn-outline-danger shadow">Delete Marked</button>
                    </form>
                </div>
            </div>
            {{-- Categories List table ends --}}
            {{--------------------------------}}
            {{-- Trash Categories table starts --}}
            <div class="card mt-5">
                <div class="card-header bg-dark shadow">
                    <h3 class="text-light shadow">Trash Categories List</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/mark/restore')}}" method="POST">
                        @csrf
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th><input id="checkAll" type="checkbox"> Mark All</th>
                                <th>Sl No.</th>
                                <th>Added By</th>
                                <th>Category Name</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trash_categories as $key=>$trash)
                            <tr>
                                <td><input type="checkbox" name='mark[]' value="{{$trash->id}}"></td>
                                <td>{{$key+1}}</td>
                                <td>
                                    @php
                                        if(App\Models\User::where('id', $trash->user_id)->exists()){
                                            echo $trash->relation_to_user->name;
                                        }
                                        else{
                                            echo "N/A";
                                        }
                                    @endphp
                                </td>
                                <td>{{$trash->category_name}}</td>
                                <td>{{$trash->created_at->diffForHumans()}}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                    
                                    <a class="btn btn-xs btn-outline-success text-center mr-1 shadow sharp" href="{{route('category.restore', $trash->id)}}"><i class="fa-solid fa-trash-arrow-up"></i></a>
                                    
                                   
                                    <a href="{{route('category.hard_delete', $trash->id)}}" class="btn btn-xs btn-outline-danger ml-1 shadow sharp"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-xs btn-outline-success shadow mr-2">Restore Marked</button>
                    </form>
                </div>
            </div>
            {{-- Trash Categories table ends --}}
        </div>

            {{-- Category Insertion table starts --}}
        <div class="col-lg-4">
            <div class="card h-auto">
                <div class="card-header bg-dark shadow">
                    <h3 class="text-light shadow">Category Insertion</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/category/insert')}}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name">
                            @error('category_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-outline-success shadow">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            {{-- Category Insertion table starts --}}
    </div>

    {{-- Table mother div ends --}}

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
  title: 'Category added successfully'
})
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

@if(session('mark_delete'))
<script>
    Swal.fire(
      'Deleted!',
      '{{session('mark_delete')}}',
      'success'
    )
</script>
@endif

@if(session('mark_restore'))
<script>
    Swal.fire(
      'Restored!',
      '{{session('mark_restore')}}',
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

@if(session('hard_delete'))
<script>
    Swal.fire(
      'Deleted!',
      '{{session('hard_delete')}}',
      'success'
    )
</script>
@endif

@endsection
