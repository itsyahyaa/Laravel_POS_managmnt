<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Order_Detail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $products = Product::all();
        $orders = Order::all();
        //Last Order Details
        $lastID = Order_Detail::max('order_id');
        $order_receipt = Order_Detail::where('order_id',$lastID)->get();

        return view('orders', compact('products', 'orders','order_receipt'));
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
        DB::transaction(function () use ($request) {

            //Order Modal
            $orders = new Order;
            $orders->name = $request->customer_name;
            $orders->address = $request->customer_Phone;
            $orders->save();
            $order_id = $orders->id; // id from order table is used as foreign key in order_details

            //Order_Detail modal
            for ($product_id=0; $product_id < count($request->product_id); $product_id++) {
                # code...
                $order_details = new Order_Detail;
                $order_details->order_id = $order_id;
                $order_details->product_id = $request->product_id[$product_id];
                $order_details->unitprice = $request->price[$product_id];
                $order_details->quantity = $request->quantity[$product_id];
                $order_details->amount = $request->total_amount[$product_id];
                $order_details->discount = $request->discount[$product_id];
                $order_details->save();
            }


            //Transaction modal
            $transaction = new Transaction;
            $transaction->order_id = $order_id;
            $transaction->user_id = auth()->user()->id;
            $transaction->balance = $request->balance;
            $transaction->paid_amount = $request->paid_amount;
            $transaction->payment_method = $request->payment_method;
            $transaction->transac_amount = $order_details->amount;
            $transaction->transac_date = date('Y-m-d');
            $transaction->save();

            //last order History
            $products = Product::all();
            $order_details  = Order_Detail::where('order_id', $order_id)->get();
            $orders = Order::where('id',$order_id)->get();
            return view('orders', compact('products', 'order_details','orders'));

        });
        return back()->with("Product Order Fails to inserted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
