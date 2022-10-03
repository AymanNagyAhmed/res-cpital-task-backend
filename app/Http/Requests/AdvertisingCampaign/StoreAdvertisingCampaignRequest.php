<?php

namespace App\Http\Requests\AdvertisingCampaign;

use App\Rules\CampaignFromToRule;
use Illuminate\Foundation\Http\FormRequest;


class StoreAdvertisingCampaignRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name'=>'required',
            'from'=> ['required', 'date', new CampaignFromToRule],
            'to'=> ['required', 'date'],
            'total'=>['required', 'numeric'],
            'daily_budget'=>['required', 'numeric'],
            'images'=>[
                'sometimes'
            ]
        ];
    }
}
