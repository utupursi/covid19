<?php

namespace Tests\Unit;

use App\Http\Request\CountryStatisticRequest;
use App\Models\Country;
use App\Models\CountryStatistic;
use App\Models\User;
use App\Repositories\Eloquent\CountryRepository;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Http\Request;

class CountryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    public function test_if_pass_invalid_country_id()
    {
        Sanctum::actingAs(User::factory()->create());
        $response = $this->getJson('/api/get-country-statistics?country_id=0');
        $response->assertUnprocessable();
    }

    public function test_if_not_authenticated_user_get_countries()
    {
        $response = $this->getJson('/api/get-countries');
        $response->assertUnauthorized();
    }


    public function test_if_user_can_get_country_statistics()
    {
        Sanctum::actingAs(User::factory()->create());
        $country= Country::factory()->create();
        CountryStatistic::factory()->create(['country_id'=>$country->id]);

        $response = $this->getJson('/api/get-country-statistics?country_id='.$country->id);
        $response->assertSuccessful();
    }
}
