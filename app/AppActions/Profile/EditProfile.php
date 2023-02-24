<?php

namespace App\AppActions\Profile;

use App\AppActions\BaseAppAction;
use App\Exceptions\BadEntity;
use Illuminate\Support\Facades\Auth;

class EditProfile extends BaseAppAction
{
    public function validate(): bool
    {
        if(isset($this->data['gender']) && !in_array($this->data['gender'], ['남자', '여자'])) {
            $this->errorMessage = '성별은 남자 또는 여자만 가능합니다';
            return false;
        }

        return true;
    }

    public function execute(): mixed
    {
        if(!$this->validate()) throw new BadEntity($this->errorMessage);

        $user = Auth::user();

        $user->gender = $this->data['gender'];
        $user->birth_date = $this->data['birth_date'];
        $user->save();

        return null;
    }
}
