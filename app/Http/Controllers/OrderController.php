<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\OrderPart;
use App\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $checkIfOrderExists = Order::where('user_id', $loggedUserId)->where('status', ' DRAFT')->exists();

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
            $order = Order::where('user_id', $loggedUserId)->where('status', 'DRAFT')->orderBy('created_at', 'desc')->first();
            $product = Product::find($inputs['product_id']);

            $orderPartData['order_id'] = $order->id;
            $orderPartData['product_id'] = $product->id;
            $orderPartData['product_name'] = $product->name;
            $orderPartData['product_price'] = 2;
            $orderPartData['quantity'] = $inputs['quantity'];
            $orderPartData['price'] = 2 * $inputs['quantity'];

            $orderPart = OrderPart::create($orderPartData);
        }

        return redirect()->route('products.index');
    }
}