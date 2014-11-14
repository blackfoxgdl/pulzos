<?php
/**
 * Muestra todos los registros de las
 * invitaciones que tienen los usuarios
 * como aceptadas de los pulzos de
 * algun negocio.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 05 April, 2011
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
        <div style="height: 25px;">
            &nbsp;
        </div>
        <?php echo img('statics/img/flecha1.png'); ?>
        <?php echo anchor('usuarios/',img(array('src'=>'statics/img/perfil1.png',
                                               'border'=>'0'))); ?>
        <?php echo img('statics/img/flecha1.png'); ?>
        <?php echo img('statics/img/invitaciones1.png'); ?>
    </div>
    <?php echo img('statics/img/div_profile.png'); ?>
    <h2>
        Mis Invitaciones Aceptadas
    </h2>
    <!-- h4>
        <?php echo anchor('usuarios/', 'Regresar'); ?>
    </h4 -->
    <h4>
        <?php echo anchor('invitaciones/organizar/'.$this->session->userdata('id'),'Organiza tu Evento'); ?>
    </h4>
    <h4>
        <?php echo anchor('invitaciones/ver_invitaciones_organizadas/'.$this->session->userdata('id'),
                          'Ver Invitaciones Organizadas'); ?>
    </h4>
    <h4>
        <?php echo anchor('invitaciones/ver_invitaciones_pendientes/'.$this->session->userdata('id'),
                          'Solicitudes de Eventos Personales'); ?>
    </h4>
    <h4>
        <?php if($contador != 0): ?>
            <?php echo anchor('invitaciones/solicitud/'.$this->session->userdata('id'), 'Solicitudes pendientes'); ?>
        <?php endif; ?>
    </h4>
    <h4>
        <?php if($contador_hechas != 0): ?>
            <?php echo anchor('invitaciones/invitaciones_hechas/'.$this->session->userdata('id'), 'Invitaciones hechas'); ?>
        <?php endif; ?>
    </h4>
    <div class="grid span-24">
        <?php if($contador_aceptadas != 0): ?>
        <?php foreach($eventos as $evento): ?>
            <div class="grid_element box span-5" style="margin-left: 15px;">
                <div class="prepend-1">
                <h3><?php echo $evento->negocioNombre; ?></h3>
                <p>
                    <?php echo img(array('src'=>get_avatar_negocios($evento->negocioUsuarioId),
                                         'width'=>90,
                                         'height'=>90
                                     )); ?> 
                </p>
                <p>
                    <?php echo $evento->invitacionMensaje; ?>
                </p>
                <p>
                    <?php echo anchor('invitaciones/detalles_invitacion/'.$evento->invitacionId.'/'.$evento->invitacionUsuarioId.'/'.$evento->invitacionPulzoId, 'Ver Invitacion'); ?>
                </p>
                </div>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
