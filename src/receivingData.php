<?php
namespace src;

class ReceivingData{
protected $url;
protected $city;
public function format($str){
    return trim(strtolower($str));
}
public function setCity($city){
    $this->city = $city;
}
public function getCity(): mixed{
    return $this->city;
}
public function setUrl($city){
    $this->url ="https://wttr.in/" . $city . "?format=%c%t";
}
public function getUrl(){
    return $this->url;
}
}
