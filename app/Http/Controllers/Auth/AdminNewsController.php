<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use JD\Cloudder\Facades\Cloudder;
use Symfony\Component\Console\Input\Input;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:news',
            'image'=>'required|mimes:jpeg,jpg,png',
            'summary'=>'required',
            'description'=>'required',
            'release_date'=>'required',
            'actif'=>'required|integer',
            'user_id'=>'required',
        ]);
        if (!$validator->fails()) {
            $image_name = $request->image->getRealPath();
            Cloudder::upload($image_name, null, ['folder' => 'heavens-shoes/news']);
            $cloudinary_new = Cloudder::getResult();

            $news = new News();
            $news->title = $request->title;
            $news->summary = $request->summary;
            $news->content = $request->description;
            $news->actif = $request->actif;
            $news->release_date = $request->release_date;
            $news->user_id = $request->user_id;
            $news->image = $cloudinary_new['secure_url'];
            $news->save();
            return response()->json(['msg' => 'Ajout de l\'actualité avec succès.','type' => 1]);
        }
        else {
            return response()->json([
                'msg' => 'Tous les champs sont obligatoire et le champs << Nom >> doit être unique.',
                'type' =>0
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $path_image = News::findOrFail($request->id);
        $extension = pathinfo($path_image->image);

        $public_id = basename($path_image->image,".".$extension['extension']);
        Cloudder::delete("heavens-shoes/news/".$public_id);
        News::findOrFail($request->id)->delete();
        return response()->json('Suppression réussis !');
    }

    public function show($id)
    {
        return response(News::findOrFail($id));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'summary'=>'required',
            'description'=>'required',
            'release_date'=>'required',
            'actif'=>'required|integer',
        ]);

        if (!$validator->fails()) {
            if ($request->newImage){
                $oldImage = News::findOrFail($request->id);
                $extension = pathinfo($oldImage->image);
                $public_id = basename($oldImage->image, "." . $extension['extension']);
                Cloudder::delete("heavens-shoes/news/" . $public_id);

                $image_name = $request->newImage->getRealPath();
                Cloudder::upload($image_name, null, ['folder' => 'heavens-shoes/news']);
                $cloudinary_new = Cloudder::getResult();

                $updateNew = News::findOrFail($request->id)->update([
                    'title' => $request->title,
                    'summary' => $request->summary,
                    'content' => $request->description,
                    'release_date' => $request->release_date,
                    "actif" => $request->actif,
                    "image" => $cloudinary_new['secure_url']
                ]);
                $newNew = News::findOrFail($request->id);

                if ($updateNew){
                    return response()->json([
                        'msg' => 'Modification de l\'actualité avec succès.',
                        'type' => 1,
                        'new' => $newNew
                    ]);
                }
                else{
                    return response()->json(['msg' => 'Erreur lors de la mise à jour de l\'actualité.','type' => 0]);
                }
            }
            else{
                $updateNew = News::findOrFail($request->id)->update([
                    'title' => $request->title,
                    'summary' => $request->summary,
                    'content' => $request->description,
                    'release_date' => $request->release_date,
                    "actif" => $request->actif,
                ]);
                $newNew = News::findOrFail($request->id);

                if ($updateNew){
                    return response()->json([
                        'msg' => 'Modification de l\'actualité avec succès.',
                        'type' => 1,
                        'new' => $newNew
                    ]);
                }
                else{
                    return response()->json(['msg' => 'Erreur lors de la mise à jour de l\'actualité.','type' => 0]);
                }
            }
        }
        else{
            return response()->json(['msg' => 'Tous les champs sont obliagtoire et le champ Titre doit $etre unique.','type' => 0]);
        }
    }
}
