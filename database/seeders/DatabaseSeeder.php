<?php

namespace Database\Seeders;

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
        $this->call(JenisAktaSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(BadanUsahaSeeder::class);
        $this->call(PersyaratanSeeder::class);
        $this->call(AktaSeeder::class);
    }
}
