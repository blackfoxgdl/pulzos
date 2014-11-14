<?php
/**
 * Vista para mostrar los mensajes de inbox de usuarios a negocios,
 * aqui mismo se muestra unas opciones para marcarlo como leido, como
 * no leido y como eliminado
 **/
?>
<script type="text/javascript">
$(".menu").click(function(event){
    event.preventDefault();
    urlVer = $(event.currentTarget).attr("href");
    $("#inboxNegocios").load(urlVer);
});

</script>
<?php echo anchor('inboxnegocios/ver_mensajes/'.$this->session->userdata('idN'),
                  '',array('id'=>'ver-mensajes','style'=>'display:none')); ?>
<div class="span-14 last" style="margin-left: 10px; margin-top: 10px" id="main-recibidos">
    <div class="span-4">
        De
    </div>
    <div class="span-6">
        Asunto
    </div>
    <div class="span-3 last">
        Fecha
    </div>
    <?php foreach($inboxes as $inboxN): ?>
        <?php if($inboxN->inboxnStatus == 1): ?>
            <div class="span-13 last">
                <div class="span-4">
                    <?php echo anchor('inboxnegocios/ver/'.$inboxN->inboxnId,
                                       substr(get_name_user($inboxN->inboxnUsuarioId),0,25)."....", array('class'=>'menu')); ?>
                </div>
                <div class="span-6">
                    <?php echo anchor('inboxnegocios/ver/'.$inboxN->inboxnId,
                                       substr($inboxN->inboxnAsunto,0,36)."....", array('class'=>'menu')); ?>
                </div>
                <div class="span-3 last">
                    <?php
                        $fecha = unix_to_human($inboxN->inboxnFecha);
                        $correcta = fecha_acomodo($fecha);
                        echo $correcta;
                     ?>
                </div>
            </div>
        <?php else: ?>
            <div class="span-13 last">
                <div class="span-4">
                    <?php echo anchor('inboxnegocios/ver/'.$inboxN->inboxnId,
                                       substr(get_name_user($inboxN->inboxnUsuarioId),0,25)."....", array('class'=>'menu')); ?>
                </div>
                <div class="span-6">
                    <?php echo anchor('inboxnegocios/ver/'.$inboxN->inboxnId,
                                       substr($inboxN->inboxnAsunto,0,36)."....", array('class'=>'menu')); ?>
                </div>
                <div class="span-3 last">
                    <?php
                        $fecha = unix_to_human($inboxN->inboxnFecha);
                        $correcta = fecha_acomodo($fecha);
                        echo $correcta;
                     ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach ?>
</div>
