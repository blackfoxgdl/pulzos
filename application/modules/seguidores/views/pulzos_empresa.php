<?php
/**
 * Vista que se encarga de mostrar solamente el pulzo
 * mas reciente que tiene la empresa en su perfil
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
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

function cargarVista()
{
    var returnLink = $('#returnLink').attr('href');
    $("#texto-menu").load(returnLink);
}

$(".comentar").click(function(event){
    event.preventDefault();
    nameAttr = $(event.currentTarget).attr('name');
    $(".comentarios-"+nameAttr).show();
});

$(".eliminarPulzo").click(function(event){
    event.preventDefault();
    url = $(event.currentTarget).attr("href");
    urlLoad = $("#reloadUrl").attr("href");
    $.get(url);
    $(event.currentTarget).parent().parent().parent().parent().hide();
});

$(".ver-mas-pulzo").click(function(event){
    event.preventDefault();
    urlRedirect = $(event.currentTarget).attr('href');
    $("#texto-menu").load(urlRedirect);
});

$(document).ready(function(){
    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
    var texto = $("div#menu-derecha").html();
    $("#main-div").html(texto);
});


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
        
        document.getElementById(nameDiv).innerHTML ="<span style=' font-size:17px; color:#660068; '>"+'tiempo restante: '+hours+ 'h : ' +mins+ 'm : '+secs+'s'+"<img src='<?php echo base_url().'statics/img/ico_empresas/reloj.jpg'; ?>' width='15' height='15px'/></span>";
        setTimeout('displayCountDown('+(countdown-1)+',\''+nameDiv+'\');',999);
		
	}
}

</script>
<div style="display: none">
    <?php echo anchor('seguidores/empresas/'.$this->session->userdata('id'), '', array('id'=>'redirectMain')); ?>
    <div id="nombre-usuario-plan">Mis Empresas</div>
    <div id="edad-usuario-plan"></div>
    <div id="relacion-usuario-plan"></div>
    <div id="estado-usuario-plan"></div>
    <div id="menu-derecha">
        <?php echo anchor('planesusuarios',
                           img(array('src'=>'statics/img/bot-armapulzo.png',
                                     'id'=>'planesU',
                                     'width'=>'80',
                                     'height'=>'20',
                                     'style'=>'margin-top: 22px; margin-left: -23px'))); ?>
    </div>
</div>
<div class="span-14 last" style="margin-top: 20px"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="span-13"><?php $b=0;?>
        <?php foreach($mis_empresas as $empresa): ?><?php $b=$b+1;?>
         <?php $number_pulzos = get_total_pulzos_posted($empresa->negocioId); ?>
         <?php if($number_pulzos != 0): ?><!-- CONDICION PARA CONOCER SI HAY PULZOS DEL NEGOCIO O NO **INICIO** -->
                <?php $pulzos_empresa = get_last_pulzo($empresa->negocioId); ?>
            <?php if(!empty($pulzos_empresa)): ?>
                <div class="span-13" style="border-bottom: 1px solid #DAD6DB; margin-bottom: 5px"><!-- DIV PRINCPAL DEL FOREACH **INICIO** -->
                <?php if($pulzos_empresa->pulzoTipo == 0): ?>
                    <div class="span-14 last" style="width: 524px"><!-- FONDO **INICIO** -->
                        <div class="span-1">
                            <?php echo img(array('src'=>get_avatar_negocios($empresa->negocioId),
                                                 'width'=>'37px',
                                                 'height'=>'37px')); ?>
                        </div>
                        <div class="interlineado span-12 last" style="margin-top: 3px; word-wrap: break-word; margin-left: 10px"><!--DIV CUERPO DEL POSTEO **INICIO** -->
                            <span class="pulzos_titulo1">   
                                <?php echo anchor('negocios/perfil/'.$empresa->negocioId,
                                                  get_complete_username($empresa->negocioUsuarioId),
                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                            </span>
                            <br />
                            <span class="pulzos_titulo2">
                                <?php echo $pulzos_empresa->pulzoTitulo; ?>
                            </span>
                            <br />
                            <span class="pulzos_titulo1">
                                Fecha Inicio: 
                            </span>
                            <span class="pulzos_titulo2">
                                <?php 
                                    $fechaI = unix_to_human($pulzos_empresa->pulzoFechaInicio); 
                                    $correctaI = fecha_acomodo($fechaI);
                                    echo $correctaI; 
                                ?>
                            </span>
                            <br />
                            <span class="pulzos_titulo1">
                                Fecha Fin: 
                            </span>
                            <span class="pulzos_titulo2">
                                <?php 
                                    $fechaF = unix_to_human($pulzos_empresa->pulzoFechaFin);
                                    $correctaF = fecha_acomodo($fechaF);
                                    echo $correctaF;
                                ?>
                            </span>
                        </div><!-- DIV CUERPO DEL POSTEO **FIN** -->
                        <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION PULZO **INICIO** -->
                            <div class="span-2">
                                <?php if($pulzos_empresa->pulzoImagenRuta == '0'): ?>
                                    <?php echo img(array('src'=>get_avatar_negocios($empresa->negocioId),
                                                         'width'=>'100',
                                                         'height'=>'100')); ?>
                                <?php else: ?>
                                    <?php echo img(array('src'=>get_avatar_pulzo($pulzos_empresa->pulzoId),
                                                         'width'=>'100',
                                                         'height'=>'100')); ?>
                                <?php endif; ?>
                            </div>
                            <div class="prepend-1 span-9 last" style="margin-top: 5px">
                                <span class="pulzos_titulo2">
                                    <?php echo anchor('pulzos/ver_simple/'.$pulzos_empresa->pulzoId,
                                                      $pulzos_empresa->pulzoAccion,
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-pulzo')); ?>
                                </span>
                            </div>
                        </div><!-- DIV DE DESCRIPCION PULZO **FIN** -->
                        <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                            <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                                <?php echo anchor('#',
                                                  'Aviso Legal:',
                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$pulzos_empresa->pulzoId, 'id'=>'ver-'.$pulzos_empresa->pulzoId)); ?>
                                <?php echo anchor('#',
                                                  'Aviso Legal:',
                                                  array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$pulzos_empresa->pulzoId, 'id'=>'ocultar-'.$pulzos_empresa->pulzoId)); ?>
                            </div>
                        </div>
                        <div style="display: none" id="aviso-legal-<?php echo $pulzos_empresa->pulzoId; ?>">
                            <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                <?php echo $pulzos_empresa->pulzoAvisoLegal; ?>    
                            </div>
                        </div><!-- DIV AVISO LEGAL **FIN** -->
                        <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                            <div class="span-6">
                                &nbsp;
                            </div>
                            <div class="prepend-1 span-2">
                                <?php echo anchor('pulzos/ver_simple/'.$pulzos_empresa->pulzoId,
                                                  'Ver mas',
                                                  array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas-pulzo')); ?>
                            </div>
                            <div class="span-2">
                                <?php echo anchor('#',
                                                  'Comentar', 
                                                  array('class'=>'comentar', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: 5px;', 'name'=>$pulzos_empresa->pulzoId)); ?>
                            </div>
                            <?php if($this->session->userdata('id') == $empresa->negocioUsuarioId): ?>
                                <div class="span-1">
                                    <?php echo anchor('pulzos/borrar/'.$pulzos_empresa->pulzoId,
                                                      'Eliminar',
                                                       array('id'=>'eliminarP', 'class'=>'eliminarPulzo', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: -5px;')); ?>
                                </div>
                            <?php else: ?>
                                <?php $planId = get_data_planusuario_by_pulzo($pulzos_empresa->pulzoId); ?>
                                <div class="span-1">
                                    <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planId->planId.'/'.$pulzos_empresa->pulzoId,
                                                      'Reservar',
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </div>      
                            <?php endif; ?>
                        </div>
                        <div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                            <?php $pulzos_post = get_pulzos_subcomments($pulzos_empresa->pulzoId); ?>
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
                                                    <?php if($this->session->userdata('idN') == $pulzos_empresa->pulzoUsuarioId): ?>
                                                        <?php echo anchor('negocios/delete_subcomments_plains/'.$pulzos_empresa->pulzoId.'/'.$posteos->comentarioId,
                                                                          img(array('src'=>'statics/img/cerrar.jpg',
                                                                                    'width'=>'14px',
                                                                                    'height'=>'12px')),
                                                                          array('class'=>'eliminar-pulzo')); ?>
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
                                <div class="comentarios-<?php echo $pulzos_empresa->pulzoId; ?> prepend-1 span-8 last" style="display: none; margin-bottom: 5px"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                    <?php echo form_open('pulzos/subcomentarios_post_pulzos/'.$pulzos_empresa->pulzoId.'/'.$pulzos_empresa->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                                        array('class'=>'forma-comentar-muro'.$pulzos_empresa->pulzoId)); ?>
                                        <div class="span-8" style="margin-left: 6px">
                                            <?php echo form_textarea(array('id'=>'sub-comentario'.$pulzos_empresa->pulzoId,
                                                                           'class'=>'secondary-comment'.$pulzos_empresa->pulzoId,
                                                                           'style'=>'width: 470px; height: 23px; color: #999999',
                                                                           'onkeypress'=>'subcomentar_enter(event,' . $pulzos_empresa->pulzoId . ')',
                                                                           'value'=>'Comentar',
                                                                           'onfocus'=>"return quitar('Comentar'," . $pulzos_empresa->pulzoId . ")",
                                                                           'onblur'=>"return poner('Comentar'," . $pulzos_empresa->pulzoId . ")",
                                                                           'name'=>'comentar_negocios')); ?>
                                        </div>
                                    <?php echo form_close(); ?>
                                    <input type="hidden" id="oct<?php echo $pulzos_empresa->pulzoId; ?>" />
                                </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                            </div><!-- FONDO  **FIN** -->
                        </div><!-- DIV DE CUERPO EN PULZOS **FIN* -->
                    </div><!-- FONDO **FIN** -->
                <?php elseif($pulzos_empresa->pulzoTipo == 1): ?>
                    <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                        <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                            <?php echo img(array('src'=>get_avatar_negocios($empresa->negocioId),
                                                 'width'=>'37px',
                                                 'height'=>'37px')); ?>
                        </div><!-- DIV AVATAR **FIN** -->
                        <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!-- DIV DEL CUERPO DEL MENSAJE **INICIO** -->
                            <span class="pulzos_titulo1">
                                <?php echo anchor('negocios/perfil/'.$empresa->negocioId,
                                                  get_complete_username($empresa->negocioUsuarioId),
                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                            </span>
                            <br />
                            <span class="pulzos_titulo2">
                                <?php echo $pulzos_empresa->pulzoTitulo; ?>
                            </span> 
                            <br />
                            <?php if($pulzos_empresa->pulzoTipoEventoId == 1): ?>
                                <span class="pulzos_titulo2">
                                    Reto de Consumo
                                </span>
                            <?php elseif($pulzos_empresa->pulzoTipoEventoId == 2): ?>
                                <span class="pulzos_titulo1">
                                    Vence en:
                                </span>
                                <span>
                                    <br><br>
                                    <div id="duracion<?php echo $b;?>"></div>
                                        <script language="javascript">
    			        					
								           var tiempotras=new Date();
												var textofecha='<?php echo $pulzos_empresa->pulzoDuracionReto; ?>';
												var auxf=textofecha.split("-");
												var nueva=auxf[0]+" "+auxf[1]+","+auxf[2]+" "+auxf[3]+":"+auxf[4]+":00";
												var tiempotras=new Date();
												var textofecha='<?php echo $pulzos_empresa->pulzoDuracionReto; ?>';
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
													if(maniana<=maniana1){start(nueva,tiempotras,'countdowncontainerine<?php echo $b;?>');}
						        		   
                                        </script>
                                        <div id="countdowncontainerine<?php echo $b;?>" style=" background:#DDEACF;  border:0px; border: 0px solid #399210; color:#006600; width:250px; height:27px;">
                                            aun falta para empezar 
                                        </div>
                                </span>
                            <?php elseif($pulzos_empresa->pulzoTipoEventoId == 3): ?>
                                <span class="pulzos_titulo2">
                                    Reto de Actividad
                                </span>
                            <?php elseif($pulzos_empresa->pulzoTipoEventoId == 4): ?>
                                <span class="pulzos_titulo1">
                                    No. de Integrantes:
                                </span>
                                <span class="pulzos_titulo2">
                                    <?php echo $pulzos_empresa->pulzoNumeroAsistentes; ?>
                                </span>
                            <?php elseif($pulzos_empresa->pulzoTipoEventoId == 5): ?>
                                <span class="pulzos_titulo2">
                                    Otros
                                </span>
                            <?php endif; ?>
                            <br />   
                        </div><!-- DIV DEL CUERPO DEL MENSAJE **FIN** -->
                        <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION RETO **INICIO** -->
                            <div class="span-2">
                                <?php if($pulzos_empresa->pulzoImagenRuta == '0'): ?>
                                    <?php echo img(array('src'=>get_avatar_negocios($pulzos_empresa->pulzoUsuarioId),
                                                         'width'=>'100px',
                                                         'height'=>'100px')); ?>
                                <?php else: ?>
                                    <?php echo img(array('src'=>$pulzos_empresa->pulzoImagenRuta,
                                                         'width'=>'100px',
                                                         'height'=>'100px')); ?>
                                <?php endif; ?>                    
                            </div>
                            <div class="prepend-1 span-9 last" style="margin-top: 5px">
                                <span class="pulzos_titulo2">
                                    <?php echo anchor('retosnegocios/ver_reto/'.$pulzos_empresa->pulzoId,
                                                      $pulzos_empresa->pulzoAccion,
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-retos')); ?>
                                </span>
                            </div>
                        </div><!-- DIV DE DESCRIPCION RETO **FIN** -->
                        <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                            <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98"> 
                                <?php echo anchor('#',
                                                  'Aviso Legal:',
                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$pulzos_empresa->pulzoId, 'id'=>'ver-'.$pulzos_empresa->pulzoId)); ?>
                                <?php echo anchor('#',
                                                  'Aviso Legal:',
                                                  array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$pulzos_empresa->pulzoId, 'id'=>'ocultar-'.$pulzos_empresa->pulzoId)); ?>
                            </div>
                        </div>
                        <div style="display: none" id="aviso-legal-<?php echo $pulzos_empresa->pulzoId; ?>">
                            <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                <?php echo $pulzos_empresa->pulzoAvisoLegal; ?>    
                            </div>
                        </div><!-- DIV AVISO LEGAL **FIN** -->
                        <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                            <div class="span-6">
                                &nbsp;
                            </div>
                            <div class="prepend-1 span-2">
                                <?php echo anchor('retosnegocios/ver_reto/'.$pulzos_empresa->pulzoId,
                                                  'Ver mas',
                                                  array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas-pulzo')); ?>
                            </div>
                            <div class="span-2">
                                <?php echo anchor('#',
                                                  'Comentar',
                                                  array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px;', 'class'=>'comentar', 'name'=>$pulzos_empresa->pulzoId)); ?>
                            </div>
                            <?php if($this->session->userdata('id') == $empresa->negocioUsuarioId): ?>
                                <div class="span-1">
                                    <?php echo anchor('pulzos/borrar/'.$pulzos_empresa->pulzoId,
                                                      'Eliminar',
                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -5px', 'class'=>'eliminarPulzo')); ?>
                                </div>
                            <?php else: ?>
                                <?php $planId = get_data_planusuario_by_pulzo($pulzos_empresa->pulzoId); ?>
                                <div class="span-1">
                                    <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planId->planId.'/'.$pulzos_empresa->pulzoId,
                                                      'Reservar',
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                            <?php $pulzos_post = get_pulzos_subcomments($pulzos_empresa->pulzoId); ?>
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
                                                        <?php if($this->session->userdata('idN') == $pulzos_empresa->pulzoUsuarioId): ?>
                                                        <?php echo anchor('negocios/delete_subcomments_plains/'.$pulzos_empresa->pulzoId.'/'.$posteos->comentarioId,
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
                        <div class="comentarios-<?php echo $pulzos_empresa->pulzoId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                            <?php echo form_open('retosnegocios/subcomentarios_post_pulzos/'.$pulzos_empresa->pulzoId.'/'.$pulzos_empresa->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                                array('class'=>'forma-comentar-muro'.$pulzos_empresa->pulzoId)); ?>
                                <div class="span-8" style="margin-left: 6px">
                                    <?php echo form_textarea(array('id'=>'sub-comentario'.$pulzos_empresa->pulzoId,
                                                                   'class'=>'secondary-comment'.$pulzos_empresa->pulzoId,
                                                                   'style'=>'width: 470px; height: 23px; color: #999999',
                                                                   'onkeypress'=>'subcomentar_enter(event,' . $pulzos_empresa->pulzoId . ')',
                                                                   'value'=>'Comentar',
                                                                   'onfocus'=>"return quitar('Comentar'," . $pulzos_empresa->pulzoId . ")",
                                                                   'onblur'=>"return poner('Comentar'," . $pulzos_empresa->pulzoId . ")",
                                                                   'name'=>'comentar_negocios')); ?>
                                </div>
                            <?php echo form_close(); ?>
                            <input type="hidden" id="oct<?php echo $pulzos_empresa->pulzoId; ?>" />
                        </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                    </div><!-- DIV DEL CUERPO **FIN** -->
                <?php else: ?>
                    <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                        <div class="span-1"><!-- DIV DEL AVATAR **INICIO** -->
                            <?php echo img(array('src'=>get_avatar_negocios($empresa->negocioId),
                                                 'width'=>'37px',
                                                 'height'=>'37px')); ?>
                        </div><!-- DIV DEL AVATAR **FIN** -->
                        <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!--DIV DEL CUERPO DEL MENSAJE **INICIO** -->
                            <span class="pulzos_titulo1">
                                <?php echo anchor('negocios/perfil/'.$pulzos_empresa->pulzoUsuarioId,
                                                  get_complete_username($empresa->negocioUsuarioId),
                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                            </span>
                            <br />
                            <span class="pulzos_titulo2">
                                <?php echo $pulzos_empresa->pulzoTitulo; ?>
                            </span>
                            <br />
                            <span class="pulzos_titulo1">
                                Fecha Inicio: 
                            </span>
                            <span class="pulzos_titulo2">
                                <?php $fecha = unix_to_human($pulzos_empresa->pulzoFechaInicio);
                                      $correcta = fecha_acomodo($fecha);
                                      echo $correcta; ?> 
                            </span>
                            <br />
                            <span class="pulzos_titulo1">
                                Fecha Fin: 
                            </span>
                            <span class="pulzos_titulo2">
                                <?php $fechaF = unix_to_human($pulzos_empresa->pulzoFechaFin);
                                      $correctaF = fecha_acomodo($fechaF);
                                      echo $correctaF; ?>
                            </span>
                            <br />
                            <span class="pulzos_titulo1">
                                Paquete: 
                            </span>
                            <span class="pulzos_titulo2">
                                <?php echo substr($pulzos_empresa->pulzoPaqueteIncluye, 0, 80) . "...."; ?>
                            </span> 
                        </div><!-- DIV DEL CUERPO DEL MENSAJE **FIN** -->
                        <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION DE LA EXPERIENCIA **INICIO** -->
                            <div class="span-2">
                                <?php if($pulzos_empresa->pulzoImagenRuta == '0'): ?>
                                    <?php echo img(array('src'=>get_avatar_negocios($pulzos_empresa->pulzoUsuarioId),
                                                         'width'=>'100',
                                                         'height'=>'100')); ?>
                                <?php else: ?>
                                    <?php echo img(array('src'=>$pulzos_empresa->pulzoImagenRuta,
                                                         'width'=>'100',
                                                         'height'=>'100')); ?>
                                <?php endif; ?>                    
                            </div>
                            <div class="prepend-1 span-9 last">
                                <span class="pulzos_titulo2">
                                    <?php echo anchor('experienciasnegocios/ver_experiencia/'.$pulzos_empresa->pulzoId,
                                                      $pulzos_empresa->pulzoAccion,
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-experiencias')); ?>
                                </span>
                            </div>
                        </div><!-- DIV DE DESCRIPCION DE LA EXPERIENCIA **FIN** -->
                        <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                            <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                                <?php echo anchor('#',
                                                  'Aviso Legal:',
                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$pulzos_empresa->pulzoId, 'id'=>'ver-'.$pulzos_empresa->pulzoId)); ?>
                                <?php echo anchor('#',
                                                  'Aviso Legal:',
                                                  array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$pulzos_empresa->pulzoId, 'id'=>'ocultar-'.$pulzos_empresa->pulzoId)); ?>
                            </div>
                        </div>
                        <div style="display: none" id="aviso-legal-<?php echo $pulzos_empresa->pulzoId; ?>">
                            <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px" >
                                <?php echo $pulzos_empresa->pulzoAvisoLegal; ?>    
                            </div>
                        </div><!-- DIV AVISO LEGAL **FIN** -->
                        <div class="prepend-1 span-14 last" style="margin-bottom: 0px"><!--DIV DEL MENU **INICIO** -->
                            <div class="span-6">
                                &nbsp;
                            </div>
                            <div class="prepend-1 span-2">
                                <?php echo anchor('experienciasnegocios/ver_experiencia/'.$pulzos_empresa->pulzoId,
                                                  'Ver mas',
                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-pulzo')); ?>
                            </div>
                            <div class="span-2">
                                <?php echo anchor('#',
                                                  'Comentar', 
                                                  array('id'=>'comentarPulzos','class'=>'comentar', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: -3px;', 'name'=>$pulzos_empresa->pulzoId)); ?>
                            </div>
                            <?php if($this->session->userdata('id') == $empresa->negocioUsuarioId): ?>
                                <div class="span-1">
                                    <?php echo anchor('pulzos/borrar/'.$pulzos_empresa->pulzoId,
                                                      'Eliminar',
                                                      array('id'=>'eliminarP', 'class'=>'eliminarPulzo', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: -5px;')); ?>
                                </div>
                            <?php else: ?>
                                <?php $planId = get_data_planusuario_by_pulzo($pulzos_empresa->pulzoId); ?>
                                <div class="span-1">
                                    <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planId->planId.'/'.$pulzos_empresa->pulzoId,
                                                      'Reservar',
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </div>
                            <?php endif; ?>
                        </div><!-- DIV DEL MENU **FIN** -->
                        <div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                            <?php $pulzos_post = get_pulzos_subcomments($pulzos_empresa->pulzoId); ?>
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
                                                    <?php if($this->session->userdata('idN') == $pulzos_empresa->pulzoUsuarioId): ?>
                                                        <?php echo anchor('negocios/delete_subcomments_plains/'.$pulzos_empresa->pulzoId.'/'.$posteos->comentarioId,
                                                                          img(array('src'=>'statics/img/cerrar.jpg',
                                                                                    'width'=>'14px',
                                                                                    'height'=>'12px')),
                                                                          array('class'=>'eliminar-pulzo')); ?>
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
                        <div class="comentarios-<?php echo $pulzos_empresa->pulzoId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                            <?php echo form_open('experienciasnegocios/subcomentarios_post_pulzos/'.$pulzos_empresa->pulzoId.'/'.$pulzos_empresa->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                                array('class'=>'forma-comentar-muro'.$pulzos_empresa->pulzoId)); ?>
                                <div class="span-8" style="margin-left: 6px">
                                    <?php echo form_textarea(array('id'=>'sub-comentario'.$pulzos_empresa->pulzoId,
                                                                   'class'=>'secondary-comment'.$pulzos_empresa->pulzoId,
                                                                   'style'=>'width: 470px; height: 23px; color: #999999',
                                                                   'onkeypress'=>'subcomentar_enter(event,' . $pulzos_empresa->pulzoId . ')',
                                                                   'value'=>'Comentar',
                                                                   'onfocus'=>"return quitar('Comentar'," . $pulzos_empresa->pulzoId . ")",
                                                                   'onblur'=>"return poner('Comentar'," . $pulzos_empresa->pulzoId . ")",
                                                                   'name'=>'comentar_negocios')); ?>
                                </div>
                            <?php echo form_close(); ?>
                            <input type="hidden" id="oct<?php echo $pulzos_empresa->pulzoId; ?>" />
                        </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                    </div><!-- DIV DEL CUERPO **FIN** -->
                <?php endif; ?>
            </div><!-- DIV PRINCIPAL DEL FOREACH **FIN** -->
                <?php endif; ?>
          <?php endif; ?><!-- CONDICION PARA CONOCER SI HAY PULZOS DEL NEGOCIO O NO **FIN** -->
        <?php endforeach; ?>
    </div>
</div><!-- DIV PRINCIPAL **FIN** -->
