<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('conexion.php');
$idN=$_REQUEST['idN'];
$referenceNumber = $_REQUEST['rn'];
$nombreN='SELECT negocioNombre FROM negocios INNER JOIN historialDeposito ON historialEmpresaId = negocioId WHERE idHistorial='.$idN;
$nN=$db->Execute($nombreN) or die (mysql_error());
$n=$nN->FetchNextObj();

$n_sinEspacio=str_replace(" ", "", $n->negocioNombre);
$timestamp = date('dmYHis');
$nReferencia['historialCodigo']=sha1($n_sinEspacio.$timestamp);
$nStatus['historialStatusDeposito']='1';
$nreferenceNumber['historialDepositoReferencia'] = $referenceNumber;
echo sha1($n_sinEspacio.$timestamp);
$db->AutoExecute('historialDeposito', $nReferencia, 'UPDATE', 'idHistorial = '.$idN);
$db->AutoExecute('historialDeposito', $nStatus, 'UPDATE', 'idHistorial = '.$idN);
$db->AutoExecute('historialDeposito', $nreferenceNumber, 'UPDATE', 'idHistorial = '.$idN);
?>
