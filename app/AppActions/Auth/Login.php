<?php

namespace App\AppActions\Auth;

use App\AppActions\BaseAppAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

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

    public function execute(): mixed
    {
        if(!$this->validate()) {
            throw new UnprocessableEntityHttpException($this->errorMessage);
        }

        if(!Auth::attempt(['email' => $this->data['email'], 'password' => $this->data['password']])) {
            throw new UnauthorizedException('일치하는 사용자가 없습니다', 401);
        }

        $user = Auth::user();
        $token = $user->createToken($user->id)->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
