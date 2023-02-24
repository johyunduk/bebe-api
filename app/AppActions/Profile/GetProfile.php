<?php

namespace App\AppActions\Profile;

use App\AppActions\BaseAppAction;
use App\Exceptions\NotFound;
use App\Models\User;

class GetProfile extends BaseAppAction
{
    public function execute(): mixed
    {
        $user = User::query()
            ->where('id', '=', $this->data['user']->id)
            ->first();

        if(!$user) throw new NotFound('사용자가 없습니다.');

        return $user;
    }
}
