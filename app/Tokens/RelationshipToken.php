<?php

namespace App\Tokens;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\UserRelationshipToken;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RelationshipToken
{
    /**
     * Validates the token and returns the user_id.
     */
    public static function validate(string $token): int
    {
        $userRelationshipToken = UserRelationshipToken::where('token', $token)->first();

        if (!$userRelationshipToken) 
            throw new BadRequestHttpException('Token inválido.');
        
        if (Carbon::parse($userRelationshipToken->expires_at)->isPast()) 
            throw new BadRequestHttpException('Token expirado.');
    
        return $userRelationshipToken->user_id;
    }
    
    /**
     * Generate or create a new token for user_id.
     */
    public static function generate(int $userId): UserRelationshipToken
    {
        $userRelationshipToken = UserRelationshipToken::where('user_id', $userId)->latest()->first();
        
        if (is_null($userRelationshipToken))
            return self::create($userId);

        if (Carbon::parse($userRelationshipToken->expires_at)->isPast()) 
            return self::create($userId);

        return $userRelationshipToken;
    }

    /**
     * Create a new token for user_id.
     */
    private static function create(string $userId): UserRelationshipToken
    {
        $token = Str::random(6);   
        $currentDate = Carbon::now();  

        return UserRelationshipToken::create([
            'user_id'    => $userId,
            'token'      => $token,
            'expires_at' => $currentDate->addMinutes(10),
            'created_at' => $currentDate,
            'updated_at' => $currentDate,
        ]);
    }
}
