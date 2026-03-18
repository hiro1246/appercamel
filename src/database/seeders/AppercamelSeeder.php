<?php

namespace Database\Seeders;

use App\Models\appercamel;
use Illuminate\Database\Seeder;

class AppercamelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        appercamel::factory()->count(35)->create();
    }
}
