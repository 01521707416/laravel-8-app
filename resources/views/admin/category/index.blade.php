@extends('layouts.dashboard')
@section('content')

{{-- Table mother div starts --}}

    <div class="row">
        <div class="col-lg-8">
            {{-- Categories List table starts --}}
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
                                <td class="d-flex flex-row">
                                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-outline-secondary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                    <br>
                                    <a href="{{route('category.soft_delete', $category->id)}}" class="btn btn-outline-danger shadow btn-xs sharp ml-1"><i class="fa fa-trash"></i></a>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-outline-danger shadow">Delete marked</button>
                </form>
                </div>
            </div>
            {{-- Categories List table ends --}}

            {{-- Trash Categories table starts --}}
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
                                <td class="d-flex flex-row">
                                    <div class="form-group"> 
                                        <a class="btn btn-xs btn-outline-success text-center mr-1 shadow" href="{{route('category.restore', $trash->id)}}">Restore</a>
                                    </div>
                                    <div class="form-group"> 
                                    <a href="{{route('category.hard_delete', $trash->id)}}" class="btn btn-xs btn-outline-danger ml-1 shadow">Delete</a>
                                    </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Trash Categories table starts --}}
        </div>

            {{-- Category Insertion table starts --}}
        <div class="col-lg-4">
            <div class="card h-auto">
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
                            <button class="btn btn-sm btn-outline-info shadow">Add Category</button>
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
