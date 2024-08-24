<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
                  ->withRouting(
                      web: __DIR__ . '/../routes/web.php',
                      commands: __DIR__ . '/../routes/console.php',
                      health: '/up',
                  )
                  ->withMiddleware(function (Middleware $middleware) {
                      $middleware->web(append: [
                          \App\Http\Middleware\HandleInertiaRequests::class,
                          \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
                      ]);

                      $middleware->alias([
                          'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
                          'allow' => \App\Http\Middleware\Allow::class
                      ]);
                  })
                  ->withExceptions(function (Exceptions $exceptions) {
                      if (request()->expectsJson()) {
                          $exceptions->render(function (NotFoundHttpException $e) {
                              return response()->json(['error' => 'Requested resource is not found'], 404);
                          });

                          $exceptions->render(function (AuthenticationException $e) {
                              return response()->json(['error' => 'Unauthorized'], 401);
                          });
                      }

                      $exceptions->render(function (QueryException $e) {
                          if (request()->expectsJson())
                              return response()->json(['error' => 'A database error has occurred.'], 500);

                          if (config('app.debug'))
                              return back()->with('error', $e->getMessage());

                          return back()->with('error', 'A database error has occurred.');
                      });
                  })->create();
