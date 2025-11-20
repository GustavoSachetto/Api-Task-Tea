<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TaskUser;
use Illuminate\Http\Request;
use App\Models\AdvancedAccess;
use App\Jobs\ProcessSubmitEmail;
use App\Models\UserRelationships;
use App\Http\Requests\UserRequest;
use App\Utils\Base64ImageConverter;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserImageRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\RelationshipResource;
use App\Http\Requests\UserResponsibleRequest;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserController extends Controller
{
    /**
     * Display the authenticated user.
     */
    public function index()
    {
        $key = "user_".Auth::user()->id."route";

        return $this->cached($key, new UserResource(Auth::user()));
    }

    /**
     * Display all the user relationships.
    */
    public function myRelationship()
    {
        $user = User::findOrFail(Auth::user()->id);

        if($user->hasRole('responsible'))
            $relationships = UserRelationships::with('userRelated')
                ->where('user_relationships.user_id', Auth::user()->id)->get();

        if($user->hasRole('child'))
            $relationships = UserRelationships::with('user')
                ->where('user_relationships.user_related_id', Auth::user()->id)->get();

        $key = "user_relationship_".Auth::user()->id."route";

        return $this->cached($key, RelationshipResource::collection($relationships));
    }

    /**
     * Store a newly created user with child role in storage.
     */
    public function storeChild(UserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->input('password'))]);

        $user = User::create($request->only(['name', 'email', 'nickname', 'birthdate', 'password']))->assignRole('child');

        // ProcessSubmitEmail::dispatchAfterResponse($user);

        $this->assignTasks($user);

        return (new UserResource($user))->additional([
            'message' => 'Conta criada com sucesso! Logue para ter acesso.'
        ]);
    }

    /**
     * Store a newly created user with responsible role in storage.
     */
    public function storeResponsible(UserResponsibleRequest $request)
    {
        $request->merge(['password' => Hash::make($request->input('password'))]);

        $user = User::create($request->only(['name', 'email', 'nickname', 'birthdate', 'password']))->assignRole('responsible');
        $request->merge(['user_id' => $user->id]);

        AdvancedAccess::create($request->only(['phone_number', 'user_id']));

        // ProcessSubmitEmail::dispatchAfterResponse($user);

        return (new UserResource($user))->additional([
            'message' => 'Conta criada com sucesso! Logue para ter acesso.'
        ]);
    }

    /**
     * Store a newly created user image in storage.
    */
    public function storeImage(UserImageRequest $request)
    {
        $request->validated();

        $user = User::findOrFail(Auth::user()->id);

        $data = $request->only('image');
        $image = new Base64ImageConverter($data['image']);

        $imagePath = Storage::putFile('images/users/profiles', $image->tempName);
        $imageUrl = asset('storage/' . $imagePath);

        $user->update(['image' => $imageUrl]);

        return ['message' => 'Imagem salva com sucesso.', 'image_path' => $imageUrl];
    }

    /**
     * Store a newly created user banner in storage.
    */
    public function storeBanner(UserImageRequest $request)
    {
        $request->validated();

        $user = User::findOrFail(Auth::user()->id);

        $data = $request->only('image');
        $image = new Base64ImageConverter($data['image']);

        $imagePath = Storage::putFile('images/users/banners', $image->tempName);
        $imageUrl = asset('storage/' . $imagePath);

        $user->update(['banner' => $imageUrl]);

        return ['message' => 'Banner salvo com sucesso.', 'image_path' => $imageUrl];
    }

    /**
     * Update the authenticated user in storage.
     */
    public function update(UserUpdateRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if ($request->filled('new_password')) {

            if ($request->new_password == $request->current_password)
                throw new BadRequestHttpException('A nova senha não pode ser igual a atual.');

            if (!Hash::check($request->current_password, $user->password))
                throw new BadRequestHttpException('Senha inválida ou nenhuma senha inserida.');

            $request->merge(['password'  => Hash::make($request->input('new_password'))]);
        }

        if ($user->hasRole('responsible') && $request->has('phone_number')) {
            $advancedAccess = AdvancedAccess::where('user_id', $user->id);
            $advancedAccess->update($request->only(['phone_number']));
        }

        $request->merge([
           'nickname'  => $request->has('nickname') ? $request->nickname : $user->nickname,
           'birthdate' => $request->has('birthdate') ? $request->birthdate : $user->birthdate
        ]);

        $user->update($request->only(['name', 'email', 'password', 'nickname', 'birthdate']));

        return (new UserResource($user))->additional([
            'message' => 'Dados atualizados com sucesso.'
        ]);
    }

    /**
     * Remove the authenticated user and their access token from storage.
     */
    public function destroy(Request $request)
    {
        User::findOrFail(Auth::user()->id)->delete();

        $request->user()->currentAccessToken()->delete();

        return ['success' => 'Conta apagada com sucesso.'];
    }

    /**
     * Assigns 8 tasks to the newly created user.
     */
    private function assignTasks(User $user)
    {
        for ($i=1; $i < 8; $i++) {
            TaskUser::create([
                'user_assigner_id' => 1,
                'user_receiver_id' => $user->id,
                'tasks_id'         => $i
            ]);
        }
    }
}
