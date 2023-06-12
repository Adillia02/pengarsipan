<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use \App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            [
                'name' => 'Staff',
                'status' => '1',
                'created_id' => '1',
                'updated_id' => '1'
            ],
        ];

        foreach ($jabatan as $jabatan) {
            Jabatan::create($jabatan);
        }
    
        $this->command->info("Jabatan Berhasil ditambahkan");
    }
}
