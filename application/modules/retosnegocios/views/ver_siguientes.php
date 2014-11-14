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

$(".comentar-reto").click(function(event){
    event.preventDefault();
    nameRetosComment = $(event.currentTarget).attr("name");
    $(".comentarios-"+nameRetosComment).show();
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

$(".eliminar-pulzo").click(function(event){
    event.preventDefault();
    urlDelete = $(event.currentTarget).attr("href");
    $.get(urlDelete);
    $(event.currentTarget).parent().parent().parent().parent().parent().hide().remove();
});

$(".eliminar-sub").click(function(event){
    event.preventDefault();
    urlDeleteSub = $(event.currentTarget).attr("href");
    $.get(urlDeleteSub);
    $(event.currentTarget).parent().parent().parent().parent().parent().hide().remove();
});

$(".ver-mas-retos").click(function(event){
    event.preventDefault();
    urlVerRetos = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlVerRetos)
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
        
        document.getElementById(nameDiv).innerHTML ="<span style=' font-size:17px; color:#660068; '>"+'tiempo restante: '+hours+ 'h : ' +mins+ 'm : '+secs+'s'+"</span>";
        setTimeout('displayCountDown('+(countdown-1)+',\''+nameDiv+'\');',999);
		
	}
}

function subcomentar_enter(event, idplan)
{
    if(event.keyCode == 13)
    {
        var accionAtr = $(".forma-comentar-muro"+idplan).attr("action");
        var datosAccion = $(".secondary-comment"+idplan).attr("value");
        //desenfocada inicio
        $(".secondary-comment"+idplan).blur();
        $("#oct"+idplan).val(datosAccion).focus();
        //desenfocada fin
        var clase = "comentarios"+idplan;
        urlReloadC = $("#recarga_comentario").attr("href");
        urlReloadComentario = urlReloadC + '/' + idplan;
        if(datosAccion != "Comentar")
        {
		  $.post(accionAtr, 
                   {comentar_negocios:datosAccion},
                   function(data){
                        $(".comentarios-"+idplan).hide();
                        $("."+clase).load(urlReloadComentario);
                        $(".secondary-comment"+idplan).val("Comentar");
            });
           

        }
    }
}
</script>
<?php echo anchor('retosnegocios/reload_comment/', '', array('style'=>'display: none', 'id'=>'recarga_comentario')); ?>
<?php $b = 0; ?>
<?php foreach($retos as $anuncios): ?>
        <?php $b=$b+1;?>
        <?php //var_dump($anuncios); ?>
        <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
            <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                    <?php echo img(array('src'=>get_avatar_negocios($anuncios->negocioId),
                                         'width'=>'37px',
                                         'height'=>'37px')); ?>
                </div><!-- DIV AVATAR **FIN** -->
                <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!-- DIV DEL CUERPO DEL MENSAJE **INICIO** -->
                    <span class="pulzos_titulo1">
                        <?php echo anchor('negocios/perfil/'.$anuncios->negocioId,
                                          get_complete_username($anuncios->negocioUsuarioId),
                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </span>
                    <br />
                    <span class="pulzos_titulo2">
                        <?php echo $anuncios->pulzoTitulo; ?>
                    </span> 
                    <br />
                    <?php if($anuncios->pulzoTipoEventoId == 1): ?>
                        <span class="pulzos_titulo2">
                            Reto de Consumo
                        </span>
                    <?php elseif($anuncios->pulzoTipoEventoId == 2): ?>
                        <span class="pulzos_titulo1">
                            Vence en:
                        </span>
                        <span>
                            <br><br>
                            <div id="duracion<?php echo $b;?>"></div>
                                <script language="javascript">
    								
								    var tiempotras=new Date();
    								var textofecha='<?php echo $anuncios->pulzoDuracionReto; ?>';
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
							    		if(maniana<=maniana1){start(nueva,tiempotras,'countdowncontainer1<?php echo $b;?>');}
								    
                                </script>
                                <div id="countdowncontainer1<?php echo $b;?>" style=" background:#DDEACF;  border:0px; border: 0px solid #399210; color:#006600; width:250px; height:27px;">
                                    aun falta para empezar 
                                </div>
                        </span>
                    <?php elseif($anuncios->pulzoTipoEventoId == 3): ?>
                        <span class="pulzos_titulo2">
                            Reto de Actividad
                        </span>
                    <?php elseif($anuncios->pulzoTipoEventoId == 4): ?>
                        <span class="pulzos_titulo1">
                            No. de Integrantes:
                        </span>
                        <span class="pulzos_titulo2">
                            <?php echo $anuncios->pulzoNumeroAsistentes; ?>
                        </span>
                    <?php elseif($anuncios->pulzoTipoEventoId == 5): ?>
                        <span class="pulzos_titulo2">
                            Otros
                        </span>
                    <?php endif; ?>
                    <br />   
                </div><!-- DIV DEL CUERPO DEL MENSAJE **FIN** -->
                <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION RETO **INICIO** -->
                    <div class="span-2">
                        <?php if($anuncios->pulzoImagenRuta == '0'): ?>
                            <?php echo img(array('src'=>get_avatar_negocios($anuncios->pulzoUsuarioId),
                                                 'width'=>'100px',
                                                 'height'=>'100px')); ?>
                        <?php else: ?>
                            <?php echo img(array('src'=>$anuncios->pulzoImagenRuta,
                                                 'width'=>'100px',
                                                 'height'=>'100px')); ?>
                        <?php endif; ?>                    
                    </div>
                    <div class="prepend-1 span-9 last" style="margin-top: 5px">
                        <span class="pulzos_titulo2">
                            <?php echo anchor('retosnegocios/ver_reto/'.$anuncios->pulzoId,
                                              $anuncios->pulzoAccion,
                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-retos')); ?>
                        </span>
                    </div>
                </div><!-- DIV DE DESCRIPCION RETO **FIN** -->
                <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                    <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98"> 
                        <?php echo anchor('#',
                                          'Aviso Legal:',
                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$anuncios->pulzoId, 'id'=>'ver-'.$anuncios->pulzoId)); ?>
                        <?php echo anchor('#',
                                          'Aviso Legal:',
                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$anuncios->pulzoId, 'id'=>'ocultar-'.$anuncios->pulzoId)); ?>
                    </div>
                </div>
                <div style="display: none" id="aviso-legal-<?php echo $anuncios->pulzoId; ?>">
                    <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                        <?php echo $anuncios->pulzoAvisoLegal; ?>    
                    </div>
                </div><!-- DIV AVISO LEGAL **FIN** -->
                <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                    <div class="span-6">
                        &nbsp;
                    </div>
                    <div class="prepend-1 span-2">
                        <?php echo anchor('retosnegocios/ver_reto/'.$anuncios->pulzoId,
                                          'Ver mas',
                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas-retos')); ?>
                    </div>
                    <div class="span-2">
                        <?php echo anchor('#',
                                          'Comentar',
                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px;', 'class'=>'comentar-reto', 'name'=>$anuncios->pulzoId)); ?>
                    </div>
                    <?php if($this->session->userdata('id') == $anuncios->negocioUsuarioId): ?>
                        <div class="span-1">
                            <?php echo anchor('pulzos/borrar/'.$anuncios->pulzoId,
                                              'Eliminar',
                                              array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -5px', 'class'=>'eliminar-pulzo')); ?>
                        </div>
                    <?php else: ?>
                        <div class="span-1">
                            <?php $planes = get_data_planusuario_by_pulzo($anuncios->pulzoId); ?>
                            <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$anuncios->pulzoId,
                                              'Reservar',
                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="comentarios<?php echo $anuncios->pulzoId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                    <?php $pulzos_post = get_pulzos_subcomments($anuncios->pulzoId); ?>
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
                                            <?php if($this->session->userdata('idN') == $anuncios->pulzoUsuarioId): ?>
                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$anuncios->pulzoId.'/'.$posteos->comentarioId,
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
                <div class="comentarios-<?php echo $anuncios->pulzoId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                    <?php echo form_open('retosnegocios/subcomentarios_post_pulzos/'.$anuncios->pulzoId.'/'.$anuncios->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                        array('class'=>'forma-comentar-muro'.$anuncios->pulzoId)); ?>
                        <div class="span-8" style="margin-left: 6px">
                            <?php echo form_textarea(array('id'=>'sub-comentario'.$anuncios->pulzoId,
                                                           'class'=>'secondary-comment'.$anuncios->pulzoId,
                                                           'style'=>'width: 470px; height: 23px; color: #999999',
                                                           'onkeypress'=>'subcomentar_enter(event,' . $anuncios->pulzoId . ')',
                                                           'value'=>'Comentar',
                                                           'onfocus'=>"return quitar('Comentar'," . $anuncios->pulzoId . ")",
                                                           'onblur'=>"return poner('Comentar'," . $anuncios->pulzoId . ")",
                                                           'name'=>'comentar_negocios')); ?>
                        </div>
                    <?php echo form_close(); ?>
                    <input type="hidden" id="oct<?php echo $anuncios->pulzoId; ?>" />
                </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
            </div><!-- DIV DEL CUERPO **FIN** -->
        </div><!-- DIV CONTENEDOR **FIN** -->
<?php endforeach; ?>
