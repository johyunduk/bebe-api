<?php

namespace App\Http\Controllers;

use App\AppActions\AppActionFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function profile(Request $request) : JsonResponse
    {
        $action = AppActionFactory::getAction('Profile', 'GetProfile', []);

        return response()->json($action->execute());
    }

    public function editProfile(Request $request) : JsonResponse
    {
        $inputs = $request->all();

        $action = AppActionFactory::getAction('Profile', 'EditProfile', $inputs);

        $action->execute();

        return response()->json(['result' => '프로필 수정 성공']);
    }
}
