<?php
/**
 * Vista del usuario que se encarga de 
 * mostrar las notificaciones que los usuarios
 * tienen pendientes en su perfil
 **/
?>
<script type="text/javascript">

$(".eliminar-invitacion").click(function(event){
    event.preventDefault();
    urlEliminar = $(event.currentTarget).attr('href');
    $.get(urlEliminar);
    urlReload = $("#reloadSecond").attr("href");
    $("#header-container").load(urlReload);
    $(event.currentTarget).parent().parent().hide();

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
    var textoMiCiudad = $("div#menu-derecha").html();
    $("#main-div").html(textoMiCiudad);
});
</script>
<?php echo anchor('usuarios/reload_header/'.$this->session->userdata('id'), '', array('id'=>'reloadSecond', 'style'=>'display:none')); ?>
<div class="span-14 last" style="margin-top: 10px; margin-bottom: 100px;"><!-- DIV PRINCIPAL **INICIO** -->
    <!-- div class="soft-header">
        Invitaciones
    </div -->
    <div style="display: none">
        <div id="nombre-usuario-plan">
            Invitaciones
        </div>
        <div id="menu-derecha">
            <?php echo anchor('planesusuarios',
                               img(array('src'=>'statics/img/bot-armapulzo.png',
                                         'id'=>'planesU',
                                         'width'=>'80',
                                         'height'=>'20',
                                         'style'=>'margin-top: 22px; margin-left: -23px'))); ?>
        </div>
    </div>
    <div class="span-14 last"><!-- DIV DEL CUERPO DE LAS INVITACIONES **INICIO** -->
        <?php foreach($invitaciones as $invitacion): ?>
            <?php if($invitacion->invitacionPersonalPlanReservacion != 0): ?><!-- IF PARA SABER SI LA INVITACION ES PLAN O RESERVACION **INICIO** -->
                <?php if($invitacion->invitacionInvitadoPersonalId != $invitacion->invitacionUsuarioPersonalId): ?>
                    <?php if($invitacion->invitacionPersonalStatus == 0): ?>
                        <div class="span-13 last" style="margin-top: 10px; border-bottom: 1px solid #DAD6DB; margin-bottom: 10px"><!-- DIV DENTRO DEL FOREACH **INICIO** -->
                            <div class="prepend-1 span-2">
                                <?php echo img(array('src'=>get_avatar($invitacion->invitacionUsuarioPersonalId),
                                                     'width'=>'80',
                                                     'height'=>'80')); ?>
                            </div>
                            <div class="prepend-12" style="margin-top: -5px; margin-left: 15px">
                                <?php echo anchor('invitacionespersonales/borrar/'.$invitacion->invitacionPersonalId.'/'.$invitacion->planId.'/'.$invitacion->invitacionInvitadoPersonalId,
                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                            'width'=>'12px',
                                                            'height'=>'12px')),
                                                  array('style'=>'text-decoration: block', 'class'=>'eliminar-invitacion')); ?>
                            </div>
                            <div class="prepend-1 span-9 last">
                                <div class="span-8 last" style="margin-top: -5px">
                                    <span class="pulzos_titulo3">
                                        <?php echo get_complete_username($invitacion->invitacionUsuarioPersonalId); ?>
                                    </span>
                                    <span class="pulzos_titulo4"> 
                                        ha reservado en <?php echo $invitacion->invitacionPersonalMensaje; ?>.
                                    </span>
                                </div>
                                <div class="span-8 last">
                                    <div class="pulzos_titulo3 span-3">
                                        Lugar:
                                    </div>
                                    <div class="pulzos_titulo4 span-5 last">
                                        <?php echo $invitacion->invitacionPersonalMensaje; ?>
                                    </div>
                                </div>
                                <div class="span-8 last">
                                    <div class="pulzos_titulo3 span-3">
                                        Fecha:
                                    </div>
                                    <div class="pulzos_titulo4 span-5 last">
                                        <?php $fecha = unix_to_human($invitacion->planFechaInicio);
                                              $acomodo = fecha_acomodo($fecha);
                                              //$fecha_evento = fecha_con_formato($acomodo);
                                              echo $acomodo; ?>
                                    </div>
                                </div>
                                <div class="span-8 last" style="margin-bottom: 5px">
                                    <div class="pulzos_titulo3 span-3">
                                        Organizador: 
                                    </div>
                                    <div class="pulzos_titulo4 span-5 last">
                                        <?php echo get_complete_username($invitacion->invitacionUsuarioPersonalId); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="prepend-9" style="margin-top: 5px; margin-bottom: 10px">
                                <?php echo anchor('invitacionespersonales/actualizar_reservaciones/'.$invitacion->invitacionPersonalPlanReservacion.'/'.$invitacion->planId.'/'.$invitacion->invitacionPersonalId.'/'.$invitacion->invitacionInvitadoPersonalId,
                                                  'Ver evento', array('class'=>'', 'style'=>'text-decoration: none; color: #8D6E98; font-weight: bold')); ?>
                            </div>
                        </div><!-- DIV DENTRO DEL FOREACH **FIN** -->
                    <?php else:?>
                        <div class="span-13 last" style="margin-top: 10px; border-bottom: 1px solid #DAD6DB; margin-bottom: 10px"><!-- DIV DENTRO DEL FOREACH **INICIO** -->
                            <div class="prepend-1 span-2">
                                <?php echo img(array('src'=>get_avatar($invitacion->invitacionUsuarioPersonalId),
                                                     'width'=>'80px',
                                                     'height'=>'80px')); ?>
                            </div>
                            <div class="prepend-12" style="margin-top: -5px; margin-left: 15px">
                                <?php echo anchor('invitacionespersonales/borrar/'.$invitacion->invitacionPersonalId.'/'.$invitacion->planId.'/'.$invitacion->invitacionInvitadoPersonalId,
                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                            'width'=>'12px',
                                                            'height'=>'12px')),
                                                  array('style'=>'text-decoration: none', 'class'=>'eliminar-invitacion')); ?>
                            </div>
                            <div class="prepend-1 span-9 last">
                                <div class="span-8D6E last" style="margin-top: -5px">
                                    <span class="pulzos_titulo1">
                                        <?php echo get_complete_username($invitacion->invitacionUsuarioPersonalId); ?>
                                    </span>
                                    <span class="pulzos_titulo2"> 
                                        ha reservado en <?php echo $invitacion->invitacionPersonalMensaje; ?>.
                                    </span>
                                </div>
                                <div class="span-8 last">
                                    <div class="pulzos_titulo1 span-3">
                                        Lugar:
                                    </div>
                                    <div class="pulzos_titulo2 span-5 last">
                                        <?php echo $invitacion->invitacionPersonalMensaje; ?>
                                    </div>
                                </div>
                                <div class="span-8 last">
                                    <div class="pulzos_titulo1 span-3">
                                        Fecha:
                                    </div>
                                    <div class="pulzos_titulo2 span-5 last">
                                        <?php $fecha = unix_to_human($invitacion->planFechaInicio);
                                              $acomodo = fecha_acomodo($fecha);
                                              //$fecha_evento = fecha_con_formato($acomodo);
                                              echo $acomodo; ?>
                                    </div>
                                </div>
                                <div class="span-8 last" style="margin-bottom: 5px">
                                    <div class="pulzos_titulo1 span-3">
                                        Organizador: 
                                    </div>
                                    <div class="pulzos_titulo2 span-5 last">
                                        <?php echo get_complete_username($invitacion->invitacionUsuarioPersonalId); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="prepend-9" style="margin-top: 5px; margin-bottom: 10px">
                                <?php echo anchor('invitacionespersonales/actualizar_reservaciones/'.$invitacion->invitacionPersonalPlanReservacion.'/'.$invitacion->planId.'/'.$invitacion->invitacionPersonalId.'/'.$invitacion->invitacionInvitadoPersonalId,
                                                  'Ver evento', array('class'=>'', 'style'=>'text-decoration: none; color: #8D6E98; font-weight: bold')); ?>
                            </div>
                        </div><!-- DIV DENTRO DEL FOREACH **FIN** -->
                    <?php endif; ?>
                <?php endif; ?>
            <?php else:  ?><!-- ELSE PARA SABER SI LA INVITACION ES PLAN ARMADO **MEDIO** -->
                <?php if($invitacion->invitacionInvitadoPersonalId != $invitacion->invitacionUsuarioPersonalId): ?>
                    <?php if($invitacion->invitacionPersonalStatus == 0): ?>
                        <div class="span-13 last" style="margin-top: 10px; border-bottom: 1px solid #DAD6DB; margin-bottom: 10px"><!-- DIV DENTRO DEL FOREACH **INICIO** -->
                            <div class="prepend-1 span-2">
                                <?php echo img(array('src'=>get_avatar($invitacion->invitacionUsuarioPersonalId),
                                                     'width'=>'80',
                                                     'height'=>'80')); ?>
                            </div>
                            <div class="prepend-12" style="margin-top: -5px; margin-left: 15px">
                                <?php echo anchor('invitacionespersonales/borrar/'.$invitacion->invitacionPersonalId.'/'.$invitacion->planId.'/'.$invitacion->invitacionInvitadoPersonalId,
                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                            'width'=>'12px',
                                                            'height'=>'12px')),
                                                  array('style'=>'text-decoration: block', 'class'=>'eliminar-invitacion')); ?>
                            </div>
                            <div class="prepend-1 span-9 last">
                                <div class="span-8 last" style="margin-top: -5px">
                                    <span class="pulzos_titulo3">
                                        <?php echo get_complete_username($invitacion->invitacionUsuarioPersonalId); ?>
                                    </span>
                                    <span class="pulzos_titulo4"> 
                                        te esta invitando a <?php echo $invitacion->planMensaje; ?>.
                                    </span>
                                </div>
                                <div class="span-8 last">
                                    <div class="pulzos_titulo3 span-3">
                                        Lugar:
                                    </div>
                                    <div class="pulzos_titulo4 span-5 last">
                                        <?php echo $invitacion->planLugar; ?>
                                    </div>
                                </div>
                                <div class="span-8 last">
                                    <div class="pulzos_titulo3 span-3">
                                        Fecha:
                                    </div>
                                    <div class="pulzos_titulo4 span-5 last">
                                        <?php $fecha = unix_to_human($invitacion->planFechaInicio);
                                              $acomodo = fecha_acomodo($fecha);
                                              //$fecha_evento = fecha_con_formato($acomodo);
                                              echo $acomodo; ?>
                                    </div>
                                </div>
                                <div class="span-8 last" style="margin-bottom: 5px">
                                    <div class="pulzos_titulo3 span-3">
                                        Organizador: 
                                    </div>
                                    <div class="pulzos_titulo4 span-5 last">
                                        <?php echo get_complete_username($invitacion->planUsuarioId); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="prepend-9" style="margin-top: 5px; margin-bottom: 10px">
                                <?php echo anchor('invitacionespersonales/actualizar_status/'.$invitacion->invitacionPersonalId.'/'.$invitacion->planId,
                                                  'Ver evento', array('class'=>'', 'style'=>'text-decoration: none; color: #8D6E98; font-weight: bold')); ?>
                            </div>
                        </div><!-- DIV DENTRO DEL FOREACH **FIN** -->
                    <?php else: ?>
                        <div class="span-13 last" style="margin-top: 10px; border-bottom: 1px solid #DAD6DB; margin-bottom: 10px"><!-- DIV DENTRO DEL FOREACH **INICIO** -->
                            <div class="prepend-1 span-2">
                                <?php echo img(array('src'=>get_avatar($invitacion->invitacionUsuarioPersonalId),
                                                     'width'=>'80',
                                                     'height'=>'80')); ?>
                            </div>
                            <div class="prepend-12" style="margin-top: -5px; margin-left: 15px">
                                <?php echo anchor('invitacionespersonales/borrar/'.$invitacion->invitacionPersonalId.'/'.$invitacion->planId.'/'.$invitacion->invitacionInvitadoPersonalId,
                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                            'width'=>'12px',
                                                            'height'=>'12px')),
                                                  array('style'=>'text-decoration:none', 'class'=>'eliminar-invitacion')); ?>
                            </div>
                            <div class="prepend-1 span-9 last">
                                <div class="span-8D6E last" style="margin-top: -5px">
                                    <span class="pulzos_titulo1"><?php echo get_complete_username($invitacion->invitacionUsuarioPersonalId); ?></span><span class="pulzos_titulo2"> te esta invitando a <?php echo $invitacion->planMensaje; ?>.</span>
                                </div>
                                <div class="span-8 last">
                                    <div class="pulzos_titulo1 span-3">
                                        Lugar:
                                    </div>
                                    <div class="pulzos_titulo2 span-5 last">
                                        <?php echo $invitacion->planLugar; ?>
                                    </div>
                                </div>
                                <div class="span-8 last">
                                    <div class="pulzos_titulo1 span-3">
                                        Fecha:
                                    </div>
                                    <div class="pulzos_titulo2 span-5 last">
                                        <?php $fecha = unix_to_human($invitacion->planFechaInicio);
                                              $acomodo = fecha_acomodo($fecha);
                                              //$fecha_evento = fecha_con_formato($acomodo);
                                              echo $acomodo; ?>
                                    </div>
                                </div>
                                <div class="span-8 last" style="margin-bottom: 5px">
                                    <div class="pulzos_titulo1 span-3">
                                        Organizador: 
                                    </div>
                                    <div class="pulzos_titulo2 span-5 last">
                                        <?php echo get_complete_username($invitacion->planUsuarioId); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="prepend-9" style="margin-top: 5px; margin-bottom: 10px">
                                <?php echo anchor('invitacionespersonales/actualizar_status/'.$invitacion->invitacionPersonalId.'/'.$invitacion->planId,
                                                  'Ver evento', array('class'=>'', 'style'=>'text-decoration: none; color: #8D6E98; font-weight: bold')); ?>
                            </div>
                        </div><!-- DIV DENTRO DEL FOREACH **FIN** -->
                    <?php endif; ?>
                <?php endif; ?><!-- IF PARA CONOCER SI LA INVITACION ES DE PLAN ARMADO O RESERVACION **FIN** -->
            <?php endif; ?>
        <?php endforeach; ?> 
    </div><!-- DIV DEL CUERPO DE LAS INVITACIONES **FIN** -->
</div><!-- DIV PRINCIPAL **FIN** -->
