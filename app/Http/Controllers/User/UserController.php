<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        return view('frontend.frontend_user_dashboard', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => [Rule::unique('users')->ignore($request->user()->id)],
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user()->id)],
            'photo' => 'image',

        ]);
        $user = User::find($request->user()->id);
        $user->update($request->except('photo'));
        $file = $request->file('photo');
        if ($file) {
            if ($user->photo && file_exists(public_path('/uploaded/user/' . $user->photo))) {
                unlink(public_path('/uploaded/user/' . $user->photo));
            }
            $file_name = date('Ymai') . $file->getClientOriginalName();
            $file->move(public_path('/uploaded/user'), $file_name);
            $user->photo = $file_name;
        }
        $user->save();
        $alert = [
            'message' => 'Profile Updated Successfully!',
            'type' => 'success'
        ];
        return back()->with($alert);
    }
}
