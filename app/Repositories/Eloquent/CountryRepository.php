<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\CountryStatisticRequest;
use App\Http\Request\LoginRequest;
use App\Http\Request\RegisterRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryStatisticResource;
use App\Models\Country;
use App\Models\CountryStatistic;
use App\Models\User;
use App\Repositories\AuthRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use mysql_xdevapi\CrudOperationBindable;

class CountryRepository implements CountryRepositoryInterface
{

    /**
     * @var CountryStatistic
     */
    public $model;

    /**
     * CountryRepository constructor.
     * @param CountryStatistic $model
     */
    public function __construct(Country $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function get(Request $request): AnonymousResourceCollection
    {
        return CountryResource::collection($this->model->get());
    }

    /**
     * @param CountryStatisticRequest $request
     * @return AnonymousResourceCollection
     */
    public function getCountryStatistic(CountryStatisticRequest $request): AnonymousResourceCollection
    {
        return CountryStatisticResource::collection(CountryStatistic::where(['country_id' => $request['country_id']])
            ->whereRaw('DATE_FORMAT(updated_at,"%Y-%m-%d")=?', [Carbon::now()->format('Y-m-d')])
            ->get());
    }


}
