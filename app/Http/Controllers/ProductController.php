<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
        $data = (object)[
            'error' => null,
            'product' => [],
        ];
        try{
            $data->product = Product::where('actif', 1)->where('id',$id)
                ->whereDate('release_date', '<=', Carbon::today()->toDateString())
                ->firstOrFail();
            $data->product->images;

            return response()->json($data);
        }
        catch (\Exception $e){
            $data->error = $e;
            $data->product= [];
            return response()->json($data,"404");
        }
    }

    public function index(Request $request, Product $product)
    {
        $data = (object)[
            'error' => null,
            'products'=>[]
        ];
        if ($request->query('search')) {
            try {
                $params = $request->query('search');
                $data->products = Product::orderBy('release_date', 'DESC')
                    ->where('actif', 1)
                    ->where('name', 'like', '%' . $params . '%')
                    ->whereDate('release_date', '<=', Carbon::today()->toDateString())
                    ->paginate(10);
                return response()->json($data);
            } catch (ModelNotFoundException $e) {
                $data->error = $e;
                $data->products = [];
                return response()->json($data, '404');
            }
        }
        if ($request->query('sort') && $request->query('max') )
        {
            try{
                $data->products =Product::all()->random(10)
                    ->where('actif',1)
                    ->where('release_date', '<=', Carbon::today()->toDateString());
                return response()->json($data);
            }
            catch (ModelNotFoundException $e) {
                $data->error = $e;
                $data->products = [];
                return response()->json($data, '404');
            }
        }
        if (!$request->query('sort') && !$request->query('max') && !$request->query('search')){

            try{
                $data->products =Product::orderBy('release_date','DESC')
                    ->whereDate('release_date', '<=', Carbon::today()->toDateString())
                    ->where('actif',1)->get();
                $data->brands = Brand::all();
                foreach ($data->brands as $brand){
                    $brand->products;
                }
                return response()->json($data);
            }
            catch (ModelNotFoundException $e){
                $data->error = $e;
                $data->brands=[];
                $data->products =[];
                return response()->json($data,'404');
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
