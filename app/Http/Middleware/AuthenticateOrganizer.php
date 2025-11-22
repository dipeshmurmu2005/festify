<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Enums\UserTypeEnum;
use App\Models\UserRole as ModelsUserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateOrganizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user) {
            $is_event_manager = ModelsUserRole::where('user_id', $user->id)->where('role', UserRole::EventManager->value)->first();
            if ($is_event_manager) {
                return $next($request);
            }
        }
        return redirect()->route('register');
    }
}
