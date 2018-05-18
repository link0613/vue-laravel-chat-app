<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_register_new_user()
    {
        $this->post('/api/auth/register', [
            'name'     => 'Ahmed Ashraf',
            'email'    => 'ahmed@larachat.dev',
            'password' => '123456',
        ])
        ->assertJson([
            'created' => 'true',
        ]);
    }

    public function test_it_fails_when_user_provide_invalid_register_data()
    {
        $this->post('/api/auth/register', [
            'name'     => '',
            'email'    => '',
            'password' => '',
        ])
        ->assertStatus(302);
    }

    public function test_login()
    {
        $user = factory(\App\User::class)->create();

        $this->post('/api/auth/login', [
            'email'    => $user->email,
            'password' => 'secret',
        ])
        ->assertJson([
            'success' => 'true',
        ]);
    }

    public function test_it_fails_when_user_provide_invalid_login_data()
    {
        $this->post('/api/auth/login', [
            'email'    => '',
            'password' => '',
        ])
        ->assertStatus(302);
    }

    public function test_it_fails_when_user_provide_invalid_login_credentials()
    {
        $this->post('/api/auth/login', [
            'email'    => 'fake@example.org',
            'password' => 'fakepassword',
        ])
        ->assertExactJson([
            'success' => false,
            'message' => 'Invalid Credentials',
        ]);
    }
}
