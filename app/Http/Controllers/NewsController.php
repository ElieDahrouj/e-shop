<?php

namespace App\Http\Controllers;
use App\News;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class NewsController extends Controller
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
            'news' => [],
        ];

        try{
            $data->news =News::orderBy('id','DESC')->where('actif',1)->get();
            return response()->json($data);
        }
        catch (ModelNotFoundException $e){
            $data->error = $e;
            $data->news=[];
            return response()->json($data,'404');
        }
    }

    public function home()
    {
        $data = (object)[
            'error' => null,
            'news' => [],
            'products'=>[]
        ];

        try{
            $data->news =News::orderBy('id','DESC')->take(5)->where('actif',1)->get();
            $data->products =Product::all()->random(10)->where('actif',1);
            return response()->json($data);
        }
        catch (ModelNotFoundException $e){
            $data->error = $e;
            $data->news=[];
            $data->products =[];
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
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news, $id)
    {
        $data = (object)[
            'error' => null,
            'new' => [],
        ];
        try{
            $data->news =News::where('actif',1)->findOrFail($id);
            return response()->json($data);
        }
        catch (ModelNotFoundException $e){
            $data->error = $e;
            $data->news= [];
            return response()->json($data,"404");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
