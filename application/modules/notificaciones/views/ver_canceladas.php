<?php
/**
 * Se mostran todas las solicitudes que se han cancelado
 * por parte del usuario
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital , May 12, 2011
 * @package notificaciones
 **/
?>
<script type="text/javascript">
$(".sub-menu").click(function(event){
    event.preventDefault();
    var url = $(event.currentTarget).attr("href");
    $("#dinamica").load(url);
});
</script>
<div class="span-18">
    <div class="span-17 last">
        <h2>
            Notificaciones
        </h2>
        <p>
            <?php echo anchor('notificaciones/canceladas/'.$datosN->negocioId,
                              'regresar', array('id'=>'regresar','class'=>'sub-menu')); ?>
        </p>
    </div>
    <div class="prepend-1 span-15 last">
        <p>
            <h4>
                El cliente ha cancelado el plan
            <h4>
        </p>
        <div class="span-3">
            <?php echo img(array('src'=>get_avatar($datosUsuario->id),
                                 'width'=>'100',
                                 'height'=>'100')); ?>
        </div>
        <div class="prepend-1 span-10">
            Nombre: <?php echo $datosUsuario->nombre; ?>
            <br />
            Edad: <?php echo edad_usuario($datosUsuario->edad); ?>
            <br />
            Usuarios invitador:
            <br />
                <?php foreach($planInvitacion as $usuarioInvitacion): ?>
                    <?php echo img(array('src'=>get_avatar($usuarioInvitacion->invitacionInvitadoId),
                                         'width'=>'30',
                                         'height'=>'30',
                                         'title'=>get_name_user($usuarioInvitacion->invitacionInvitadoId))); ?>
                <?php endforeach; ?>
            <br />
            Datos del negocio.
            <br />
            <br />
            Negocio: <?php echo $datosN->negocioNombre; ?>
            <br />
            Email del Negocio: <?php echo $datosN->negocioEmail; ?>
            <br />
            Pulzo de interes: <?php echo $datosP->planMensaje; ?>
            <br />
            Fecha de creacion: <?php $fecha = unix_to_human($datosP->pulzoFechaCreacion);
                                     $fechaBuena = fecha_acomodo($fecha);
                                     echo $fechaBuena; ?>
        </div>
    </div>
</div>
