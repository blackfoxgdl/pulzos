<?php
/**
 * Se muestran los retos de forma individual
 * al usuario o el negocio los puede ver tambien
 **/
?>
<script type="text/javascript">

$('.ver-aviso').click(function(event){
    event.preventDefault();
    attrName = $(event.currentTarget).attr("name");
    $(event.currentTarget).hide();
    $("#ocultar-"+attrName).show();
    $("#aviso-legal-"+attrName).show();
});

$('.ocultar-aviso').click(function(event){
    event.preventDefault();
    attrNameO = $(event.currentTarget).attr("name");
    $(event.currentTarget).hide();
    $("#ver-"+attrNameO).show();
    $("#aviso-legal-"+attrNameO).hide();
});

$("#eliminar-pulzo-simple").click(function(event){
    event.preventDefault();
    urlEliminar = $(this).attr("href");
//    urlCargar = $("#return").attr("href");
    urlView = $("#reloadView").attr("href");
    //alert(urlCargar);
    $.get(urlEliminar);
  //  $("#pulzos_hecho").load(urlCargar);
    $("#texto-menu").load(urlView);
    recargar();
});

function recargar()
{
    url = $("#return").attr("href");
    $("#pulzos_hecho").load(url);
}


function start(fecha_inicio, fecha_final,div) 
{
	displayCountDown(setCountDown(fecha_inicio, fecha_final),div);
}

function setCountDown(inicio, tiempoactual) 
{	
		
	var fechainicio=new Date(Date.parse(inicio));
	var nuevo =new Date(0);
	var finf=(nuevo.setMilliseconds(fechainicio)+86400000);	
	var nuevo2 =new Date(0);	
	return Math.floor((nuevo2.setMilliseconds(finf-tiempoactual)/1000)+3600);
}

function displayCountDown(countdown,nameDiv) 
{	
    if (countdown < 0) document.getElementById(nameDiv).innerHTML = "<span style=' font-size:15px; color:#FF0000;'>Reto terminado </span>"; //Mensaje de ejemplo para deal finalizado
	else {
		
        var secs = countdown % 60; 
        if (secs < 10) secs = '0'+secs;
        var countdown1 = (countdown - secs) / 60;
        var mins = countdown1 % 60; 
        if (mins < 10) mins = '0'+mins;
        countdown1 = (countdown1 - mins) / 60;
        var hours = countdown1 % 24;
        var days = (countdown1 - hours) / 24;
        
        hours = days * 24 + hours;
        
        document.getElementById(nameDiv).innerHTML ="<span style=' font-size:17px; color:#660068; '>"+'tiempo restante: '+hours+ 'h : ' +mins+ 'm : '+secs+'s'+"</span>";
        setTimeout('displayCountDown('+(countdown-1)+',\''+nameDiv+'\');',999);
		
	}
}

//YO ESTO
$(".comentar-reto").click(function(event){
    event.preventDefault();
    nameRetosComment = $(event.currentTarget).attr("name");
    $(".comentarios-"+nameRetosComment).show();
});

$(".eliminar-pulzo").click(function(event){
    event.preventDefault();
    urlDelete = $(event.currentTarget).attr("href");
    $.get(urlDelete);
    urlRetos = $("#redirectR").attr("href");
    $("#texto-menu").load(urlRetos);
});

$(".eliminar-sub").click(function(event){
    event.preventDefault();
    urlDeleteSub = $(event.currentTarget).attr("href");
    $.get(urlDeleteSub);
    $(event.currentTarget).parent().parent().parent().parent().hide().remove();
});

function poner(val, id)
{
    if(document.getElementById('sub-comentario'+id).value == '')
    {
        document.getElementById('sub-comentario'+id).value = 'Comentar';
    }
}

function quitar(val, id)
{
    if(document.getElementById('sub-comentario'+id).value == 'Comentar')
    {
        document.getElementById('sub-comentario'+id).value = '';
    }
}

function subcomentar_enter(event, idplan)
{
    if(event.keyCode == 13)
    {
        $("#oct"+idplan).focus();
        var accionAttr = $(".forma-comentar-muro"+idplan).attr("action");
        var datosAccion = $(".secondary-comment"+idplan).attr("value");
        if(datosAccion != "Comentar")
        {
            $.post(accionAttr,
                   {comentar_negocios:datosAccion},
                   function(data){
                       url = $("#redirectMain").attr("href");
                       $("#texto-menu").load(url);
                   });
        }
    }
}

