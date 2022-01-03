<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // // direct admin home page
    // public function index()
    // {
    //     return view('admin.home');
    // }

    // direct admin profile
    public function profile()
    {
        $id = auth()->user()->id;
        // dd($id);
        $user = User::where('id', $id)->first();
        // dd($user->toArray());
        return view('admin.profile.index')->with('user', $user);
    }

    // direct category page
    public function category()
    {
        $categories = Category::paginate(2);
        return view('admin.category.list')->with('category', $categories);
    }

    // add category page
    public function addCategory()
    {
        return view('admin.category.addCategory');
    }

    public function createCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'category_name' => $request->name
        ];
        Category::create($data);
        return redirect()->route('admin#category')->with('categorySuccess', 'Category Added...');
    }

    // delete category
    public function deleteCategory($id)
    {
        Category::where('category_id', $id)->delete();
        return back()->with('categoryDelete', 'Category Successfully Deleted!');
    }

    // direct pizza page
    public function pizza()
    {
        return view('admin.pizza.list');
    }
}