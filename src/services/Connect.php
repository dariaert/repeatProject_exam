<?php

namespace services;

class Connect
{

    public static function Connect()
    {

        $db = mysqli_connect(
            '127.0.0.1:3306',
            'root',
            '',
            'repeatProject'
        );

        if (!$db)
        {
            die('нет соединения с бд');
        }
        else
        {
            return $db;
        }

    }

}