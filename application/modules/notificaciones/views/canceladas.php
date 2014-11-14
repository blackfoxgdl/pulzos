<?php
/**
 * Se muestran las invitaciones canceladas de los usuarios
 * que ya no desean asistir al evento por una u otra razon
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 12, 2011
 * @package notificaciones
 **/
?>
<script type="text/javascript">
$(".sub-menu").click(function(event){
    event.preventDefault();
    var url = $(event.currentTarget).attr("href");
    $("#dinamica").load(url);
});

$(".eliminarNotificaciones").click(function(event){
    event.preventDefault();
    var url = $(event.currentTarget).attr("href");
    $.get(url);
    $(event.currentTarget).parent().hide("fast");
});
</script>
<div class="span-18">
    <div class="span-17">
        <h2>
            Planes Cancelados
        </h2>
        <p>
            <?php echo anchor('notificaciones/index/'.$datosNegocio->negocioId,
                              'Regresar', array('id'=>'regresar','class'=>'sub-menu')); ?>
        </p>
    </div>
    <div class="span-17 last">
        <?php foreach($notificacion as $notificaciones): ?>
            <div class="prepend-1 span-4 box">
                <b><?php echo get_name_user($notificaciones->planUsuarioId); ?></b>
                <br />
                <br />
                <?php echo anchor('notificaciones/ver/'.$notificaciones->pulzoUsuarioId.'/'.$notificaciones->planUsuarioId.'/'.$notificaciones->planId,
                                  img(array('src'=>get_avatar($notificaciones->planUsuarioId),
                                            'width'=>'100',
                                            'height'=>'100')),
                                  array('id'=>'imagenNotificacion', 'class'=>'sub-menu')) ?>
                <br />
                <?php echo character_limiter($notificaciones->planMensaje, 20) . "..."; ?>
                <br />
                <?php
                    $fechaT = unix_to_human($notificaciones->pulzoFechaInicio);
                    $fechaNormal = fecha_acomodo($fechaT);
                    echo "Inicio: " . $fechaNormal;
                ?>
                <br />
                <?php echo anchor('notificaciones/ver_canceladas/'.$notificaciones->pulzoUsuarioId.'/'.$notificaciones->planUsuarioId.'/'.$notificaciones->planId,
                    'ver mas', array('id'=>'verMas','class'=>'sub-menu')); ?>
                <br />
                <?php echo anchor('notificaciones/eliminar/'.$notificaciones->planId,
                                  'Eliminar', array('id'=>'eliminarN','class'=>'eliminarNotificaciones')); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
