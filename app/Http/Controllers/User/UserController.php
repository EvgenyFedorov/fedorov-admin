<?php

namespace App\Http\Controllers\User;

use App\Models\Bot\Jobs;
use App\Models\User;
use App\Models\Users\Accesses;
use App\Models\Users\Programs;
use App\Models\Users\TimeZones;

class UserController extends RolesController
{
    public function users(){
        return new User();
    }
    public function time_zones(){
        return new TimeZones();
    }
    public function accesses(){
        return new Accesses();
    }
    public function programs(){
        return new Programs();
    }
    public function jobs(){
        return new Jobs();
    }
    public function inputs()
    {
        $this->setInputs();
        return $this->getInputs();
    }
    public function request(){
        return $this->getRequest();
    }
    public function accessDenied(){
        return "ACCESS DENIED!";
    }
}
