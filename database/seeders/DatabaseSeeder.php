<?php

namespace Database\Seeders;

use App\Models\JadwalAula;
use App\Models\Klien;
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
            'id' => 17123906614959,
            'name' => 'Klien 1',
            'username' => 'test',
            'password' => bcrypt('test'),
            'role' => '2',
        ]);

        Klien::create([
            'id' => intval((microtime(true) * 10000)),
            'user_id' => 17123906614959,
            'nama_klien' => 'test',
            'nip' => 'test',
            'jabatan' => 'test',
            'email' => 'test',
            'alamat' => 'test',
            'alamat_kantor' => 'test',
            'no_telepon' => "084755432987",
        ]);

        JadwalAula::create([
            'id' => intval((microtime(true) * 12000)),
            'nama_sesi' => "Sesi 1",
            'sesi_awal' => "08:00:00",
            'sesi_akhir' => "12:00:00",
            'status' => "aktif",
        ]);

        JadwalAula::create([
            'id' => intval((microtime(true) * 12000)),
            'nama_sesi' => "Sesi 2",
            'sesi_awal' => "13:00:00",
            'sesi_akhir' => "16:00:00",
            'status' => "aktif",
        ]);
        JadwalAula::create([
            'id' => intval((microtime(true) * 12000)),
            'nama_sesi' => "1 hari",
            'sesi_awal' => "08:00:00",
            'sesi_akhir' => "16:00:00",
            'status' => "aktif",
        ]);
    }
}
