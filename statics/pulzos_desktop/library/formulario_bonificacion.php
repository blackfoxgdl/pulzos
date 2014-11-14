<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include ('conexion.php');
$email=$_REQUEST['email'];
$password=$_REQUEST['pass'];
$secret='ElAxolot3d34ccion3smi43r003';
$password=sha1($secret.$password);
$busqueda=mysql_query('Select * from usuarios WHERE email="'.$email.'" and password="'.$password.'" and statusEU=1',$conexion) or die('Error en consulta');
$datos=mysql_fetch_array($busqueda);
if($datos != false){ 
$inerUE=mysql_query('SELECT negocios.* FROM usuarios INNER JOIN negocios ON usuarios.id = negocios.negocioUsuarioId WHERE negocioUsuarioId ='.$datos['id']) or die(mysql_error());
$inerUEdatos=mysql_fetch_array($inerUE);
    header('Location:http://www.pulzos.com/statics/pulzos_desktop/formulario.php?negocioId='.$inerUEdatos['negocioId']);
    //header('Location:http://localhost/pulzos/statics/pulzos_desktop/formulario.php?negocioId='.$inerUEdatos['negocioId']);
}else{
    header('Location:http://www.pulzos.com/statics/pulzos_desktop/index.php');
    //header('Location:http://localhost/pulzos/statics/pulzos_desktop/index.php');
}

?>
