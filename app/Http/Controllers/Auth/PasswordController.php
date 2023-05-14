<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
    
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
    
            return redirect()->back()->with('success', 'le mot de pass a été changé!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé avec le changement de mot de pass!");
        }
        
    }
}
