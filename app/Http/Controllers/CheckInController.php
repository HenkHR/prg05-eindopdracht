<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckInController extends Controller
{

    public function create()
    {
        return view('checkin');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:30|max:300',
            'sleep_quality' => 'required|integer|min:1|max:10',
            'training_quality' => 'required|integer|min:1|max:10',
            'soreness' => 'required|integer|min:1|max:10',
            'food_quality' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('checkin-images', 'public');
        }

        CheckIn::create([
            'user_id' => Auth::id(),
            'weight' => $validated['weight'],
            'sleep_quality' => $validated['sleep_quality'],
            'training_quality' => $validated['training_quality'],
            'soreness' => $validated['soreness'],
            'food_quality' => $validated['food_quality'],
            'comment' => $validated['comment'],
            'image_path' => $imagePath
        ]);

        return redirect()->route('checkin')->with('success', 'Check-in submitted successfully!');
    }

public function index()
{
    $checkIns = CheckIn::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('feedback', compact('checkIns'));
}

public function show(CheckIn $checkIn)
{
    if ($checkIn->user_id !== Auth::id() && !Auth::user()->is_admin) {
        abort(403);
    }
    
    return view('checkin.show', compact('checkIn'));
}
}