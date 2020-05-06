<?php

use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;
use App\Brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/brands.json');
        $datas = json_decode($getJson);

        foreach ($datas as $data){
            Cloudder::upload(storage_path('img/'.$data->image),null,['folder'=>'heavens-shoes/brands']);
            $image = Cloudder::getResult();
            Cloudder::upload(storage_path('img/'. $data->banner),null,['folder'=>'heavens-shoes/brands']);
            $bannerImage = Cloudder::getResult();
            $brand = new Brand();
            $brand->name = $data->name;
            $brand->image = $image['secure_url'];
            $brand->banner = $bannerImage['secure_url'];
            $brand->save();
        }
    }
}
