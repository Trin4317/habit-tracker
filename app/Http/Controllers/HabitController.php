<?php

namespace App\Http\Controllers;

use App\Models\Habit;

class HabitController extends Controller
{
    public function index()
    {
        $habits = Habit::all();

        return view('habits.index', compact('habits'));
    }
}
