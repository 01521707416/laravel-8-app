<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    function users()
    {
        $all_users = User::all();
        $total_users = User::count();
        return view('admin.users.users', compact('all_users', 'total_users'));
    }

    function user_delete($user_id)
    {
        User::find($user_id)->delete();
        return back();
    }
}
