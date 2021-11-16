<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;

class ScheduleController extends Controller
{
    public function index () {
        $data = Schedule::paginate(15);

        return response()->json([ScheduleResource::collection($data), 'Agendamentos Recuperados']);
    }
}
