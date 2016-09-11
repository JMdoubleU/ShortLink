<?php
require_once("config.php");

$conn = mysql_connect($config['db']['host'], $config['db']['username'], $config['db']['password']);
if (!$conn) {
    die($config['lang']['ERR_DB_CONN_ERROR']);
}
mysql_select_db($config['db']['database'], $conn);

function query($sql) {
    global $conn, $config;
    $result = mysql_query($sql, $conn);
    if (!$result) {
        die($config['lang']['ERR_DB_QUERY_ERROR']);
    }
    return $result;
}

function insert($table, $inserts) {
    $values = array_map('mysql_real_escape_string', array_values($inserts));
    $keys = array_keys($inserts);
    return query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
}

function close() {
    global $conn;
    mysql_close($conn);
}

function clean($string) {
    return mysql_real_escape_string($string);
}
?>