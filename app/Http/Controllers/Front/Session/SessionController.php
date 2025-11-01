<?php

namespace App\Http\Controllers\Front\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\UserLoginHistoryService;

class SessionController extends Controller
{
    private UserLoginHistoryService $userLoginHistoryService;

    public function __construct(UserLoginHistoryService $userLoginHistoryService)
    {
        $this->userLoginHistoryService = $userLoginHistoryService;
    }

    /**
     * Display user's active sessions
     */
    public function index(Request $request): View
    {
        $user = auth()->guard('web')->user();
        $activeSessions = $this->userLoginHistoryService->getActiveSessions($user->id);
        $recentSessions = $this->userLoginHistoryService->getRecentSessions($user->id, 30);

        return view('front.account.session.index', [
            'user' => $user,
            'activeSessions' => $activeSessions,
            'recentSessions' => $recentSessions,
        ]);
    }

    /**
     * Logout from a specific session
     */
    public function logoutSession(Request $request, $sessionId)
    {
        try {
            $user = auth()->guard('web')->user();
            $session = $this->userLoginHistoryService->getSessionByToken($sessionId);

            if (!$session || $session->user_id !== $user->id) {
                return redirect()->back()->with('error', 'Session not found.');
            }

            $this->userLoginHistoryService->logoutSession($sessionId, 'user_manual');

            // If logging out current session, redirect to login
            // if ($sessionId === session()->getId()) {
            //     auth()->guard('web')->logout();
            //     $request->session()->invalidate();
            //     $request->session()->regenerateToken();

            //     return redirect()->route('front.auth.login')->with('success', 'You have been logged out from this device.');
            // }

            return redirect()->back()->with('success', 'Session logged out successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to logout from session.');
        }
    }

    /**
     * Logout from all sessions except current
     */
    public function logoutAllSessions(Request $request)
    {
        try {
            $user = auth()->guard('web')->user();
            $currentSessionToken = session()->getId();

            // Logout all sessions except current
            $activeSessions = $this->userLoginHistoryService->getActiveSessions($user->id);

            // dd($currentSessionToken, $activeSessions);

            foreach ($activeSessions as $session) {
                if ($session->token !== $currentSessionToken) {
                    $this->userLoginHistoryService->logoutSession($session->token, 'user_manual_all');
                }
            }

            return redirect()->back()->with('success', 'Logged out from all other devices.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to logout from all sessions.');
        }
    }
}
