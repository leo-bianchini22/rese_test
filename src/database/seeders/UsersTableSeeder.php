<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // ロール(役割)作成
        $adminRole = ModelsRole::create(['name' => 'admin']);
        $admin->assignRole($adminRole);

        // 代表者のロールを作成
        $representativeRole = ModelsRole::create(['name' => 'representative']);
    }
}
