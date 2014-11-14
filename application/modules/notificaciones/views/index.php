<?php
/**
 * Se mostraran todas las notificaciones que
 * se tengan en la bandeja de entrada para
 * que el usuario o administrador del negocio
 * pueda revisar los comentarios o posibles
 * reservaciones que se haran
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigita, May 11, 2011
 * @package notificaciones
 **/
?>
<script type="text/javascript">

$(".eliminar-not").click(function(event){
    event.preventDefault();
    urlEliminar = $(event.currentTarget).attr("href");
    urlAttrEnviar = $(event.currentTarget).attr("name");
    urlUpdateEnviar = $("#actualizar-amigos").attr("href");
    urlSendUpdate = urlUpdateEnviar + '/' + urlAttrEnviar;
    $.get(urlSendUpdate,
          function(){
            urlReloadSecond = $("#reloadSecond").attr("href");
            $("#header-container").load(urlReloadSecond);
          });
    $.get(urlEliminar);
    $(event.currentTarget).parent().parent().parent().parent().hide();
});

$(".ver-mas").click(function(event){
    event.preventDefault();
    urlVerMas = $(event.currentTarget).attr("href");
    urlAttrSend = $(event.currentTarget).attr("name");
    urlUpdateMore = $("#actualizar-amigos").attr("href");
    urlEnviarUpdate = urlUpdateMore + '/' + urlAttrSend;
    $.get(urlEnviarUpdate,
          function(){
                urlReloadSecond = $("#reloadSecond").attr("href");
                $("#header-container").load(urlReloadSecond);
          });
    $("#texto-menu").load(urlVerMas);
});

function update() {
    urlReloadSecond = $("#reloadSecond").attr("href");
    $("#header-container").load(urlReloadSecond);
}

$(".ver-mas-amigos").click(function(event){
    event.preventDefault();
    urlVerMasAmigos = $(event.currentTarget).attr("href");
    urlId = $(event.currentTarget).attr("name");
    urlUpdate = $("#actualizar-amigos").attr("href");
    urlEnviar = urlUpdate+'/'+urlId;
    $.get(urlEnviar,
            function(){
                urlReloadSecond = $("#reloadSecond").attr("href");
                $("#header-container").load(urlReloadSecond);
          });
    $("#texto-menu").load(urlVerMasAmigos);
});

$(".ver-saludo").click(function(event){
    event.preventDefault();
    url_armar = $("#actualizar-amigos").attr("href");
    var UrlPerfilSaludo = $(event.currentTarget).attr("href");
    var name_attr = $(event.currentTarget).attr('name');
    total_url = url_armar + '/' + name_attr;
    $.get(total_url, 
          function(){ 
              location.href=UrlPerfilSaludo;
          });
});

$(".ver-pulzo").click(function(event){
    event.preventDefault();
    url_armar2 = $("#actualizar-amigos").attr("href");
    name_attr2 = $(event.currentTarget).attr("name");
    urlPerfilUno = $(event.currentTarget).attr("href");
    total_url2 = url_armar2 + '/' + name_attr2;
    $.get(total_url2,
          function(){
              location.href=urlPerfilUno;
          });
});

$(document).ready(function(){
    nombre_notification = $("#nombre-notificacion").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(nombre_notification);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);});
