<?php

namespace App\Repositories;

use App\Http\Request\CountryStatisticRequest;
use App\Http\Request\LoginRequest;

use App\Http\Request\RegisterRequest;
use Illuminate\Http\Request;

interface CountryRepositoryInterface
{
    public function get(Request $request);

    public function getCountryStatistic(CountryStatisticRequest $request);

}
