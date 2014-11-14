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

$(".eliminarPulzo").click(function(event){
    event.preventDefault();
    url = $(event.currentTarget).attr("href");
    urlLoad = $("#reloadUrl").attr("href");
    $.get(url);
    $(event.currentTarget).parent().parent().parent().parent().hide();
});

$(".comentar").click(function(event){
    event.preventDefault();
    nameAttr = $(event.currentTarget).attr('name');
    $(".comentarios-"+nameAttr).show();
});

$(".ver-mas-experiencias").click(function(event){
    event.preventDefault();
    urlVerExperiencias = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlVerExperiencias);
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
        {//if inicio
            $.post(accionAtr, 
                   {comentar_negocios:datosAccion},
                   function(data){
                        $(".comentarios-"+idplan).hide();
                        $("."+clase).load(urlReloadComentario);
                        $(".secondary-comment"+idplan).val("Comentar");
            });
        }//if final
    }
}

$(".eliminar-pulzo").click(function(event){
    event.preventDefault();
    urlDelete = $(event.currentTarget).attr("href");
    $.get(urlDelete);
    $(event.currentTarget).parent().parent().parent().parent().parent().hide().remove();
});

</script>
<?php echo anchor('experienciasnegocios/reload_comment/', '', array('style'=>'display: none', 'id'=>'recarga_comentario')); ?>
<?php foreach($experiencias as $experiencia): ?>
        <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
            <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                <div class="span-1"><!-- DIV DEL AVATAR **INICIO** -->
                    <?php echo img(array('src'=>get_avatar_negocios($experiencia->negocioId),
                                         'width'=>'37px',
                                         'height'=>'37px')); ?>
                </div><!-- DIV DEL AVATAR **FIN** -->
                <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!--DIV DEL CUERPO DEL MENSAJE **INICIO** -->
                    <span class="pulzos_titulo1">
                        <?php echo anchor('negocios/perfil/'.$experiencia->pulzoUsuarioId,
                                          get_complete_username($experiencia->negocioUsuarioId),
                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </span>
                    <br />
                    <span class="pulzos_titulo2">
                        <?php echo $experiencia->pulzoTitulo; ?>
                    </span>
                    <br />
                    <span class="pulzos_titulo1">
                        Fecha Inicio: 
                    </span>
                    <span class="pulzos_titulo2">
                        <?php $fecha = unix_to_human($experiencia->pulzoFechaInicio);
                              $correcta = fecha_acomodo($fecha);
                              echo $correcta; ?> 
                    </span>
                    <br />
                    <span class="pulzos_titulo1">
                        Fecha Fin: 
                    </span>
                    <span class="pulzos_titulo2">
                        <?php $fechaF = unix_to_human($experiencia->pulzoFechaFin);
                              $correctaF = fecha_acomodo($fechaF);
                              echo $correctaF; ?>
                    </span>
                    <br />
                    <span class="pulzos_titulo1">
                        Paquete: 
                    </span>
                    <span class="pulzos_titulo2">
                        <?php echo substr($experiencia->pulzoPaqueteIncluye, 0, 80) . "...."; ?>
                    </span> 
                </div><!-- DIV DEL CUERPO DEL MENSAJE **FIN** -->
                <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION DE LA EXPERIENCIA **INICIO** -->
                    <div class="span-2">
                        <?php if($experiencia->pulzoImagenRuta == '0'): ?>
                            <?php echo img(array('src'=>get_avatar_negocios($experiencia->pulzoUsuarioId),
                                                 'width'=>'100',
                                                 'height'=>'100')); ?>
                        <?php else: ?>
                            <?php echo img(array('src'=>$experiencia->pulzoImagenRuta,
                                                 'width'=>'100',
                                                 'height'=>'100')); ?>
                        <?php endif; ?>                    
                    </div>
                    <div class="prepend-1 span-9 last">
                        <span class="pulzos_titulo2">
                            <?php echo anchor('experienciasnegocios/ver_experiencia/'.$experiencia->pulzoId,
                                              $experiencia->pulzoAccion,
                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-experiencias')); ?>
                        </span>
                    </div>
                </div><!-- DIV DE DESCRIPCION DE LA EXPERIENCIA **FIN** -->
                <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                    <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                        <?php echo anchor('#',
                                          'Aviso Legal:',
                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$experiencia->pulzoId, 'id'=>'ver-'.$experiencia->pulzoId)); ?>
                        <?php echo anchor('#',
                                          'Aviso Legal:',
                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$experiencia->pulzoId, 'id'=>'ocultar-'.$experiencia->pulzoId)); ?>
                    </div>
                </div>
                <div style="display: none" id="aviso-legal-<?php echo $experiencia->pulzoId; ?>">
                    <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px" >
                        <?php echo $experiencia->pulzoAvisoLegal; ?>    
                    </div>
                </div><!-- DIV AVISO LEGAL **FIN** -->
                <div class="prepend-1 span-14 last" style="margin-bottom: 0px"><!--DIV DEL MENU **INICIO** -->
                    <div class="span-6">
                        &nbsp;
                    </div>
                    <div class="prepend-1 span-2">
                        <?php echo anchor('experienciasnegocios/ver_experiencia/'.$experiencia->pulzoId,
                                          'Ver mas',
                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-experiencias')); ?>
                    </div>
                    <div class="span-2">
                        <?php echo anchor('#',
                                          'Comentar', 
                                          array('id'=>'comentarPulzos','class'=>'comentar', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: -3px;', 'name'=>$experiencia->pulzoId)); ?>
                    </div>
                    <?php if($this->session->userdata('id') == $experiencia->negocioUsuarioId): ?>
                        <div class="span-1">
                            <?php echo anchor('pulzos/borrar/'.$experiencia->pulzoId,
                                              'Eliminar',
                                              array('id'=>'eliminarP', 'class'=>'eliminarPulzo', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: -5px;')); ?>
                        </div>
                    <?php else: ?>
                        <div class="span-1">
                            <?php $planes = get_data_planusuario_by_pulzo($experiencia->pulzoId); ?>
                            <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$experiencia->pulzoId,
                                              'Reservar',
                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                        </div>
                    <?php endif; ?>
                </div><!-- DIV DEL MENU **FIN** -->
                <div class="comentarios<?php echo $experiencia->pulzoId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                    <?php $pulzos_post = get_pulzos_subcomments($experiencia->pulzoId); ?>
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
                                            <?php if($this->session->userdata('idN') == $experiencia->pulzoUsuarioId): ?>
                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$experiencia->pulzoId.'/'.$posteos->comentarioId,
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
                <div class="comentarios-<?php echo $experiencia->pulzoId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                    <?php echo form_open('experienciasnegocios/subcomentarios_post_pulzos/'.$experiencia->pulzoId.'/'.$experiencia->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                        array('class'=>'forma-comentar-muro'.$experiencia->pulzoId)); ?>
                        <div class="span-8" style="margin-left: 6px">
                            <?php echo form_textarea(array('id'=>'sub-comentario'.$experiencia->pulzoId,
                                                           'class'=>'secondary-comment'.$experiencia->pulzoId,
                                                           'style'=>'width: 470px; height: 23px; color: #999999',
                                                           'onkeypress'=>'subcomentar_enter(event,' . $experiencia->pulzoId . ')',
                                                           'value'=>'Comentar',
                                                           'onfocus'=>"return quitar('Comentar'," . $experiencia->pulzoId . ")",
                                                           'onblur'=>"return poner('Comentar'," . $experiencia->pulzoId . ")",
                                                           'name'=>'comentar_negocios')); ?>
                        </div>
                    <?php echo form_close(); ?>
                    <input type="hidden" id="oct<?php echo $experiencia->pulzoId; ?>" />
                </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
            </div><!-- DIV DEL CUERPO **FIN** -->
        </div><!-- DIV CONTENEDOR **FIN** -->
    <?php endforeach; ?>
