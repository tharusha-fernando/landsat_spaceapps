<?php

namespace App\Services;

use App\Models\User;

class LandSatServices
{
    public $users;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->users=User::all();
        //
    }

    public function checkSatPasses(){
        //loop users
        foreach($this->users as $user){
            //check user's location and satellite passes
            //get locations
            $locations=$this->getLocations($user);

            //loop locations
            foreach($locations as $location){
                $lead_time=$location->lead_time;

                //get sat data
                $this->getaSatData($location,$lead_time);
            }
            //...
        }
        //return results
    }

    public function getLocations($user){
        return $user->locations;
    }

    public function getaSatData($location,$lead_time){
       //get when sattelite next pass the location from the api

       //if next date is less than lead time send notifications to user
       
    }
}
 //get sat data from API
        //...
        //process data and return result