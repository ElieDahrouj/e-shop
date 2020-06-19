<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use JD\Cloudder\Facades\Cloudder;
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'color' => 'required',
            'image'=>'required|mimes:jpeg,jpg,png',
            'price'=>'required|numeric',
            'description'=>'required',
            'release_date'=>'required',
            'actif'=>'required|integer',
            'brand'=>'required',
            'brand_id'=>'required|integer',
            'moreImages'=>'required',
        ]);
        if (!$validator->fails()) {
            $image_name = $request->image->getRealPath();
            Cloudder::upload($image_name, null, ['folder' => 'heavens-shoes/products']);
            $cloudinary_brand = Cloudder::getResult();

            $newProduct = new Product();
            $newProduct->name = $request->name;
            $newProduct->description = $request->description;
            $newProduct->price = $request->price;
            $newProduct->color = $request->color;
            $newProduct->brand = $request->brand;
            $newProduct->release_date = $request->release_date;
            $newProduct->actif = $request->actif;
            $newProduct->brand_id = $request->brand_id;
            $newProduct->image = $cloudinary_brand['secure_url'];
            $newProduct->save();

            foreach ($request->moreImages as $secondPicture){
                $image_second = $secondPicture->getRealPath();
                Cloudder::upload($image_second, null, ['folder' => 'heavens-shoes/images']);
                $cloudinary_secondPicture = Cloudder::getResult();

                $secondary_pictures = new Image();
                $secondary_pictures->image = $cloudinary_secondPicture['secure_url'];
                $secondary_pictures->product_id = $newProduct->id;
                $secondary_pictures->save();
            }

            return response()->json(['msg' => 'Ajout de la paire avec succès.','type' => 1]);
        }
        else {
            return response()->json([
                'msg' => 'Tous les champs sont obligatoire , verifier que les donnéers renseignées soient corrects et que le champs << Titre >> soit unique.',
                'type' => 0
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $path_image = Product::findOrFail($request->id);
        $extension = pathinfo($path_image->image);

        $public_id = basename($path_image->image,".".$extension['extension']);
        Cloudder::delete("heavens-shoes/products/".$public_id);

        $path_imageSecondary = Image::where("product_id","=",$request->id)->get();

        foreach ($path_imageSecondary as $pathPicture)
        {
            $extensionSecondary = pathinfo($pathPicture->image);
            $public_id_Secondary = basename($pathPicture->image,".".$extensionSecondary['extension']);
            Cloudder::delete("heavens-shoes/images/".$public_id_Secondary);
            Image::where("product_id","=",$pathPicture->product_id)->delete();
        }

        Product::findOrFail($request->id)->delete();
        return response()->json('Suppression réussis !');
    }

    public function show($id)
    {
        return response(Product::with('images')->findOrFail($id));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'color' => 'required',
            'price'=>'required|numeric',
            'description'=>'required',
            'release_date'=>'required',
            'actif'=>'required|integer',
        ]);
        if (!$validator->fails()) {
            $updateProduct = Product::findOrFail($id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'color' => $request->color,
                'release_date' => $request->release_date,
                'actif' => $request->actif
            ]);

            if ($request->image) {
                $oldImage = Product::findOrFail($id);
                $extension = pathinfo($oldImage->image);
                $public_id = basename($oldImage->image, "." . $extension['extension']);
                Cloudder::delete("heavens-shoes/products/".$public_id);

                $image_name = $request->image->getRealPath();
                Cloudder::upload($image_name, null, ['folder' => 'heavens-shoes/products']);
                $cloudinary_Banner = Cloudder::getResult();

                $updateProduct = Product::findOrFail($id)->update([
                    'image' => $cloudinary_Banner['secure_url'],
                ]);
            }
            if ($request->moreImages){
                $ProductToUpdated = Product::findOrFail($id);
                foreach ($request->moreImages as $secondPicture){
                    $image_second = $secondPicture->getRealPath();
                    Cloudder::upload($image_second, null, ['folder' => 'heavens-shoes/images']);
                    $cloudinary_secondPicture = Cloudder::getResult();

                    $secondary_pictures = new Image();
                    $secondary_pictures->image = $cloudinary_secondPicture['secure_url'];
                    $secondary_pictures->product_id = $ProductToUpdated->id;
                    $secondary_pictures->save();
                }
            }
            if ($request->brand){
                $updateProduct = Product::findOrFail($id)->update([
                    'brand' => $request->brand,
                    'brand_id' => $request->brand_id,
                ]);
            }
            $newProductUpdated = Product::with('images')->findOrFail($id);
            if ($updateProduct){
                return response()->json([
                    'msg' => 'Modification de la paire avec succès.',
                    'type' => 1,
                    'product' => $newProductUpdated
                ]);
            }
            else{
                return response()->json(['msg' => 'Erreur lors de la mise à jour de la paire.','type' => 0]);
            }
        }
    }
}
