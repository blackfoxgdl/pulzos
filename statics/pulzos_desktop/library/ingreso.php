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
$u= $db->Execute('Select * FROM usuarios WHERE email="'.$email.'" and statusEU=1');
$aU=$u->FetchNextObj();
$p= $db->Execute('Select * FROM usuarios WHERE password="'.$password.'" and statusEU=1');
$pU=$p->FetchNextObj();
//Asociados
//$asociado =& $db->Execute("SELECT * FROM usuarios_mostrador Where email = '".$email."' and password = '".$password."'") or die (mysql_error());
$asociado = $db->Execute("SELECT usuarios_mostrador.*, negocios.* FROM usuarios_mostrador LEFT JOIN negocios ON usuarios_mostrador.idNegocio = negocios.negocioId Where email = '".$email."' and password = '".$password."'");
$asociados=$asociado->FetchNextObj();
if($asociados==true){
    
    //session_start();
    //$_SESSION['login']=$asociados->idusuarios_mostrador;
    //session_register('idSession');
    $url='http://localhost/pulzos/statics/pulzos_desktop/templateA.php?negocioId='.$asociados->idNegocio.'&negocioUsuarioId='.$asociados->negocioUsuarioId.'&idMostrador='.$asociados->idusuarios_mostrador;
    //$url='http://www.pulzos.com/statics/pulzos_desktop/templateA.php?negocioId='.$asociados->idNegocio.'&negocioUsuarioId='.$asociados->negocioUsuarioId.'&idMostrador='.$asociados->idusuarios_mostrador;
    echo "1|".$url;
}else if($aU==false){
    echo "u";
}else if($pU==false){
    echo "p";
}else{
    $b =& $db->Execute('Select * from usuarios WHERE email="'.$email.'" and password="'.$password.'" and statusEU=1');
    $array = $b->FetchNextObj();
    if($array != false){
        //session_start();
        //$_SESSION['login']=$inerUEdatos->negocioId;
        //setcookie("login",$inerUEdatos->negocioId,time()+3600);
        
        $inerUE =& $db->Execute('SELECT negocios.* FROM usuarios INNER JOIN negocios ON usuarios.id = negocios.negocioUsuarioId WHERE negocioUsuarioId ='.$array->id) or die(mysql_error());
        $inerUEdatos = $inerUE->FetchNextObj();
        //$url='http://www.pulzos.com/statics/pulzos_desktop/template.php?negocioId='.$inerUEdatos->negocioId.'&negocioUsuarioId='.$inerUEdatos->negocioUsuarioId;
        $url='http://localhost/pulzos/statics/pulzos_desktop/template.php?negocioId='.$inerUEdatos->negocioId.'&negocioUsuarioId='.$inerUEdatos->negocioUsuarioId;
        echo "1|".$url;    
    }else{
        echo "0";
    }
}
?>
