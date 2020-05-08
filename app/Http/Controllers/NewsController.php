<?php

namespace App\Http\Controllers;
use App\News;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
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
            $data->news =News::orderBy('release_date','DESC')
                ->where('actif',1)
                ->whereDate('release_date', '<=', Carbon::today()->toDateString())
                ->get();
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
            $data->news =News::orderBy('release_date','DESC')->take(5)
                ->where('actif',1)
                ->whereDate('release_date', '<=', Carbon::today()->toDateString())
                ->get();
            $data->products =Product::all()->random(10)
                ->where('actif',1)
                ->where('release_date', '<=', Carbon::today()->toDateString());
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
            $data->new =News::where('actif',1)
                ->whereDate('release_date', '<=', Carbon::today()->toDateString())
                ->findOrFail($id);
            $data->new->user->name;
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
