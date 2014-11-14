<?php
session_start();

require_once('funciones_procesos.php');
require_once('conexion.php');
$conect = conectar();
$id_consultar = $_GET['e'];
$activarDesactivar=$_GET['a'];
$negocioUsuarioId=$_GET['id'];

	if($activarDesactivar==1)//CONDICION `PARA VER SI SE VA A ACTIVAR O A DESACTIVAR
	{	
		$nombre_negocio=$_GET['n'];
		$email_negocio=$_GET['m'];
		$codigoActivacion=get_codigo_activacion($email_negocio,$nombre_negocio);
	
		//consulta para contar numero de registros
		$sql = update_activado($negocioUsuarioId,$codigoActivacion);
		//echo $sql;
		$query = mysql_query($sql, $conect) or die('Error en la consulta');
		
		$num_rows = mysql_num_rows($query);
		header('location: principal.php');
		
	}
	else
	{
		$sql = update_desactivado($negocioUsuarioId);
		//echo $sql;
		$query = mysql_query($sql, $conect) or die('Error en la consulta');
		
		$num_rows = mysql_num_rows($query);
		header('location: principal.php');
	}	
	
