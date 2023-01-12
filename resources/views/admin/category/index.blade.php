@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Categories List</h3>
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
                                <td>{{$category->relation_to_user->name}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                    <button name="{{route('category.soft_delete', $category->id)}}" class="btn btn-sm btn-danger delete">Delete</button>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-danger">Delete marked</button>
                </form>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Trash Categories List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
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
                                <td>{{$key+1}}</td>
                                <td>{{$trash->relation_to_user->name}}</td>
                                <td>{{$trash->category_name}}</td>
                                <td>{{$trash->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('category.restore', $trash->id)}}" class="btn btn-sm btn-success">Restore</a>
                                    <button name="{{route('category.hard_delete', $trash->id)}}" class="btn btn-sm btn-danger delete">Delete Forever</button>
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
                    <h3 class="text-center">Category Insertion</h3>
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
                            <button class="btn btn-sm btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
  title: 'Category added successfully'
})
</script>
@endif

<script>
    $('.delete').click(
        function()
        {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var link = $(this).attr('name');
                    window.location.href = link;
                                        }
            })
        });
</script>

@if(session('delete'))
<script>
    Swal.fire(
      'Deleted!',
      '{{session('delete')}}',
      'success'
    )
</script>
@endif

<script>
    $('#checkAll').click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

@endsection
