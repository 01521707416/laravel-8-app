<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

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
        return back()->with('user_delete', 'User has been deleted successfully!');
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
            'password' => 'required',
            'password' => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
            'new_password' => 'confirmed',
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {

            if (Hash::check($request->password, Auth::user()->password)) {
                return back()->with('same_pass', 'New password cannot be same as current password!');
            } else {
                User::find(Auth::id())->update([
                    'password' => bcrypt($request->password),
                    'updated_at' => Carbon::now(),
                ]);
                return back()->with('change_pass_success', 'Password changed successfully!');
            }
        } else {
            return back()->with('wrong_pass', 'Current password is incorrect!');
        }
    }

    function photo_update(Request $request)
    {
        $request->validate([
            'profile_photo' => 'image',
            'profile_photo' => 'file|max:2048',
        ]);

        $uploaded_photo = $request->profile_photo;
        $extension = $uploaded_photo->getClientOriginalExtension();
        $filename = Auth::id() . '.' . $extension;

        if (Auth::user()->profile_photo == 'default.png') {
            Image::make($uploaded_photo)->save(public_path('/uploads/users/' . $filename));
            // We will be using image intervention extension in order to upload image to database
            User::find(Auth::id())->update([
                'profile_photo' => $filename,
            ]);
            return back();
        } else {
            $delete_from_db = public_path('/uploads/users/' . Auth::user()->profile_photo);
            unlink($delete_from_db);

            Image::make($uploaded_photo)->save(public_path('/uploads/users/' . $filename));
            // We will be using image intervention extension in order to upload image to database
            User::find(Auth::id())->update([
                'profile_photo' => $filename,
            ]);
            return back();
        }
    }
}
