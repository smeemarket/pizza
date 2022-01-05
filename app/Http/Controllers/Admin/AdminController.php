<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // direct admin profile
    public function profile()
    {
        $id = auth()->user()->id;
        // dd($id);
        $user = User::where('id', $id)->first();
        // dd($user->toArray());
        return view('admin.profile.index')->with('user', $user);
    }

    // update profile
    public function updateProfile($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = $this->requestUserData($request);
        User::where('id', $id)->update($updateData);
        return back()->with('updateSuccess', 'User Information Updated..');
    }

    // change password page
    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }

    // change password
    public function changePassword($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                // ->with('passwordErrors', 'Need to fill all password fields!');
                ->withErrors($validator)
                ->withInput();
        }

        $old_password = $request->oldPassword;
        $new_password = $request->newPassword;
        $confirm_password = $request->confirmPassword;

        $db_hash_password = auth()->user()->password;

        if (Hash::check($old_password, $db_hash_password)) {
            if ($new_password == $confirm_password) {
                if (strlen($new_password) >= 6) {
                    $new_hash_password = Hash::make($new_password);
                    User::where('id', $id)->update([
                        'password' => $new_hash_password
                    ]);
                    return back()->with('success', 'Password Successfully Changed...');
                } else {
                    return back()->with('lengthError', 'New Password must be at least 6 characters.');
                }
            } else {
                return back()->with('notSameError', 'Password confirmation do not match.. Not same');
            }
        } else {
            return back()->with('notMatchError', 'Password do not match! Try Again..');
        }
    }

    private function requestUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
}