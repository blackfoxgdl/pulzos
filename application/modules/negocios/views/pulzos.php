<?php
/**
 * Vista que se encarga de mostrar los pulzos del lado
 * derecho, estos son los tres formas que hay, pulzos, retos
 * y experiencias de vida
 **/
?>
<script type="text/javascript">
$(".links").click(function(event){
    event.preventDefault();
    urlE = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlE);
});
</script>
<div class="span-5 last colorLetra" style="margin-top: 25px">
    <div class="span-6" style="margin-bottom: 20px">
        <div class="soft-header">
            Pulzos
            <span class="right ver-todo-link">
                <?php echo anchor('pulzos/ver/'.$id,
                                  'ver mas', array('class'=>'links')); ?>
            </span>
        </div>
    </div>
    <?php $i = 1; ?>
    <?php foreach($pulzos as $pulzo): ?>
        <div class="span-6">
            <div class="soft-header">
                <?php echo $pulzo->pulzoTitulo; ?>
            </div>
        </div>
        <div class="span-6" style="background-color: #baa7bd; margin-bottom: 20px;">
            <div class="span-2 last" style="margin-top:10px; margin-left:1px">
                <?php if($pulzo->pulzoImagenRuta == '0'): ?>
                    <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                         'width'=>'60',
                                         'height'=>'60')); ?>
                <?php else: ?>
                    <?php echo img(array('src'=>get_avatar_pulzo($pulzo->pulzoId),
                                         'width'=>'60',
                                         'height'=>'60')); ?>
                <?php endif; ?>
            </div>
            <div class="span-4 last" style="margin-top:10px; margin-bottom: 10px; line-height: 12px;">
                <?php echo substr($pulzo->pulzoAccion,0,80) . ".."; ?>
            </div>
            <div class="prepend-4">
                <?php echo anchor('pulzos/ver_simple/'.$pulzo->pulzoId, 'ver mas', array('class'=>'links')); ?>
            </div>
        </div>
        <?php $i = $i+1; ?>
    <?php endforeach; ?>
</div>
<!-- DIV CON EL CUAL SE VERAN LOS RETOS -->
<div class="span-5 last colorLetra" style="margin-top: 25px">
    <div class="span-6" style="margin-bottom: 20px;">
        <div class="soft-header">
            Retos
            <span class="right ver-todo-link"><?php echo anchor('retosnegocios/ver/'.$id,  
                                             'ver mas', array('class'=>'links')); ?></span>
        </div>
    </div>
    <?php $i = 1; ?>
    <?php foreach($retos as $reto): ?>
        <div class="span-6">
            <div class="soft-header">
                <?php echo $reto->pulzoTitulo; ?>
            </div>
        </div>
        <div class="span-6" style="background-color: #baa7bd; margin-bottom: 20px">
            <div class="span-2 last" style="margin-top:10px; margin-left:1px">
                <?php if($reto->pulzoImagenRuta == '0'): ?>
                    <?php echo img(array('src'=>get_avatar_negocios($reto->pulzoUsuarioId),
                                         'width'=>'60',
                                         'height'=>'60')); ?>
                <?php else: ?>
                    <?php echo img(array('src'=>get_avatar_pulzo($reto->pulzoId),
                                         'width'=>'60',
                                         'height'=>'60')); ?>
                <?php endif; ?>
            </div>
            <div class="interlineado span-4 last" style="margin-top:10px; margin-bottom: 10px">
                <?php echo substr($reto->pulzoAccion,0,80) . ".."; ?>
            </div>
            <div class="prepend-4">
                <?php echo anchor('retosnegocios/ver_reto/'.$reto->pulzoId, 'ver mas', array('class'=>'links')); ?>
            </div>
        </div>
        <?php $i = $i+1; ?>
    <?php endforeach; ?>
</div>
<!-- DIV CON EL CUAL SE MOSTRARAN LAS EXPERIENCIAS -->
<div class="span-5 last colorLetra" style="margin-top: 25px">
    <div class="span-6" style="margin-bottom: 20px">
        <div class="soft-header">
            Experiencias de Vida
            <span class="right ver-todo-link"><?php echo anchor('experienciasnegocios/ver/'.$id,  
                                             'ver mas', array('class'=>'links')); ?></span>
        </div>
    </div>
    <?php $i = 1; ?>
    <?php foreach($experiencias as $experiencia): ?>
        <div class="span-6">
            <div class="soft-header">
                <?php echo $experiencia->pulzoTitulo; ?>
            </div>
        </div>
        <div class="span-6" style="background-color: #baa7bd; margin-bottom: 20px">
            <div class="span-2 last" style="margin-top:10px; margin-left:1px">
                <?php if($experiencia->pulzoImagenRuta == '0'): ?>
                    <?php echo img(array('src'=>get_avatar_negocios($experiencia->pulzoUsuarioId),
                                         'width'=>'60',
                                         'height'=>'60')); ?>
                <?php else: ?>
                    <?php echo img(array('src'=>get_avatar_pulzo($experiencia->pulzoId),
                                         'width'=>'60',
                                         'height'=>'60')); ?>
                <?php endif; ?>
            </div>
            <div class="interlineado span-4 last" style="margin-top:10px; margin-bottom: 10px">
                <?php echo substr($experiencia->pulzoAccion,0,80) . ".."; ?>
            </div>
            <div class="prepend-4">
                <?php echo anchor('experienciasnegocios/ver_experiencia/'.$experiencia->pulzoId, 'ver mas', array('class'=>'links')); ?>
            </div>
        </div>
        <?php $i = $i+1; ?>
    <?php endforeach; ?>
</div>

