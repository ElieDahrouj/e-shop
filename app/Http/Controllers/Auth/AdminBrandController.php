<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Validator;
class AdminBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:brands',
            'image'=>'required|mimes:jpeg,jpg,png',
            'banner'=>'required|mimes:jpeg,jpg,png',
        ]);

        if (!$validator->fails()) {
            $image_name = $request->image->getRealPath();
            Cloudder::upload($image_name, null, ['folder' => 'heavens-shoes/brands']);
            $cloudinary_brand = Cloudder::getResult();

            $bannerName = $request->banner->getRealPath();
            Cloudder::upload($bannerName, null, ['folder' => 'heavens-shoes/brands']);
            $cloudinary_banner = Cloudder::getResult();

            $brand = new Brand();
            $brand->name = $request->name;

            if ($request->description !== null) {
                $brand->description = $request->description;
            }

            $brand->image = $cloudinary_brand['secure_url'];
            $brand->banner = $cloudinary_banner['secure_url'];
            $brand->save();
            return response()->json(['msg' => 'Ajout de la marque avec succès.','type' => 1]);
        }
        else {
            return response()->json([
                'msg' => 'Tous les champs sont obligatoire sauf description, verifier que les donnéers renseignées soient corrects et que le champs << Nom >> soit unique.',
                'type' =>0
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $path_image = Brand::findOrFail($request->id);
        $extension = pathinfo($path_image->image);
        $extension_banner = pathinfo($path_image->banner);

        $public_id = basename($path_image->image,".".$extension['extension']);
        Cloudder::delete("heavens-shoes/brands/".$public_id);

        $public_id_banner = basename($path_image->banner,".".$extension_banner['extension']);
        Cloudder::delete("heavens-shoes/brands/".$public_id_banner);

        Brand::findOrFail($request->id)->delete();
        return response()->json('Suppression réussis !');
    }

    public function show($id)
    {
        return response(Brand::findOrFail($id));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $updateBrand = "";
        if (!$validator->fails()) {
            $updateBrand = Brand::findOrFail($id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if ($request->image) {
                $oldImage = Brand::findOrFail($id);
                $extension = pathinfo($oldImage->image);
                $public_id = basename($oldImage->image, "." . $extension['extension']);
                Cloudder::delete("heavens-shoes/brands/".$public_id);

                $image_name = $request->image->getRealPath();
                Cloudder::upload($image_name, null, ['folder' => 'heavens-shoes/brands']);
                $cloudinary_Banner = Cloudder::getResult();

                $updateBrand = Brand::findOrFail($id)->update([
                    'image' => $cloudinary_Banner['secure_url'],
                ]);
            }
            if ($request->banner){
                $oldImage = Brand::findOrFail($id);
                $extension = pathinfo($oldImage->banner);
                $public_id = basename($oldImage->banner, "." . $extension['extension']);
                Cloudder::delete("heavens-shoes/brands/" . $public_id);

                $image_name = $request->banner->getRealPath();
                Cloudder::upload($image_name, null, ['folder' => 'heavens-shoes/brands']);
                $cloudinary_Banner = Cloudder::getResult();

                $updateBrand = Brand::findOrFail($id)->update([
                    'banner' => $cloudinary_Banner['secure_url'],
                ]);
            }
            $newBrandUpdated = Brand::findOrFail($id);
            if ($updateBrand){
                return response()->json([
                    'msg' => 'Modification de la marque avec succès.',
                    'type' => 1,
                    'brand' => $newBrandUpdated
                ]);
            }
            else{
                return response()->json(['msg' => 'Erreur lors de la mise à jour de la marque.','type' => 0]);
            }
        }
    }
}
