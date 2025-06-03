<?php
namespace src;

class ReceivingData{
protected $url;
protected $formatUrl;
protected $city;
public function format($str):string {
    return trim(strtolower($str));
}
public function setCity($city):void {
    $this->city = $city;
}
public function getCity():string {
    return $this->city;
}
public function setUrl($city):void {
    $this->url = "https://wttr.in/" . $city . "?format=%c%t";
}
public function getUrl():string {
    return $this->url;
}
public function setFormatUrl($formatUrl):void {
    $this->formatUrl = $formatUrl;
}
public function getFormatUrl():string {
    return $this->formatUrl;
}
}
