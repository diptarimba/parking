<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Activity;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Feedback;
use App\Models\OptionalContent;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $feedback = Feedback::take(10)->get();
        $faq = Faq::take(5)->get();
        $about = About::take(3)->get();
        $feature = (Object) Feature::take(4)->get()->toArray();
        $optionalContent = OptionalContent::get();
        $activity = Activity::take(4)->get();
        $parkingLocation = ParkingLocation::get();
        return view('landing.index', compact('feedback', 'faq', 'about', 'feature', 'optionalContent', 'activity', 'parkingLocation'));
    }
}
