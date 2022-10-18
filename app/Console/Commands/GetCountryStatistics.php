<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\CountryStatistic;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetCountryStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-country-statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get country statistics';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $countries = Country::get();
            foreach ($countries as $country) {
                $response = Http::post('https://devtest.ge/get-country-statistics', [
                    'code' => $country->code
                ]);
                if ($response->ok()) {
                    $data = $response->json();
//
                    $countryStatistic = CountryStatistic::where(['country_id' => $country->id])->whereRaw('DATE_FORMAT(updated_at, "%Y-%m-%d") = ?', [Carbon::now()->format('Y-m-d')])->first();
                    if (!$countryStatistic) {
                        CountryStatistic::create([
                            'country_id' => $country->id,
                            'confirmed' => $data['confirmed'],
                            'recovered' => $data['recovered'],
                            'critical' => $data['critical'],
                            'deaths' => $data['deaths'],
                            'created_at' => $data['created_at'],
                            'updated_at' => $data['updated_at']
                        ]);
                    } else {
                        $countryStatistic->update([
                            'confirmed' => $data['confirmed'],
                            'recovered' => $data['recovered'],
                            'critical' => $data['critical'],
                            'deaths' => $data['deaths'],
                        ]);

                    }

                }
//
            }
            return Command::SUCCESS;

        } catch
        (\Exception $exception) {
            return Command::FAILURE;
        }


    }
}
