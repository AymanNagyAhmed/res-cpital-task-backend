<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase

{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_successful()
    {
        $user = User::where("id", 3)->first();


        $response = $this->json("POST", '/api/login',[
            "email"=> $user->email,
            "password"=> "password",
        ]);

        $response->assertStatus(200);
    }
    public function test_login_unsuccessful()
    {
        $user = User::where("id", 3)->first();


        $response = $this->json("POST", '/api/login',[
            "email"=> $user->email,
            "password"=> "wrong_pass",
        ]);

        $response->assertStatus(401);
    }
    public function test_register_successful(){
        $response = $this->json("POST", "api/register", [
            "name"=>"test_user",
            "email"=> "test@test2.com",
            "password"=>"password"
        ]);
        $response->assertStatus(201);
    }
    public function test_register_unsuccessful(){
        $response = $this->json("POST", "api/register", [
            "name"=>"test_user",
            "password"=>"password"
        ]);
        $response->assertStatus(422);
    }
    protected $seed=true;
}
