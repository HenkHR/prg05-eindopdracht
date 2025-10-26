<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        $clients = $query->get();
        $searchTerm = $request->search;

        return view('clients', compact('clients', 'searchTerm'));
    }

    public function show(User $user)
    {
        $user->load('checkIns');
        return view('clients.show', compact('user'));

    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('clients.show', $user);
    }
}
