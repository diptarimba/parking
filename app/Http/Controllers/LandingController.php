<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Feedback;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $feedback = Feedback::take(10)->get();
        $faq = Faq::take(5)->get();
        $about = About::take(3)->get();
        $feature = (Object) Feature::take(3)->get()->toArray();
        // dd($feature);
        return view('landing.index', compact('feedback', 'faq', 'about', 'feature'));
    }
}
