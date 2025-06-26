<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Articles;
use App\Models\Projects;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);

        DB::table('users')->insert([
            'name' => 'Seeding Test',
            'email' => 'seeding'.'@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Articles::factory(50)->create();
    }
}
