#!/usr/bin/env php
<?php

require_once('../vendor/autoload.php');

try {
    $data = new \src\receivingData();
    $menu = new \src\Menu($data);
    
    $data->setCity($data->format(readline("Введите город: ")));
    if (empty($data->getCity())) {
        throw new InvalidArgumentException("Город не может быть пустым");
    }
    
    $menu->choiceMenu(); // Установка формата после ввода города
    
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
    
    echo "Погода в городе " . $data->getCity() . ":\n" . $weather . PHP_EOL;
    
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . PHP_EOL;
    exit(1);
}