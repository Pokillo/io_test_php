<?php
//
//include 'vendor/autoload.php';
//
//$config = [
//    'host' => 'localhost',
//    'port' => '8123',
//    'username' => 'default',
//    'password' => '521794k'
//];


//
//$db = new ClickHouseDB\Client($config);
//
//$sql = 'select * FROM test_table';
//
//$WriteToFile = new ClickHouseDB\WriteToFile('1_select.csv');
//$db->select($sql, [], null, $WriteToFile);

$cmd = 'clickhouse-client --help';
$out = shell_exec($cmd);

var_dump($out);
