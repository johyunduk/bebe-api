<?php

namespace App\AppActions\Profile;

use App\AppActions\BaseAppAction;
use App\Exceptions\NotFound;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetProfile extends BaseAppAction
{
    public function execute(): mixed
    {
        $user = Auth::user();

        if(!$user) throw new NotFound('사용자가 없습니다.');

        return $user;
    }
}
