#!/usr/bin/env php
<?php

require_once ('../vendor/autoload.php');

try {
    
$data = new \src\receivingData();
$data->setCity($data->format(readline("Введите город: ")));
if (empty($data->getCity())) {
    throw new InvalidArgumentException("Город не может быть пустым");
}

$data->setUrl(city: $data->getCity());
$options = [ 
    'http' => [
        'method' => "GET",
        'header' => "User-Agent: curl/7.68.0\r\n",
        'timeout' => 10  
    ]
];
$context = stream_context_create($options);
$weather = file_get_contents($data->getUrl(), false, $context);
    
    if ($weather === false) {
        throw new RuntimeException("Не удалось получить данные о погоде");
    }
    
    echo "Погода в городе " . $data->getCity()  . $weather . PHP_EOL;
    
} 
catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
