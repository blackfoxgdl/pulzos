<?php
/**
 * Vista en la cual se muestran la informacion que se ha
 * enviado en un inbox o en todos para que se pueda leer,
 * regresar a los inbox o pueda contestar el mensaje privado
 * que se ha enviado. NOTA SE USA EL ID DE EMPRESA EN LA TABLA
 * DE USUARIO NO EN LA TABLA DE NEGOCIOS
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 5, 2011
 * @package inboxNegocios
 **/
?>
<script type="text/javascript">
$("#Eliminar").click(function(event){
    event.preventDefault();
    urlEN = $(this).attr("href");
    $.get(urlEN);
    urlR = $("#regresarI").attr("href");
    $("#inboxNegocios").load(urlR);
});

$("#responderB").click(function(event){
    event.preventDefault();
    var urlF = $("#formaResponder").attr("action");
    $("#inboxNegocios").load(urlF);
});
</script>
<div class="span-18"><!-- main **begin** -->
    <div class="span-18">
        <h2>
            Inbox Abierto
        </h2>
        <?php echo anchor('inboxnegocios/index/'.$this->session->userdata('id'),
                          'Regresar', array('id'=>'regresarI', 'class'=>'regresar', 'style'=>'display: none')); ?>
        <?php echo anchor('inboxnegocios/borrar/'.$inbox->inboxnId,
                          'Eliminar Mensaje', array('id'=>'Eliminar','class'=>'eliminarInbox')); ?>
    </div>
    <div class="span-18">
        <?php echo form_open(base_url().'index.php/inboxnegocios/responder/'.$inbox->inboxnId,
                             array('id'=>'formaResponder', 'class'=>'responder')); ?>
            <div class="span-18">
                <div class="span-1 left">
                    De:
                </div>
                <div class="class-15">
                    <?php echo $inbox->nombre; ?>
                </div>
            </div>
            <div class="span-18">
                <div class="span-1 left">
                    Asunto:
                </div>
                <div class="span-13">
                    <?php echo "&nbsp;" . $inbox->inboxnAsunto; ?>
                </div>
            </div>
            <div class="span-18 prepend-top">
                <div class="class-17">
                    Mensaje:
                </div>
                <div class="span-17 last append-bottom">
                    <?php echo $inbox->inboxnMensaje; ?>
                </div>
            </div>
            <div class="span-18">
                <?php echo form_submit(array('id'=>'responderB',
                                             'class'=>'respuesta',
                                             'value'=>'Responder')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div><!-- main **end** -->
