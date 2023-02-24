<?php

namespace App\AppActions\Auth;

use App\AppActions\BaseAppAction;
use App\Exceptions\BadEntity;
use App\Exceptions\Unauthorize;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends BaseAppAction
{
    public function validate(): bool
    {
        if(!isset($this->data['email'])) {
            $this->errorMessage = '이메일은 필수 항목입니다.';
            return false;
        }

        if(!isset($this->data['password'])) {
            $this->errorMessage = '비밀번호는 필수 항목입니다.';
            return false;
        }

        if(strlen($this->data['password']) < 8) {
            $this->errorMessage = '비밀번호는 최소 8자리 입니다.';
            return false;
        }

        return true;
    }

    /**
     * @throws BadEntity
     * @throws Unauthorize
     */
    public function execute(): mixed
    {
        if(!$this->validate()) {
            throw new BadEntity($this->errorMessage);
        }

        $user = User::query()
            ->where('email', '=', $this->data['email'])
            ->first();

        if(!$user) throw new Unauthorize('등록되지 않은 이메일입니다.');

        if(!Hash::check($this->data['password'], $user->password)) throw new Unauthorize('비밀번호가 틀렸습니다.');

        if(!Auth::attempt(['email' => $this->data['email'], 'password' => $this->data['password']])) {
            throw new Unauthorize('일치하는 사용자가 없습니다');
        }

        $user = Auth::user();
        $token = $user->createToken($user->id)->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
