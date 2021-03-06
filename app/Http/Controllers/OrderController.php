<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\OrderPart;
use App\Product;
use App\Mail\PlaceOrder;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->where('status', '!=', 'DRAFT')->get();
        
        return view('admin.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id)->with('orderParts')->first();

        return view('admin.orderDetails', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addItems(Request $request)
    {
        $inputs = $request->all();
        $loggedUserId = Auth::user()->id;
        $checkIfOrderExists = Order::where('user_id', $loggedUserId)
                                        ->where('status', 'DRAFT')
                                        ->exists();
        // dd($checkIfOrderExists);

        if (!$checkIfOrderExists) {
            $params['user_id'] = $loggedUserId;
            $product = Product::find($inputs['product_id']);

            $order = Order::create($params);

            $orderPartData['order_id'] = $order->id;
            $orderPartData['product_id'] = $product->id;
            $orderPartData['product_name'] = $product->name;
            $orderPartData['product_price'] = 2;
            $orderPartData['quantity'] = $inputs['quantity'];
            $orderPartData['price'] = 2 * $inputs['quantity'];

            $orderPart = OrderPart::create($orderPartData);
        } else {
            $order = Order::where('user_id', $loggedUserId)
                                    ->where('status', 'DRAFT')
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                                    
            $product = Product::find($inputs['product_id']);

            $orderPartData['order_id'] = $order->id;
            $orderPartData['product_id'] = $product->id;
            $orderPartData['product_name'] = $product->name;
            $orderPartData['product_price'] = 2;
            $orderPartData['quantity'] = $inputs['quantity'];
            $orderPartData['price'] = 2 * $inputs['quantity'];

            $orderPart = OrderPart::create($orderPartData);
        }

        return redirect()->route('products.index')->with('success', 'Product added to cart!');
        ;
    }

    public function showCart()
    {
        $loggedUser = Auth::user()->id;
        $userOrder = Order::with('orderParts')
                            ->where('user_id', $loggedUser)
                            ->where('status', 'DRAFT')
                            ->orderBy('created_at', 'DESC')
                            ->first();

        $totalPrice = 0;

        if ($userOrder == null) {
            return view('cart.index');
        }

        if (count($userOrder->orderParts)) {
            foreach ($userOrder->orderParts as $part) {
                $totalPrice += $part->price;
            }
        }

        return view('cart.index', compact('userOrder', 'totalPrice'));
    }

    public function deleteOrderPart(Request $request)
    {
        $inputs = $request->all();
        $orderPart = OrderPart::find($inputs['part_id']);
        $orderPart->delete();

        return redirect()->route('cart');
    }

    public function updateOrderStatus(Request $request)
    {
        $inputs = $request->all();
        $loggedUser = Auth::user()->id;

        if ($inputs['status'] == 'NEW') {
            $order = Order::where('user_id', $loggedUser)
                            ->where('status', 'DRAFT')
                            ->orderBy('created_at', 'DESC')
                            ->first();

            $order->delivery_type = $inputs['delivery'];
            $order->hour = $inputs['hour'];
            $order->status = $inputs['status'];
            $order->total_price = $inputs['totalPrice'];
            $order->update();

            Mail::to('euugen_90@yahoo.com')->send(new PlaceOrder());

            return view('cart.orderSuccess');
        }

        if ($inputs['status'] == 'PROCESSING') {
            $order = Order::find($inputs['id']);
            $order->status = $inputs['status'];
            $order->update();

            return true;
        }

        if ($inputs['status'] == 'CANCELED') {
            $order = Order::find($inputs['id']);
            $order->status = $inputs['status'];
            $order->update();

            return true;
        }

        if ($inputs['status'] == 'DELIVERED') {
            $order = Order::find($inputs['id']);
            $order->status = $inputs['status'];
            $order->update();

            return true;
        }
    }
}