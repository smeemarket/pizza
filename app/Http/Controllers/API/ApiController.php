<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    public function categoryList(){
            $category = Category::get();

            $response = [
                'status'=>200,
                'message'=>'success',
                'data'=>$category
            ];
            return Response::json($response);
    }

    public function createCategory(Request $request)
    {
//        dd($request->header('API-KEY')); // from header
//        dd($request->name); // from body
//        dd($request->all());
        $data = [
            'category_name'=>$request->categoryName,
            'created_at'=>Carbon::now(),
            'updated-at'=>Carbon::now()
        ];

        Category::create($data);

        $response = [
            'status'=>200,
            'message'=>'success'
        ];

        return Response::json($response);
    }

    public function categoryDetails($id)
    {
//        $id = $request->id;

        $data = Category::where('category_id',$id)->first();

        if(!empty($data)){
            return Response::json([
                'status'=>200,
                'message'=>'success',
                'data'=>$data
            ]);
        }
         return Response::json([
             'status'=>200,
             'message'=>'fail',
             'data'=>$data
         ]);
    }

    public function categoryDelete($id)
    {
        $data = Category::where('category_id',$id)->first();

        if(empty($data))
        {
            return Response::json([
                'status'=>200,
                'message'=>'There is no search data in database',
            ]);
        }

        Category::where('category_id',$id)->delete();

        return Response::json([
            'status'=>200,
            'message'=>'success',
            'data'=>$data
        ]);
    }

    public function categoryUpdate(Request $request)
    {
        $updateData = [
            'category_id'=>$request->id,
            'category_name'=>$request->categoryName,
            'updated_at'=>Carbon::now()
        ];

        $check = Category::where('category_id',$request->id)->first();

        if(!empty($check))
        {
            Category::where('category_id',$request->id)->update($updateData);
            return Response::json([
                'status'=>200,
                'message'=>'success'
            ]);
        }

        return Response::json([
            'status'=>200,
            'message'=>'There is no data to update'
        ]);

    }
}
