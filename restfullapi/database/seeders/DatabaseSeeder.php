<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Status;
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
    	
    	User::truncate();
    	Status::truncate();
    	
    	User::factory(40)
        ->create();

        Status::factory(40)
        ->create();
    }
}