<?php
/**
 * Se muestran todos los pulzos hechos por
 * la empresa que este logueada y presione el link
 * de los pulzos
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

$(".comentar").click(function(event){
    event.preventDefault();
    attrId = $(event.currentTarget).attr('name');
    $(".comentarios-"+attrId).show();
    //urlComment = $(this).attr("href");
    //$("#texto-menu").load(urlComment);
});

$(".ver-mas-pulzo").click(function(event){
    event.preventDefault();
    urlVerPulzo = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlVerPulzo);
});

$(".pulzo-empresa").click(function(event){
    event.preventDefault();
    urlE = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlE);
});

$(".eliminarPulzo").click(function(event){
    event.preventDefault();
    urlEliminar = $(event.currentTarget).attr("href");
    urlLoad = $("#reload").attr("href");
    $.get(urlEliminar);
    $(event.currentTarget).parent().parent().parent().parent().hide("hide").remove();
    $("#pulzos_hecho").load(urlLoad);
});
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

//VAMOS PARA LOS SIGUIENTES PULZOS
$(".ver-mas-publicaciones").click(function(event){
    event.preventDefault();
    urlPrimera = $(event.currentTarget).attr("href");
    ultimos = $("#ultimos").text();
    urlGet = $("#urlGet").attr("href");
    urlSendFirst =  urlPrimera + '/' + ultimos;
    urlSendSecond = urlGet + '/' + ultimos;
    clases = "ver"+ultimos;
    $.ajax({
           type: "POST",
           url: urlSendFirst,
           success: function(html){
               $("#verMas").append($("<div></div>").addClass(clases));
               $("."+clases).html(html);
            }
    });
    $.ajaxSetup({cache: false})
    $.get(urlSendSecond,
        function(data){
              $("#ultimos").text(data);
          }, 
         "json"
     );
});

</script>
<div class="span-14 last" style="margin-top: 20px">
    <?php echo anchor('pulzos/reload_comment/', '', array('style'=>'display: none', 'id'=>'recarga_comentario')); ?>
    <?php echo anchor('pulzos/ver/'.$id,'',array('id'=>'enlace', 'style'=>'display: none')); ?>
    <?php echo anchor('negocios/get_pulzos_nuevos/'.$id, '', array('id'=>'reload', 'style'=>'display:none')); ?>
    <?php $valores = obtain_array_company($pulzos); ?>
    <?php foreach($pulzos as $anuncio): ?>
        <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV DE CUERPO EN PULZOS **FIN** -->
            <div class="span-14 last" style="width: 524px"><!-- FONDO **INICIO** -->
                <div class="span-1">
                    <?php echo img(array('src'=>get_avatar_negocios($anuncio->negocioId),
                                         'width'=>'37px',
                                         'height'=>'37px')); ?>
                </div>
                <div class="interlineado span-12 last" style="margin-top: 3px; word-wrap: break-word; margin-left: 10px"><!--DIV CUERPO DEL POSTEO **INICIO** -->
                    <span class="pulzos_titulo1">
                        <?php echo anchor('negocios/perfil/'.$anuncio->negocioId,
                                          get_complete_username($anuncio->negocioUsuarioId),
                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </span>
                    <br />
                    <span class="pulzos_titulo2">
                        <?php echo $anuncio->pulzoTitulo; ?>
                    </span>
                    <br />
                    <span class="pulzos_titulo1">
                        Fecha Inicio: 
                    </span>
                    <span class="pulzos_titulo2">
                        <?php 
                            $fechaI = unix_to_human($anuncio->pulzoFechaInicio); 
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
                            $fechaF = unix_to_human($anuncio->pulzoFechaFin);
                            $correctaF = fecha_acomodo($fechaF);
                            echo $correctaF;
                        ?>
                    </span>
                </div><!-- DIV CUERPO DEL POSTEO **FIN** -->
                <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION PULZO **INICIO** -->
                    <div class="span-2">
                        <?php if($anuncio->pulzoImagenRuta == '0'): ?>
                            <?php echo img(array('src'=>get_avatar_negocios($anuncio->negocioId),
                                                 'width'=>'100',
                                                 'height'=>'100')); ?>
                        <?php else: ?>
                            <?php echo img(array('src'=>get_avatar_pulzo($anuncio->pulzoId),
                                                 'width'=>'100',
                                                 'height'=>'100')); ?>
                        <?php endif; ?>
                    </div>
                    <div class="prepend-1 span-9 last" style="margin-top: 5px">
                        <span class="pulzos_titulo2">
                            <?php echo anchor('pulzos/ver_simple/'.$anuncio->pulzoId,
                                              $anuncio->pulzoAccion,
                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-pulzo')); ?>
                        </span>
                    </div>
                </div><!-- DIV DE DESCRIPCION PULZO **FIN** -->
                <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                    <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                        <?php echo anchor('#',
                                          'Aviso Legal:',
                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$anuncio->pulzoId, 'id'=>'ver-'.$anuncio->pulzoId)); ?>
                        <?php echo anchor('#',
                                          'Aviso Legal:',
                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$anuncio->pulzoId, 'id'=>'ocultar-'.$anuncio->pulzoId)); ?>
                    </div>
                </div>
                <div style="display: none" id="aviso-legal-<?php echo $anuncio->pulzoId; ?>">
                    <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                        <?php echo $anuncio->pulzoAvisoLegal; ?>    
                    </div>
                </div><!-- DIV AVISO LEGAL **FIN** -->
                <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                    <div class="span-6">
                        &nbsp;
                    </div>
                    <div class="prepend-1 span-2">
                        <?php echo anchor('pulzos/ver_simple/'.$anuncio->pulzoId,
                                          'Ver mas',
                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas-pulzo')); ?>
                    </div>
                    <div class="span-2">
                        <?php echo anchor('#',
                                          'Comentar', 
                                          array('class'=>'comentar', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: 5px;', 'name'=>$anuncio->pulzoId)); ?>
                    </div>
                    <?php if($this->session->userdata('id') == $anuncio->negocioUsuarioId): ?>
                        <div class="span-1">
                            <?php echo anchor('pulzos/borrar/'.$anuncio->pulzoId,
                                              'Eliminar',
                                               array('id'=>'eliminarP', 'class'=>'eliminarPulzo', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: -5px;')); ?>
                        </div>
                    <?php else: ?>
                        <?php $planes = get_data_planusuario_by_pulzo($anuncio->pulzoId); ?>
                        <div class="span-1">
                            <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$anuncio->pulzoId,
                                              'Reservar',
                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="comentarios<?php echo $anuncio->pulzoId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                    <?php $pulzos_post = get_pulzos_subcomments($anuncio->pulzoId); ?>
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
                                            <?php if($this->session->userdata('idN') == $anuncio->pulzoUsuarioId): ?>
                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$anuncio->pulzoId.'/'.$posteos->comentarioId,
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
                <div class="comentarios-<?php echo $anuncio->pulzoId; ?> prepend-1 span-8 last" style="display: none; margin-bottom: 5px"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                    <?php echo form_open('pulzos/subcomentarios_post_pulzos/'.$anuncio->pulzoId.'/'.$anuncio->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                        array('class'=>'forma-comentar-muro'.$anuncio->pulzoId)); ?>
                        <div class="span-8" style="margin-left: 6px">
                            <?php echo form_textarea(array('id'=>'sub-comentario'.$anuncio->pulzoId,
                                                           'class'=>'secondary-comment'.$anuncio->pulzoId,
                                                           'style'=>'width: 470px; height: 23px; color: #999999',
                                                           'onkeypress'=>'subcomentar_enter(event,' . $anuncio->pulzoId . ')',
                                                           'value'=>'Comentar',
                                                           'onfocus'=>"return quitar('Comentar'," . $anuncio->pulzoId . ")",
                                                           'onblur'=>"return poner('Comentar'," . $anuncio->pulzoId . ")",
                                                           'name'=>'comentar_negocios')); ?>
                        </div>
                    <?php echo form_close(); ?>
                    <input type="hidden" id="oct<?php echo $anuncio->pulzoId; ?>" />
                </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
            </div><!-- FONDO  **FIN** -->
        </div><!-- DIV DE CUERPO EN PULZOS **FIN* -->
    <?php endforeach; ?>    
    <?php /** checar esto del error hasta aqui **/ ?>
    <div class="span-14 last"><!-- DIV DONDE SE PONDRAN LOS REGISTROS DE VER MAS **INICIO** -->
        <div id="verMas">
        </div>
    </div><!-- DIV DONDE SE PONDRAN LOS REGISTROS DE VER MAS **FIN** -->
    <div class="span-14 last" style="display: none">
    <span id="ultimos"><?php echo $valores; ?></span>
        <?php echo anchor('pulzos/get_next_ten_datas/'.$id, '', array('style'=>'display:', 'id'=>'urlGet')); ?>
    </div>
    <div class="span-14">
        <div class="prepend-12 last">
            <?php echo anchor('pulzos/siguientes_pulzos/'.$id,
                              'Ver mas',
                              array('style'=>'text-decoration: none; color: #660066', 'class'=>'ver-mas-publicaciones')); ?>
        </div>
    </div>
</div>
