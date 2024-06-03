<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;


class AgendaController extends Controller
{
    public function __invoke()
    {
        $events = [];

        // Eager load the 'user' relationship
        $appointments = Appointment::with(['user'])->get();

        dd($appointments);
        foreach ($appointments as $appointment) {
            // Access the associated user using the 'user' relationship
            $userName = $appointment->user->name;
            
            $events[] = [
                'title' => $appointment->title . ' (' . $userName . ')',
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }

        return view('/agenda', compact('events'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'start_time' => 'required|date',
            'finish_time' => 'required|date',
            // Add validation rules for other event data fields if needed
        ]);

        $appointment = Appointment::create($validatedData);

        return response()->json($appointment, 201);
    }
}
