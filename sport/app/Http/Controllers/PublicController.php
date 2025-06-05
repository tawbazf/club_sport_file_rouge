<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Coach;
use App\Models\Contact;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function services()
    {
        $subscriptions = Subscription::select('type', 'price')->distinct()->get();
        $coaches = Coach::with('user')->get();
        $courses = Course::with('coach.user')->where('status', 'planned')->get();
        return response()->json([
            'subscriptions' => $subscriptions,
            'coaches' => $coaches,
            'courses' => $courses,
        ]);
    }

    public function schedule()
    {
        $courses = Course::with('coach.user')
            ->where('status', 'planned')
            ->orderBy('start_time')
            ->get();
        return response()->json($courses);
    }

    public function contact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($data);
        return response()->json(['message' => 'Message envoyé', 'contact' => $contact], 201);
    }
}