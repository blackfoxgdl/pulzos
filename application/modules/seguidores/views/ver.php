<?php
/**
 * Vista para la muestra de los usuarios
 * que estan siguiendo al negocios que
 * se encuentra registrado en pulzos
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package Usuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
 
echo doctype();
?>
<script type="text/javascript">
$('.comentarios').click(function(event){
    event.preventDefault();
    $('html, body').animate({
        scrollTop: $(document).height()
        },1500
    );
    var idPulzos = $(event.currentTarget).attr('name');
    $("#forma-comentar-"+idPulzos).show();
});

function subcomentar_enter(event, idpulzo)
{
    if(event.keyCode == 13)
    {
        var accion = $(".forma-comentar"+idpulzo).attr("action");
        var datoaccion = $(".comentar-pulzos"+idpulzo).attr("value");
        $.ajax({
            type: "POST",
            url: accion,
            data: "comentar_pulzo="+datoaccion,
            success: cargarVista
        });
    }
}

function cargarVista()
{
    $('html, body').animate({
        scrollTop: 0
        },1500
    );
    var returnLink = $("#returnLink").attr('href');
    $("#texto-menu").load(returnLink);
}

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
</script>
<div style="display: none">
    <?php echo anchor('seguidores/ver/'.$negocio->pulzoId, '', array('id'=>'returnLink')); ?>
    <div id="nombre-usuario-plan">Pulzo Actual</div>
    <div id="edad-usuario-plan"></div>
    <div id="relacion-usuario-plan"></div>
    <div id="estado-usuario-plan"></div>  
</div>
<div class="span-14 last" style="margin-top: 20px;"><!-- DIV PRINCIPAL DE LA VISTA **INICIO** -->
    <div class="span-14">
        <div class="span-1" id="foto">
            <?php echo anchor('negocios/perfil/'.$negocio->negocioId,
                              img(array('src'=>get_avatar_negocios($negocio->negocioId),
                                        'height'=>'37px',
                                        'width'=>'37px'))); ?>
        </div>
        <div class="span-12"><!-- DIV CUERPO PULZO -->
            <div class="span-12 last" style="margin-left: 10px">
                <?php echo anchor('negocios/perfil/'.$negocio->negocioId,
                                  $negocio->negocioNombre,
                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'pulzos_titulo1')); ?>
            </div>
            <div class="span-12 last">
                <span style="margin-left: 13px">
                    <?php echo $negocio->pulzoAccion; ?>
                </span>
            </div>
        </div><!-- DIV CUERPO PULZO -->
        <div class="span-12" style="margin-top: 14px"><!-- DIV FECHA DEL PULZO -->
            <div class="span-10" style="color: #8D6E98; margin-left: 10px">
                <div class="span-1">
                    Inicia:
                </div>
                <div class="span-8 last" style="margin-left: 20px">
                    <?php $fechaI = unix_to_human($negocio->pulzoFechaInicio);
                          $fecha_acomodo = fecha_acomodo($fechaI);
                          echo $fecha_acomodo; ?>
                </div>
            </div>
            <div class="span-10" style="color: #8D6E98; margin-left: 10px">
                <div class="span-1">
                    Termina:
                </div>
                <div class="span-8 last" style="margin-left: 20px">
                    <?php $fechaF = unix_to_human($negocio->pulzoFechaFin);
                          $fecha_acomodo2 = fecha_acomodo($fechaF);
                          echo $fecha_acomodo2; ?>
                </div>
            </div>
        </div><!-- DIV FECHA DEL PULZO -->
        <div class="prepend-1 span-11 last" style="margin-top: 23px; margin-left: 13px"><!-- DIV DEL MENU Y FECHA PUBLICACION -->
            <div class="span-1">
                <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                     'width'=>'16',
                                     'height'=>'12')); ?>
            </div>
            <div class="span-3" style="margin-top: -3px; color: #999999">
                <?php $fecha = unix_to_human($negocio->pulzoFechaCreacion);
                      $fecha_correcta = fecha_acomodo($fecha);
                      echo $fecha_correcta; ?>
            </div>
            <div class="span-3">
                &nbsp;
            </div>
            <div class="span-4 last">
                <div class="span-2">
                    &nbsp;
                </div>
                <div class="span-1">
                    <?php echo anchor('#',
                                      'Comentar',
                                      array('style'=>'margin-left: -15px; color: #8D6E98; text-decoration: none', 'class'=>'comentarios', 'name'=>$negocio->pulzoId)); ?>
                </div>
                <div class="span-1 last">
                    <?php echo anchor('#',
                                      'Reservar',
                                      array('style'=>'margin-left: 10px; color: #8D6E98; text-decoration: none')); ?>
                </div>
            </div>
        </div><!-- DIV DEL MENU Y FECHA DE PUBLICACION -->
        <div class="prepend-1 span-11" style="margin-left: 10px; margin-top: 17px"><!-- DIV DE LOS COMENTARIOS **INICIO** -->
            <?php $comentarios = get_comments_Allpulzos($negocio->pulzoId, $negocio->negocioId); ?>
            <?php foreach($comentarios as $subcomentario): ?>
                <div class="span-12" style="background-color: #DCCEDD; margin-top: 10px; margin-bottom: 10px">
                    <div class="span-12 last">
                        <?php if($subcomentario->statusEU == 0): ?>
                            <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                <?php echo img(array('src'=>get_avatar($subcomentario->id),
                                                     'width'=>'36',
                                                     'height'=>'36')); ?>
                            </div>
                        <?php else: ?>
                            <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                <?php $datosNeg = datos_negocios($subcomentario->id); ?>
                                <?php echo img(array('src'=>get_avatar_negocios($datosNeg->negocioId),
                                                     'width'=>'36',
                                                     'height'=>'36')); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($subcomentario->statusEU == 0): ?>
                            <div class="span-10 last" style="margin-top: 10px; margin-left: 14px">
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('usuarios/perfil/'.$subcomentario->id,
                                                      get_complete_username($subcomentario->id),
                                                      array('style'=>'text-decoration: none', 'class'=>'pulzos_titulo1')); ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo2" style="word-wrap: break-word;">
                                    <?php echo $subcomentario->comentarioTexto; ?>
                                </span>
                            </div>
                            <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                <div class="span-1">
                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                         'width'=>'14',
                                                          'height'=>'12')); ?>
                                </div>
                                <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999">
                                    <?php $fecha = unix_to_human($subcomentario->comentarioFechaCreacion);
                                          $fechaCreacionComentario = fecha_acomodo($fecha);
                                          echo $fechaCreacionComentario; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="span-10 last" style="margin-top: 10px; margin-left: 14px">
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('negocios/perfil/'.$datosNeg->negocioId,
                                                      $subcomentario->nombre,
                                                      array('style'=>'text-decoration: none', 'class'=>'pulzos_titulo1')); ?>
                                </span>
                                <br />
                                <span class="pulzos_tiulo2" style="word-wrap: break-word;">
                                    <?php echo $subcomentario->comentarioTexto; ?>
                                </span>
                            </div>
                            <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                <div class="span-1" style="margin-top: 20px">
                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                         'width'=>'14',
                                                         'height'=>'12')); ?>
                                </div>
                                <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999">
                                    <?php $fecha = unix_to_human($subcomentario->comentarioFechaCreacion);
                                          $fechaCreacionComentario = fecha_acomodo($fecha);
                                          echo $fechaCreacionComentario; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!-- DIV DE LOS COMENTARIOS **FIN** -->
        <div class="prepend-1 span-10 last" style="margin-top. 10px; display: none" id="forma-comentar-<?php echo $negocio->pulzoId; ?>">
            <?php echo form_open('seguidores/guardar_comentario_pulzo/'.$negocio->pulzoUsuarioId.'/'.$this->session->userdata('id').'/'.$negocio->pulzoId,
                                 array('class'=>'forma-comentar'.$negocio->pulzoId)); ?>
                <?php echo form_textarea(array('id'=>'',
                                               'class'=>'comentar-pulzos'.$negocio->pulzoId,
                                               'style'=>'width: 450px; height: 25px; margin-left: 10px',
                                               'onkeypress'=>'subcomentar_enter(event,' . $negocio->pulzoId . ')',
                                               'name'=>'comentar_pulzo')); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div><!-- DIV PRINCIPAL DE LA VISTA -->
