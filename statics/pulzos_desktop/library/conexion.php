<?php 
include("adodb/adodb.inc.php");
include ("adodb/adodb-exceptions.inc.php");
//include_once("adodb/session/adodb-session2.php");
$host="localhost";
$user="root";
$pass="";

$dataB="pulzos_bueno";
try{
$db=NewADOConnection("mysql");
$db->Connect($host, $user, $pass, $dataB);
mysql_query("SET NAMES 'utf8'");
}catch(exception $e){
    var_dump($e);
}
/*$conexion=mysql_connect($host,$user,$pass) or die (mysql_error());
mysql_select_db('pulzos_bueno',$conexion) or die ('ERROR: No se encuentra la base de datos');*/
?>
