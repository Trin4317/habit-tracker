<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Http\Resources\HabitResource;
use Illuminate\Http\Request;

class HabitApiController extends Controller
{
    public function index()
    {
        return HabitResource::collection(Habit::withCount('executions')->get());
    }

    public function store(StoreHabitRequest $request)
    {
        Habit::create([
            'name' => $request->input('name'),
            'times_per_day' => $request->input('times_per_day')
        ]);

        return HabitResource::collection(Habit::withCount('executions')->get());
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $habit->update([
            'name' => $request->input('name'),
            'times_per_day' => $request->input('times_per_day')
        ]);

        return HabitResource::collection(Habit::withCount('executions')->get());
    }

    public function destroy(Request $request, Habit $habit)
    {
        $habit->delete();

        return HabitResource::collection(Habit::withCount('executions')->get());
    }

    public function execute(Request $request, Habit $habit)
    {
        $habit->executions()->create();
    }
}
