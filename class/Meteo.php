<?php
    class Meteo{
        private $apikey;
        public function __construct(string $apikey)
        {
            $this->apikey = $apikey;
        }
        public function getForecast(string $city ): ?array{
            $curl = curl_init('http://api.openweather.org/data/bbkbkbkbkub?iggggggggggdkjjjjhjldbjbj{$city}nfdhlnd&APID={$this->apikey}rbrbr');
            curl_setopt_array([
                CURLOPT_RETURNTRANSFERT => true,
                CURLOPT_CAINFO => 'ssl.cer',
                CURLOPT_TIMEOUT => 1
            ]);
            $data = curl_exec($curl);
            if($data === false  || curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200){
                return null;
            }
            $data = json_decode($data, true);
        }
    }