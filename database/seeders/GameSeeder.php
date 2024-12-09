<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use Carbon\Carbon;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_timestamp = Carbon::now();
        Game::insert([
            ['developer_id' => 1, 'title' => 'Silent Hill 2', 'description' => 'spooky foggy town ', 'image' => 'silent_hill_2_cover.jpg', 'age_restriction' => 18, 'release_date' => '2024-09-09', 'created_at'=> $current_timestamp, 'updated_at' => $current_timestamp],
            ['developer_id' => 2, 'title' => 'Skyrim', 'description' => 'RPG with dragons and stuff', 'image' => 'skyrim_cover.jpg', 'age_restriction' => 16, 'release_date' => '2011-06-23', 'created_at'=> $current_timestamp, 'updated_at' => $current_timestamp],
            ['developer_id' => 3, 'title' => 'Call of Duty: Modern Warfare', 'description' => 'Shooty game in the middle east', 'image' => 'modern_warfare_cover.jpg', 'age_restriction' => 18, 'release_date' => '2024-10-13', 'created_at'=> $current_timestamp, 'updated_at' => $current_timestamp],
            ['developer_id' => 4, 'title' => 'Fallout 4', 'description' => 'Post apocalyptic RPG', 'image' => 'fallout_4_cover.jpg', 'age_restriction' => 16, 'release_date' => '2012-11-12', 'created_at'=> $current_timestamp, 'updated_at' => $current_timestamp],
            ['developer_id' => 5, 'title' => 'Call of Duty: Modern Warfare 2', 'description' => 'Shooty game in russia', 'image' => 'modern_warfare_2_cover.jpg', 'age_restriction' => 18, 'release_date' => '2024-11-02', 'created_at'=> $current_timestamp, 'updated_at' => $current_timestamp]
        ]);
    }
}
