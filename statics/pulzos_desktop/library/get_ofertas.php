<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include ('conexion.php');
if(isset($_REQUEST['idNegocio'])){
    $idNegocio=$_REQUEST['idNegocio'];
    $b=$db->Execute('SELECT * FROM ofertas_negocios WHERE idNegocioOferta="'.$idNegocio.'" AND ofertaActivacion=1');
    $ofertaNegocio=$b->FetchNextObj();
    if(empty($ofertaNegocio)){
        false;
    }else{
    echo $ofertaNegocio->bonificaPorcentaje;
    }
}else if(isset($_REQUEST['negocioId'])){
    $idNegocio=$_REQUEST['negocioId'];
    $b=$db->Execute('SELECT * FROM ofertas_negocios WHERE idNegocioOferta="'.$idNegocio.'" AND ofertaActivacion=1');
    $ofertaNegocio=$b->FetchNextObj();
    if(empty($ofertaNegocio)){
        false;
    }else{
        echo $ofertaNegocio->consumoMinimo;
    }
}else if(isset($_REQUEST['idNStatus'])){
    $idNegocio=$_REQUEST['idNStatus'];
    $b=$db->Execute('SELECT * FROM ofertas_negocios WHERE idNegocioOferta="'.$idNegocio.'" AND ofertaActivacion=1');
    $ofertaNegocio=$b->FetchNextObj();
    if(empty($ofertaNegocio)){
        false;
    }else{
        echo $ofertaNegocio->statusTipoBonificacion;
        
    }
    
}else if(isset($_REQUEST['idNOStatus'])){
    $arreglo=array();
    $idNegocio=$_REQUEST['idNOStatus'];
    $b=$db->Execute('SELECT
                        ofertas_negocios.*,
                        planesusuarios.planDescripcion
                        FROM
                        ofertas_negocios
                        INNER JOIN planesusuarios ON planesusuarios.planId = ofertas_negocios.idPlanUsuarioOfertaNegocio
                        WHERE idNegocioOferta = '.$idNegocio.' AND ofertaActivacion = 1');
    
    $ofertaNegocio=$b->FetchNextObj();
    if(empty($ofertaNegocio)){
        false;
    }else{
        foreach($b as $w){
             $arreglo[] = $w;
        }
        echo json_encode($arreglo);
    }
    //AQUI INFORMACION DE USUARIO DE MOSTRADOR
    
    }else if(isset($_REQUEST['idNOMostrador'])){
    $arreglo=array();
    $idNegocio=$_REQUEST['idNOMostrador'];
    $b=$db->Execute("SELECT CONCAT(nombre,' ',apellidos) AS nCompleto, usuarios_mostrador.idusuarios_mostrador, usuarios_mostrador.idUsuarioPulzos 
                        FROM  usuarios_mostrador
                        INNER JOIN usuarios ON usuarios_mostrador.idUsuarioPulzos = usuarios.id
                        WHERE idNegocio = ".$idNegocio);
    
    $ofertaNegocio=$b->FetchNextObj();
    if(empty($ofertaNegocio)){
        false;
    }else{
        foreach($b as $w){
             $arreglo[] = $w;
        }
        echo json_encode($arreglo);
    }
    
}else if(isset($_REQUEST['idOferta'])){
    $b=$db->Execute('SELECT * FROM ofertas_negocios WHERE ofertaId="'.$_REQUEST['idOferta'].'" AND ofertaActivacion=1');
    $ofertaNegocio=$b->FetchNextObj();
    if(empty($ofertaNegocio)){
        false;
    }else{
        echo json_encode($ofertaNegocio);
        //echo $ofertaNegocio->statusTipoBonificacion.'-'.$ofertaNegocio->bonificaPorcentaje.'-'.$ofertaNegocio->statusIva;
    }
}else if (isset($_REQUEST['idOfertaFijo'])){
    $b=$db->Execute('SELECT * FROM ofertas_negocios WHERE ofertaId="'.$_REQUEST['idOfertaFijo'].'" AND ofertaActivacion=1');
    $ofertaNegocio=$b->FetchNextObj();
    if(empty($ofertaNegocio)){
        false;
    }else{
        echo $ofertaNegocio->bonificaPorcentaje;   
    }
}
?>
