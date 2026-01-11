<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            TradisiSeeder::class,
            PeraturanSeeder::class,
            WisataSeeder::class,
            KulinerSeeder::class,
        ]);
    }
}
