<?php

namespace App\Http\Controllers\User;

use App\Models\Bot\Jobs;
use App\Models\User;
use App\Models\Users\Accesses;
use App\Models\Users\Orders;
use App\Models\Users\Programs;
use App\Models\Users\TimeZones;
use App\Models\Users\Videos;

class UserController extends RolesController
{
    public function users(){
        return new User();
    }
    public function jobs(){
        return new Jobs();
    }
    public function videos(){
        return new Videos();
    }
    public function orders(){
        return new Orders();
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
