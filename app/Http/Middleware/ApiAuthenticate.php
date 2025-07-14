<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserLoginHistory;
use Illuminate\Support\Facades\Hash;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'code' => 401,
                'message' => 'No token provided'
            ], 401);
        }

        // return response()->json([
        //     'token' => $token
        // ], 200);

        // Get all active tokens from the database
        $userHistories = UserLoginHistory::where('is_active', 1)->get();

        // Check each token to find a match
        $validHistory = null;
        foreach ($userHistories as $history) {
            if (Hash::check($token, $history->token)) {
                $validHistory = $history;
                break;
            }
        }

        if (!$validHistory) {
            return response()->json([
                'code' => 401,
                'message' => 'Invalid token'
            ], 401);
        }

        // Check if token is expired
        if ($validHistory->expires_at && $validHistory->expires_at->isPast()) {
            return response()->json([
                'code' => 401,
                'message' => 'Token expired'
            ], 401);
        }

        // return response()->json([
        //     'histories' => $userHistories
        // ], 200);

        // foreach($userHistories as $userHistory) {
        //     if (Hash) {
        //         # code...
        //     }
        // }

        // Attach the authenticated user to the request
        $request->merge(['user_id' => $validHistory->user_id]);
        // auth()->login($validHistory->user);

        return $next($request);
    }
}
