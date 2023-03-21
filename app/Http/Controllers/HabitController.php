<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;
use App\Http\Requests\StoreHabitRequest;

class HabitController extends Controller
{
    public function index()
    {
        $habits = Habit::all();

        return view('habits.index', compact('habits'));
    }

    public function store(StoreHabitRequest $request)
    {
        Habit::create([
            'name' => $request->input('name'),
            'times_per_day' => $request->input('times_per_day')
        ]);

        return to_route('habits.index');
    }

    public function update(Request $request, Habit $habit)
    {
        $habit->update([
            'name' => $request->input('name'),
            'times_per_day' => $request->input('times_per_day')
        ]);

        return to_route('habits.index');
    }
}
