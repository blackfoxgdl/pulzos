<?php
session_start();

require_once('funciones_procesos.php');
require_once('conexion.php');
$conect = conectar();

$_SESSION['user'] = $_POST['usuario'];
$password = $_POST['pass'];
$clave_encript = 'ElAxolot3d34ccion3smi43r003';

//password a checar
$_SESSION['password'] = sha1($clave_encript.$password);

//consulta para contar numero de registros
$sql = get_query_loggin($_SESSION['user'], $_SESSION['password']);
if($sql=='error')
{
	header('location: ingreso.php');
}
else
{
	$query = mysql_query($sql, $conect) or die('Error en la consulta');
	
	$num_rows = mysql_num_rows($query);
	
	if($num_rows == 1)
	{
		header('location: principal.php');
	}
	else
	{
		header('location: ingreso.php');
	}
}
