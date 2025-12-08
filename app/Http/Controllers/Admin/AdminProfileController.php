<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        return View('admin.profile.admin_profile', compact('user'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user()->id)]
        ]);
        $user = User::find($request->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if ($request->file('photo')) {
            if ($user->photo && file_exists(public_path('uploaded/admin/' . $user->photo))) {
                unlink(public_path('uploaded/admin/' . $user->photo));
            }
            $file = $request->file('photo');
            $file_name = date('ddmmY') . $file->getClientOriginalName();
            $file->move(public_path('uploaded/admin'), $file_name);
            $user->photo = $file_name;
        }

        $userStatus = $user->isDirty();
        $user->save();
        $alert = [
            'message' => 'No Data Changed!',
            'type' => 'info'
        ];
        if ($userStatus) {


            $alert = [
                'message' => 'Profile Update Successfully!',
                'type' => 'success'
            ];
        }
        return redirect()->back()->with($alert);
    }

    public function editPassword(): View
    {
        return View('admin.profile.admin_password_change');
    }
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|current_password',
            'password' => ['required', Password::defaults(), 'confirmed']
        ]);

        $current_password = auth()->user()->password;
        $new_password = $request->password;

        $validator->after(function ($validator) use ($current_password, $new_password) {
            if (Hash::check($new_password, $current_password)) {
                $validator->errors()->add('current_password', 'Current Password and New Password cant be same');
            }
        });

        $validated = $validator->validate();

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($validated['password']);
        $user->save();
        $alert = [
            'message' => 'Password Changed Successfully!',
            'type' => 'success'
        ];

        return back()->with($alert);
    }
}
