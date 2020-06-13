<?php


namespace App\Repositories\Api\Response;

use App\Models\Api\Response as Model;
use App\Repositories\CoreRepository;

class ResponseRepository extends CoreRepository
{

    public function Json(){
        return $this->startConditions()->Json();
    }

    protected function getModelClass()
    {
        return Model::class;
    }
}
