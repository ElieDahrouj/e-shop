<?php

use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $getJson= File::get('database/data/sneakers.json');
        $datas = json_decode($getJson);

        foreach ($datas as $data){
            Cloudder::upload(storage_path('img/'.$data->image),null,['folder'=>'heavens-shoes/products']);
            $image = Cloudder::getResult();
            $product = new Product();
            $product->name = $data->name;
            $product->brand = $data->brand;
            $product->color = $data->color;
            $product->description = $data->description;
            $product->price = $data->price;
            $product->image = $image['secure_url'];
            $product->brand_id = $data->brand_id;
            $product->release_date = $data->release_date;
            $product->save();
        }
    }
}
