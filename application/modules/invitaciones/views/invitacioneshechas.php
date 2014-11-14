<?php
/**
 * Muestra las invitaciones hechas del
 * usuario, con el cual podra ver quien
 * ha confirmado asistir al evento o quien
 * ha propuesto otro lugar.
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
        <div style="height: 25px">
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
        Invitaciones Hechas
    </h1>
    <!-- h3>
        <?php echo anchor($this->agent->referrer(), 'Regresar'); ?>
    </h3 -->
    <div class="grid span-24">
        <?php foreach($hechas as $hecha): ?>
            <div class="grid_element box span-5">
                <h3>
                    <?php echo $hecha->negocioNombre; ?>
                </h3>
                <p>
                    <?php echo img(array('src'=>get_avatar_negocios($hecha->negocioUsuarioId),
                                         'width'=>90,
                                         'height'=>90        
                                        )); ?>
                </p>
                <p>
                    <?php echo $hecha->invitacionMensaje; ?>
                </p>
                <p>
                    <?php echo anchor('invitaciones/detalles_invitacion/'.$hecha->invitacionId.'/'.$hecha->invitacionUsuarioId.'/'.$hecha->invitacionPulzoId, 'Ver Invitacion'); ?>
                    <?php echo anchor('invitaciones/borrar/'.$hecha->invitacionId, 'Borrar Invitacion'); ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
