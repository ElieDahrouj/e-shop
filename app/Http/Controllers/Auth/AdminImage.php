<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Image;
use App\Product;
use JD\Cloudder\Facades\Cloudder;

class AdminImage extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $extension = pathinfo($image->image);

        $public_id = basename($image->image,".".$extension['extension']);
        Cloudder::delete("heavens-shoes/images/".$public_id);

        Image::findOrFail($id)->delete();
        return response()->json([
            'product' => Product::with('images')->findOrFail($image->product_id)
        ]);
    }
}
