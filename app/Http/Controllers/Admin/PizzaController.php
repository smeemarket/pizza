<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    // direct pizza page
    public function pizza()
    {
        $data = Pizza::paginate(9);
        // dd($data->total());
        return view('admin.pizza.list')->with('pizza', $data);
    }

    // direct pizza page
    public function addPizza()
    {
        $category = Category::get();

        return view('admin.pizza.createPizza')->with('category', $category);
    }

    // direct create pizza
    public function createPizza(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('image');

        $fileName = uniqid() . '_' . $file->getClientOriginalName();

        $file->move(public_path() . '/uploads/', $fileName); // , ကော်မာ သတိထား

        $data = $this->requestPizzaData($request, $fileName);

        Pizza::create($data);
        return redirect()->route('admin#pizza')->with('createSuccess', 'Pizza Successfully Created..');
    }

    // delete pizza
    public function deletePizza($id)
    {
        $data = Pizza::select('image')->where('pizza_id', $id)->first();
        $fileName = $data['image'];

        Pizza::where('pizza_id', $id)->delete(); // db delete

        // project delete . ဒေါ့ သတိထား ကော်မာ မဟုတ်
        if (File::exists(public_path() . '/uploads/' . $fileName)) {
            File::delete(public_path() . '/uploads/' . $fileName);
        }

        return back()->with('deleteSuccess', 'Pizza Successfully Deleted!');
    }

    // look pizza information
    public function pizzaInfo($id)
    {
        $data = Pizza::where('pizza_id', $id)->first();
        return view('admin.pizza.info')->with('pizza', $data);
    }

    // edit pizza page
    public function editPizza($id)
    {
        $category = Category::get();
        $data = Pizza::select('*')
            ->join('categories', 'categories.category_id', 'pizzas.category_id')
            ->where('pizzas.pizza_id', $id)
            ->first();
        // dd($data->toArray());
        return view('admin.pizza.edit')->with(['pizza' => $data, 'category' => $category]);
    }

    // update pizza
    public function updatePizza($id, Request $request)
    {
        // dd($id, $request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = $this->requestUpdatePizzaData($request);

        if (isset($updateData['image'])) {
            // get old image name
            $data = Pizza::select('image')->where('pizza_id', $id)->first();
            $fileName = $data['image'];

            // delete old image file
            if (File::exists(public_path() . '/uploads/' . $fileName)) {
                File::delete(public_path() . '/uploads/' . $fileName);
            }

            // get new image data
            $file = $request->file('image');

            $fileName = uniqid() . '_' . $file->getClientOriginalName();

            $file->move(public_path() . '/uploads/', $fileName);

            $updateData['image'] = $fileName;
        }
        Pizza::where('pizza_id', $id)->update($updateData);

        return redirect()->route('admin#pizza')->with('updateSuccess', 'Pizza Successfully Updated..');
    }

    // search pizza
    public function searchPizza(Request $request)
    {
        $searchKey = $request->pizzaSearch;

        $searchData = Pizza::where('pizza_name', 'like', '%' . $searchKey . '%')
            ->orWhere('price', $searchKey)
            ->paginate(9);
        // dd($searchData->toArray());
        // return back()->with('pizza', $searchData);
        return view('admin.pizza.list')->with('pizza', $searchData);
    }

    private function requestUpdatePizzaData($request)
    {
        $arr = [
            'pizza_name' => $request->name,
            // 'image' => $fileName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if (isset($request->image)) {
            $arr['image'] = $request->image;
        }

        return $arr;
    }

    // request pizza data
    private function requestPizzaData($request, $fileName)
    {
        return [
            'pizza_name' => $request->name,
            'image' => $fileName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}