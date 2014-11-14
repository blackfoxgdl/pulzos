<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('conexion.php');
$idNegocio=$_POST['idNegocio'];
$red=mysql_query('SELECT * FROM social_media_empresa where socialEmpresaUsuarioId ='.$idNegocio) or die(mysql_error());
$redSocial=mysql_fetch_array($red);
echo $redSocial['mensajeFacebook'].':'.$redSocial['mensajeTwitter'];
?>
