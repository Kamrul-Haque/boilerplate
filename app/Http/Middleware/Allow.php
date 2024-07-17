<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class Allow
{
    /**
     * Permits a user with the given or higher role
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @param string ...$roleNames
     * @return Response
     * @throws Exception
     */
    public function handle(Request $request, Closure $next, string ...$roleNames): Response
    {
        foreach ($roleNames as $roleName) {
            $roleCase = Str::upper($roleName);

            if (!in_array($roleCase, Role::names()))
                throw new Exception('Invalid Role');

            $role = Role::{$roleCase}->value;

            if (auth()->user()->hasRole($role))
                return $next($request);
        }

        abort(403, 'You are not authorized');
    }
}
