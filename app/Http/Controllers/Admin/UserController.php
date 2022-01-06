<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // direct user list page
    public function userList()
    {
        // dd(User::find(2)->toArray()); // id ဖြစ်မှ ရှာ
        $data = User::where('role', 'user')->paginate(9);
        return view('admin.user.userList')->with('user', $data);
    }

    // user search
    public function userSearch(Request $request)
    {
        $response = $this->search('user', $request);
        return view('admin.user.userList')->with('user', $response);
    }

    // delete user
    public function userDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with('deleteSuccess', 'User account successfully deleted!');
    }

    // direct admin list page
    public function adminList()
    {
        $data = User::where('role', 'admin')->paginate(9);
        return view('admin.user.adminList')->with('admin', $data);
    }

    // admin search
    public function adminSearch(Request $request)
    {
        $response = $this->search('admin', $request);
        return view('admin.user.adminList')->with('admin', $response);
    }

    // delete admin
    public function adminDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with('deleteSuccess', 'admin account successfully deleted!');
    }

    // data searching
    private function search($role, $request)
    {
        $searchData = User::where('role', $role)
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->searchData . '%')
                    ->orWhere('email', 'like', '%' . $request->searchData . '%')
                    ->orWhere('address', 'like', '%' . $request->searchData . '%')
                    ->orWhere('phone', 'like', '%' . $request->searchData . '%');
            })->paginate(9);
        $searchData->appends($request->all());
        return $searchData;
    }
}