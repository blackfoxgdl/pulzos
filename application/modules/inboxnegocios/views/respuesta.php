<?php
/**
 * Vista en la cual se mostrar el formulario para responder
 * la usuario la duda que esta solicitando o alguna
 * informacion especifica. NOTA SE USA EL ID DE EMPRESA EN
 * LA TABLA DE USUARIOS NO EN LA TABLA DE NEGOCIOS
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 6, 2011
 * @package InboxNegocios
 **/ 

?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#responderForm").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: loadView
    };
    $(this).ajaxSubmit(opciones);
    return false;
});

function loadView()
{
    var url = $("#regresarIN").attr("href");
    $("#inboxNegocios").load(url);
}

$("#regresarIN").click(function(event){
    event.preventDefault();
    urlN = $(this).attr("href");
    $("#inboxNegocios").load(urlN)
});

</script>
<div class="span-14 last">
    <div class="span-14">
        <div class="soft-header" style="margin-top:10px">
            Respuesta del Mensaje
        </div>
    </div>
    <div class="span-13 last">
        <?php echo form_open('inboxnegocios/responder/'.$datosInbox->negocioUsuarioId.'/'.$datosUserInbox->id,
                             array('id'=>'responderForm', 'class'=>'responderF')); ?>
            <div class="span-13 last">
                <div class="span-2">
                    De:
                </div>
                <div class="span-11 last">
                    <?php echo $datosInbox->negocioNombre; ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    Para:
                </div>
                <div class="span-11 last">
                    <?php echo $datosUserInbox->nombre; ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    Asunto:
                </div>
                <div class="span-11 last">
                    <?php echo form_input(array('id'=>'inboxA',
                                                'class'=>'inboxAsunto',
                                                'name'=>'Respuesta[inboxnAsunto]',
                                                )); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    Mensaje:
                </div>
                <div class="span-11 last">
                    <?php echo form_textarea(array('id'=>'InboxM',
                                                   'class'=>'InboxMensaje',
                                                   'name'=>'Respuesta[inboxnMensaje]',
                                                   'cols'=>'40',
                                                   'rows'=>'10')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <?php echo anchor('inboxnegocios/ver/'.$datosInbox->inboxnId,
                                  'Cancelar', array('id'=>'regresarIN', 'class'=>'menu')); ?>
                ó
                <?php echo form_submit(array('id'=>'enviar',
                                             'class'=>'enviarI',
                                             'value'=>'Responder')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
