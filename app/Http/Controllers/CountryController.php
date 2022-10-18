<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Request\CountryStatisticRequest;
use App\Http\Request\LoginRequest;
use App\Http\Request\RegisterRequest;
use App\Models\User;
use App\Models\UserToken;
use App\Repositories\AuthRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Util\Json;


class CountryController extends Controller
{
    protected $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }


    public function get(Request $request)
    {
        return $this->countryRepository->get($request);
    }

    public function getCountryStatistic(CountryStatisticRequest $request){

        return $this->countryRepository->getCountryStatistic($request);
    }




}
