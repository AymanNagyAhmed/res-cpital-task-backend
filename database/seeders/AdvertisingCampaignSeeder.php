<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\AdvertisingCampaign;
use Illuminate\Database\Seeder;
use Spatie\Image\Image;

class AdvertisingCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adCampaigns= AdvertisingCampaign::factory(10)->create();
        foreach ($adCampaigns as $key => $adCampaign) {
            $faker = Faker::create();
            $imageUrl = 'https://source.unsplash.com/random/400x400';

            $adCampaign->addMediaFromUrl($imageUrl)
            ->withCustomProperties(["width" => 400, "height" => 400])
            ->toMediaCollection("images");
        }
    }
}
