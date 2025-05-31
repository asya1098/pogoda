#!/usr/bin/env php
<?php

require_once ('../vendor/autoload.php');

$configFile = __DIR__ . '/.weather_city';
$savedCity = file_exists($configFile) ? trim(file_get_contents($configFile)) : null;

$data = new \src\receivingData();
if(empty($savedCity)){
$data->setCity($data->format(readline("Введите город: ")));
    file_put_contents($configFile, $data->getCity());
    echo "Город сохранен. В следующий раз погода будет показываться для: " . $data->getCity() . "\n\n";
}else{
    $data->setCity($savedCity);
}
$data->setUrl(city: $data->getCity());
// Настраиваем контекст запроса (User-Agent обязателен для wttr.in)
$options = [
    'http' => [
        'method' => 'GET',
        'header' => "User-Agent: curl/7.68.0\r\n"
    ]
];
$context = stream_context_create($options);
try {
    $weather = file_get_contents($data->getUrl(), false, $context);
    
    if ($weather === false) {
        throw new Exception("Не удалось получить данные о погоде");
    }
    
    // Выводим результат (например: "☀️+15°C")
    echo "Погода в городе " . $data->getCity()  . $weather . PHP_EOL;
    
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
