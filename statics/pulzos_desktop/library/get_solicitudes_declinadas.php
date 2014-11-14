<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include ('conexion.php');
$idNegocio=$_GET['idNegocio'];
$inbxn=mysql_query('SELECT inboxn.*, CONCAT_WS(" ",nombre, apellidos) as nombreCompleto
                        FROM
                        inboxn
                        LEFT JOIN usuarios ON inboxn.inboxnUsuarioId = usuarios.id
                        WHERE  inboxn.inboxnUsuarioId = '.$idNegocio.' and inboxn.inboxnMoneyStatus = 3') or die (mysql_error());

//if($inboxS=mysql_fetch_array($inbxn)==''){ echo "No hay solicitudes Declinadas"; }else{
    while($inboxS=mysql_fetch_array($inbxn)){
        echo '<h3>'.$inboxS['nombreCompleto'].'</h3>'.$inboxS['inboxnMensaje'].'<br><br>';
  //  }
}
?>
