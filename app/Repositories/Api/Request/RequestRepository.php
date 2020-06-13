<?php


namespace App\Repositories\Api\Request;

use App\Models\Core\Curl as Model;
use App\Repositories\CoreRepository;

class RequestRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
    public function curlGetInfoServer($url){
        return $this->startConditions()->getResultInfo($url);
    }
    // Загрузка картинки по API
    public function curlUploadImages($settings){
        return $this->startConditions()->uploadImages($settings);
    }
}
