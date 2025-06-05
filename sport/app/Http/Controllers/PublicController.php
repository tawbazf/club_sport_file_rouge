<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Coach;
use App\Models\Course;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $subscriptions = Subscription::select('type', 'price')->distinct()->get();
        $coaches = Coach::with('user')->get();
        $courses = Course::with('coach.user')->where('status', 'planned')->get();
        return view('public.home', compact('subscriptions', 'coaches', 'courses'));
    }

    public function classes()
    {
        $courses = Course::with('coach.user')->where('status', 'planned')->get();
        return view('public.classes', compact('courses'));
    }

    public function coaches()
    {
        $coaches = Coach::with('user')->get();
        return view('public.coaches', compact('coaches'));
    }

    public function schedule()
    {
        $courses = Course::with('coach.user')->where('status', 'planned')->get();
        return view('public.schedule', compact('courses'));
    }

    public function showContactForm()
    {
        return view('public.contact');
    }

    public function contact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Handle contact form submission (e.g., send email or store in database)
        return redirect()->route('public.home')->with('success', 'Message envoyé avec succès !');
    }
}