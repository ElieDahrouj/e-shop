<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class AdminProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $data = (object)[
            'error' => null,
            'products' => [],
        ];

        try{
            $data->products =Product::orderBy('release_date','DESC')->get();
            return response()->json($data);
        }
        catch (ModelNotFoundException $e){
            $data->error = $e;
            $data->products =[];
            return response()->json($data,'404');
        }
    }
}
