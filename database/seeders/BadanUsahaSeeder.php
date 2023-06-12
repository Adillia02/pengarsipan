<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use \App\Models\BadanUsaha;

class BadanUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badanusaha = [
            [
                'name' => 'PT',
                'abbreviation' => 'Perseroan Terbatas',
                'status' => '1',
                'created_id' => '1',
                'updated_id' => '1'
            ],
            [
                'name' => 'CV',
                'abbreviation' => 'Commanditaire Vennootschap',
                'status' => '1',
                'created_id' => '1',
                'updated_id' => '1'
            ],
        ];

        foreach ($badanusaha as $badanusaha) {
            BadanUsaha::create($badanusaha);
        }
    
        $this->command->info("Badan Usaha Berhasil ditambahkan");
    }
}
