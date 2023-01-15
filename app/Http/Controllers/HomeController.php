<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    function dash()
    {
        return view('layouts.dashboard');
    }

    function profile()
    {
        return view('admin.users.profile');
    }

    function name_update(Request $request)
    {
        User::find(Auth::id())->update([
            'name' => $request->name,
            'updated_at' => Carbon::now(),
        ]);
        return back();
    }

    function pass_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        // // User::find(Auth::id())->update([
        // //     'name' => $request->name,
        // //     'updated_at' => Carbon::now(),
        // // ]);
        // return back();
    }
}
