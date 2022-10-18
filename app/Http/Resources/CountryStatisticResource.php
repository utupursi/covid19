<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryStatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'confirmed' => $this->confirmed,
            'recovered' => $this->recovered,
            'deaths' => $this->deaths,
        ];
    }
}
