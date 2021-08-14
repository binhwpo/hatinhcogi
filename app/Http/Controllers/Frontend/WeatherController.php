<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WeatherController extends Controller
{

    function getUserIP() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        // return $ipaddress;
        return '14.253.108.78';
    }
    
    function sendJsontoServer() {
        $userIP = $this->getUserIP();
        $access_key = "?access_key=8569cd7c531097fa109645385aa9bc68";
        $array_json = "http://api.ipstack.com/" . $userIP . $access_key;
        $json = file_get_contents($array_json);
        $obj = json_decode($json);
        return $obj;
    }
    
    //Lay chuoi JSON thoi tiet hien tai cua Vi tri User
    function getCurrentData($region, $coutry_name, $access_key) {
        $location = $region . "," . $coutry_name . "&units=metric";
        $array_json = "http://api.openweathermap.org/data/2.5/weather?q=" . $location . $access_key;
        $json = file_get_contents($array_json);
        $obj = json_decode($json);
        return $obj;
    }
    
    function getWeather(){
        $access_key = "&appid=984df010bdc212c9c90c291fd793d7a5";
        $ip_obj = $this->sendJsontoServer();
        
        $country = $ip_obj->country_name;
        $region = $ip_obj->region_name;
        
        $region = $ip_obj->region_name;
        if(!$region){
            $region = $ip_obj->location->capital;
        }

        $current_obj = $this->getCurrentData($region, $country, $access_key);

        return $current_obj;
    }
}