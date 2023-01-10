@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mt-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name">
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