</script>
<?php echo anchor('retosnegocios/ver_reto/'.$reto->pulzoId, '', array('id'=>'redirectMain', 'style'=>'display: none')); ?>
<?php echo anchor('retosnegocios/ver/'.$reto->negocioId, '', array('id'=>'redirectR', 'style'=>'display: none')); ?>
<div class="span-14 last" style="margin-top: 20px"><!-- MAIN **INICIO** --><?php $a=0;?>
    <div class="span-13 last">

    </div>
    <?php //var_dump($reto); ?>
    <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
        <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
            <div class="span-1"><!-- DIV DEL AVATAR **INICIO** -->
                <?php echo img(array('src'=>get_avatar_negocios($reto->negocioId),
                                     'width'=>'37px',
                                     'height'=>'37px')); ?>
            </div><!-- DIV DEL AVATAR **FIN** -->
            <div class="interlineado span-12 last" style="margin-left: 10px"><!-- DIV DEL CUERPO DEL MENSAJE **INICIO** -->
                <span class="pulzos_titulo1">
                    <?php echo anchor('negocios/perfil/'.$reto->negocioId,
                                      get_complete_username($reto->negocioUsuarioId),
                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                </span>
                <br />
                <span class="pulzos_titulo2">
                    <?php echo $reto->pulzoTitulo; ?>
                </span>
                <br />
                <?php if($reto->pulzoTipoEventoId == 1): ?>
                    <span class="pulzos_titulo2">
                        Reto de Consumo
                    </span>
                <?php elseif($reto->pulzoTipoEventoId == 2): ?>
                    <span class="pulzos_titulo1">
                        Vence en:
                    </span>
                    <span>
                         <script language="javascript">
												
												var tiempotras=new Date();
												var textofecha='<?php echo $reto->pulzoDuracionReto; ?>';
												var auxf=textofecha.split("-");
												var nueva=auxf[0]+" "+auxf[1]+","+auxf[2]+" "+auxf[3]+":"+auxf[4]+":00";
												var tiempotras=new Date();
												var textofecha='<?php echo $reto->pulzoDuracionReto; ?>';
												var auxf=textofecha.split("-");
												if(auxf[0]==01){auxf[0]='January'}
												if(auxf[0]==02){auxf[0]='February'}
												if(auxf[0]==03){auxf[0]='March'}
												if(auxf[0]==04){auxf[0]='April'}
												if(auxf[0]==05){auxf[0]='May'}
												if(auxf[0]==06){auxf[0]='June'}
												if(auxf[0]==07){auxf[0]='July'}
												if(auxf[0]==08){auxf[0]='August'}
												if(auxf[0]==09){auxf[0]='September'}
												if(auxf[0]==10){auxf[0]='October'}
												if(auxf[0]==11){auxf[0]='November'}
												if(auxf[0]==12){auxf[0]='December'}
												var nueva=auxf[0]+" "+auxf[1]+","+auxf[2]+" "+auxf[3]+":"+auxf[4]+":00";
												
											
													maniana=new Date(nueva);
													maniana1=new Date();
													if(maniana<=maniana1){start(nueva,tiempotras,'countdowncontainerini');}
												
												
												</script>
                        <div id="countdowncontainerini" style=" background:#DDEACF;  border:0px; border: 0px solid #399210; color:#006600; width:250px; height:27px;">aun falta para empezar </div>
                    </span>
                <?php elseif($reto->pulzoTipoEventoId == 3): ?>
                    <span class="pulzos_titulo2">
                        Reto de Actividad
                    </span>
                <?php elseif($reto->pulzoTipoEventoId == 4): ?>
                    <span class="pulzos_titulo1">
                        No. de Integrantes:
                    </span>
                    <span class="pulzos_titulo2">
                        <?php echo $reto->pulzoNumeroAsistentes; ?>
                    </span>
                <?php elseif($reto->pulzoTipoEventoId == 5): ?>
                    <span class="pulzos_titulo2">
                        Otros
                    </span>
                <?php endif; ?>
                <br />
            </div><!-- DIV DEL CUERPO DEL MENSAJE **FIN** -->
            <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION RETO **INICIO** -->
                <div class="span-2">
                    <?php if($reto->pulzoImagenRuta == '0'): ?>
                        <?php echo img(array('src'=>get_avatar_negocios($reto->pulzoUsuarioId),
                                             'width'=>'100px',
                                             'height'=>'100px')); ?>
                    <?php else: ?>
                        <?php echo img(array('src'=>$reto->pulzoImagenRuta,
                                             'width'=>'100px',
                                             'height'=>'100px')); ?>
                    <?php endif; ?>
                </div>
                <div class="prepend-1 span-9 last" style="margin-top: 5px">
                    <span class="pulzos_titulo2">
                        <?php echo $reto->pulzoAccion; ?>
                    </span>
                </div>
            </div><!-- DIV DE DESCRIPCION RETO **FIN** -->
            <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                    <?php echo anchor('#',
                                      'Aviso Legal:',
                                       array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$reto->pulzoId, 'id'=>'ver-'.$reto->pulzoId)); ?>
                    <?php echo anchor('#',
                                      'Aviso Legal:',
                                       array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$reto->pulzoId, 'id'=>'ocultar-'.$reto->pulzoId)); ?>
                </div>
            </div>
            <div id="aviso-legal-<?php echo $reto->pulzoId; ?>" style="display: none">
                <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                    <?php echo $reto->pulzoAvisoLegal; ?>    
                </div>
            </div><!-- DIV AVISO LEGAL **FIN** -->
            <div class="prepend-1 span-14 last" style="margin-bottom: 0px"><!-- MENU RETO **INICIO** -->
                <div class="span-6">
                    &nbsp;
                </div>
                <div class="prepend-3 span-2">
                    <?php echo anchor('#',
                                      'Comentar',
                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px;', 'class'=>'comentar-reto', 'name'=>$reto->pulzoId)); ?>
                </div>
                <?php if($this->session->userdata('id') == $reto->negocioUsuarioId): ?>
                    <div class="span-1">
                        <?php echo anchor('pulzos/borrar/'.$reto->pulzoId,
                                          'Eliminar',
                                          array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -5px', 'class'=>'eliminar-pulzo')); ?>
                    </div>
                <?php else: ?>
                    <div class="span-1">
                        <?php $planes = get_data_planusuario_by_pulzo($reto->pulzoId); ?>
                        <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$reto->pulzoId,
                                          'Reservar',
                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </div>
                <?php endif; ?>
            </div><!-- MENU RETO **FIN** -->
            <div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                <?php $pulzos_post = get_pulzos_subcomments($reto->pulzoId); ?>
                <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                    <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                        <div class="span-12 last" style="background-color: #DCCEDD; margin-left: 50px; margin-bottom: 10px">
                            <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                    <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                    <?php if($datos_like_user->statusEU == 0): ?>
                                        <?php echo img(array('src'=>get_avatar($posteos->comentarioUsuarioId),
                                                             'width'=>'36px',
                                                             'height'=>'36px')); ?>
                                    <?php else: ?>
                                        <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                        <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                             'width'=>'36px',
                                                             'height'=>'36px')); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                    <div class="span-12">
                                        <div class="span-9">
                                            <span class="pulzos_titulo1">
                                                <?php if($datos_like_user->statusEU == 0): ?>
                                                    <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                        get_complete_username($posteos->comentarioUsuarioId),
                                                                        array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                <?php else: ?>
                                                    <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                        get_complete_username($posteos->comentarioUsuarioId),
                                                                        array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div class="span-2 last">
                                            <?php if($this->session->userdata('idN') == $reto->pulzoUsuarioId): ?>
                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$reto->pulzoId.'/'.$posteos->comentarioId,
                                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                                            'width'=>'14px',
                                                                            'height'=>'12px')),
                                                                  array('class'=>'eliminar-sub')); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <br />
                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                        <?php echo $posteos->comentarioTexto; ?>
                                    </span>
                                </div>
                                <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                    <div class="span-1" style="margin-left: 20px">
                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                             'width'=>'14px',
                                                             'height'=>'12px')); ?>
                                    </div>
                                    <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                        <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                              $fechaCreacionSub = fecha_acomodo($fecha);
                                              echo $fechaCreacionSub;
                                        ?>
                                    </div>
                                </div>
                            </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                        </div>
                    <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
                </div>
            </div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **FIN** -->
            <div class="comentarios-<?php echo $reto->pulzoId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                <?php echo form_open('retosnegocios/subcomentarios_post_pulzos/'.$reto->pulzoId.'/'.$reto->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                     array('class'=>'forma-comentar-muro'.$reto->pulzoId)); ?>
                    <div class="span-8" style="margin-left: 6px">
                        <?php echo form_textarea(array('id'=>'sub-comentario'.$reto->pulzoId,
                                                       'class'=>'secondary-comment'.$reto->pulzoId,
                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                       'onkeypress'=>'subcomentar_enter(event,' . $reto->pulzoId . ')',
                                                       'value'=>'Comentar',
                                                       'onfocus'=>"return quitar('Comentar'," . $reto->pulzoId . ")",
                                                       'onblur'=>"return poner('Comentar'," . $reto->pulzoId . ")",
                                                       'name'=>'comentar_negocios')); ?>
                    </div>
                <?php echo form_close(); ?>
                <input type="hidden" id="oct<?php echo $reto->pulzoId; ?>" />
            </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
        </div><!-- DIV DEL CUERPO **FIN** -->
    </div><!-- DIV CONTENEDOR **FIN** -->
</div><!-- MAIN **FIN** -->
