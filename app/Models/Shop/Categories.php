<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function products(){
        return $this->hasOne(Products::class, 'category_id', 'id');
    }
}
