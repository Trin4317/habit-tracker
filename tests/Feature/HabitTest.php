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

        $response = $this->withoutExceptionHandling()->get('/habits');

        $response->assertStatus(200);
        $response->assertViewHas('habits', $habits);
    }

    public function test_habits_can_be_created(): void
    {
        $habit = Habit::factory()->raw();

        $response = $this->withoutExceptionHandling()->post('/habits', $habit);

        $response->assertRedirect('/habits');
        $this->assertDatabaseHas('habits', $habit);
    }

    public function test_habits_can_be_updated(): void
    {
        $habit = Habit::factory()->create();
        $updatedHabit = [
            'name' => '::updated_habit::',
            'times_per_day' => 10
        ];

        $response = $this->withoutExceptionHandling()->put("/habits/{$habit->id}", $updatedHabit);

        $response->assertRedirect('/habits');
        $this->assertDatabaseHas('habits', ['id' => $habit->id, ...$updatedHabit]);
    }

    public function test_habits_can_not_be_created_without_name(): void
    {
        $habit = Habit::factory()->raw([
            'name' => null
        ]);

        $response = $this->post('/habits', $habit);

        $response->assertSessionHasErrors(['name']);
    }
}
