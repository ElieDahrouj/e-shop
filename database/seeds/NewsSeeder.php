<?php

use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;
use App\News;
class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/news.json');
        $datas = json_decode($getJson);

        foreach ($datas as $data){
            Cloudder::upload(storage_path('img/'.$data->image),null,['folder'=>'heavens-shoes/news']);
            $image = Cloudder::getResult();
            $news = new News();
            $news->title = $data->title;
            $news->summary = $data->summary;
            $news->content = $data->content;
            $news->image = $image['secure_url'];
            $news->actif = $data->is_published;
            $news->user_id = $data->author;
            $news->save();
        }
    }
}
