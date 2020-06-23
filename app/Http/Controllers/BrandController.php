<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (object)[
            'error' => null,
            'brands' => [],
        ];

        try{
            $data->brands = Brand::with('products')->orderBy('id','DESC')->get();
            return response()->json($data);
        }
        catch (ModelNotFoundException $e){
            $data->error = $e;
            $data->brands = [];
            return response()->json($data,'404');
        }
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
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand, $id)
    {
        $data = (object)[
            'error' => null,
            'brand' =>[]
        ];
        try{
            $data->brand = Brand::with('products')->findOrFail($id);
            return response()->json($data);
        }
        catch (\Exception $e){
            $data->error = $e;
            $data->brand= [];
            return response()->json($data,"404");
        }
    }

    public function showOne(Brand $brand, $id)
    {
        $data = (object)[
            'error' => null,
            'brand' =>[]
        ];
        try{
            $data->brand = Brand::findOrFail($id);
            return response()->json($data);
        }
        catch (\Exception $e){
            $data->error = $e;
            $data->brand= [];
            return response()->json($data,"404");
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
