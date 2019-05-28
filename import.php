<?php

require_once "autoload.php";

$sp_type = 'podr';
$text_search = '';
$field_search = '';
$query_type = 'elem';

$find = new GetData($sp_type, $text_search, $field_search, $query_type);
$results = $find->result_data;

foreach ($results as $result){
/*    if (strlen($result['db_server'])){
        //var_dump($result);
        $db_server = $result['db_server'];
        $db_user = $result['db_user'];
        $db_password = $result['db_password'];
        $db_name = $result['db_name'];
        //var_dump($result['db_server']);
//        $serverName = $result['db_server'];
//        $connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password");
//        $conn = sqlsrv_connect( $serverName, $connectionInfo);
    }*/

}


$serverName = "172.16.44.2";
$connectionInfo = array( "Database"=>"TM5", "UID"=>"sa", "PWD"=>"1");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT plu_id FROM plu";
$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

// Make the first (and in this case, only) row of the result set available for reading.
if( sqlsrv_fetch( $stmt ) === false) {
    die( print_r( sqlsrv_errors(), true));
}
$i = 1;
while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
    //var_dump($row);
    $i++;
}
var_dump($i);
sqlsrv_free_stmt( $stmt);
