<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Http\Requests\StoreHabitRequest;
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
}
