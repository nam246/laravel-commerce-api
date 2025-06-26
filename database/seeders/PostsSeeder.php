<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    public function run(): void
    {
        Posts::factory(25)->create();
    }
}
