@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Name</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/name/update')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Password</h3>
            </div>
                    @if(session('change_pass_success'))
                        <strong class="text-success pt-2">{{session('change_pass_success')}}</strong>
                    @endif
            <div class="card-body">
                <form action="{{url('/pass/update')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="old_password">
                        @if(session('wrong_pass'))
                        <strong class="text-danger pt-2">{{session('wrong_pass')}}</strong>
                        @endif
                        @if(session('same_pass'))
                        <strong class="text-danger pt-2">{{session('same_pass')}}</strong>
                        @endif
                        @error('old_password')
                           <strong class="text-danger pt-2">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                           <strong class="text-danger pt-2">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection