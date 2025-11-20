<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\ValidatorCPF\CPF;
use App\Models\UserRelationships;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\IntegrityException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class Controller
{
    /** 
     * Check if the id is of numberic type.
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
    */
    protected function checkId(string|int $id): void
    {
        if (!is_numeric($id)) 
            throw new BadRequestHttpException('O id deve ser do tipo númerico.');
    }

    /** 
     * Check if the CPF is valid.
     * 
     * @throws \App\Exceptions\IntegrityException
    */
    protected function checkCPF(string $cpf): void
    {
        $document = new CPF($cpf);

        if (!$document->isValid()) 
            throw new IntegrityException("CPF inválido.");
    }

    /**
     * Return the content within Cache::remember for 10 seconds.
     */
    protected function cached(string $key, mixed $content): mixed
    {
        return Cache::remember($key, 10, function() use ($content) {

            return $content;
        });
    }

    /**
     * Check if the user relationship does not exist.
     *
     * @throws \App\Exceptions\Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    protected function checkUserIsNotRelated(string|int $userId): void
    {
        $this->checkId($userId);
        $user = User::findOrFail($userId);

        $userRelationship = $user->hasRole('responsible') 
            ? UserRelationships::where('user_id', $user->id)->first()
            : UserRelationships::where('user_related_id', $user->id)->first();

        if($userRelationship) throw new BadRequestHttpException("Esse usuário já está relacionado.");  
    }
}
