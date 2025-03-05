<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateProfilePasswordRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function show(): Response
    {
        $user = Auth::user();

        return Inertia::render('Profile/Profile', [
            'profile' => [
                'account_info' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar ? asset('public/avatar/'.$user->avatar) : null,
                    'personal_details' => [
                        'first_name' => $user->name,
                        'middle_name' => $user->middle_name,
                        'last_name' => $user->last_name,
                        'preferred_name' => $user->Preferred_name,
                        isset($request->personal_details['date_of_birth'])
                            ? Carbon::parse($request->personal_details['date_of_birth'])->format('Y-m-d')
                            : today(),
                        'gender' => $user->gender,
                        'nationality' => $user->nationality,
                    ],
                    'address' => [
                        'country' => $user->country_of_residence,
                        'city' => $user->city_of_residence,
                        'state' => $user->state,
                        'zip' => $user->zip_code,
                        'full_address' => $user->student->address ?? 'N/A',
                    ],
                    'contact' => [
                        'primary_email' => $user->email,
                        'secondary_email' => $user->secondary_email_address,
                        'phone' => $user->phone_number,
                    ],
                ],
                'program_details' => [
                    'student_id' => $user->student->student_id ?? 'N/A',
                    'status' => $user->student->status ?? 'N/A',
                    'enrollment_date' => $user->student->enrollment_date ?? 'N/A',
                    'CGPA' => $user->student->CGPA ?? 'N/A',
                ],
            ],
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return to_route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('/');
    }

    public function passwordUpdate(UpdateProfilePasswordRequest $request): RedirectResponse
    {
        $request->validated();
        if (! Hash::check($request->oldPassword, auth()->user()->password)) {
            return redirect()->back()->with('error', 'Your old password is incorrect.');
        }
        auth()->user()->update([
            'password' => Hash::make($request->newPassword),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
