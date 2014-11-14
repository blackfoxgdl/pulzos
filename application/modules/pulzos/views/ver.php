<?php
/**
 * Ver pulzos del usuario identificado
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright Zavordigital, 10 March, 2011
 * @package Pulzos
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
    urlEliminar = $(event.currentTarget).attr("href");
    urlLateral = $("#urlVer").attr("href");
    urlVer = $("#return").attr("href");
    $.get(urlEliminar);
    $("#texto-menu").load(urlLateral);
    $("#pulzos_hecho").load(urlVer);
    $(event.currentTarget).parent().parent().parent().hide("hide");
});

function recargarPV()
{
    url = ("#return").attr("href");
    $("#pulzos_hecho").load(url);
}

$("#comentarPulzos").click(function(event){
    event.preventDefault();
    url = $(this).attr("href");
    $("#texto-menu").load(url);
});

$(".comentar").click(function(event){
    event.preventDefault();
    attrId = $(event.currentTarget).attr('name');
    $(".comentario-"+attrId).show();
});

$(".eliminarPulzo").click(function(event){
    event.preventDefault();
    urlEliminar = $(event.currentTarget).attr("href");
    urlLoad = $("#reload").attr("href");
    $.get(urlEliminar);
    urlRedirect = $("#redirectP").attr("href");
    $("#texto-menu").load(urlRedirect);
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
                       url = $("#pulzosR").attr("href");
                       $("#texto-menu").load(url);
                   });
        }
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
    $(event.currentTarget).parent().parent().parent().parent().hide().remove();
});
</script>
<?php echo anchor('pulzos/ver_simple/'.$pulzo->pulzoId, '', array('style'=>'display: none', 'id'=>'pulzosR')); ?>
<?php echo anchor('pulzos/ver/'.$pulzo->negocioId, '', array('style'=>'display: none', 'id'=>'redirectP')); ?>
<div class="span-13" style="margin-top: 20px">
    <div class="span-13"><!-- MAIN **INICIO** -->
        <div class="span-14 last"><!-- DIV PRINCIPAL CUERPO **INICIO** -->
            <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                <?php echo img(array('src'=>get_avatar_negocios($pulzo->negocioId),
                                     'width'=>'37px',
                                     'height'=>'37px')); ?>
            </div><!-- DIV AVATAR **FIN** -->
            <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!--DIV DEL CUERPO MENSAJE PULZO **INICIO** -->
                <span class="pulzos_titulo1">
                    <?php echo anchor('negocios/perfil/'.$pulzo->negocioId,
                                      get_complete_username($pulzo->negocioUsuarioId),
                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                </span>
                <br />
                <span class="pulzos_titulo2">
                    <?php echo $pulzo->pulzoTitulo; ?>
                </span>
                <br />
                <span class="pulzos_titulo1">
                    Fecha Inicio:
                </span>
                <span class="pulzos_titulo2">
                    <?php $fechaI = unix_to_human($pulzo->pulzoFechaInicio);
                          $inicio = fecha_acomodo($fechaI);
                          echo $inicio; ?>
                </span>
                <br />
                <span class="pulzos_titulo1">
                    Fecha Fin:
                </span>
                <span class="pulzos_titulo2">
                    <?php
                        $fechaF = unix_to_human($pulzo->pulzoFechaFin);
                        $correctaF = fecha_acomodo($fechaF);
                        echo $correctaF;
                    ?>
                </span>
            </div><!-- DIV DEL CUERPO MENSAJE PULZO **FIN** -->
            <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DESCRIPCION PULZO **INICIO** -->
                <div class="span-2">
                    <?php if($pulzo->pulzoImagenRuta == '0'): ?>
                        <?php echo img(array('src'=>get_avatar_negocios($pulzo->negocioId),
                                             'width'=>'100px',
                                             'height'=>'100px')); ?>
                    <?php else: ?>
                        <?php echo img(array('src'=>$pulzo->pulzoImagenRuta,
                                             'width'=>'100px',
                                             'height'=>'100px')); ?>
                    <?php endif; ?>
                </div>
                <div class="prepend-1 span-9 last" style="margin-top: 5px">
                    <span class="pulzos_titulo2">
                        <?php echo $pulzo->pulzoAccion; ?>
                    </span>
                </div>
            </div><!-- DIV DESCRIPCION PULZO **FIN*** -->
            <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                    <?php echo anchor('#',
                                      'Aviso Legal:',
                                       array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$pulzo->pulzoId, 'id'=>'ver-'.$pulzo->pulzoId)); ?>
                    <?php echo anchor('#',
                                      'Aviso Legal:',
                                       array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$pulzo->pulzoId, 'id'=>'ocultar-'.$pulzo->pulzoId)); ?>
                </div>
            </div>
            <div style="display: none; margin-bottom: 5px" id="aviso-legal-<?php echo $pulzo->pulzoId; ?>">
                <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                    <?php echo $pulzo->pulzoAvisoLegal; ?>    
                </div>
            </div><!-- DIV AVISO LEGAL **FIN** -->
            <div class="prepend-1 span-14 last" style="margin-bottom: 0px"><!-- DIV DEL MENU **INICIO** -->
                <div class="span-6">
                    &nbsp;
                </div>
                <div class="prepend-3 span-2">
                    <?php echo anchor('#',
                                      'Comentar',
                                      array('class'=>'comentar', 'style'=>'color: #8D6E98; text-decoration: none', 'name'=>$pulzo->pulzoId)); ?>
                </div>
                <?php if($this->session->userdata('id') == $pulzo->negocioUsuarioId): ?>
                    <div class="span-1">
                        <?php echo anchor('pulzos/borar/'.$pulzo->pulzoId,
                                          'Eliminar',
                                          array('id'=>'', 'class'=>'eliminarPulzo', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: -5px')); ?>
                    </div>
                <?php else: ?>
                    <div class="span-1">
                        <?php $planes = get_data_planusuario_by_pulzo($pulzo->pulzoId); ?>
                        <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$pulzo->pulzoId,
                                          'Reservar',
                                           array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </div>
                <?php endif; ?>
            </div><!-- DIV DEL MENU **FIN** -->
                <div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                    <?php $pulzos_post = get_pulzos_subcomments($pulzo->pulzoId); ?>
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
                                <div class="span-9 last" style="margin-top: 5px; margin-left: 0px">
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
                                            <?php if($this->session->userdata('idN') == $pulzo->pulzoUsuarioId): ?>
                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$pulzo->pulzoId.'/'.$posteos->comentarioId,
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
            <div class="comentario-<?php echo $pulzo->pulzoId; ?> prepend-1 span-8 last" style="display: none; margin-bottom: 5px"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                <?php echo form_open('pulzos/subcomentarios_post_pulzos/'.$pulzo->pulzoId.'/'.$pulzo->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                    array('class'=>'forma-comentar-muro'.$pulzo->pulzoId)); ?>
                    <div class="span-8" style="margin-left: 6px">
                        <?php echo form_textarea(array('id'=>'sub-comentario'.$pulzo->pulzoId,
                                                       'class'=>'secondary-comment'.$pulzo->pulzoId,
                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                       'onkeypress'=>'subcomentar_enter(event,' . $pulzo->pulzoId . ')',
                                                       'value'=>'Comentar',
                                                       'onfocus'=>"return quitar('Comentar'," . $pulzo->pulzoId . ")",
                                                       'onblur'=>"return poner('Comentar'," . $pulzo->pulzoId . ")",
                                                       'name'=>'comentar_negocios')); ?>
                    </div>
                <?php echo form_close(); ?>
                <input type="hidden" id="oct<?php echo $pulzo->pulzoId; ?>" />
            </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->            
        </div><!-- DIV PRINCIPAL CUERPO **FIN** -->
    </div><!-- MAIN **FIN** -->
</div>
