<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('conexion.php');
$folio=$_REQUEST['folio'];
$idNegocio=$_REQUEST['idNegocio'];
$b=$db->Execute('SELECT * FROM money_back WHERE moneyFolioFactura="'.$folio.'" AND moneyNegocioId="'.$idNegocio.'"');
//$select=mysql_query('SELECT * FROM money_back WHERE moneyFolioFactura="'.$folio.'" AND moneyNegocioId="'.$idNegocio.'"',$conexion);
//$row=mysql_fetch_array($select);
$row=$b->FetchNextObj();
if($row!=''){
    echo '1';    
}else{
    echo '0';
}
$db->Close();

?>