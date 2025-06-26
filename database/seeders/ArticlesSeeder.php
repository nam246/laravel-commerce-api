<?php

namespace Database\Seeders;

use App\Models\Articles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    public function run(): void
    {
        Articles::factory(25)->create();
    }
}
