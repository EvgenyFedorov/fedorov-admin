<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class CoreRepository{

    protected $model;
    public $input;

    public function __construct(){
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function staticCondition(){
        return $this->model;
    }
    protected function startConditions(){
        return clone $this->model;
    }
}
