<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use  Faker\Factory as faker;
class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=0;$i<4;$i++){
            $title=$faker->sentence(6);
        DB::table('blogs')->insert([
            'category'=>rand(1,7),
            'title'=>$faker->title,
            'image'=>$faker->imageUrl(800, 400, 'cats', true, 'Faker'),
            'content'=>$faker->paragraph(4,true),
            'slug'=>$faker->title,
            'created_at'=>$faker->dateTime('now'),
            'updated_at'=>now()


        ]);


        }
            }
}
