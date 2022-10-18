<?php

namespace App\Http\Request;

use App\Models\Country;
use App\Models\CountryStatistic;
use Illuminate\Foundation\Http\FormRequest;

class CountryStatisticRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => ['required','integer',function($attribute,$value,$fail){
                 $country=Country::where(['id'=>$value])->first();
                 if(!$country){
                     $fail('Invalid country id provided');
                 }
            }],
        ];
    }
}
