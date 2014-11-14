<?php
/**
 * Vista que mostrara los mensajes enviados por
 * inbox a los diferentes usuarios de la plataforma
 * o mejor dicho a sus seguidores
 **/
?>
<script type="text/javascript">
$(".menu").click(function(event){
    event.preventDefault();
    urlVer = $(event.currentTarget).attr("href");
    $("#inboxNegocios").load(urlVer);
});
</script>
<div class="span-14 last" style="margin-left: 10px; margin-top: 10px">
    <div class="span-4">
        Para
    </div>
    <div class="span-6">
        Asunto
    </div>
    <div class="span-3 last">
        Fecha
    </div>
    <?php foreach($recibidos as $inboxN): ?>
        <?php if($inboxN->inboxnStatus == 1): ?>
            <div class="span-13 last">
                <div class="span-4">
                    <?php echo anchor('inboxnegocios/ver/'.$inboxN->inboxnId,
                                      substr(get_name_user($inboxN->inboxnUsuarioRecibeId),0,25)."....", array('class'=>'menu')); ?>
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
                                      substr(get_name_user($inboxN->inboxnUsuarioRecibeId),0,25)."....", array('class'=>'menu')); ?>
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
