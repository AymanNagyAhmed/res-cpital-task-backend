<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisingCampaign\DeleteAdvertisingCampaignRequest;
use App\Http\Requests\AdvertisingCampaign\StoreAdvertisingCampaignRequest;
use App\Http\Requests\AdvertisingCampaign\UpdateAdvertisingCampaignRequest;
use App\Http\Resources\AdvertisingCampaignResource;
use App\Models\AdvertisingCampaign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Spatie\Image\Image;

class AdvertisingCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adCampaigns= AdvertisingCampaign::all();
        return AdvertisingCampaignResource::collection($adCampaigns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdvertisingCampaign\StoreAdvertisingCampaignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertisingCampaignRequest $request)
    {

        $validated = $request->validated();
        $validated["owner_id"] = Auth::user()->id;

        $images = $validated['images'];
        unset($validated["images"]);
        // dd([...$validated]);
        $adCampaign = AdvertisingCampaign::create($validated);
        foreach ($images as $key => $file) {
            $image =  Image::load($file);

            $adCampaign->addMedia($file)
            ->withCustomProperties(["width" => $image->getWidth(), "height" => $image->getHeight()])
            ->toMediaCollection("images");
        }

        return new AdvertisingCampaignResource($adCampaign);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,AdvertisingCampaign $advertisingCampaign)
    {
       //dd($advertisingCampaign->name);

        return new AdvertisingCampaignResource($advertisingCampaign);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvertisingCampaign $advertisingCampaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdvertisingCampaignRequest  $request
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertisingCampaignRequest $request, AdvertisingCampaign $advertisingCampaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteAdvertisingCampaignRequest $request,AdvertisingCampaign $advertisingCampaign)
    {
        $advertisingCampaign->delete();
    }
}
