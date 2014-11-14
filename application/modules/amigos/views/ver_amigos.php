<?php
/**
 * se muestran los amigos con un checkbox
 * para seleccionar a quiien quieres invitar
 **/
?>
<div class="span-12 box">
    <?php foreach($amigos as $amigo): ?>
        <div class="span-12">
            <div class="span-2">
            <?php echo img(array('src'=>get_avatar($amigo->id),
                                 'width'=>60,
                                 'height'=>60)); ?>
            <?php echo form_checkbox(array('name'=>'Invitacion[invitacionInvitadoId]',
                'id'=>'invitacion',
                'value'=>$amigo->id)); ?>
            <?php echo $amigo->nombre; ?>
        </div>
        </div>
    <?php endforeach; ?>
    <?php echo form_open('invitaciones/crear_invitacion'); ?>
    <?php echo form_label('Hora y Fecha:','horaFecha'); ?>
    <?php echo form_input(array('name'=>'Invitacion[invitacionFechaHora]',
                                'id'=>'invitacionF',
                                'style'=>'background-color: #C0C0C0'
                                )); ?>
    <?php echo form_hidden(array('name'=>'Invitacion[invitacionEmpresaId]','value'=>$idE, 'id'=>'idE')); ?>
    <?php echo form_submit(array('id'=>'crear_invitacion', 'value'=>'invitar')); ?>
    <?php echo form_close();?>
</div>
