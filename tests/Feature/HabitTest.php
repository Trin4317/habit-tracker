<?php

namespace Tests\Feature;

use App\Models\Habit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HabitTest extends TestCase
{
    use RefreshDatabase;

    public function test_habits_view_can_be_rendered(): void
    {
        $habits = Habit::factory(3)->create();

        $response = $this->withExceptionHandling()->get('/habits');

        $response->assertStatus(200);
        $response->assertViewHas('habits', $habits);
    }
}
