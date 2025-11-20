<?php

namespace App\Http\Controllers;

use App\Models\UserRelationships;
use App\Tokens\RelationshipToken;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRelationshipRequest;

class UserRelationshipController extends Controller
{
    /** 
     * Create a token for relationship.
    */
    public function createToken()
    {
        $this->checkUserIsNotRelated(Auth::user()->id);

        $userRelationshipToken = RelationshipToken::generate(Auth::user()->id);

        return [
            'token'      => $userRelationshipToken->token,
            'message'    => 'Token criado com sucesso!',
            'expires_at' => $userRelationshipToken->expires_at
        ];
    }

    /** 
     * Store a newly created relationship between users.
    */
    public function storeRelationship(UserRelationshipRequest $request)
    {
        $token = $request->input('token');   

        $user_id = RelationshipToken::validate($token);

        $this->checkUserIsNotRelated($user_id);
        
        UserRelationships::create([
            "user_id" => Auth::user()->id,
            "user_related_id" => $user_id
        ]);

        return ["message" => "Usuário relacionado com sucesso."];
    }

    /**
     * Remove the specified relationship in storage.
     */
    public function destroy(string $id)
    {
        $this->checkId($id);

        $userRelationship = UserRelationships::where('user_related_id', $id)
            ->where('user_id', Auth::user()->id)->firstOrFail();    
        
        $userRelationship->delete();

        return ['message' => 'Relacionamento deletado com sucesso.'];
    }

    /**
     * Remove the relationship in storage.
     */
    public function myDestroy()
    {
        $userRelationship = UserRelationships::where('user_related_id', Auth::user()->id);
        $userRelationship->delete();

        return ['message' => 'Relacionamento deletado com sucesso.'];
    }
}
