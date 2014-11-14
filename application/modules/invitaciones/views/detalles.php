<?php
/**
 * Se muestran los detalles de las invitaciones
 * junto con los comentarios de los amigos del 
 * usuario que envio la invitacion
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 06 April, 2011
 * @package Invitaciones
 **/
?>
<div class="container">
    <div class="span-24">
        &nbsp;
    </div>
    <div class="span-24 last">
        <div class="span-6 box">
            <div class="span-3 first">
                <?php echo img(array('src'=>get_avatar($usuario->id),
                                     'width'=>90,
                                     'height'=>90)); ?>
            </div>
            <div class="prepend-1" id="titulo1">
                <?php echo $usuario->nombre; ?>
                <br />
                <?php echo $ciudad->nombre . ", " . $pais->nombre; ?>
                <br />
                <?php echo $edad; ?>
            </div>
        </div>
        <div style="height:25px;">
            &nbsp;
        </div>
        <?php echo img('statics/img/flecha1.png'); ?>
        <?php echo anchor('usuarios/', img(array('src'=>'statics/img/perfil1.png',
                                                 'border'=>'0'))); ?>
        <?php echo img('statics/img/flecha1.png'); ?>
        <?php echo anchor('invitaciones/ver/'.$usuario->id, img(array('src'=>'statics/img/invitaciones1.png',
                                                                      'border'=>'0'))); ?>
    </div>
    <?php echo img('statics/img/div_profile.png'); ?>
    <h1>
    Evento en <?php echo $empresa->negocioNombre; ?>
    </h1>
    <div class="span-24">
        <div class="prepend-2 span-5">
            <?php echo img(array('src'=>get_avatar_negocios($empresa->negocioUsuarioId),
                                 'widht'=>100,
                                 'height'=>100
                             )); ?>
            <br />
            <?php echo 'Lugar: ' .$empresa->negocioNombre; ?>
            <br />
            <?php echo 'Giro: ' . $giro->nombre; ?>
            <br />
            <?php echo 'Ubicacion: ' . $ciudad->nombre . ', ' . $country->nombre; ?>
        </div>
        <div class="span-14 last">
            <h3>
                <?php echo $empresa->invitacionMensaje; ?>
            </h3>
            <br />
            <h3>
                <?php echo "fecha y hora"; ?>
            </h3>
        </div>
    </div>
    <div class="span-24 last">
        <br />
        <br />
    </div>
    <div class="span-24 last">
        <div class="prepend-2 span-5">
            <h2>
                Confirmados
            </h2>
            <?php foreach($usuarios as $usuario): ?>
                <?php echo img(array('src'=>get_avatar($usuario->id),
                                     'width'=>60,
                                     'height'=>60)); ?>
                <?php echo $usuario->nombre; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
