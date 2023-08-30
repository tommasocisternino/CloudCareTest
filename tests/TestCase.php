<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected string $token;

    protected User $user;

    public function createUser(){
        $this->user = new User([
            'username' => 'utente',
            'email' => 'utente@test.it',
            'password' => Hash::make('password'),
        ]);
        $this->user->save();

        $this->token = JWTAuth::fromUser($this->user);
    }

}
