<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $users = User::factory()
            ->count(4)
            ->has(Note::factory()->count(3))
            ->create();

        $users->each(function ($user) {
           dump($user->notes->toArray());
        });
    }
}
