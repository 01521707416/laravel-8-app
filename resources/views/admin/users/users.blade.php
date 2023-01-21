@extends('layouts.dashboard')
@section('content')

{{-- Breadcrumb Starts --}}
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Users List</a></li>
    </ol>
</div>
{{-- Breadcrumb Ends --}}

{{-- User Table starts --}}
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-info shadow">
                    <h3 class="text-white">Users List
                        <span class="badge badge-pill badge-warning mx-5">Total Users: {{$total_users}}</span>
                    </h3>
                </div>

                    @if(session('delete'))
                        <strong class="text-success mt-4 ml-5">{{session('delete')}}</strong>
                    @endif

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_users as $key=> $user)   
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>
                                <div class="text-center">
                                    <a href="{{route('user.delete', $user->id)}}" class="btn btn-outline-danger shadow btn-xs"><i class="fa-solid fa-trash-can"></i></a>
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
{{-- User Table ends --}}

@endsection