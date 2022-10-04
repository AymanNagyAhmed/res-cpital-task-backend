<?php

namespace Tests\Feature;

use App\Models\AdvertisingCampaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertisingCampaignTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_logged_in(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post("api/ad-campaigns",[
            "name"=>"test-campaign",
            "from"=>"2022-10-10",
            "to"=>"2022-10-14",
            "total"=>"300.00",
            "daily_budget"=> "30.0",
            "images"=>[],
        ]);

        $response->assertStatus(201);
        assert($response->json()->data->owner->id==$user->id);
    }
    public function test_create_anonymous(){
        $response = $this->withHeader("Accept", "application/json")->post("api/ad-campaigns",[
            "name"=>"test-campaign",
            "from"=>"2022-10-10",
            "to"=>"2022-10-14",
            "total"=>"300.00",
            "daily_budget"=> "30.0",
            "images"=>[],
        ]);
        $response->assertStatus(401);
    }

    public function test_show_all(){
        $user = User::factory()->create();
        $count = AdvertisingCampaign::all()->count();
        $response = $this->actingAs($user)->json("GET","api/ad-campaigns");
        $response->assertStatus(200);

        $response->assertJsonCount($count,"data");

    }
    public function test_view_logged_in(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->json("GET","api/ad-campaigns/1");
        $response->assertStatus(200);

    }
    public function test_view_anonymous(){
        $response = $this->withHeader("Accept", "application/json")->json("GET","api/ad-campaigns/1");
        $response->assertStatus(401);
    }
    public function test_delete_owner(){
        $user= User::where("id", 1)->first();

        $response = $this->actingAs($user)->json("DELETE","api/ad-campaigns/3");
        $response->assertStatus(200);
    }
    public function test_delete_non_owner(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->json("DELETE","api/ad-campaigns/1");
        $response->assertStatus(403);
    }


    public function test_delete_anonymous(){
        $response = $this->withHeader("Accept", "application/json")->json("DELETE","api/ad-campaigns/1");
        $response->assertStatus(401);
    }


    protected $seed=true;
}
