<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $query = User::query();

        if (!empty(request()->input('type'))) {
            $query->where('type', request()->input('type'));
        }

        return $query->get();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(UserStoreRequest $request)
    {
        // Opção 1
        User::create($request->all());

        // Opção 2
        /*$user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $user->save();*/

        return response([
            'message' => "Usuário foi cadastrado com sucesso!!",
        ], Response::HTTP_CREATED);
    }

    public function update(UserStoreRequest $request, User $user)
    {
        $user->update($request->all());

        return response([
            'message' => "Usuário foi atualizado com sucesso!!",
            'method' => $request->method()
        ], Response::HTTP_OK);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response([
            'message' => "Usuário foi deletado com sucesso!!",
        ], Response::HTTP_OK);
    }
}
