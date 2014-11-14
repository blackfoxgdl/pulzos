<?php
/**
 * Vista para la revision o los comentarios del
 * pulzo que ha hecho la empresa, pudiendo calificar
 * la misma
 **/
?>
<script type="text/javascript">
$("#comentarPulzo").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    url = $("#cancelarComentario").attr("href");
    $("#texto-menu").load(url);
}

$("#cancelarComentario").click(function(event){
    event.preventDefault();
    url = $("#cancelarComentario").attr("href");
    $("#texto-menu").load(url);
});
</script>
<div class="span-14" style="margin-left: 10px; margin-top: 20px;">
    <div class="soft-header" style="margin-bottom: 10px; margin-right: 30px;">
        Comentarios del Pulzo
    </div>
    <div class="span-14">
        <?php echo form_open('pulzos/pulzo_comentario/'.$negocio.'/'.$usuario.'/'.$pulzos,
                            array('id'=>'comentarPulzo')); ?>
            <div class="span-2">
                <?php echo form_label('Comentario:','comentario'); ?>
            </div>
            <div class="span-12 last">
                <?php echo form_textarea(array('id'=>'comentariosP',
                                               'class'=>'comentario',
                                               'name'=>'Comentarios[comentarioTexto]',
                                               'cols'=>'20',
                                               'rows'=>'5')); ?>
            </div>
            <div class="span-14">
                <?php echo anchor('pulzos/ver/'.$negocio,
                                  'Cancelar',
                                  array('id'=>'cancelarComentario', 'class'=>'cancelar')); ?> ó
                <?php echo form_submit('Comentar','comentar'); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
