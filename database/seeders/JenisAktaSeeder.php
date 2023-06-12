<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use \App\Models\JenisAkta;

class JenisAktaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisakta = [
            [
                'name' => 'Pendirian',
                'status' => '1',
                'created_id' => '1',
                'updated_id' => '1'
            ],
        ];

        foreach ($jenisakta as $jenis) {
            JenisAkta::create($jenis);
        }
    
        $this->command->info("Kategori Berhasil ditambahkan");
    }
}
