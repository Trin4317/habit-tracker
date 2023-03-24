<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Http\Resources\HabitResource;
use Illuminate\Http\Request;

class HabitApiController extends Controller
{
    public function index()
    {
        return HabitResource::collection(Habit::withCount('executions')->get());
    }
}
