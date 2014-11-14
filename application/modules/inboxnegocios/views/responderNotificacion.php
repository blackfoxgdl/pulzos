<?php
/**
 * Vista que cargara la respuesta de las
 * notificaciones que se haran o se tienen hechas
 * al negocio, por medio de esta podra contactar a los usuarios
 * que han reservado o intentan reservar. NOTA SE USA EL ID DE
 * EMPRESA EN LA TABLA DE USUARIOS NO EN LA TABLA DE NEGOCIOS
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 17, 2011
 * @package inboxNegocios
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#formaN").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: loadView
    };
    $(this).ajaxSubmit(opciones);
    return false;
});

function loadView()
{
    var url = $("#formaR").attr("href");
    $("#dinamica").load(url);
}

$(".formaRegresar").click(function(event){
    event.preventDefault();
    var url = $(event.currentTarget).attr("href");
    $("#dinamica").load(url);
});
</script>
<div class="span-18">
    <div class="span-18">
        <h2>
            Contactar al Usuario del Plan
        </h2>
        <p>
            <?php echo anchor('notificaciones/index/'.$negocio->negocioId,
                              'Cancelar', array('id'=>'formaR', 'class'=>'formaRegresar')); ?>
        </p>
    </div>
    <div class="span-18 prepend-top">
        <?php echo form_open('inboxnegocios/responder_solicitud/'.$negocio->negocioId.'/'.$usuario->id,
                             array('id'=>'formaN', 'class'=>'responderF')); ?>
            <div class="span-18">
                <div class="span-2">
                    De:
                </div>
                <div class="span-15">
                    <?php echo $negocio->negocioNombre; ?>
                </div>
            </div>
            <div class="span-18">
                <div class="span-2">
                    Para:
                </div>
                <div class="span-15">
                    <?php echo $usuario->nombre; ?>
                </div>
            </div>
            <div class="span-18">
                <div class="span-2">
                    Asunto:
                </div>
                <div class="span-15">
                    <?php echo form_input(array('id'=>'notificacionA',
                                                'class'=>'notificacionAsunto',
                                                'name'=>'RespuestaN[inboxnAsunto]',
                                                )); ?>
                </div>
            </div>
            <div class="span-18">
                <div class="span-2">
                    Mensaje:
                </div>
                <div class="span-15">
                    <?php echo form_textarea(array('id'=>'notificacionM',
                                                   'class'=>'notificacionMensaje',
                                                   'name'=>'RespuestaN[inboxnMensaje]')); ?>
                </div>
            </div>
            <div class="span-18">
                <?php echo form_submit(array('id'=>'enviar',
                                             'class'=>'enviarN',
                                             'value'=>'Enviar Mensaje')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
