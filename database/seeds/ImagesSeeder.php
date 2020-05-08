<?php

use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;
use App\Image;
class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/images.json');
        $datas = json_decode($getJson);

        foreach ($datas as $data){
            Cloudder::upload(storage_path('img/'.$data->image),null,['folder'=>'heavens-shoes/images']);
            $image = Cloudder::getResult();
            $img = new Image();
            $img->image = $image['secure_url'];
            $img->product_id = $data->sneaker_id;
            $img->save();
        }
    }
}
