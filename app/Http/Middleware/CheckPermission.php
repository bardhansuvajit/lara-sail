<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!canAccess($permission)) {
            // abort(403, 'Unauthorized action.');
            // Redirect to custom 403 page
            return redirect()->route('admin.unauthorized')->with([
                'message' => 'You do not have permission to access this page.',
                'permission' => $permission,
                'intended_url' => $request->fullUrl()
            ]);
        }

        return $next($request);
    }
}