</script>
<?php echo anchor('usuarios/reload_header/'.$this->session->userdata('id'), '', array('id'=>'reloadSecond', 'style'=>'display:none')); ?>
<?php echo anchor('notificaciones/update_friendly/', '', array('id'=>'actualizar-amigos', 'style'=>'display: none')); ?>
<div class="span-14">
    <div style="display: none"><!-- TITULO **INICIO** -->
        <div id="nombre-notificacion">Notificaciones</div>
    </div><!-- DIV TITULO **FIN** -->
    <div class="span-14 last" style="margin-bottom: 30px"><!-- DIV DEL CUERPO **INICIO** -->
      <?php if(empty($notificaciones)): ?>
        <div class="span-14 last" style="margin-top: 30px; color: #660068; font-family: Arial, Helvetica, sans-serif; font-size: 18px; margin-bottom: 30px; text-align: center">
            No hay notificaciones actualmente
        </div>
      <?php else: ?>
        <?php foreach($notificaciones as $notificacion): ?><!-- FOREACH OBTENER NOTIFICACIONES **INICIO** -->
            <?php if($notificacion->notificacionTipo == 8): ?>
                <?php $valores = get_data_notificate_comment($notificacion->notificacionPlanId, $notificacion->notificacionUsuarioId); ?>
                <?php $val_comment = get_datas_comments($notificacion->notificacionPlanId); ?>
                <?php if($notificacion->notificacionLeido == 1): ?><!-- IF NOTIFICACION LEIDO **INICIO** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php $status = get_status_user($val_comment->planAmigoUsuarioId);?>
                                <?php if($status == 0): ?>
                                    <?php echo anchor('usuarios/perfil/'.$val_comment->planAmigoUsuarioId,
                                                        img(array('src'=>get_avatar($val_comment->planAmigoUsuarioId),
                                                                  'width'=>'37',
                                                                  'height'=>'37',
                                                                  'title'=>get_complete_username($val_comment->planAmigoUsuarioId))),
                                                        array('style'=>'text-decoration: none;')); ?>
                                <?php else: ?>
                                    <?php $datosNeg = get_data_company($val_comment->planAmigoUsuarioId); ?>
                                    <?php echo anchor('negocios/perfil/'.$datosNeg->negocioId,
                                                        img(array('src'=>get_avatar_negocios($datosNeg->negocioId),
                                                                  'width'=>'37',
                                                                  'height'=>'37',
                                                                  'title'=>get_complete_username($val_comment->planAmigoUsuarioId))),
                                                        array('style'=>'text-decoration: none;')); ?>
                                <?php endif; ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planAmigoUsuarioId), 
                                                        array('style'=>'text-decoration: none; color: #8D6E98')); ?> ha comentado en tu perfil.
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('notificaciones/ver_notificacion/'.$notificacion->notificacionId.'/'.$notificacion->notificacionPlanId,
                                                          'Ver mas',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php else: ?>
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php $status = get_status_user($val_comment->planAmigoUsuarioId);?>
                                <?php if($status == 0): ?>
                                    <?php echo anchor('usuarios/perfil/'.$val_comment->planAmigoUsuarioId,
                                                        img(array('src'=>get_avatar($val_comment->planAmigoUsuarioId),
                                                                  'width'=>'37',
                                                                  'height'=>'37',
                                                                  'title'=>get_complete_username($val_comment->planAmigoUsuarioId))),
                                                        array('style'=>'text-decoration: none;')); ?>
                                <?php else: ?>
                                    <?php $datosNeg = get_data_company($val_comment->planAmigoUsuarioId); ?>
                                    <?php echo anchor('negocios/perfil/'.$datosNeg->negocioId,
                                                        img(array('src'=>get_avatar_negocios($datosNeg->negocioId),
                                                                  'width'=>'37',
                                                                  'height'=>'37',
                                                                  'title'=>get_complete_username($val_comment->planAmigoUsuarioId))),
                                                        array('style'=>'text-decoration: none;')); ?>
                                <?php endif; ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planAmigoUsuarioId), 
                                                        array('style'=>'text-decoration: none; color: #8D6E98')); ?> <span style="color: #339900">ha comentado</span> en tu perfil.
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('notificaciones/ver_notificacion/'.$notificacion->notificacionId.'/'.$notificacion->notificacionPlanId,
                                                          'Ver mas',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php endif; ?> 
            <?php endif; ?>
            <?php if($notificacion->notificacionTipo == 1): ?><!-- IF TIPO NOTIFICACION 1 **INICIO** -->
                <?php $valores = get_data_notificate($notificacion->notificacionPlanId, $notificacion->notificacionUsuarioId); ?>
                <?php $val_comment = get_datas_comments($notificacion->notificacionPlanId); ?>
                <?php if($notificacion->notificacionLeido == 1): ?><!-- IF NOTIFICACION LEIDO **INICIO** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId,
                                                  img(array('src'=>get_avatar($valores->notificaUsuarioId),
                                                            'width'=>'37',
                                                            'height'=>'37',
                                                            'title'=>get_complete_username($valores->notificaUsuarioId))),
                                                  array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php if($this->session->userdata('id') == $val_comment->planUsuarioId): ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'color: #8D6E98; text-decoration: none')); ?> ha comentado en una publicacion tuya.
                                    <?php elseif($val_comment->planUsuarioId == $valores->notificaUsuarioId): ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?> ha comentado en su publicacion.
                                    <?php else: ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?> ha comentado en una publicacion de
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($val_comment->planUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('notificaciones/ver/'.$notificacion->notificacionId.'/'.$notificacion->notificacionPlanId,
                                                          'Ver mas',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php else: ?><!-- IF NOTIFICACION NO LEIDO ** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId,
                                                  img(array('src'=>get_avatar($valores->notificaUsuarioId),
                                                            'width'=>'37',
                                                            'height'=>'37',
                                                            'title'=>get_complete_username($valores->notificaUsuarioId))),
                                                  array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php if($this->session->userdata('id') == $val_comment->planUsuarioId): ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'color: #8D6E98; text-decoration: none')); ?> <span style="color: #339900">ha comentado</span> en una publicacion tuya.
                                    <?php elseif($val_comment->planUsuarioId == $valores->notificaUsuarioId): ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?> <span style="color: #339900">ha comentado</span> en su publicacion.
                                    <?php else: ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?> <span style="color: #339900">ha comentado</span> en una publicacion de
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($val_comment->planUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('notificaciones/ver/'.$notificacion->notificacionId.'/'.$notificacion->notificacionPlanId,
                                                          'Ver mas',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas')); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php endif; ?><!-- IF NOTIFICACION LEIDO O NO **FIN** -->
            <?php elseif($notificacion->notificacionTipo == 2): ?><!-- IF DE LA PARTE DONDE SE NOTIFICAN LOS ME APUNTO **INICIO** -->
                <?php $valores = get_data_notificate($notificacion->notificacionPlanId, $notificacion->notificacionUsuarioId); ?>
                <?php $val_comment = get_datas_comments($notificacion->notificacionPlanId); ?>
                <?php if($notificacion->notificacionLeido == 1): ?><!-- IF NOTIFICACION LEIDO **INICIO** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId,
                                                  img(array('src'=>get_avatar($valores->notificaUsuarioId),
                                                            'width'=>'37',
                                                            'height'=>'37',
                                                            'title'=>get_complete_username($valores->notificaUsuarioId))),
                                                  array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php if($this->session->userdata('id') == $val_comment->planUsuarioId): ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado en una publicacion tuya.
                                    <?php elseif($val_comment->planUsuarioId == $valores->notificaUsuarioId): ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?> se ha apuntado en su publicacion.
                                    <?php else: ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?> se ha apuntado en una publicacion de
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($val_comment->planUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('notificaciones/ver/'.$notificacion->notificacionId.'/'.$notificacion->notificacionPlanId,
                                                          'Ver mas',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php else: ?><!-- IF NOTIFICACION NO LEIDO ** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId,
                                                  img(array('src'=>get_avatar($valores->notificaUsuarioId),
                                                            'width'=>'37',
                                                            'height'=>'37',
                                                            'title'=>get_complete_username($valores->notificaUsuarioId))),
                                                  array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php if($this->session->userdata('id') == $val_comment->planUsuarioId): ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'color: #8D6E98; text-decoration: none')); ?> <span style="color: #339900">se ha apuntado</span> en una publicacion tuya.
                                    <?php elseif($val_comment->planUsuarioId == $valores->notificaUsuarioId): ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?> <span style="color: #339900">se ha apuntado</span> en su publicacion.
                                    <?php else: ?>
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($valores->notificaUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?> <span style="color: #339900">se ha apuntado</span> en una publicacion de
                                        <?php echo anchor('usuarios/perfil/'.$valores->notificaUsuarioId, get_complete_username($val_comment->planUsuarioId), array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('notificaciones/ver/'.$notificacion->notificacionId.'/'.$notificacion->notificacionPlanId,
                                                          'Ver mas',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas')); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php endif; ?><!-- IF NOTIFICACION LEIDO O NO **FIN** -->
            <?php elseif($notificacion->notificacionTipo == 3): ?><!-- NOTIFICACION DE TIPO ENVIO SALUDO -->
                <?php $valores = get_data_notificate($notificacion->notificacionPlanId, $notificacion->notificacionUsuarioId); ?>
                <?php $val_comment = get_datas_comments($notificacion->notificacionPlanId); ?>
                <?php if($notificacion->notificacionLeido == 1): ?><!-- IF NOTIFICACION LEIDO **INICIO** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                  img(array('src'=>get_avatar($val_comment->planUsuarioId),
                                                            'width'=>'37',
                                                            'height'=>'37',
                                                            'title'=>get_complete_username($val_comment->planUsuarioId))),
                                                  array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planUsuarioId), 
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> te ha enviado un saludo.
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                          'Ver perfil',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-saludo', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar_saludo/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php else: ?>
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                  img(array('src'=>get_avatar($val_comment->planUsuarioId),
                                                            'width'=>'37',
                                                            'height'=>'37',
                                                            'title'=>get_complete_username($val_comment->planUsuarioId))),
                                                  array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planUsuarioId), 
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> <span style="color: #339900">te ha enviado un saludo.</span>
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                          'Ver perfil',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-saludo', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar_saludo/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php endif; ?>
            <?php elseif($notificacion->notificacionTipo == 5): ?>
                <?php $valores = get_data_notificate($notificacion->notificacionPlanId, $notificacion->notificacionUsuarioId); ?>
                <?php $val_comment = get_datas_comments($notificacion->notificacionPlanId); ?>
                <?php if($notificacion->notificacionLeido == 1): ?><!-- IF NOTIFICACION LEIDO **INICIO** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                    img(array('src'=>get_avatar($val_comment->planUsuarioId),
                                                              'width'=>'37',
                                                              'height'=>'37',
                                                              'title'=>get_complete_username($val_comment->planUsuarioId))),
                                                    array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planUsuarioId), 
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'onclick'=>'update();')); ?> quiere ser tu amig@.
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('amigos/index/'.$notificacion->notificacionUsuarioId,
                                                           'Ver amigos',
                                                           array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-amigos', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar_saludo/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php else: ?>
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                    img(array('src'=>get_avatar($val_comment->planUsuarioId),
                                                              'width'=>'37',
                                                              'height'=>'37',
                                                              'title'=>get_complete_username($val_comment->planUsuarioId))),
                                                    array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planUsuarioId), 
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'onclick'=>'update();')); ?> <span style="color: #339900">quiere ser tu amig@.</span>
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('amigos/index/'.$notificacion->notificacionUsuarioId,
                                                           'Ver amigos',
                                                           array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-amigos', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar_saludo/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php endif; ?>    
            <?php elseif($notificacion->notificacionTipo == 6): ?>
                <?php $valores = get_data_notificate($notificacion->notificacionPlanId, $notificacion->notificacionUsuarioId); ?>
                <?php $val_comment = get_datas_comments($notificacion->notificacionPlanId); ?>
                <?php if($notificacion->notificacionLeido == 1): ?><!-- IF NOTIFICACION LEIDO **INICIO** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                    img(array('src'=>get_avatar($val_comment->planUsuarioId),
                                                              'width'=>'37',
                                                              'height'=>'37',
                                                              'title'=>get_complete_username($val_comment->planUsuarioId))),
                                                    array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planUsuarioId), 
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> ha pulzado en tu plan.
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('planesusuarios/ver_plan/'.$notificacion->notificacionPrincipalComentario,
                                                           'Ver plan',
                                                           array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-pulzo', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar_saludo/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php else: ?>
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                    img(array('src'=>get_avatar($val_comment->planUsuarioId),
                                                              'width'=>'37',
                                                              'height'=>'37',
                                                              'title'=>get_complete_username($val_comment->planUsuarioId))),
                                                    array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planUsuarioId), 
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> <span style="color: #339900">ha pulzado</span> en tu plan.
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('planesusuarios/ver_plan/'.$notificacion->notificacionPrincipalComentario,
                                                           'Ver plan',
                                                           array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'')); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar_saludo/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php endif; ?>
            <?php elseif($notificacion->notificacionTipo == 7): ?>
                <?php $valores = get_data_notificate($notificacion->notificacionPlanId, $notificacion->notificacionUsuarioId); ?>
                <?php $val_comment = get_datas_comments($notificacion->notificacionPlanId); ?>
                <?php if($notificacion->notificacionLeido == 1): ?><!-- IF NOTIFICACION LEIDO **INICIO** -->
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                    img(array('src'=>get_avatar($val_comment->planUsuarioId),
                                                              'width'=>'37',
                                                              'height'=>'37',
                                                              'title'=>get_complete_username($val_comment->planUsuarioId))),
                                                    array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planUsuarioId), 
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> no pulzo en tu plan.
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('planesusuarios/ver_plan/'.$notificacion->notificacionPrincipalComentario,
                                                           'Ver plan',
                                                           array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-pulzo', 'name'=>$notificacion->notificacionId)); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar_saludo/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php else: ?>
                    <div class="span-13 last" style="margin-top: 10px; background-color: #DCCEDD; width: 524px"><!-- DIV CUERPO NO LEIDO **INICIO** -->
                        <div class="span-14"><!-- CONTENEDOR DEL CUERPO **INICIO** -->
                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                <?php echo anchor('usuarios/perfil/'.$val_comment->planUsuarioId,
                                                    img(array('src'=>get_avatar($val_comment->planUsuarioId),
                                                              'width'=>'37',
                                                              'height'=>'37',
                                                              'title'=>get_complete_username($val_comment->planUsuarioId))),
                                                    array('style'=>'text-decoration: none;')); ?>
                            </div>
                            <div class="span-12 last">
                                <div class="pulzos_titulo2 span-12" style="margin-top: 5px; margin-left: 5px">
                                    <?php echo anchor('usuarios/perfil/', get_complete_username($val_comment->planUsuarioId), 
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> <span style="color: #339900">no pulzo</span> en tu plan.
                                </div>
                            </div>
                            <div class="prepend-8 last">
                                <div class="span-9 last">
                                    <div class="span-2">
                                        <?php echo anchor('planesusuarios/ver_plan/'.$notificacion->notificacionPrincipalComentario,
                                                           'Ver plan',
                                                           array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'', 'onclick'=>'update();')); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('notificaciones/eliminar_saludo/'.$notificacion->notificacionUsuarioId.'/'.$notificacion->notificacionPlanId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-not')); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CONTENEDOR DEL CUERPO **FIN** -->
                    </div><!-- DIV CUERPO NO LEIDO **FIN**-->
                <?php endif; ?>
            <?php endif; ?><!-- IF TIPO NOTIFICACION 1 **FIN** -->
        <?php endforeach; ?><!-- FOREACH OBTENER NOTIFICACIONES **FIN** -->
      <?php endif; ?>
    </div><!-- DIV DEL CUERPO **FIN** -->
</div>
