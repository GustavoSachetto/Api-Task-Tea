<?php

use Illuminate\Http\Request;
use App\Exceptions\IntegrityException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\UnauthorizedException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api:__DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (BadRequestHttpException $e, Request $request) {
            if ($request->is('api/*')) 
                return response()->json(["message" => 'Solicitação mal enviada', "errors" => $e->getMessage()], 400);
        });

        $exceptions->render(function (UnauthorizedException $e, Request $request) {
            if ($request->is('api/*')) 
                return response()->json(["message" => 'Não autorizado', "errors" => $e->getMessage()], 401);
        });

        $exceptions->render(function (ForbiddenException $e, Request $request) {
            if ($request->is('api/*')) 
                return response()->json(["message" => 'Acesso negado', "errors" => $e->getMessage()], 403);
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) 
                return response()->json(["message" => 'Url não encontrada', "errors" => $e->getMessage()], 404);
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) 
                return response()->json(["message" => 'Método não permitido', "errors" => $e->getMessage()], 405);
        });

        $exceptions->render(function (IntegrityException $e, Request $request) {
            if ($request->is('api/*')) 
                return response()->json(["message" => 'Restrição de integridade foi violada.', "errors" => $e->getMessage()], 409);
        });
    })->create();
