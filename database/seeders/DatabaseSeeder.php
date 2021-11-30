<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Movie::unguard();
        $this->call(MoviesTableSeeder::class);
        Movie::reguard();
        
        // \App\Models\User::factory(10)->create();
    }
}
