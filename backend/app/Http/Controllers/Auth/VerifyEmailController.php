<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Laravel\Fortify\Fortify;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{

    public function verify($id)
    {
        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));

            return request()->wantsJson()
                ? new JsonResponse([], 204)
                : redirect(url(env('SPA_URL')) . '/?verified=1');
        }

        return request()->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(url(env('SPA_URL')) . '/?verified=1');
    }

    public function resend()
    {
        request()->user()->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Verification email sent.',
        ]);
    }
}
