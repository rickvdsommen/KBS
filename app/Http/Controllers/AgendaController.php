<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Throwable;

class AgendaController extends Controller
{
    public function index()
    {
        return view('agenda');
    }

    public function getEvents(Request $request)
    {
        // Eager load the 'user' relationship
        $appointments = Appointment::whereDate('start', '>=', $request->start)->whereDate('end', '<=', $request->end)->get();
        $events = array();

        foreach ($appointments as $appointment) {            
            $obj = [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'start' => $appointment->start,
                'end' => $appointment->end,
                'allDay' => (bool) $appointment->all_day,
                'description' => $appointment->description,
            ];

            array_push($events, $obj);
        }

        return response()->json($events);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string',
                'start' => 'string',
                'end' => 'nullable|string',
                'all_day' => 'required|boolean',
                'description' => 'nullable|string',
                // Add validation rules for other event data fields if needed
            ]);

            $appointment = Appointment::create($validatedData);
                       
            return response()->json(status: 200, data: $appointment);

        } catch (Throwable $e) {
            return response()->json($e);
        }
    }

    public function patch(Request $request) {
        try {

            $validatedData = $request->validate([
                'id' => 'required',
                'title' => 'required|string',
                'start' => 'date',
                'end' => 'date',
                'all_day' => 'required|boolean',
                'description' => 'string',
            ]);
            
            $appointment = Appointment::find($request->id);
            
            // $appointment->title = $validatedData['title'];
            $appointment->start = $validatedData['start'];
            $appointment->end =  $validatedData['end'];
            $appointment->all_day =  $validatedData['all_day'];
            $appointment->save();

            return response(status: 200);

        } catch (Throwable $e) {
            return response()->json($e);
        }
    }

    public function destroy(Request $request)
    {
        $event = Appointment::findOrFail($request->id);
        $event->delete();
        
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
