<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // direct user home page
    public function index()
    {
        $pizza = Pizza::where('publish_status', 1)->paginate(9);
        $category = Category::get();

        return view('user.home')->with(['pizza' => $pizza, 'category' => $category]);
    }

    public function categorySearch($id)
    {
        $pizza = Pizza::where('category_id', $id)
            ->where('publish_status', 1)
            ->paginate(9);
        $category = Category::get();
        return view('user.home')->with(['pizza' => $pizza, 'category' => $category]);
    }

    public function searchItem(Request $request)
    {
        $data = Pizza::where(
            'pizza_name',
            'like',
            '%' . $request->searchData . '%'
        )
            ->where('publish_status', 1)
            ->paginate(9);
        $data->appends($request->all());
        $category = Category::get();
        return view('user.home')->with(['pizza' => $data, 'category' => $category]);
    }

    public function pizzaDetails($id)
    {
        $pizza = Pizza::where('pizza_id', $id)->first();
        Session::put('PIZZA_INFO', $pizza);
        return view('user.details')->with('pizza', $pizza);
    }

    public function order()
    {
        $pizzaInfo = Session::get('PIZZA_INFO');

        return view('user.order')->with('pizza', $pizzaInfo);
    }

    public function placeOrder(Request $request)
    {
        $pizzaInfo = Session::get('PIZZA_INFO');
        $userId = auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'pizzaCount' => 'required',
            'paymentType' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $orderData = $this->requestOrderData($pizzaInfo, $userId, $request);

        Order::create($orderData);

        $totalTime = $pizzaInfo['waiting_time'] * $orderData['pizza_count'];

        return back()->with(['orderSuccess' => 'Order Success...', 'time' => $totalTime]);
    }

    public function searchPizzaItem(Request $request)
    {
        $min = $request->minPrice;
        $max = $request->maxPrice;
        $start_date = $request->startDate;
        $end_date = $request->endDate;

        $query = Pizza::select('*');

        if (!is_null($start_date) && is_null($end_date)) {
            $query = $query->whereDate('created_at', '>=', $start_date);
        } else if (is_null($start_date) && !is_null($end_date)) {
            $query = $query->whereDate('created_at', '<=', $end_date);
        } else if (!is_null($start_date) && !is_null($end_date)) {
            $query = $query->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date);
        }

        if (!is_null($min) && is_null($max)) {
            $query = $query->where('price', '>=', $min);
        } else if (is_null($min) && !is_null($max)) {
            $query = $query->where('price', '<=', $max);
        } else if (!is_null($min) && !is_null($max)) {
            $query = $query->where('price', '>=', $min)
                ->where('price', '<=', $max);
        }

        $query = $query->paginate(9);
        $query->appends($request->all());

        $category = Category::get();
        return view('user.home')->with(['pizza' => $query, 'category' => $category]);
    }

    private function requestOrderData($pizzaInfo, $userId, $request)
    {
        return [
            'customer_id' => $userId,
            'pizza_id' => $pizzaInfo['pizza_id'],
            'pizza_count' => $request->pizzaCount,
            'payment_status' => $request->paymentType,
            'order_time' => Carbon::now(),
        ];
    }
}