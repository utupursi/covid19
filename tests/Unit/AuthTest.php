<?php

namespace Tests\Unit;

use App\Http\Request\CountryStatisticRequest;
use App\Models\Country;
use App\Models\User;
use App\Repositories\Eloquent\CountryRepository;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Http\Request;

class AuthTest extends TestCase
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
    public function test_users_can_authenticate()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

         $response=$this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

         $response->assertSuccessful();

    }

    public function test_users_can_not_authenticate()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response=$this->post('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertUnprocessable();
    }

}
