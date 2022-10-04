<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisingCampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'from'=>$this->faker->date("Y-m-d",'now'),
            'to'=> $this->faker->dateTimeBetween('now', "+2 week"),
            'total'=>$this->faker->randomNumber(5, true)/100,
            'daily_budget'=>$this->faker->randomNumber(5,true)/100,
            "owner_id"=>1,
        ];
    }
}
