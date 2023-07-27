<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function edit($id)
    {
        $participant = User::findOrFail($id);
        return view('home', compact('user'));
    }
    
    
    public function updateFirstName(Request $request, $id)
    {
        $participant = User::findOrFail($id);
        $participant->update(['first_name' => $request->first_name]);
    
        return redirect()->route('home')->with('status', 'Imię zostało zaktualizowane.');
    }
    
    public function updateLastName(Request $request, $id)
    {
        $participant = User::findOrFail($id);
        $participant->update(['last_name' => $request->last_name]);
    
        return redirect()->route('home')->with('status', 'Nazwisko zostało zaktualizowane.');
    }
    
}
