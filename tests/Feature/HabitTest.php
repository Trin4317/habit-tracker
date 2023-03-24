<?php

namespace Tests\Feature;

use App\Models\Habit;
use App\Http\Resources\HabitResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class HabitTest extends TestCase
{
    use RefreshDatabase;

    public function test_habits_view_can_be_rendered(): void
    {
        $response = $this->withoutExceptionHandling()->get('/habits');

        $response->assertStatus(200);
    }

    public function test_habits_list_can_be_fetched(): void
    {
        Habit::factory(3)->create();
        $habitResource = HabitResource::collection(Habit::withCount('executions')->get());
        $request = Request::create('/api/habits', 'GET');

        $response = $this->getJson('/api/habits');

        $response->assertStatus(200)
                 ->assertJson(
                    $habitResource->response($request)->getData(true)
            );
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

    public function test_habits_can_be_deleted(): void
    {
        $habitId = Habit::factory()->create()->id;

        $response = $this->withoutExceptionHandling()->delete("/habits/{$habitId}");

        $response->assertRedirect('/habits');
        $this->assertDatabaseMissing('habits', ['id' => $habitId]);
    }

    /**
     * @dataProvider provideBadHabitData
     */
    public function test_create_habit_validation($missing, $data): void
    {
        $response = $this->post('/habits', $data);

        $response->assertSessionHasErrors([$missing]);
    }

    /**
     * @dataProvider provideBadHabitData
     */
    public function test_update_habit_validation($missing, $data): void
    {
        $habitId = Habit::factory()->create()->id;

        $response = $this->put("/habits/{$habitId}", $data);

        $response->assertSessionHasErrors([$missing]);
    }

    public function provideBadHabitData()
    {
        $habit = Habit::factory()->raw();

        return [
            'missing name' => [
                'name',
                [
                    ...$habit,
                    'name' => null,
                ]
            ],
            'missing times_per_day' => [
                'times_per_day',
                [
                    ...$habit,
                    'times_per_day' => null
                ]
            ],
        ];
    }
}
