<?php
/**
 * Vista en la cual se ven y se visualizaran todos los
 * valores de las transacciones que se tienen actualmente
 * por parte del usuario, sin importar si son completas o
 * estan pendientes
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
	
	mainmenu(); 
	
    nombre_usuario = $("#nombre-usuario-plan").text();
    $("#nombre-profile").text(nombre_usuario);

    $(".ver_detalle").click(function(event){
        event.preventDefault();
        flag = $(event.currentTarget).attr('flag');
        $("#ver"+flag).hide();
        $("#detalle"+flag).show();
        $("#ocultar"+flag).show();
    });

    $(".ocultar_detalle").click(function(event){
        event.preventDefault();
        flag = $(event.currentTarget).attr('flag');
        $("#ocultar"+flag).hide();
        $("#detalle"+flag).hide();
        $("#ver"+flag).show();
    });
});

function mainmenu(){
// Oculto los submenus
$(" #nav ul ").css({display: "none"});
// Defino que submenus deben estar visibles cuando se pasa el mouse por encima
$(" #nav li").hover(function(){
    $(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
    },function(){
        $(this).find('ul:first').slideUp(400);
    });
}

$("#movimientos_pend").click(function(event){
    event.preventDefault();
    urlMovimientos = $(this).attr('href');
    $('#texto-menu').load(urlMovimientos);
});

$("#edo_cuenta").click(function(event){
    event.preventDefault();
    urlEdoCuenta = $(this).attr('href');
    $("#texto-menu").load(urlEdoCuenta);
});

$("#cantidad-tran").click(function(event){
    event.preventDefault();
    urlCantidad = $(this).attr('href');
    $("#texto-menu").load(urlCantidad);
});

$("#informacion-tran").click(function(event){
    event.preventDefault();
    urlInformacion = $(this).attr('href');
    $("#texto-menu").load(urlInformacion);
});
</script>
<style type="text/css">
#menu {
    height:30px; 
    width:400px; 
    margin: 0px;
}
#nav { 
    list-style:none; 
}
#nav li { 
    float:left; 
	margin:0 1px;
	background:#dccedd;
	color:#660068;
}
#nav li a { 
    display:block; 
    padding:7px 10px;
    text-decoration:none; 
    color:#660068;  
}
#nav li a:hover { 
	background:#660068;
	color:#FFFFFF;
	
}

/* Submenu */
#nav ul.submenu { 
    border:1px solid; 
    position:absolute; 
    list-style:none; 
}
#nav ul.submenu li { 
    float:none;
    margin-left: -20px;
    border-bottom:1px solid #FFFFFF; 
    width:98px;
}



</style>
<div style="display: none">
    <div id="nombre-usuario-plan">
        Movimientos
    </div>
</div>
<div class="span-14">
    <div id="menu">
        <ul id="nav">
            <li style="width: 110px">
                <a href="http://www.pulzos.com/inicio.php/redessociales/redes_sociales_usuarios/<?php echo $this->session->userdata('id'); ?>" style="text-decoration: none;font-family: Arial, Helvetica, sans-serif;">
                    Redes Sociales
                </a>
            </li>
            <li>
                <?php echo anchor('transacciones/movimientos_pendientes/'.$this->session->userdata('id'),
                                  'Movimientos', 
                                   array('style'=>' text-decoration: none; margin-left: 0px', 'id'=>'movimientos_pend')); ?>
            </li>
            <li>
                <?php echo anchor('transacciones/movimientos_cuenta/'.$this->session->userdata('id'),
                                  'Edo. Cuenta',
                                   array('style'=>'text-decoration: none; margin-left: 0px', 'id'=>'edo_cuenta')); ?>

            </li>
            <li style="color: #FFFFFF; text-decoration: none; margin-left: 0px">
            <a style="text-decoration: none; margin-left: 0p">Retiros</a>

                    <ul class="submenu">
                        <li style="border-bottom: 1px solid #FFFFFF">
                            <?php echo anchor('transacciones/transfer',
                                              'Informacion',
                                              array('style'=>'text-decoration: none; ', 'id'=>'informacion-tran')); ?>
                        </li>
                        <li>
                            <?php echo anchor('transacciones/retirar_recursos/',
                                              'Cantidad',
                                              array('style'=>'text-decoration: none; ', 'id'=>'cantidad-tran')); ?>
                        </li>
                    </ul>
            </li>
        </ul>
    </div>
