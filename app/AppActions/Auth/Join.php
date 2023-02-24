<?php

namespace App\AppActions\Auth;

use App\AppActions\BaseAppAction;
use App\Exceptions\BadEntity;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Join extends BaseAppAction
{
    public function validate(): bool
    {
        if(is_null($this->data['email'])) {
            $this->errorMessage = "이메일을 입력해 주세요.";
            return false;
        }

        if(is_null($this->data['password'])) {
            $this->errorMessage = "비밀번호를 입력해 주세요";
            return false;
        }

        if(strlen($this->data['password']) < 8) {
            $this->errorMessage = "비밀번호는 최소 8자리 입니다.";
            return false;
        }

        if(is_null($this->data['gender'])) {
            $this->errorMessage = "성별을 입력해 주세요";
            return false;
        }

        if(is_null($this->data['birth_date'])) {
            $this->errorMessage = "생일을 입력해 주세요.";
            return false;
        }

        return true;
    }

    /**
     * @throws BadEntity
     */
    public function execute(): mixed
    {
        if(!$this->validate()) {
            throw new BadEntity($this->errorMessage);
        }

        $this->data['password'] =  Hash::make($this->data['password']);

        return User::query()
            ->create($this->data);
    }
}
