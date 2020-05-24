<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class AdminNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    public function index()
    {
        $data = (object)[
            'error' => null,
            'news' => [],
        ];

        try{
            $data->news =News::orderBy('release_date','DESC')->get();
            return response()->json($data);
        }
        catch (ModelNotFoundException $e){
            $data->error = $e;
            $data->news=[];
            return response()->json($data,'404');
        }
    }
}
