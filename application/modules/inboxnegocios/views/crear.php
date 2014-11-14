<?php
/**
 * Vista para crear un mensaje inbox
 * que sera enviado al usuario, el cual
 * lo recibira en su inbox de manera privada.
 * NOTA SE USA EL ID DE EMPRESA EN LA TABLA DE
 * USUARIOS NO EL DE LA TABLA DE NEGOCIOS
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 4, 2011
 * @package inboxNegocios
 **/

?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#formInbox").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    urlReturn = $("#returnLoad").attr("href");
    $("#inboxNegocios").load(urlReturn);
}
</script>
<div class="span-14 last" style="margin-top: 10px">
    <?php echo anchor('inboxnegocios/ver_mensajes/'.$idNegocio, '', array('style'=>'display:none', 'id'=>'returnLoad')); ?>
    <?php if($paraMsj != '0'): ?>
        <?php echo form_open('inboxnegocios/crear/'.$idNegocio, array('id'=>'formInbox', 'class'=>'inboxForm')); ?>
            <div class="span-13 last" style="margin-left: 10px">
                <div class="span-3">
                    <?php echo form_label('Para:', 'paraInbox'); ?>
                </div>
                <div class="span-10 last">
                    <?php $valores = 'id="paraQuienInbox"
                                      class="para_quien"'; ?>
                    <?php echo form_dropdown('Inbox[inboxnUsuarioRecibeId]',
                                             $paraMsj,
                                             '',
                                             $valores); ?>
                </div>
                <div class="span-3">
                    <?php echo form_label('Asunto: ', 'asuntoInbox'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'inboxNegociosAsunto',
                                                'class'=>'inbox_negocios_asunto',
                                                'name'=>'Inbox[inboxnAsunto]')); ?>
                </div>
                <div class="span-3">
                    <?php echo form_label('Mensaje: ','mensajeInbox'); ?> 
                </div>
                <div class="span-10 last">
                    <?php echo form_textarea(array('id'=>'cuerpoMensaje',
                                                   'name'=>'Inbox[inboxnMensaje]',
                                                   'class'=>'',
                                                   'cols'=>'30',
                                                   'rows'=>'5')); ?>
                </div>
                <div class="span-13 last">
                    <?php echo form_submit(array('id'=>'enviarMensaje',
                                                 'class'=>'enviar_mensaje',
                                                 'value'=>'Enviar Mensaje')); ?>
                </div>
            </div>
        <?php echo form_close(); ?>
    <?php else: ?>
        <?php echo "No tienes seguidores actualmente"; ?>
    <?php endif; ?>
</div>
