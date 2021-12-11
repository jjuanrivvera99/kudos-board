<?php

namespace Database\Seeders;

use App\Models\BoardType;
use Illuminate\Database\Seeder;

class BoardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BoardType::create(['name' => 'Team', 'slug' => 'team']);
        BoardType::create(['name' => 'Birthday', 'slug' => 'birthday']);
        BoardType::create(['name' => 'Project', 'slug' => 'project']);
    }
}
