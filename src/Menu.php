<?php
namespace src;
class Menu{
    public $data;
    public function __construct() {
        $this->data = new \src\receivingData();
    }
    public function showMenu()
{
    return $this->data->format(readline("\nВыберите вариант:\n
    1. Погода сейчас\n
    2. Погода на следующие 3 дня\n
    3. Выход\n
    Ваш выбор: "));
}
    public function choiceMenu(){
        $choice = $this->showMenu();
        switch($choice){
            case "1":
                $this->data->setFormatUrl("?format=%c%t");
            break;
            case "2":
                $this->data->setFormatUrl(null);
            break;
            case "3":
                exit(0);
            break;
            default:
                echo "Неверный выбор!\n";
        }
    }
}