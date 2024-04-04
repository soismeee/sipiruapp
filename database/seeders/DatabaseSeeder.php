<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'id' => intval((microtime(true) * 10000)),
            'name' => 'DPMTPSP',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => '1',
        ]);

        User::create([
            'id' => intval((microtime(true) * 10000)),
            'name' => 'Klien 1',
            'username' => 'test',
            'password' => bcrypt('test'),
            'role' => '2',
        ]);
    }
}
