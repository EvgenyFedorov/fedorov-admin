<?php

namespace App\Http\Controllers;

use App\Models\Users\Countries;
use App\Models\Users\TimeZones;
use Illuminate\Http\Request;

class TimeZonesController extends Controller
{
    public function getTimeZones(){
        return TimeZones::getTimeZones();
    }
    public function getCountries(){
        return Countries::getCountries();
    }
}
