<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckInController extends Controller
{
    public function index()
    {
        $checkIns = CheckIn::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('feedback', compact('checkIns'));
    }

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


    public function show(CheckIn $checkIn)
    {
        if ($checkIn->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }
        
        return view('checkin.show', compact('checkIn'));
    }

    public function addComment(Request $request, CheckIn $checkIn)
    {
        if(!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'coach_comment' => 'required|string|max:1000'
        ]);

        $checkIn->update([
            'coach_comment' => $validated['coach_comment']
        ]);

        return redirect()->route('checkin.show', $checkIn)->with('success', 'Comment added successfully!');
    }

    public function todayCheckIns()
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $checkIns = CheckIn::whereDate('created_at', today())
            ->with('user') 
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('checkin.today', compact('checkIns'));
    }

    public function weeklyReport()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        
        $checkIns = CheckIn::where('user_id', Auth::id())
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'asc')
            ->get();
        
        $averages = [
            'weight' => $checkIns->avg('weight'),
            'sleep_quality' => $checkIns->avg('sleep_quality'),
            'training_quality' => $checkIns->avg('training_quality'),
            'soreness' => $checkIns->avg('soreness'),
            'food_quality' => $checkIns->avg('food_quality'),
        ];
        
        return view('checkin.weekly', compact('checkIns', 'averages', 'startOfWeek', 'endOfWeek'));
    }

}