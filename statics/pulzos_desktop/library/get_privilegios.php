<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include ('conexion.php');

if(isset($_REQUEST['erase'])){
     $db->Execute('DELETE FROM usuarios_mostrador WHERE idusuarios_mostrador ='.$_REQUEST['erase']) or die(mysql_error());
     echo "Empleado eliminado con éxito";
//VERIFICAR SI UN USUARIO YA ESTA REGISTRADO
}else if(isset($_REQUEST['email'])){
//VERIFICAR REGISTRADO ONO COMO EMPLEADO
    $user=$db->Execute('Select * from usuarios_mostrador WHERE email="'.$_REQUEST['email'].'"') or die (mysql_error());
    $users=$user->FetchNextObj();    
//CUANDO ES UN NEGOCIO
     $b = $db->Execute('SELECT * FROM usuarios WHERE email="'.$_REQUEST['email'].'" and statusEU=1');
     $j=$b->FetchNextObj();
//CUANDO NO ESTA EN LA BASE DE DATOS
     $t=$db->Execute('SELECT * FROM usuarios WHERE email="'.$_REQUEST['email'].'" and statusEU=0');
     $p=$t->FetchNextObj();
        if($users==true){
            echo "0";
        }else if($j==true){
            echo "1";
        }else if($p==false){
            echo "2";
        }
}

?>