</div>
<div class="span-14 last" style="margin-top: 15px">
    <div class="span-14" style="color: #660068">
        <div class="span-2">
            Fecha
        </div>
        <div class="span-3">
            <span style="margin-left: 10px">
                Negocio
            </span>
        </div>
        <div class="span-4">
            Promocion
        </div>
        <div class="span-3 last">
            Monto $
        </div>
        <div class="span-2">
            &nbsp;
        </div>
    </div>
    <?php $i = 1; ?>
    <?php foreach($movimientos as $movimiento): ?>
        <?php $hst = data_transactions_users($movimiento->usuarioMoneyUsuarioId, $movimiento->moneyNegocioId, $movimiento->moneyFolioFactura); ?>
        <?php $pln = bonifications_data_message_offerts($movimiento->moneyBackOfertaId); ?>
        <?php if(!empty($hst) && !empty($pln)): ?>
            <?php if($i%2 == 0): ?><!-- IF -->
                <?php if($hst->historialStatusDeposito != 2): ?>
                    <div class="span-14" style="background-color: #FFFFFF">
                        <div class="span-2">
                            <?php $fecha = unix_to_human($hst->comisionRecibidaFechaTransaccion); 
                                  $formatoHumano = fecha_acomodo_corto($fecha);
                                  echo $formatoHumano;
                            ?>
                        </div>
                        <div class="span-3">
                            <span style="margin-left: 10px">
                                <?php $empresa = get_data_by_id_bussiness($hst->comisionRecibidaEmpresaId);
                                      echo substr($empresa->negocioNombre, 0, 10). '...';
                                ?>
                            </span>
                        </div>
                        <div class="span-4">
                            <?php if(!empty($pln)): ?>
                                <?php echo substr($pln->planDescripcion, 0, 15).'...'; ?>
                            <?php else: ?>
                                <?php $text_value = "Promocion " . $empresa->negocioNombre; ?>
                                <?php echo substr($text_value, 0, 15) . '...'; ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-3 last" style="color: #FF0000">
                            <?php echo '$ ' . $hst->comisionRecibidaUsuarioBonificacion; ?> MX
                        </div>
                        <div class="span-2 last">
                            <?php echo anchor('',
                                              'Ver Detalle',
                                              array('id'=>'ver'.$hst->comisionRecibidaId, 'style'=>'text-decoration: none; color: #660068', 'class'=>'ver_detalle', 'flag'=>$hst->comisionRecibidaId)); ?>
                            <?php echo anchor('',
                                              'Ocultar Detalle',
                                              array('id'=>'ocultar'.$hst->comisionRecibidaId, 'style'=>'text-decoration: none; color: #660068; display: none; margin-left: -20px', 'class'=>'ocultar_detalle', 'flag'=>$hst->comisionRecibidaId)); ?>
                        </div>
                        <div class="span-14" id="detalle<?php echo $hst->comisionRecibidaId; ?>" style="display: none; margin-top: 3px">
                            <div class="span-13 last">
                                <div class="span-2">
                                    Fecha:
                                </div>
                                <div class="span-11 last">
                                    <?php $fecha_detalle = unix_to_human($hst->comisionRecibidaFechaTransaccion);
                                          $fechaD = fecha_acomodo($fecha_detalle);
                                          echo $fechaD;
                                    ?>
                               </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Negocio:
                                </div>
                                <div class="span-11 last">
                                    <?php echo $empresa->negocioNombre; ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Promocion:
                                </div>
                                <div class="span-11 last">
                                    <?php if(!empty($pln)): ?>
                                        <?php echo $pln->planDescripcion; ?>
                                    <?php else: ?>
                                        <?php $text_value = "Promocion " . $empresa->negocioNombre; ?>
                                        <?php echo $text_value; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Monto:
                                </div>
                                <div class="span-11 last">
                                    <?php echo '$ ' . $hst->comisionRecibidaUsuarioBonificacion; ?> MX
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Status:
                                </div>
                                <div class="span-11 last" style="color: #FF0000">
                                    Pendiente de Deposito
                                </div>
                            </div>
                            <div class="span-13 last" style="margin-top: 3px">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="span-14" style="background-color: #FFFFFF">
                        <div class="span-2">
                            <?php $fecha = unix_to_human($hst->comisionRecibidaFechaTransaccion); 
                                  $formatoHumano = fecha_acomodo_corto($fecha);
                                  echo $formatoHumano;
                            ?>
                        </div>
                        <div class="span-3">
                            <span style="margin-left: 10px">
                                <?php $empresa = get_data_by_id_bussiness($hst->comisionRecibidaEmpresaId);
                                      echo substr($empresa->negocioNombre, 0, 10). '...';
                                ?>
                            </span>
                       </div>
                        <div class="span-4">
                            <?php if(!empty($pln)): ?>
                                <?php echo substr($pln->planDescripcion, 0, 15).'...'; ?>
                            <?php else: ?>
                                <?php $text_value = "Promocion " . $empresa->negocioNombre; ?>
                                <?php echo substr($text_value, 0, 15) . '...'; ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-3 last" style="color: #000000">
                            <?php echo '$ ' . $hst->comisionRecibidaUsuarioBonificacion; ?> MX
                        </div>
                        <div class="span-2 last">
                            <?php echo anchor('',
                                              'Ver Detalle',
                                              array('id'=>'ver'.$hst->comisionRecibidaId, 'style'=>'text-decoration: none; color: #660068', 'class'=>'ver_detalle', 'flag'=>$hst->comisionRecibidaId)); ?>
                            <?php echo anchor('',
                                              'Ocultar Detalle',
                                              array('id'=>'ocultar'.$hst->comisionRecibidaId, 'style'=>'text-decoration: none; color: #660068; display: none; margin-left: -20px', 'class'=>'ocultar_detalle', 'flag'=>$hst->comisionRecibidaId)); ?>
                        </div>
                        <div class="span-14" id="detalle<?php echo $hst->comisionRecibidaId; ?>" style="display: none; margin-top: 3px">
                            <div class="span-13 last">
                                <div class="span-2">
                                    Fecha:
                                </div>
                                <div class="span-11 last">
                                    <?php $fecha_detalle = unix_to_human($hst->comisionRecibidaFechaTransaccion);
                                          $fechaD = fecha_acomodo($fecha_detalle);
                                          echo $fechaD;
                                    ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Negocio:
                                </div>
                                <div class="span-11 last">
                                    <?php echo $empresa->negocioNombre; ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Promocion:
                                </div>
                                <div class="span-11 last">
                                    <?php if(!empty($pln)): ?>
                                        <?php echo $pln->planDescripcion; ?>
                                    <?php else: ?>
                                        <?php $text_value = "Promocion " . $empresa->negocioNombre; ?>
                                        <?php echo $text_value; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Monto:
                                </div>
                                <div class="span-11 last">
                                    <?php echo '$ ' . $hst->comisionRecibidaUsuarioBonificacion; ?> MX
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Status:
                                </div>
                                <div class="span-11 last" style="color: GREEN">
                                    Disponible
                                </div>
                            </div>
                            <div class="span-13 last" style="margin-top: 3px">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?><!-- ELSE PART OF CONFIRM PAYMENT -->
                 <?php if($hst->historialStatusDeposito != 2): ?>
                    <div class="span-14" style="background-color: #C1C1C1">
                        <div class="span-2">
                            <?php $fecha = unix_to_human($hst->comisionRecibidaFechaTransaccion); 
                                  $formatoHumano = fecha_acomodo_corto($fecha);
                                  echo $formatoHumano;
                            ?>
                        </div>
                        <div class="span-3">
                            <span style="margin-left: 10px">
                                <?php $empresa = get_data_by_id_bussiness($hst->comisionRecibidaEmpresaId);
                                      echo substr($empresa->negocioNombre, 0, 10). '...';
                                ?>
                            </span>
                        </div>
                        <div class="span-4">
                            <?php if(!empty($pln)): ?>
                                <?php echo substr($pln->planDescripcion, 0, 15).'...'; ?>
                            <?php else: ?>
                                <?php $text_value = "Promocion " . $empresa->negocioNombre; ?>
                                <?php echo substr($text_value, 0, 15) . '...'; ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-3 last" style="color: #FF0000">
                            <?php echo '$ ' . $hst->comisionRecibidaUsuarioBonificacion; ?> MX
                        </div>
                        <div class="span-2 last">
                            <?php echo anchor('',
                                              'Ver Detalle',
                                              array('id'=>'ver'.$hst->comisionRecibidaId, 'style'=>'text-decoration: none; color: #660068', 'class'=>'ver_detalle', 'flag'=>$hst->comisionRecibidaId)); ?>
                            <?php echo anchor('',
                                              'Ocultar Detalle',
                                              array('id'=>'ocultar'.$hst->comisionRecibidaId, 'style'=>'text-decoration: none; color: #660068; display: none; margin-left: -20px', 'class'=>'ocultar_detalle', 'flag'=>$hst->comisionRecibidaId)); ?>
                        </div>
                        <div class="span-14" id="detalle<?php echo $hst->comisionRecibidaId; ?>" style="display: none; margin-top: 3px">
                            <div class="span-13 last">
                                <div class="span-2">
                                    Fecha:
                                </div>
                                <div class="span-11 last">
                                    <?php $fecha_detalle = unix_to_human($hst->comisionRecibidaFechaTransaccion);
                                          $fechaD = fecha_acomodo($fecha_detalle);
                                          echo $fechaD;
                                    ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Negocio:
                                </div>
                                <div class="span-11 last">
                                    <?php echo $empresa->negocioNombre; ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Promocion:
                                </div>
                                <div class="span-11 last">
                                    <?php if(!empty($pln)): ?>
                                        <?php echo $pln->planDescripcion; ?>
                                    <?php else: ?>
                                        <?php $text_value = "Promocion " . $empresa->negocioNombre; ?>
                                        <?php echo $text_value; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Monto:
                                </div>
                                <div class="span-11 last">
                                    <?php echo '$ ' . $hst->comisionRecibidaUsuarioBonificacion; ?> MX
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Status:
                                </div>
                                <div class="span-11 last" style="color: #FF0000">
                                    Pendiente de Deposito
                                </div>
                            </div>
                            <div class="span-13 last" style="margin-top: 3px">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="span-14" style="background-color: #C1C1C1">
                        <div class="span-2">
                            <?php $fecha = unix_to_human($hst->comisionRecibidaFechaTransaccion); 
                                  $formatoHumano = fecha_acomodo_corto($fecha);
                                  echo $formatoHumano;
                            ?>
                        </div>
                        <div class="span-3">
                            <span style="margin-left: 10px">
                                <?php $empresa = get_data_by_id_bussiness($hst->comisionRecibidaEmpresaId);
                                      echo substr($empresa->negocioNombre, 0, 10). '...';
                                ?>
                            </span>
                        </div>
                        <div class="span-4">
                            <?php if(!empty($pln)): ?>
                                <?php echo substr($pln->planDescripcion, 0, 15).'...'; ?>
                            <?php else: ?>
                                <?php $text_value = "Promocion " . $empresa->negocioNombre; ?>
                                <?php echo substr($text_value, 0, 15) . '...'; ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-3 last" style="color: #000000">
                            <?php echo '$ ' . $hst->comisionRecibidaUsuarioBonificacion; ?> MX
                        </div>
                        <div class="span-2 last">
                            <?php echo anchor('',
                                              'Ver Detalle',
                                              array('id'=>'ver'.$hst->comisionRecibidaId, 'style'=>'text-decoration: none; color: #660068', 'class'=>'ver_detalle', 'flag'=>$hst->comisionRecibidaId)); ?>
                            <?php echo anchor('',
                                              'Ocultar Detalle',
                                              array('id'=>'ocultar'.$hst->comisionRecibidaId, 'style'=>'text-decoration: none; color: #660068; display: none; margin-left: -20px', 'class'=>'ocultar_detalle', 'flag'=>$hst->comisionRecibidaId)); ?>
                        </div>
                        <div class="span-14" id="detalle<?php echo $hst->comisionRecibidaId; ?>" style="display: none; margin-top: 3px">
                            <div class="span-13 last">
                                <div class="span-2">
                                    Fecha:
                                </div>
                                <div class="span-11 last">
                                    <?php $fecha_detalle = unix_to_human($hst->comisionRecibidaFechaTransaccion);
                                          $fechaD = fecha_acomodo($fecha_detalle);
                                          echo $fechaD;
                                    ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Negocio:
                                </div>
                                <div class="span-11 last">
                                    <?php echo $empresa->negocioNombre; ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Promocion:
                                </div>
                                <div class="span-11 last">
                                    <?php if(!empty($pln)): ?>
                                        <?php echo $pln->planDescripcion; ?>
                                    <?php else: ?>
                                        <?php $text_value = "Promocion " . $empresa->negocioNombre; ?>
                                        <?php echo $text_value; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Monto:
                                </div>
                                <div class="span-11 last">
                                    <?php echo '$ ' . $hst->comisionRecibidaUsuarioBonificacion; ?> MX
                                </div>
                            </div>
                            <div class="span-13 last">
                                <div class="span-2">
                                    Status:
                                </div>
                                <div class="span-11 last" style="color: GREEN">
                                    Disponible
                                </div>
                            </div>
                            <div class="span-13 last" style="margin-top: 3px">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?><!-- END IF -->
        <?php endif; ?>
        <?php $i++; ?>
    <?php endforeach; ?>
    <div class="span-14" style="margin-top: 20px">
        &nbsp;
    </div>
</div>
