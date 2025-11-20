<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthController extends Controller
{
    /**
     * Create user login token in storage.
     */
    public function login(AuthRequest $request)
    {
        if (!$request->has('email') && !$request->has('nickname'))
            throw new BadRequestHttpException('Insira o email ou o apelido para entrar.');

        $user = $request->has('email')
            ? User::where('email', $request->email)->first()
            : User::where('nickname', $request->nickname)->first();

        if (!Hash::check($request->password, $user->password))
            throw new UnauthorizedException('Usuário não autorizado, email ou senha inválidos');

        Auth::login($user, true);

        $token = $request->user()->createToken('invoice');

        return [
            'message' => 'Usuário autenticado com sucesso.',
            'token'   => $token->plainTextToken
        ];
    }

    /**
     * Rovoking user login token in storage.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ['message' => 'Token removido com sucesso.'];
    }
}
