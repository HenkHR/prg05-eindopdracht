<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index( Request $request)
    {
        $query = User::where('is_admin', false);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }
        if ($request->has('filter') && $request->filter) {
            $today = Carbon::today();

            switch ($request->filter) {
                case 'checked_in_today':
                    $query->whereHas('checkIns', function($q) use ($today) {
                        $q->whereDate('created_at', $today);
                    });
                    break;

                case 'not_checked_in_today':
                    $query->whereDoesntHave('checkIns', function($q) use ($today) {
                        $q->whereDate('created_at', $today);
                    });
                    break;

                case 'checked_in_this_week':
                    $weekStart = Carbon::now()->startOfWeek();
                    $query->whereHas('checkIns', function($q) use ($weekStart) {
                        $q->where('created_at', '>=', $weekStart);
                    });
                    break;

                case 'has_img_today':
                    $today = Carbon::today();
                    $query->whereHas('checkIns', function ($q) use ($today){
                       $q->whereDate('created_at', $today)->whereNotNull('image_path');
                    });
                    break;
            }
        }
        $clients = $query->get();
        $searchTerm = $request->search;
        $selectedFilter = $request->filter;

        return view('clients', compact('clients', 'searchTerm', 'selectedFilter'));
    }

    public function show(User $user)
    {
        if(!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }
        $user->load('checkIns');
        return view('clients.show', compact('user'));

    }

    public function update(Request $request, User $user)
    {
        if(!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->update($validated);
        return redirect()->route('clients.show', $user);
    }
}
