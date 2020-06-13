<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Imgur extends Model
{

    private $attribute = [
        'client_id' => '07364b8f5d90d0e',
        'account_id' => '127443095',
        'client_secret' => 'f3d57d1eb887c30196a6435ba0b87ce888d14bbb',
        'access_token' => 'ea3d8f554bf77e54bcb53eabb7f497cfa1283b13',
        'refresh_token' => 'fee2e50a75b657c64b2f919721bcd308b4d1f68e',
        'url' => 'https://api.imgur.com/3/image'
    ];

    public function isDateAttribute($key)
    {
        return isset($this->attribute[$key]) ? $this->attribute[$key] : false;
    }

    public function getAttribute($key)
    {
        return $this->isDateAttribute($key);
    }
}
