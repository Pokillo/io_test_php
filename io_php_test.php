<?php


////Initiate cURL.
//$ch = curl_init('http://dorchevski.site/');
//
////Disable CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER by
////setting them to false.
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//
////Execute the request.
//curl_exec($ch);
//
////Check for errors.
//if(curl_errno($ch)){
//    throw new Exception(curl_error($ch));
//}



include 'vendor/autoload.php';

$config = [
    'host' => 'localhost',
    'port' => '8123',
    'username' => 'default',
    'password' => ''
];

$clickhouse = new ClickHouseDB\Client($config);


$names_tables = [
    'test_table1',
    'test_table2',
    'test_table3'
];



// Function that creates 3 test tables
function createTables($names_tables) {


    $sql_create = 'CREATE TABLE %TABLE_NAME%
(
     `date` Date,
     `text` String
    
) ENGINE = MergeTree()
PARTITION BY date 
ORDER BY date';

    foreach ($names_tables as $name) {
        $create_table_result[] = str_replace('%TABLE_NAME%', $name, $sql_create);

    }
    return $create_table_result;
}

$create_table_result = createTables($names_tables);



foreach ($create_table_result as $creat_table) {
    $response = $clickhouse->write($creat_table);
    var_dump($response);

}



// Populates tables with sample data
foreach ($names_tables as $name) {

    for ($i = 0; $i <= 10; $i++) {
        $date = date('Y-m-d H:i:s');
        $str = md5(time());

        $sql_insert = "INSERT INTO default.{$name}(date, text)
values ('{$date}', '{$str}')";

        $insert = $clickhouse->write($sql_insert);

        sleep(1);

    }

}



die();





$sql_show = 'DESC test_table';


$sql_create = 'CREATE TABLE test_table1 
(
     `date` Date,
     `text` String
    
) ENGINE = MergeTree()
PARTITION BY date 
ORDER BY date';

$sql_drop = 'DROP Table test_table3';

$show_tables = $clickhouse->showTables();


$response = $show_tables;
//$response = $clickhouse->write();
//$response = $clickhouse->select($sql)->fetchRow();


die();




