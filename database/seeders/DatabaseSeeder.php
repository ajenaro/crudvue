<?php

namespace Database\Seeders;

use App\Models\{User, Note};
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
        Note::truncate();
        User::truncate();

        User::factory()->has(Note::factory()->count(5))->create([
            'name' => 'Antonio Jenaro',
            'email' => 'antonio.jenaro@gmail.com'
        ]);

        User::factory()
            ->count(9)
            ->has(Note::factory()->count(rand(0, 6)))
            ->create();
    }
}
