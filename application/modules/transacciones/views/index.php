<?php
/**
 * Vista que se usa para realizar el volcado de todos los
 * registros que se tienen de las transacciones que se han
 * hecho y se han completado
 **/
?>
<?php echo link_tag('statics/css/ext/jquery.confirm.css'); ?>
<style type="text/css">
</style>
<script type="text/javascript" src="<?php echo base_url().'statics/js/confirm.jquery.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
});

$(".ver-opciones").click(function(event){
    event.preventDefault();
    ids = $(event.currentTarget).attr('id');
    $("#desglose"+ids).show();
});

$(".ocultar-opciones").click(function(event){
    event.preventDefault();
    ids = $(event.currentTarget).attr('id');
    $("#desglose"+ids).hide();
});

$(".depositar").click(function(event){
    event.preventDefault();
    value = $(event.currentTarget).attr("flag");
    urlSent = $(event.currentTarget).attr('href');
    urlUpdate = $("#updateReference"+value).attr('href');
    //alert(urlUpdate);
    data_save = $("#noReferenciaBNK"+value).val();
    if(data_save != '')
    {
        $.confirm({
			'title'		: 'Confirmacion de Deposito',
			'message'	: 'Seguro que deseas confirmar el deposito bancario? <br /> No. Referencia: ' + data_save,
			'buttons'	: {
				'Aceptar'	: {
					'class'	: 'blue',
					'action': function(){
                        sendUrlUpdate = urlUpdate + '/' + value + '/' + data_save;
                        $.get(sendUrlUpdate);
                        $.get(urlSent,
                              function(data){
                                  $("#code"+value).text(data.substring(0,15)+"....");
                              });
                        atributo = "#depositacion"+value;
                        $(atributo).hide();
					}
				},
				'Cancelar'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		}); 
    }
    else
    {
        $("#alert").html('Ingrese el No. de referencia de su Ficha de Deposito.').slideDown('slow', function(){
            setTimeout(function(){
                $("#alert").slideUp('slow');
                $("#noReferenciaBNK").focus();
            }, 1500);
        });
        return false;
    }
});

$('.detalle_open_historial').click(function(event){
    event.preventDefault();
    id = $(event.currentTarget).attr('flag');
    $("#ver"+id).hide();
    $("#desglose_personal"+id).show();//desglose_personal"+id).show();dos
    $("#ocultar"+id).show();
});

$('.detalle_close_historial').click(function(event){
    event.preventDefault();
    id = $(event.currentTarget).attr('flag');
    $("#ocultar"+id).hide();
    $("#desglose_personal"+id).hide();//desglose_personal"+id).hide();dos
    $("#ver"+id).show();
});

$(".cerrar").click(function(event){
    event.preventDefault();
    $("#uno").hide();
});

$(".abrir").click(function(event){
    event.preventDefault();
    $("#uno").show();
});
</script>
<div style="display: none">
    <div id="nombre-usuario-plan">Estado de Cuenta</div>
</div>
<div id="alert" class="redondeo-div-inferior" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#FFFFFF;display:none;text-align:center;margin-top: 1px;background-color:#996699;width: 370px; height: 28px;margin-left: 85px;line-height:28px;">
</div>
<div class="span-14" style="margin-top: 20px; margin-bottom: 10px"> 
    <?php if(empty($todos)): ?>
    <?php else: ?>
        <div class="span-13 last" style="color: #660066"><!-- CABECERA IDENTIFICADORA **INICIO** -->
            <div class="span-14">
                <div class="span-3">
                    No. Referencia
                </div>
                <div class="span-3">
                    Total Bonificacion
                </div>
                <div class="span-2">
                    Fecha Inicio
                </div>
                <div class="span-2">
                    Fecha Fin
                </div>
                <div class="span-2" style="margin-left: 20px">
                    Opciones
                </div>
            </div>
        </div><!-- CABECERA IDENTIFICADORA **FIN** -->
        <?php $i = 1; ?>
        <?php foreach($todos as $history): ?>
            <?php echo anchor('transacciones/update_number_reference', '', array('id'=>'updateReference'.$history->idHistorial, 'style'=>'display: none')); ?>
            <?php if($i%2 == 0): ?>
                <div class="span-13 last" style="background-color: #FFFFFF"><!-- CONTENEDOR MAIN DEL CUERPO DINAMICO **INICIO** -->
                    <div class="span-14 last" style="color: #7F7D7D"><!-- CONTENEDOR SECUNDARIO DEL CUERPO DINAMICO **INICIO** -->
                       <div class="span-3" id="code<?php echo $history->idHistorial; ?>">
                            <?php echo substr($history->historialCodigo, 0, 15).'...'; ?>
                        </div>
                        <div class="span-3">
                            <?php echo "$ " . $history->historialTotalQuincenal . " MX"; ?>
                        </div>
                        <div class="span-2">
                            <?php $newFechaInicio = unix_to_human($history->historialFechaInicio);
                                  $formatoFechaInicio = fecha_acomodo_corto($newFechaInicio);
                                  echo $formatoFechaInicio;
                            ?>
                        </div>
                        <div class="span-2">
                            <?php $newFechaFin = unix_to_human($history->historialFechaFin);
                                  $formatoFechaFin = fecha_acomodo_corto($newFechaFin);
                                  echo $formatoFechaFin;
                            ?>
                        </div>
                        <div class="span-3 last">
                            <div class="span-4 last">
                                <div class="span-2 last">
                                    <?php echo anchor('#',
                                                      'Ver Mas',
                                                      array('style'=>'text-decoration: none; color: #660066; margin-left: 10px', 'class'=>'ver-opciones', 'id'=>$history->idHistorial)); ?>
                                </div>
                                <div class="span-1">
                                    <?php echo anchor('#',
                                                      'Ocultar',
                                                      array('style'=>'text-decoration: none; color: #660066; margin-left: 0px', 'class'=>'ocultar-opciones', 'id'=>$history->idHistorial)); ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- CONTENEDOR SECUNDARIO DEL CUERPO DINAMICO **FIN** --> 
                    <div class="span-13 last" style="display: none; margin-top: 15px" id="desglose<?php echo $history->idHistorial; ?>"><!-- CUERPO DE LOS MENSAJES DE LOS DATOS DESGLOSADO POR USUARIO **INICIO** -->
                        <div class="span-14 last" style="color: #660066">
                            <div class="span-3">
                                No. Referencia
                            </div>
                            <div class="span-3">
                                Usuario
                            </div>
                            <div class="span-3">
                                Folio/Factura
                            </div>
                            <div class="span-3">
                                Bonificacion
                            </div>
                            <div class="span-2">
                                &nbsp;
                            </div>
                        </div>
                        <?php $desglose = get_individual_data($history->idHistorial); ?>
                        <?php $j = 1; ?>
                        <?php foreach($desglose as $individual): ?> 
                            <?php if($j%2 == 0): ?>
                                <div class="span-14 last" style="color: #7F7D7D"><!-- CONTENEDOR MAIN DEL CUERPO DEL DESGLOSE **INICIO** -->
                                    <div class="span-13" style="background-color: #DCDCDC">
                                        <div class="span-3">
                                            <?php echo substr($individual->comisionRecibidaNumeroReferencia, 0, 15) . '...'; ?>
                                        </div>
                                        <div class="span-3">
                                            <?php echo get_user_name($individual->comisionRecibidaUsuarioId); ?>
                                        </div>
                                        <div class="span-3">
                                            <?php echo substr($individual->comisionRecibidaFolioTransaccion, 0, 10) . '...'; ?>
                                        </div>
                                        <div class="span-2">
                                            <?php echo "$ " . number_format($individual->comisionRecibidaUsuarioBonificacion, 2, '.', '') . " MX"; ?>
                                        </div>
                                        <div class="span-1 last">
                                            <div class="span-5">
                                                <?php echo anchor('#',
                                                                  'Ver detalle',
                                                                  array('style'=>'color: #660066; text-decoration: none', 'id'=>'ver'.$individual->comisionRecibidaId, 'class'=>'detalle_open_historial', 'flag'=>$individual->comisionRecibidaId)); ?>
                                                <?php echo anchor('#',
                                                                  'Ocultar detalle',
                                                                  array('style'=>'color: #660066; text-decoration: none; display: none; margin-left: -10px', 'id'=>'ocultar'.$individual->comisionRecibidaId, 'class'=>'detalle_close_historial', 'flag'=>$individual->comisionRecibidaId)); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="desglose_personal<?php echo $individual->comisionRecibidaId; ?>" style="display: none">
                                        <div class="span-13 last" style="background-color: #DCDCDC; padding-top: 5px; padding-bottom: 5px">
                                            <div class="span-13">   
                                                <div class="span-3" style="color: #660066">
                                                    Nombre:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo get_user_name($individual->comisionRecibidaUsuarioId); ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div clasS="span-3" style="color: #660066">
                                                    Folio:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo $individual->comisionRecibidaFolioTransaccion; ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div class="span-3" style="color: #660066">
                                                    Bonificaci&oacute;n:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo '$ ' . number_format($individual->comisionRecibidaUsuarioBonificacion, 2, '.', '') . ' MX'; ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div class="span-3" style="color: #660066">
                                                    No. Referencia:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo $individual->comisionRecibidaNumeroReferencia; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- CONTENEDRO MAIN DEL CUERPO DEL DESGLOSE **FIN** -->
                            <?php else: ?>
                                <div class="span-14 last" style="color: #7F7D7D"><!-- CONTENEDOR MAIN DEL CUERPO DEL DESGLOSE **INICIO** -->
                        
                                    <div class="span-3">
                                        <?php echo substr($individual->comisionRecibidaNumeroReferencia, 0, 15) . '...'; ?>
                                    </div>
                                    <div class="span-3">
                                        <?php echo get_user_name($individual->comisionRecibidaUsuarioId); ?>
                                    </div>
                                    <div class="span-3">
                                        <?php echo substr($individual->comisionRecibidaFolioTransaccion, 0, 10) . '...'; ?>
                                    </div>
                                    <div class="span-2">
                                        <?php echo "$ " . number_format($individual->comisionRecibidaUsuarioBonificacion, 2, '.', '') . " MX"; ?>
                                    </div>
                                    <div class="span-1 last">
                                        <div class="span-5">
                                            <?php echo anchor('#',
                                                              'Ver detalle',
                                                              array('style'=>'color: #660066; text-decoration: none', 'id'=>'ver'.$individual->comisionRecibidaId, 'class'=>'detalle_open_historial', 'flag'=>$individual->comisionRecibidaId)); ?>
                                            <?php echo anchor('#',
                                                              'Ocultar detalle',
                                                              array('style'=>'color: #660066; text-decoration: none; display: none; margin-left: -10px', 'id'=>'ocultar'.$individual->comisionRecibidaId, 'class'=>'detalle_close_historial', 'flag'=>$individual->comisionRecibidaId)); ?>
                                        </div>
                                    </div>
                                    <div id="desglose_personal<?php echo $individual->comisionRecibidaId; ?>" style="display: none">
                                        <div class="span-13 last" style="padding-top: 5px; padding-bottom: 5px">
                                            <div class="span-13">   
                                                <div class="span-3" style="color: #660066">
                                                    Nombre:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo get_user_name($individual->comisionRecibidaUsuarioId); ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div clasS="span-3" style="color: #660066">
                                                    Folio:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo $individual->comisionRecibidaFolioTransaccion; ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div class="span-3" style="color: #660066">
                                                    Bonificaci&oacute;n:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo '$ ' . number_format($individual->comisionRecibidaUsuarioBonificacion, 2, '.', '') . ' MX'; ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div class="span-3" style="color: #660066">
                                                    No. Referencia:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo $individual->comisionRecibidaNumeroReferencia; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- CONTENEDRO MAIN DEL CUERPO DEL DESGLOSE **FIN** -->
                            <?php endif; ?>
                            <?php $j++; ?>
                        <?php endforeach; ?>
                    </div><!-- CUERPO DE LOS MENSAJES DE LOS DATOS DESGLOSADO POR USUARIO **FIN** -->
                    <?php 
                        $dia = date('d');
                        $mes = date('m');
                        $date_ini = date('d-m-Y', $history->historialFechaInicio);
                        $date_fin = date('d-m-Y', $history->historialFechaFin);
                        $recorte_ini = explode('-', $date_ini);
                        $recorte_fin = explode('-', $date_fin);
                    ?>
                    <!-- IF'S FOR CHECK THE SHOWING BUTTON **START** -->
                    <?php if(($recorte_ini[0] == '01') && ($recorte_fin[0] == '15')): ?>
                    <!-- START OF FIRST IF -->
                        <?php if((($recorte_ini[1] == $mes) && ($recorte_fin[1] == $mes) && ($recorte_fin[0] == '15')) || (($recorte_ini[1] > $mes) && ($recorte_fin[1] > $mes))): ?>
                            <?php if($history->historialStatusDeposito == 0): ?>
                                <div class="prepend-4 span-10" id="depositacion<?php echo $history->idHistorial; ?>">
                                    <div class="span-7 last" style="margin-top: 10px">
                                        <?php echo form_label('# Referencia: ', 'noReferneciaFichaDeposito'); ?>
                                        <?php echo form_input(array('id'=>'noReferenciaBNK'.$history->idHistorial,
                                                                    'class'=>'numeroReferenciaBNK',
                                                                    'name'=>'noReferenciaBnk',
                                                                    'style'=>'')); ?>
                                    </div>
                                    <div class="span-2 redondeo-menu" style="text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px;margin-top:10px">
                                        <?php echo anchor('transacciones/actualizar_transaccion/'.$history->idHistorial,
                                                          'Depositar',
                                                          array('style'=>'text-decoration: none; color: #FFFFFF; margin-left: 0px; text-align: center', 'class'=>'depositar', 'flag'=>$history->idHistorial)); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <!-- END OF FIRST IF -->
                    <?php endif; ?>
                    <?php if((($recorte_ini[0] == '16') && ($recorte_fin[0] == '30')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '31')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '28')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '29'))): ?>
                    <!-- START OF FIRST IF -->
                        <?php if(($recorte_ini[1] > $mes) && ($recorte_fin[1] > $mes)): ?>
                            <?php if($history->historialStatusDeposito == 0): ?>
                                <div class="prepend-4 span-10" id="depositacion<?php echo $history->idHistorial; ?>">
                                    <div class="span-7 last" style="margin-top: 10px">
                                        <?php echo form_label('# Referencia: ', 'noReferneciaFichaDeposito'); ?>
                                        <?php echo form_input(array('id'=>'noReferenciaBNK'.$history->idHistorial,
                                                                    'class'=>'numeroReferenciaBNK',
                                                                    'name'=>'noReferenciaBnk',
                                                                    'style'=>'')); ?>
                                    </div>
                                    <div class="span-2 redondeo-menu" style="text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px;margin-top:10px">
                                        <?php echo anchor('transacciones/actualizar_transaccion/'.$history->idHistorial,
                                                          'Depositar',
                                                          array('style'=>'text-decoration: none; color: #FFFFFF; margin-left: 0px; text-align: center', 'class'=>'depositar', 'flag'=>$history->idHistorial)); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <!-- END OF FIRST IF -->
                    <?php endif; ?>
                    <!-- IF'S FOR CHECK THE SHOWING BUTTON **END** -->
                </div><!-- CONTENEDOR DEL CUERPO DINAMICO **FIN** -->
            <?php else: ?>
                <div class="span-13 last" style="background-color: #C1C1C1"><!-- CONTENEDOR MAIN DEL CUERPO DINAMICO **INICIO** -->
                    <div class="span-14 last" style="color: #83547F"><!-- CONTENEDOR SECUNDARIO DEL CUERPO DINAMICO **INICIO** -->
                       <div class="span-3" id="code<?php echo $history->idHistorial; ?>">
                            <?php echo substr($history->historialCodigo, 0, 15).'...'; ?>
                        </div>
                        <div class="span-3">
                            <?php echo "$ " . $history->historialTotalQuincenal . " MX"; ?>
                        </div>
                        <div class="span-2">
                            <?php $newFechaInicio = unix_to_human($history->historialFechaInicio);
                                  $formatoFechaInicio = fecha_acomodo_corto($newFechaInicio);
                                  echo $formatoFechaInicio;
                            ?>
                        </div>
                        <div class="span-2">
                            <?php $newFechaFin = unix_to_human($history->historialFechaFin);
                                  $formatoFechaFin = fecha_acomodo_corto($newFechaFin);
                                  echo $formatoFechaFin;
                            ?>
                        </div>
                        <div class="span-3 last">
                            <div class="span-4 last">
                                <div class="span-2 last">
                                    <?php echo anchor('#',
                                                      'Ver Mas',
                                                      array('style'=>'text-decoration: none; color: #83547F; margin-left: 10px', 'class'=>'ver-opciones', 'id'=>$history->idHistorial)); ?>
                                </div>
                                <div class="span-1">
                                    <?php echo anchor('#',
                                                      'Ocultar',
                                                      array('style'=>'text-decoration: none; color: #83547F; margin-left: 0px', 'class'=>'ocultar-opciones', 'id'=>$history->idHistorial)); ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- CONTENEDOR SECUNDARIO DEL CUERPO DINAMICO **FIN** --> 
                    <div class="span-13 last" style="background-color: #FFFFFF; display: none; margin-top: 15px" id="desglose<?php echo $history->idHistorial; ?>"><!-- CUERPO DE LOS MENSAJES DE LOS DATOS DESGLOSADO POR USUARIO **INICIO** -->
                        <div class="span-14 last" style="color: #660066">
                            <div class="span-3">
                                No. Referencia
                            </div>
                            <div class="span-3">
                                Usuario
                            </div>
                            <div class="span-3">
                                Folio/Factura
                            </div>
                            <div class="span-3">
                                Bonificacion
                            </div>
                            <div class="span-2">
                                &nbsp;
                            </div>
                        </div>
                        <?php $desglose = get_individual_data($history->idHistorial); ?>
                        <?php $j = 1; ?>
                        <?php foreach($desglose as $individual): ?>
                            <?php if($j%2 == 0): ?> 
                                <div class="span-14 last" style="color: #000000;"><!-- CONTENEDOR MAIN DEL CUERPO DEL DESGLOSE **INICIO** --> 
                                    <div class="span-13" style="background-color: #DCDCDC">
                                        <div class="span-3">
                                            <?php echo substr($individual->comisionRecibidaNumeroReferencia, 0, 15) . '...'; ?>
                                        </div>
                                        <div class="span-3">
                                            <?php echo get_user_name($individual->comisionRecibidaUsuarioId); ?>
                                        </div>
                                        <div class="span-3">
                                            <?php echo $individual->comisionRecibidaFolioTransaccion; ?>
                                        </div>
                                        <div class="span-2">
                                            <?php echo "$ " . number_format($individual->comisionRecibidaUsuarioBonificacion, 2, '.', '') . " MX"; ?>
                                        </div>
                                        <div class="span-1 last">
                                            <div class="span-5">
                                                <?php echo anchor('#',
                                                              'Ver detalle',
                                                              array('style'=>'color: #660066; text-decoration: none', 'id'=>'ver'.$individual->comisionRecibidaId, 'class'=>'detalle_open_historial', 'flag'=>$individual->comisionRecibidaId)); ?>
                                            <?php echo anchor('#',
                                                              'Ocultar detalle',
                                                              array('style'=>'color: #660066; text-decoration: none; display: none; margin-left: -10px', 'id'=>'ocultar'.$individual->comisionRecibidaId, 'class'=>'detalle_close_historial', 'flag'=>$individual->comisionRecibidaId)); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="desglose_personal<?php echo $individual->comisionRecibidaId; ?>" style="display: none;">
                                        <div class="span-13 last" style="background-color: #DCDCDC; padding-top: 5px; padding-bottom: 5px">
                                            <div class="span-13">   
                                                <div class="span-3" style="color: #660066">
                                                    Nombre:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo get_user_name($individual->comisionRecibidaUsuarioId); ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div clasS="span-3" style="color: #660066">
                                                    Folio:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo $individual->comisionRecibidaFolioTransaccion; ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div class="span-3" style="color: #660066">
                                                    Bonificaci&oacute;n:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo '$ ' . number_format($individual->comisionRecibidaUsuarioBonificacion, 2, '.', '') . ' MX'; ?>
                                                </div>
                                            </div>
                                            <div class="span-13">
                                                <div class="span-3" style="color: #660066">
                                                    No. Referencia:
                                                </div>
                                                <div class="span-9 last" style="color: #000000">
                                                    <?php echo $individual->comisionRecibidaNumeroReferencia; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- CONTENEDRO MAIN DEL CUERPO DEL DESGLOSE **FIN** -->
                            <?php else: ?>
                                <div class="span-14 last" style="color: #7F7D7D"><!-- CONTENEDOR MAIN DEL CUERPO DEL DESGLOSE **INICIO** -->
                                    <div class="span-3">
                                        <?php echo substr($individual->comisionRecibidaNumeroReferencia, 0, 15) . '...'; ?>
                                    </div>
                                    <div class="span-3">
                                        <?php echo get_user_name($individual->comisionRecibidaUsuarioId); ?>
                                    </div>
                                    <div class="span-3">
                                        <?php echo $individual->comisionRecibidaFolioTransaccion; ?>
                                    </div>
                                    <div class="span-2">
                                        <?php echo "$ " . number_format($individual->comisionRecibidaUsuarioBonificacion, 2, '.', '') . " MX"; ?>
                                    </div>
                                    <div class="span-1 last">
                                        <div class="span-5">
                                            <?php echo anchor('#',
                                                              'Ver detalle',
                                                              array('style'=>'color: #660066; text-decoration: none', 'id'=>'ver'.$individual->comisionRecibidaId, 'class'=>'detalle_open_historial', 'flag'=>$individual->comisionRecibidaId)); ?>
                                            <?php echo anchor('#',
                                                              'Ocultar detalle',
                                                              array('style'=>'color: #660066; text-decoration: none; display: none; margin-left: -10px', 'id'=>'ocultar'.$individual->comisionRecibidaId, 'class'=>'detalle_close_historial', 'flag'=>$individual->comisionRecibidaId)); ?>
                                        </div>
                                    </div>
                                </div><!-- CONTENEDRO MAIN DEL CUERPO DEL DESGLOSE **FIN** -->
                                <div id="desglose_personal<?php echo $individual->comisionRecibidaId; ?>" style="display: none;">
                                    <div class="span-13 last" style="padding-top: 5px; padding-bottom: 5px">
                                        <div class="span-13">   
                                            <div class="span-3" style="color: #660066">
                                                Nombre:
                                            </div>
                                            <div class="span-9 last" style="color: #000000">
                                                <?php echo get_user_name($individual->comisionRecibidaUsuarioId); ?>
                                            </div>
                                        </div>
                                        <div class="span-13">
                                            <div clasS="span-3" style="color: #660066">
                                                Folio:
                                            </div>
                                            <div class="span-9 last" style="color: #000000">
                                                <?php echo $individual->comisionRecibidaFolioTransaccion; ?>
                                            </div>
                                        </div>
                                        <div class="span-13">
                                            <div class="span-3" style="color: #660066">
                                                Bonificaci&oacute;n:
                                            </div>
                                            <div class="span-9 last" style="color: #000000">
                                                <?php echo '$ ' . number_format($individual->comisionRecibidaUsuarioBonificacion, 2, '.', '') . ' MX'; ?>
                                            </div>
                                        </div>
                                        <div class="span-13">
                                            <div class="span-3" style="color: #660066">
                                                No. Referencia:
                                            </div>
                                            <div class="span-9 last" style="color: #000000">
                                                <?php echo $individual->comisionRecibidaNumeroReferencia; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php $j++; ?>
                        <?php endforeach; ?>
                    </div><!-- CUERPO DE LOS MENSAJES DE LOS DATOS DESGLOSADO POR USUARIO **FIN** -->
                    &nbsp;
                    <?php 
                        $dia = date('d');
                        $mes = date('m');
                        $date_ini = date('d-m-Y', $history->historialFechaInicio);
                        $date_fin = date('d-m-Y', $history->historialFechaFin);
                        $recorte_ini = explode('-', $date_ini);
                        $recorte_fin = explode('-', $date_fin);
                    ?>
                    <!-- IF'S FOR CHECK THE SHOWING BUTTON **START** -->
                    <?php if(($recorte_ini[0] == '01') && ($recorte_fin[0] == '15')): ?>
                        <?php if((($recorte_ini[1] == $mes) && ($recorte_fin[1] == $mes) && ($recorte_fin[0] == '15')) || (($recorte_ini[1] > $mes) && ($recorte_fin[1] > $mes))): ?>
                            <?php if($history->historialStatusDeposito == 0): ?>
                                <div class="prepend-4 span-10" id="depositacion<?php echo $history->idHistorial; ?>">
                                    <div class="span-7 last" style="margin-top: 10px">
                                        <?php echo form_label('# Referencia: ', 'noReferneciaFichaDeposito', array('style'=>'color: #660066')); ?>
                                        <?php echo form_input(array('id'=>'noReferenciaBNK'.$history->idHistorial,
                                                                    'class'=>'numeroReferenciaBNK',
                                                                    'name'=>'noReferenciaBnk',
                                                                    'style'=>'')); ?>
                                    </div>
                                    <div class="span-2 redondeo-menu" style="text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px;margin-top:10px">
                                        <?php echo anchor('transacciones/actualizar_transaccion/'.$history->idHistorial,
                                                          'Depositar',
                                                          array('style'=>'text-decoration: none; color: #FFFFFF; margin-left: 0px; text-align: center', 'class'=>'depositar', 'flag'=>$history->idHistorial)); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if((($recorte_ini[0] == '16') && ($recorte_fin[0] == '30')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '31')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '28')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '29'))): ?>
                       
                            <?php if($history->historialStatusDeposito == 0): ?>
                                <div class="prepend-4 span-10" id="depositacion<?php echo $history->idHistorial; ?>">
                                    <div class="span-7 last" style="margin-top: 10px">
                                        <?php echo form_label('# Referencia: ', 'noReferneciaFichaDeposito', array('style'=>'color: #660066')); ?>
                                        <?php echo form_input(array('id'=>'noReferenciaBNK'.$history->idHistorial,
                                                                    'class'=>'numeroReferenciaBNK',
                                                                    'name'=>'noReferenciaBnk',
                                                                    'style'=>'')); ?>
                                    </div>
                                    <div class="span-2 redondeo-menu" style="text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px;margin-top:10px">
                                        <?php echo anchor('transacciones/actualizar_transaccion/'.$history->idHistorial,
                                                          'Depositar',
                                                          array('style'=>'text-decoration: none; color: #FFFFFF; margin-left: 0px; text-align: center', 'class'=>'depositar', 'flag'=>$history->idHistorial)); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                       
                    <?php endif; ?>
                    <!-- IF'S FOR CHECK THE SHOWING BUTTON **END** -->
                </div><!-- CONTENEDOR DEL CUERPO DINAMICO **FIN** -->
            <?php endif; ?>
            <?php $i++; ?>
        <?php endforeach; ?>
      
    <?php endif; ?>
</div>
