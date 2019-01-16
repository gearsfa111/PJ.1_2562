<?php
function connect(){
  $servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'leave_pj';#oci:dbname  mysql:host sqlsrv:server
	$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password); #mysql
  	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    	return $conn;
}
function selectSql($sql){
	$conn = connect();
	//$sth = $conn->exec($sql);
	$sth = $conn->prepare($sql);
	$sth->execute();
	unset($sql);
	$rows = array();
	$result = $sth->setFetchMode(PDO::FETCH_ASSOC);
    #foreach(new RecursiveArrayIterator($sth->fetchAll()) as $k=>$v) {
    foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $k=>$v) {
        $rows[] = $v;
    }
	$conn = null;
  return $rows;
}

function in_up_delSql($sql){
	$conn = connect();
	//$conn->exec($sql);//exec
	$sth = $conn->prepare($sql);
	unset($sql);
	$sth->execute();
	$conn = null;
	return false;
}

function delAllSql($sql, $Table, $col){
	$conn = connect();
	foreach($sql as $value){
	//$conn->exec('DELETE FROM '.$Table.' WHERE '.$col.' = "'.$value.'"');
	$sth = $conn->prepare('DELETE FROM '.$Table.' WHERE '.$col.' = "'.$value.'"');
	$sth->execute();
	}
	$conn = null;
	return false;
}
?>