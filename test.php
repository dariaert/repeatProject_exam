<?php

use models\Users;
$User = new Users();

$expectedValue = [
    "email" => "info",
    "password" => "12345"
];

//$realValue = [
//    "email" => "info",
//    "password" => "parol"
//];

$proc = microtime(true);
$realValue = $User->getOneUser(1);
$valueDouble = sprintf('%6f sec.', microtime(true) - $proc);


$result = $realValue['email'] === $expectedValue['email'];

if($result)
{
    $report = "info";
    $report =  "Тестер: Admin
Окружение: браузер Yandex, версия PHP: 8.2
Цель: Проверка корректности обработки полей формы при авторизации. \n
Результат: \n" .
        "\tОжидаемое значение логина: " . $expectedValue['email'] . "\n" .
        "\tРеальное значение логина: " . $realValue['email'] . "\n" .
        "\tВремя выполнения: " . $valueDouble . "\n\n" .
        "Итог: Тест завершен корректно.";

    $myFile = fopen( filename: "infow.txt", mode: 'w+') or die("file not exist");
    fwrite($myFile, $report);
    fclose($myFile);
}