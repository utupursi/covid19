<?php

namespace App\Console\Commands;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $response = Http::get('https://devtest.ge/countries');

            if ($response->ok()) {
                foreach ($response->json() as $country) {
                    $arr = [
                        'en' => [
                            'name' => $country['name']['en']
                        ],
                        'ka' => [
                            'name' => $country['name']['ka']
                        ],
                        'code' => $country['code'],
                    ];

                    Country::create($arr);
                }

            }
        }
        catch (\Exception $exception){
            return Command::FAILURE;
        }


        return Command::SUCCESS;
    }
}
