<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Customer;
use App\Orders_products;
use Illuminate\Support\Facades\Validator;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Customer $customer ,Order $order, Orders_products $orders_products )
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'email' => 'required',
            'phone_number' => 'numeric|digits_between:10,10',
            'basketful'=> 'required',
            'cvc' => 'numeric|digits_between:3,3',
            'month' => 'numeric|digits_between:1,2',
            'year' => 'numeric|digits_between:4,4',
            'cartNumber' => 'numeric|digits_between:16,16'
        ]);

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->zipcode = $request->zipcode;
        $customer->city= $request->city;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->save();

        $order->order_number = $request->basketful['token'];
        $order->customer_id = $customer->id;
        $order->save();

        foreach ($request->basketful['basket'] as $details => $value)
        {
            $orderProduct = new Orders_products;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $value['product']['id'];
            $orderProduct->save();
        }
        return response()->json([
            'msg' => 'Confirmation du traitement de la commande avec succès',
            'type' => 1
        ]);
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
