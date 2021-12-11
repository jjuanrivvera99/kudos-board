<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\BoardType;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $birhtday = BoardType::where('slug', 'birthday')->first();
        $project = BoardType::where('slug', 'project')->first();
        $team = BoardType::where('slug', 'team')->first();

        // Board::create([
        //     'name' => 'Admin\'s birthday',
        //     'description' => 'This board is to give kudos to Admin for his birthday',
        //     'board_type_id' => $birhtday->id,
        //     'user_id' => 1,
        // ]);

        Board::create([
            'name' => 'Marketing Team',
            'description' => 'This board is to give kudos to Marketing Team',
            'board_type_id' => $team->id,
        ]);

        Board::create([
            'name' => 'Pegasus',
            'description' => 'This board is to give kudos to Pegasus Project',
            'board_type_id' => $project->id,
        ]);

        Board::create([
            'name' => 'StarLink',
            'description' => 'This board is to give kudos to StarLink Project',
            'board_type_id' => $project->id,
        ]);

        Board::create([
            'name' => 'Kimera',
            'description' => 'This board is to give kudos to Kimera Project',
            'board_type_id' => $project->id,
        ]);

        Board::create([
            'name' => 'Umbrella',
            'description' => 'This board is to give kudos to Umbrella Project',
            'board_type_id' => $project->id,
        ]);

        Board::create([
            'name' => 'Showcase',
            'description' => 'This board is to give kudos to Showcase Project',
            'board_type_id' => $project->id,
        ]);
    }
}
