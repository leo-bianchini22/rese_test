<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create(['name' => '寿司']);
        Genre::create(['name' => '焼肉']);
        Genre::create(['name' => '居酒屋']);
        Genre::create(['name' => 'イタリアン']);
        Genre::create(['name' => 'ラーメン']);
    }
}
