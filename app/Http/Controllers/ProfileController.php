<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * Update the user's profile information.
     */
    public function index()
    {
        try {
            $user = auth()->user()->only(['email', 'name']);
            return view('pages.dashboard.profile', compact('user'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé avec la modification des infos");
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            return redirect()->back()->with('success','les informations ont été modifiées avec succès!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé avec la modification des infos");
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
