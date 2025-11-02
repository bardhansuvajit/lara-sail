<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\UserLoginHistoryService;

class CheckActiveSessionWeb
{
    public function __construct(private UserLoginHistoryService $loginHistoryService) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('web')->check()) {
            $user = auth()->guard('web')->user();
            $currentToken = session()->getId();

            // Check if current session is still active
            $isActive = $this->loginHistoryService->isTokenActive($currentToken);
            // dd($isActive);

            if (!$isActive) {
                // Session was logged out from another device
                auth()->guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('front.login')
                    ->with('error', 'Your session was terminated from another device.');
            }

            // Update last activity for current session
            $this->loginHistoryService->updateActivity($currentToken);
        }

        return $next($request);
    }
}
