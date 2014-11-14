<?php
/**
 * Formulario de captura de mensajes privados
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright Zavordigital, 17 May, 2011
 * @package inbox
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(".inbox-menu").click(function(event){
    event.preventDefault();
    urlToload = $(event.currentTarget).attr("href");
    $("#canvas").load(urlToload);
});
$("#inbox-form").submit(function(event){
    event.preventDefault();
    options = {
        success: loadView
    };
    $(this).ajaxSubmit(options);
    return false;
});

function loadView(responseText, statusText, xhr, $form){
    urlToLoad = $("#inbox-salida").attr("href");
    $("#canvas").load(urlToLoad);
}
</script>
<ul>
    <li><?php echo anchor('inboxes/crear', 'Mandar Mensaje', array('class'=>'inbox-menu seleccionado')); ?></li>
    <li><?php echo anchor('inboxes/entrada', 'Buzón de Entrada', array('class'=>'inbox-menu')); ?></li>
    <li><?php echo anchor('inboxes/salida', 'Buzón de salida', array('class'=>'inbox-menu', 'id'=>'inbox-salida')); ?></li>
</ul>
<div class="formulario-captura">
    <h1>Mandar mensaje privado</h1>
    <?php echo form_open('inboxes/crear', array('id'=>'inbox-form')); ?>
        <p>
        <?php echo form_label('Seleccionar destinatario', 'Inbox[inboxUsuarioRecibeId]');?>
        </p>
        <p>
        <?php echo form_dropdown('Inbox[inboxUsuarioRecibeId]', $amigos); ?>
        </p>
        <p>
        <?php echo form_input('Inbox[inboxAsunto]', 'Asunto'); ?>
        </p>
        <p>
        <?php echo form_textarea( array('name'=>'Inbox[inboxMensaje]', 'value'=>'Mensaje','cols'=>'80')); ?>
        </p>
        <?php echo form_submit(array('value'=>'Mandar Mensaje')); ?>
    <?php form_close(); ?>
</div>
