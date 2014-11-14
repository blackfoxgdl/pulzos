<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/html; charset=UTF-8');
include('../../library/conexion.php');

$idNegocio=$_REQUEST['idNegocio'];
$idNUsuario=$_REQUEST['idNUsuario'];
$titulo=$_REQUEST['titulo'];
$consumo = /*$_REQUEST['consumo'];*/'0';
$porcentaje=$_REQUEST['porcentaje'];
$facebook=$_REQUEST['facebook'];
$twitter=$_REQUEST['twitter'];
$imagen="http:--www.pulzos.com-statics-img_negocios-4-2-02e7fea1832cc6d44dca7999fccd60ad.jpg";
if(isset($_REQUEST['fijo'])){
    $status=$_REQUEST['fijo'];
    
}else if(isset($_REQUEST['porcentaje'])){
    $status=$_REQUEST['porcentaje'];
}
if(isset($_REQUEST['iva'])){
    $ivas = $_REQUEST['iva'];
}
else
{
    $ivas = 3;
}



$nombre="nombre";

//echo $idNegocio.'<br>'.$consumo.'<br>'.$porcentaje.'<br>'.$facebook.'<br>'.$twitter;


//Insertar registros en La tabla de social Empresa
$insrt=mysql_query("INSERT INTO social_media_empresa VALUES ('','','','','','".$facebook."','".$twitter."','','".$idNegocio."') ") or die (mysql_error());
$last=mysql_insert_id();
echo $last.'<br>';

//Actualiza para desactivar la oferta activa en 0
//mysql_query('UPDATE ofertas_negocios SET ofertaActivacion=0  WHERE idNegocioOferta = '.$idNegocio);

//Insertar en Pulzos

mysql_query("INSERT INTO pulzos VALUES('','".$idNegocio."','0','0','".$titulo."','0','','','','','','0','0','0','4','0','0','0','','3','".time()."','','') ") or die (mysql_error());
$lastPulzo=mysql_insert_id();
echo $lastPulzo.'<br>';

//Insertar en Scrible
mysql_query("INSERT INTO scribbles_comments VALUES('','".$idNUsuario."','".$titulo."','0','0','".$nombre."','".$imagen."','0','0','0','0','0','0','0') ") or die (mysql_error());;
$lastScrible=mysql_insert_id();
echo $lastScrible.'<br>';

//Inserta en la tabla de planesusuarios
mysql_query("INSERT INTO planesusuarios VALUES('','".$idNUsuario."','0','','','0','','','','','".$titulo."','".time()."','','','','0','','".$idNegocio."','".$lastPulzo."','','".$lastScrible."') ") or die (mysql_error());
//mysql_query("INSERT INTO planesusuarios VALUES('','".$idNUsuario."','0','0','','0','0','0','0','0','".$titulo."','".time()."','','','','0','0','".$idNegocio."','planEmpresaPulzoId','planVirtual','planScribbleId')" );
$lasPlan=mysql_insert_id();
echo $lasPlan.'<br>';
//Inserta en la tabla de ofertanegocio
mysql_query("INSERT INTO ofertas_negocios VALUES ('','".$consumo."','".$porcentaje."','1','".$idNegocio."','".$last."','1','".$status."', '".$lasPlan."','" . $ivas . "')") or die (mysql_error());
?>
