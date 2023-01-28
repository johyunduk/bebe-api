<?php

namespace App\Http\Controllers;

use App\AppActions\AppActionFactory;
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
}
