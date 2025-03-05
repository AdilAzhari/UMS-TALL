<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\Laravel\Facades\Image;
use Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return to_route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function updateInfo(UpdateProfileRequest $request): RedirectResponse
    {
        $request->validated();

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'middle_name' => $request->personal_details['middle_name'] ?? null,
            'last_name' => $request->personal_details['last_name'] ?? null,
            'preferred_name' => $request->personal_details['preferred_name'] ?? null,
            'date_of_birth' => isset($request->personal_details['date_of_birth'])
                ? Carbon::parse($request->personal_details['date_of_birth'])->format('Y-m-d')
                : today(),
            'gender' => $request->personal_details['gender'] ?? null,
            'nationality' => $request->personal_details['nationality'] ?? null,
        ]);

        // Handle avatars upload
        if ($request->hasFile('avatar')) {

            $avatar = Image::read($request->avatar);
            $imageName = time() . '-' . $request->file('avatar')->getClientOriginalName();
            $destinationPath = public_path('images/avatars');
            $avatar->save($destinationPath . $imageName);

            $destinationPathThumbnail = public_path('images/avatars');
            $avatar->resize(100, 100);
            $avatar->save($destinationPathThumbnail . $imageName);

            $user->update(['avatar' => $imageName]);
        }

        event(new NewNotification('Profile updated successfully'));
//       Debug: Log the event
        Log::info('NewNotification event triggered');
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
