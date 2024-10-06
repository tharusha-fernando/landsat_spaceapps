<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index(){
        $user=Auth::user();
        $satelliteName=fake()->name();//,
        $latitude=fake()->latitude();//,
        $longitude=fake()->longitude();
        $passDateTime=fake()->dateTime()->format('Y-m-d H:i:s');
       $cloudCoverage=fake()->randomNumber();

       return view('mail.sat_pass',compact('cloudCoverage','passDateTime','longitude','latitude','satelliteName','user'));
    }
    //
}
