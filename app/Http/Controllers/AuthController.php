<?php

namespace App\Http\Controllers;

use App\AppActions\AppActionFactory;
use App\Exceptions\Unauthorize;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => [
            'join',
            'login'
        ]]);
    }

    public function join(Request $request) : JsonResponse
    {
        $data = $request->all();

        $action = AppActionFactory::getAction('Auth', 'Join', $data);

        return $this->jsonResponse($action->execute());
    }

    public function login(Request $request) : JsonResponse
    {
        $data = $request->all();

        $action = AppActionFactory::getAction('Auth', 'Login', $data);

        return $this->jsonResponse($action->execute());
    }

    public function logout(Request $request) : JsonResponse
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return $this->jsonResponse(['result' => '로그아웃 성공']);
    }
}
