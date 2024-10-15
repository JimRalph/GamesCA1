<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Games;
use Carbon\Carbon;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Games::insert([
            ['developer_id' => '1', 'title' => 'Silent Hill 2', 'description' => 'spooky foggy town ', 'age_restriction' => '18', 'release_date' => '2024-09-09', ]
        ]);
    }
}
