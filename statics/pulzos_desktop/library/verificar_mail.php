<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('conexion.php');
if(isset($_REQUEST['email'])){
    $email=$_REQUEST['email'];
    $b = $db->Execute('SELECT * FROM usuarios WHERE email="'.$email.'" and statusEU=0');
    $row= $b->FetchNextObj();
    (!empty($row))? print_r(base64_encode($row->id)):"";
}
$db->Close();

?>
