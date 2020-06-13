<?php


namespace App\Repositories\Api\Imgur;

use App\Models\Api\Imgur as Model;
use App\Models\Core\Curl;
use App\Repositories\Api\Response\ResponseRepository;
use App\Repositories\CoreRepository;

class ImgurRepository extends CoreRepository
{
    private $curl = null;
    private $response = null;
    private $server = null;

    protected function getModelClass()
    {
        $this->initResponseRepository();
        return Model::class;
    }
    private function initResponseRepository(){
        $this->response = new ResponseRepository();
        $this->response =  $this->response->Json();
    }
    public function isUploadFile($upload_file){
        return isset($upload_file) && !empty($upload_file) ? $upload_file : false;
    }

    // Удаление картинки
    public function curlDeleteImages($server_id, $user_id){

        $this->response->setData('error_status', 'false');

        if($server = $this->server->getServerUser($server_id, $user_id)){

            $imgur = $this->startConditions();

            $curl = new Curl();

            $result = $curl->Images([
                "url" => $imgur->getAttribute('url') . '/' . $server->deletehash,
                "headers" => [
                    "Authorization: Client-ID " . $imgur->getAttribute('client_id')
                ]
            ]);

            $result = json_decode($result);

            if($result->success === true){

                $imgur = $this->startConditions()
                    ->where([['server_id', $server_id]])
                    ->delete();

                if($imgur){

                    $this->response->setData('success', $result);

                }else{

                    $this->response->setData('error_status', 'true');
                    $this->response->setData('error_value', 'Ошибка при удалении картинки!');

                }

            }else{

                $this->response->setData('error_status', 'true');
                $this->response->setData('error_value', 'Ошибка при удалении картинки с IMGUR!');
                $this->response->setData('error_code', $result->status);

            }

        }else{

            $this->response->setData('error_status', 'true');
            $this->response->setData('error_value', 'Данного сервера не существует!');

        }

        return $this->response->jsonEncode();

    }

    // Загрузка картинки
    public function curlUploadImages($upload_file){

        $this->response->setData('error_status', 'false');

        if($this->isUploadFile($upload_file)) {

            $imgur = $this->startConditions();

            $curl = new Curl();

            $result = $curl->Images([
                "url" => $imgur->getAttribute('url'),
                "attribute" => [
                    'image' => $upload_file
                ],
                "headers" => [
                    "Authorization: Client-ID " . $imgur->getAttribute('client_id')
                ]
            ]);

            $result = json_decode($result);

            if($result->success === true){

                $this->response->setData('success', $result);

            }else{

                $this->response->setData('error_status', 'true');
                $this->response->setData('error_value', 'Ошибка!');
                $this->response->setData('error_code', $result->status);

            }

        }else{

            $this->response->setData('error_status', 'true');
            $this->response->setData('error_value', 'Отсутствует загружаемый файл!');

        }

        return $this->response->jsonEncode();

    }
    public function saveUploadImages($response, $server_id){

        $this->response->setData('error_status', 'false');

        $imgur = $this->startConditions();

        $response = json_decode($response);

        if($response->success){

            $imgur->server_id = $server_id;
            $imgur->imgurs_id = $response->success->data->id;
            $imgur->width = $response->success->data->width;
            $imgur->height = $response->success->data->height;
            $imgur->size = $response->success->data->size;
            $imgur->deletehash = $response->success->data->deletehash;
            $imgur->link = $response->success->data->link;
            $imgur->created_at = date("Y-m-d H:i:s", date("U") + (3600 * 3));
            $imgur->save();

            $this->response->setData('success', $response);

        }else{

            $this->response->setData('error_status', 'true');
            $this->response->setData('error_value', 'Ошибка сохранения изобаражения!');

        }

        return $this->response->jsonEncode();

    }
}
