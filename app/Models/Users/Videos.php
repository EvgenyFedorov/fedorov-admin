<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Videos extends Model
{

    public function getEditUser(){
        return DB::table('videos')
            ->where([['enable', 1]])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getEditJob(){
        return DB::table('videos')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getPaginate(){
        return DB::table('videos')
            ->orderBy('videos.id', 'desc')
            ->paginate(10);

    }
}
