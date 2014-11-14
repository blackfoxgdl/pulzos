<?php
/**
 * Se usa para mostrar los datos de las invitaciones que se
 * organizan de manera personal por el usuario, el cual
 * puede ver cuales son las invitaciones personales que el
 * ha creado
 * 
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, April 12, 2011
 * @package Invitaciones
 **/
?>
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
        <div class="prepend-1">
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
    <?php echo anchor('usuarios/perfil/'.$usuario->id, img(array('src'=>'statics/img/perfil1.png',
                                                                 'border'=>'0'))); ?>
    <?php echo img('statics/img/flecha1.png'); ?>
    <?php echo anchor('invitaciones/ver/'.$usuario->id, img(array('src'=>'statics/img/invitaciones1.png',
                                                            'border'=>'0'))); ?>
</div>
<?php echo img('statics/img/div_profile.png'); ?>
<h2>
    Eventos Personales Organizados
</h2>
<div class="span-24">
    &nbsp;
</div>
<div class="span-24 last">
    <?php foreach($amigosA as $amigos): ?>
        <div class="span-4 box" style="margin-left: 25px;">
            <?php echo $amigos->invitacionPersonalMensaje; ?>
            <br />
            <?php echo img(array('src'=>get_avatar($usuario->id),
                                 'widht'=>90,
                                 'height'=>90)); ?>
            <br />
            <?php if($this->session->userdata('id') == $amigos->invitacionUsuarioPersonalId): ?>
                <?php echo anchor('', 'Ver Invitacion Organizada'); ?>
            <?php else: ?>
                <?php echo anchor('', 'Aceptar Invitacion'); ?>
                <br />
                <?php echo anchor('invitaciones/rechazar_invitacion_personal/'.$amigos->invitacionPersonalId.'/'.$this->session->userdata('id'),
                                  'Rechazar Invitacion'); ?>
                <br />
                <?php echo anchor('invitaciones/borrar_invitacion_personal/'.$amigos->invitacionPersonalId, 'Borrar Invitacion'); ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
