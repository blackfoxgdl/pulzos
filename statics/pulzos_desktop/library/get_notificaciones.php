<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('conexion.php');

if(isset($_GET['msj'])){
$id=$_GET['msj'];
$query='SELECT COUNT(inboxnId) as contador FROM inboxn LEFT JOIN negocios ON inboxn.inboxnUsuarioRecibeId = negocios.negocioUsuarioId WHERE negocioId ='.$id.' and inboxnStatus=1';
$r=$db->Execute($query);
$q=$r->FetchNextObj();
print_r($q->contador);
}

elseif(isset($_GET['cuenta'])){
    print_r('?');
}

?>