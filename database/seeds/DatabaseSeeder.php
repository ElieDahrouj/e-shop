<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProductsTableSeeder::class,
            BrandSeeder::class,
            NewsSeeder::class,
            ImagesSeeder::class
        ]);
    }
}
