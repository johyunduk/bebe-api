<?php

namespace App\Http\Controllers;

use App\AppActions\AppActionFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function profile(Request $request) : JsonResponse
    {
        $user = $request->user();

        $action = AppActionFactory::getAction('Profile', 'GetProfile', ['user' => $user]);

        return response()->json($action->execute());
    }
}
