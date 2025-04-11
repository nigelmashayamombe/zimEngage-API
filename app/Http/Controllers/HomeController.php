<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Get some statistics for the home page
        $stats = [
            'total_feedback' => Feedback::count(),
            'positive_sentiment' => Feedback::where('sentiment_label', 'POSITIVE')->count(),
            'negative_sentiment' => Feedback::where('sentiment_label', 'NEGATIVE')->count(),
            'resolved_issues' => Feedback::where('status', 'resolved')->count(),
        ];
        
        return view('home', compact('stats'));
    }
} 