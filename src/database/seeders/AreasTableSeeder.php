<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create(['name' => '東京都']);
        Area::create(['name' => '大阪府']);
        Area::create(['name' => '福岡県']);
    }
}
