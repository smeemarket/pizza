<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // // direct admin home page
    // public function index()
    // {
    //     return view('admin.home');
    // }

    // direct category page
    public function category()
    {
        $categories = Category::paginate(9);
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

    // edit category
    public function editCategory($id)
    {
        $category = Category::where('category_id', $id)->first();
        return view('admin.category.update')->with('category', $category);
    }

    // update category
    public function updateCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Category::where('category_id', $request->id)->update(['category_name' => $request->name]);
        return redirect()->route('admin#category')->with('updateSuccess', 'Category Successfully Updated...');
    }

    // search category
    public function searchCategory(Request $request)
    {
        $data = Category::where('category_name', 'like', '%' . $request->searchData . '%')->paginate(9);
        $data->appends($request->all());
        // dd($data->toArray());
        return view('admin.category.list')->with('category', $data);
    }
}