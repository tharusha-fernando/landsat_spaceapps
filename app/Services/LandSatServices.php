<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LandSatServices
{
    public $users;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->users = User::all();
        //
    }

    public function checkSatPasses()
    {
        //loop users
        foreach ($this->users as $user) {
            //check user's location and satellite passes
            //get locations
            $locations = $this->getLocations($user);

            //loop locations
            foreach ($locations as $location) {
                $lead_time = $location->lead_time;

                //get sat data
                $this->getaSatData($location, $lead_time);
            }
            //...
        }
        //return results
    }

    public function getLocations($user)
    {
        return $user->locations;
    }

    public function getaSatData($location, $lead_time)
    {
        //get when sattelite next pass the location from the api
        $satData = $this->getDataFromAPi($location);

        //if next date is less than lead time send notifications to user

    }

    // public function getDataFromAPi($location){

    // }


    // use Illuminate\Support\Facades\Http;

    // public function getDataFromApi($location)
    // {
    //     $apiUrl = 'https://m2m.cr.usgs.gov/api/api/json/stable/scene-search';
    //     $token = 'jUcUtIxfTFQN7G@FM7hYynoXHK@eJNJBmF82y6vk_@3rrk2MfcFiRvB33PwIPdHj';

    //     $response = Http::withHeaders([
    //         'X-Auth-Token' => $token
    //     ])->post($apiUrl, [
    //         'spatialFilter' => [
    //             'filterType' => 'mbr',
    //             'lowerLeft' => [
    //                 'latitude' => $location['latitude'],
    //                 'longitude' => $location['longitude']
    //             ],
    //             'upperRight' => [
    //                 'latitude' => $location['latitude'],
    //                 'longitude' => $location['longitude']
    //             ]
    //         ],
    //         'datasetName' => 'LANDSAT_8_C1',  // Example dataset, change based on requirement
    //         'acquisitionFilter' => [
    //             'start' => now()->subDays(30)->toDateString(),  // Get data from the past 30 days
    //             'end' => now()->toDateString()
    //         ]
    //     ]);

    //     if ($response->successful()) {
    //         return $response->json();
    //     }

    //     Log::info($response);
    //     return null;  // Handle the error accordingly
    // }
    // use Illuminate\Support\Facades\Http;

    public function getDataFromApi($location)
    {
        $token = 'jUcUtIxfTFQN7G@FM7hYynoXHK@eJNJBmF82y6vk_@3rrk2MfcFiRvB33PwIPdHj';

        // Authentication step to get the token
        $authResponse = Http::post('https://m2m.cr.usgs.gov/api/api/json/stable/login-token', [
            'username' => 'tharusha_fernando', //your_username
            'token' => $token,//'',  // Replace with actual application token//your_application_token//password
        ]);

        Log::info("Auth Response", $authResponse->json());

        if ($authResponse->failed()) {
            return 'Authentication Failed: ' . $authResponse->json()['errorMessage'];
        }

        $apiToken = $authResponse->json()['data'];  // Retrieve the token

        // Now make the request to get satellite pass data using the token
        $apiUrl = 'https://m2m.cr.usgs.gov/api/api/json/stable/scene-search';

        $response = Http::withHeaders([
            'X-Auth-Token' => $apiToken  // Use the retrieved token here
        ])->post($apiUrl, [
            'spatialFilter' => [
                'filterType' => 'mbr',
                'lowerLeft' => [
                    'latitude' => $location['latitude'],
                    'longitude' => $location['longitude']
                ],
                'upperRight' => [
                    'latitude' => $location['latitude'],
                    'longitude' => $location['longitude']
                ]
            ],
            'datasetName' => 'LANDSAT_8_C1',  // Example dataset
            'acquisitionFilter' => [
                'start' => now()->subDays(30)->toDateString(),  // Get data from the past 30 days
                'end' => now()->toDateString()
            ]
        ]);

        Log::info("Data Response:", $response->json());
        if ($response->successful()) {
            return $response->json();
        }

        return 'Data Retrieval Failed: ' . $response->json()['errorMessage'];
    }
}
 //get sat data from API
        //...
        //process data and return result