<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class VendorProfileController extends Controller
{
    public function index(): View
    {

        $user = User::find(Auth::id());
        return View('vendor.profile.vendor_profile', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required | string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user()->id)],
            'photo' => 'image | max:2024'
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $file = $request->file('photo');
        if ($file) {
            if ($user->photo && file_exists(public_path('uploaded/vendor/' . $user->photo))) {
                unlink(public_path('uploaded/vendor/' . $user->photo));
            }
            $file_name = date('Ymai') . $file->getClientOriginalName();
            $file->move(public_path('/uploaded/vendor'), $file_name);
            $user->photo = $file_name;
        }
        $userStatus = $user->isDirty();
        $user->save();
        $alert = [
            'message' => 'No Data Changes',
            'type' => 'info'
        ];

        if ($userStatus) {
            $alert = [
                'message' => 'Profile Updated Successfully!',
                'type' => 'success'
            ];
        }
        return back()->with($alert);
    }
    public function editPassword(): View
    {
        return view('vendor.profile.vendor_password_change');
    }
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|current_password',
            'password' => ['required', Password::defaults(), 'confirmed']
        ]);
        $current_password = Auth::user()->password;
        $new_password = $request->password;

        $validator->after(function ($validator) use ($current_password, $new_password) {
            if (Hash::check($new_password, $current_password)) {
                $validator->errors()->add('current_password', 'Old and New passwrod can\'t be same');
            }
        })->validate();

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        $alert = [
            'message' => 'Password Change Successfully!',
            'type' => 'success'
        ];

        return back()->with($alert);
    }
}
