<?php

$config = parse_ini_file(__DIR__ . "/../config.ini", true);
$port = $config["database"]["port"];
$ip = $config["database"]["hostname"];
$dbname = $config["database"]["database"];
$username = $config["database"]["username"];
$password = $config["database"]["password"];

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host=$ip;dbname=$dbname",
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
