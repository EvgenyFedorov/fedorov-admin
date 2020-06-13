<?php

namespace App\Models\Core;

class Curl
{
    public $site = null;
    public $url = null;
    public $ch = null;
    public $result = null;

    public function __construct(array $attributes = [])
    {
        $this->site = "http://" . $_SERVER['HTTP_HOST'];
        return $this->ch = curl_init();
    }
    public function Images($settings){

        // Этот метод заливает картинку на IMGUR.COM

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $settings["url"],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => isset($settings['attribute']) ? $settings['attribute'] : "",
            CURLOPT_HTTPHEADER => $settings["headers"],
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

    }
    public function setOptions()
    {
        // отправка запроса
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

    }
    public function setUrl($url = null){
        if($url != null){
            $this->url = $this->site . $url;
            curl_setopt($this->ch, CURLOPT_URL, $this->url);
        }else{
            $this->url = $this->site;
            curl_setopt($this->ch, CURLOPT_URL, $this->url);
        }
    }
    public function getResultInfo($url){

        // отправка запроса
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        if($url != null){
            curl_setopt($this->ch, CURLOPT_URL, $url);
        }else{
            $url = $this->site;
            curl_setopt($this->ch, CURLOPT_URL, $url);
        }

        $this->result = curl_exec($this->ch);
        return $this->result;
    }
}
