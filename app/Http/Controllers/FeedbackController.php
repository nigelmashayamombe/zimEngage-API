<?php

namespace App\Http\Controllers;

use App\Jobs\AnalyzeFeedbackSentiment;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = Feedback::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('feedback.index', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:complaint,suggestion,inquiry,praise,other',
            'message' => 'required|string|min:10',
        ]);

        $feedback = Feedback::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        // Dispatch job to analyze sentiment
        AnalyzeFeedbackSentiment::dispatch($feedback);

        return redirect()->route('feedback.index')
            ->with('success', 'Your feedback has been submitted successfully and is being analyzed.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        $this->authorize('view', $feedback);
        
        return view('feedback.show', compact('feedback'));
    }
} 