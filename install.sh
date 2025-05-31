#!/bin/bash

if ! command -v composer &> /dev/null; then
    echo "Composer не установлен. Установите его с помощью вашего пакетного менеджера"
    exit 1
fi

if [ ! -d "vendor" ]; then
    echo "Установка зависимостей Composer..."
    composer install
fi

mv pogoda.sh $HOME