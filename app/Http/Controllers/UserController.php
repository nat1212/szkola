<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('home', compact('user'));
    }
    
    
    public function updateProfile(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
       
    ]);

    if ($validator->fails()) {
        return redirect('/home')->with('error', 'Wystąpił błąd walidacji danych.');

    }

    $dataToUpdate = [];
    if (!empty($request->first_name)) {
        $dataToUpdate['first_name'] = $request->first_name;
    }

    if (!empty($request->last_name)) {
        $dataToUpdate['last_name'] = $request->last_name;
    }
    
    if (!empty($request->email)) {
        $newEmail = $request->email;
        if ($newEmail != $user->email) {
            // Sprawdzanie unikalności adresu e-mail
            $existingParticipant = User::where('email', $newEmail)->first();
            if ($existingParticipant) {
                return redirect()->back()->with('error', 'Email już jest zajęty.');
            } else {
                $dataToUpdate['email'] = $newEmail;
                $dataToUpdate['email_verified_at'] = null;
                $dataToUpdate['email_number'] = 2;
                $user->update($dataToUpdate);
                $user->sendEmailVerificationNotification($newEmail);
            }
        }
    }

   
    $user->update($dataToUpdate);

    
    return redirect('/home')->with('success', 'Profil został zaktualizowany.');
}
    
}
