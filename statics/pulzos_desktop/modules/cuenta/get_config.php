<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('../../library/conexion.php');
if(isset($_GET['idNegocio'])){
$idNegocio=$_GET['idNegocio'];
//Informacion del negocio
    $query1='SELECT * FROM negocios WHERE negocioId ='.$idNegocio;
    $i=$db->Execute($query1) or die(mysql_error());
    $info=$i->FetchNextObj();
    
//Ofertas del negocio
    $query2='SELECT ofertas_negocios.ofertaId, social_media_empresa.mensajeFacebook, social_media_empresa.mensajeTwitter, ofertas_negocios.consumoMinimo, ofertas_negocios.bonificaPorcentaje, ofertas_negocios.tipoDescuento, ofertas_negocios.ofertaActivacion, ofertas_negocios.statusTipoBonificacion, planesusuarios.planDescripcion as nombreOferta
                            FROM social_media_empresa
                                LEFT JOIN ofertas_negocios ON social_media_empresa.socialEmpresaId = ofertas_negocios.idMensajeOferta
                                LEFT JOIN planesusuarios ON ofertas_negocios.idPlanUsuarioOfertaNegocio = planesusuarios.planId
                            WHERE idNegocioOferta= '.$idNegocio.' ORDER BY ofertaId DESC';//' ORDER BY idNegocioOferta DESC';
    $b=$db->Execute($query2);
    $ofertas=$b->GetArray();

/*
 *
 * Seccion para las ofertas 
 * 
 */        
//Obtener todas las ofertas activas, no activas y eliminadas regresando un json (**configuracion de cuenta**)
}else if(isset($_REQUEST['todasOfertas'])){
    $idNegocio=$_REQUEST['todasOfertas'];
    $arreglo=array();
    
    $b=$db->Execute('SELECT ofertas_negocios.ofertaId, social_media_empresa.mensajeFacebook, social_media_empresa.mensajeTwitter, ofertas_negocios.consumoMinimo, ofertas_negocios.bonificaPorcentaje, ofertas_negocios.tipoDescuento, ofertas_negocios.ofertaActivacion, ofertas_negocios.statusTipoBonificacion, planesusuarios.planDescripcion as nombreOferta
                        FROM social_media_empresa
                            LEFT JOIN ofertas_negocios ON social_media_empresa.socialEmpresaId = ofertas_negocios.idMensajeOferta
                            LEFT JOIN planesusuarios ON ofertas_negocios.idPlanUsuarioOfertaNegocio = planesusuarios.planId
                        WHERE idNegocioOferta='.$idNegocio.' ORDER BY idNegocioOferta');
     
    $ofertaNegocio=$b->FetchNextObj();
    if(empty($ofertaNegocio)){
        false;
    }else{
        foreach($b as $w){
             $arreglo[] = $w;
        }
        echo json_encode($arreglo);
    }
//Actualiza el Estatus de las ofertas de activas-No activas y eliminadas
}else if(isset($_POST['change'])){
 $change['ofertaActivacion']=$_POST['change'];
 $id= $_POST['id'];
 $db->AutoExecute('ofertas_negocios', $change, 'UPDATE', 'ofertaId = '.$id) or die(mysql_error);
 echo 'Oferta Eliminada con éxito';

 /*
 * 
 * Seccion privilegios(Empleados) 
 * 
 */
 
//Borrar el empleado
}else if(isset($_REQUEST['erase'])){
     $db->Execute('DELETE FROM usuarios_mostrador WHERE idusuarios_mostrador ='.$_REQUEST['erase']) or die(mysql_error());
     echo "Empleado eliminado con éxito";

//Select PARA ACTUALIZAR SOLO EL DIV CUANDO SE HALLA INSERTADO UN EMPLEADO   
}else if(isset($_REQUEST['empleados'])){
$idNegocio=$_REQUEST['empleados'];

$user=$db->Execute('SELECT * FROM( SELECT usuarios_mostrador.*, imagenes_thumb.*, usuarios.nombre FROM usuarios_mostrador
LEFT JOIN imagenes_thumb ON usuarios_mostrador.idUsuarioPulzos = imagenes_thumb.thumbUsuarioId
INNER JOIN usuarios ON usuarios.id = thumbUsuarioId 
WHERE idNegocio = "'.$idNegocio.'" ORDER BY thumbUsuarioId DESC ) AS priv GROUP BY idusuarios_mostrador') or die (mysql_error());
$e=$user->GetArray();

foreach($e as $u){
$c=explode('./statics',$u['usuarioThumbName']); 

echo '<div class="empleados" >
               <img id="'.$u['idusuarios_mostrador'].'" src="img/erase.png" width="16" height="16" style="float: right; margin-right:5px;margin-top:5px;cursor:pointer;" onclick="options(this.id)" />
               
               <div style="margin-left: 10px;margin-top: 10px">
                   <div style="float:left;width:55px;height: 65px;">
                        <img src="..'.$c[1].'" width="45"  height="55"/>
                   </div>
                   '.$u["nombre"].'
               </div>
               
</div> '; 
}

//VERIFICAR SI UN USUARIO YA ESTA REGISTRADO
}else if(isset($_REQUEST['email'])){
//VERIFICAR REGISTRADO O NO COMO EMPLEADO
    $user=$db->Execute('Select * from usuarios_mostrador WHERE email="'.$_REQUEST['email'].'"') or die (mysql_error());
    $users=$user->FetchNextObj();    
//CUANDO ES UN NEGOCIO
     $b = $db->Execute('SELECT * FROM usuarios WHERE email="'.$_REQUEST['email'].'" and statusEU=1');
     $j=$b->FetchNextObj();
//CUANDO NO ESTA EN LA BASE DE DATOS
     $t=$db->Execute('SELECT * FROM usuarios WHERE email="'.$_REQUEST['email'].'" and statusEU=0');
     $p=$t->FetchNextObj();
        if($users==true){
            print_r("0");
        }else if($j==true){
            print_r('1');
        }else if($p==false){
            print_r('2');
        }
 
}else if(isset($_POST['mostrador'])){
    $m=$_POST['mostrador'];
    $password=$m['password'];$secret='ElAxolot3d34ccion3smi43r003';
    $m['password']=sha1($secret.$password);
        unset($m['confPass']);
        $m['statusMostrador']='1';
        $db->AutoExecute('usuarios_mostrador',$m,'INSERT');
/*
 * Actualizar datos de la empresa
 */        
}else if(isset($_POST['datosNegocio'])){
    $datos=$_POST['datosNegocio'];
    
    $update=array(
    'negocioNombre'=>$datos['nombre'],
    'negocioDireccion'=>$datos['direccion'],
    'negocioDescripcion'=>$datos['descripcion'],
    'negocioEmail'=>$datos['email'],
    'negocioTelefono'=>$datos['telefono'],
    'negocioSitioWeb'=>$datos['sitioweb']);
$db->AutoExecute('negocios', $update, 'UPDATE', 'negocioId = '.$datos['idNegocio']) or die(mysql_error());
    
}else if(isset($_POST['idGeo'])){
    $b = $db->Execute('SELECT negocios.negocioLatitud, negocios.negocioLongitud, negocios.negocioId FROM negocios Where  negocioId ='.$_POST['idGeo']);
    $j=$b->FetchNextObj();
    if(($j->negocioLatitud!='' || $j->negocioLongitud!='')){
       echo $j->negocioLatitud.'_'.$j->negocioLongitud;
       
    }else{
        print_r('empty');
    }
}else if(isset($_POST['geo'])){
    $datos=$_POST['geo'];
    $update=array('negocioLatitud'=>$datos['latitud'], 'negocioLongitud'=>$datos['longitud']);
    $db->AutoExecute('negocios', $update, 'UPDATE', 'negocioId = '.$datos['idN']) or die(mysql_error());
}

$db->Close();

?>

