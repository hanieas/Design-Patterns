<?php

class Database
{

    private static $instance = [];

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instance[$subclass])) {
            self::$instance[$subclass] = new static();
        }
        return self::$instance[$subclass];
    }
}

class MySQL extends Database
{

    public static function Info(): void
    {
        echo 'MySQL information';
    }
}

$s1 = MySQL::getInstance();
$s2 = MySQL::getInstance();
if ($s1 === $s2) {
    echo "MySQL has a single instance.";
} else {
    echo "MySQL's instances are different.";
}
