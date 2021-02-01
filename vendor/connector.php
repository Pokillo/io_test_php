<?php

include 'vendor/autoload.php';

$config = [
    'host' => 'localhost',
    'port' => '8123',
    'username' => 'default',
    'password' => ''
];

$clickhouse = new ClickHouseDB\Client($config);