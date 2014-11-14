<?php
/**
 * Vista de las solicitudes de los
 * usuarios que han sido invitados 
 * pos un amigo para reunirse en
 * algun negocio que haya pulzado 
 * una promocio.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital , 05 April, 2011
 * @package invitaciones
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
                                     'height'=>90,
                                     'width'=>90)); ?>
            </div>
            <div class="prepend-1" id="titulo1">
                <?php echo $usuario->nombre; ?>
                <br />
                <?php echo $ciudad->nombre . ", " . $pais->nombre; ?>
                <br />
                <?php echo $edad; ?>
            </div>
        </div>
        <div style="height: 25px;">
            &nbsp;
        </div>
        <?php echo img('statics/img/flecha1.png'); ?>
        <?php echo anchor('usuarios/', img(array('src'=>'statics/img/perfil1.png',
                                                 'border'=>'0'))); ?>
        <?php echo img('statics/img/flecha1.png'); ?>
        <?php echo img('statics/img/invitaciones1.png'); ?>
    </div>
    <?php echo img('statics/img/div_profile.png'); ?>
    <h1>
        Solicitud de invitaciones.
    </h1>
    <!-- h4>
        <?php echo anchor($this->agent->referrer(), 'Regresar'); ?>
    </h4 -->
    <div class="grid span-24" style="margin-left: 25px;">
        <?php foreach($request as $solicitud): ?>
            <div class="grid_element box span-5">
                <div align="center">
                <h3>
                    <?php echo $solicitud->negocioNombre; ?>
                </h3>
                <p>
                    <?php echo img(array('src'=>get_avatar_negocios($solicitud->negocioUsuarioId),
                                         'width'=>90,
                                         'height'=>90
                                        )); ?>
                </p>
                <p>
                    <?php echo $solicitud->invitacionMensaje; ?>
                </p>
                <p>
                    <?php echo anchor('invitaciones/aceptar/'.$solicitud->invitacionId, 'Aceptar'); ?>
                    <?php echo anchor('invitaciones/rechazar/'.$solicitud->invitacionId, 'Rechazar'); ?>
                </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
