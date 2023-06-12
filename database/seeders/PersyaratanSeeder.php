<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use \App\Models\Persyaratan;

class PersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persyaratan = [
            [
                'deed_type_id' => '1',
                'name' => 'KTP',
                'status' => '1',
                'status_personal' => false,
                'created_id' => '1',
                'updated_id' => '1'
            ],
        ];

        foreach ($persyaratan as $syarat) {
            Persyaratan::create($syarat);
        }

        $this->command->info("Persyaratan Berhasil ditambahkan");
    }
}
