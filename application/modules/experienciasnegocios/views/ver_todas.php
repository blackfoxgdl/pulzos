<?php
/**
 * Vista en la cual se mostraran todas las etiquetas que
 * se tienen de las experiencias de vida con las cuales
 * vas a poder visualizar los pulzos de experiencias de vida
 * y asi ya ver todos
 **/
?>
<script type="text/javascript">
$('.experienciaNube').click(function(event){
    event.preventDefault();
    urlNube = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlNube);
});

$(document).ready(function(){
    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
    var texto = $("div#menu-derecha").html();
    $("#main-div").html(texto);
});
</script>
<div class="span-14 last" style="margin-top: 20px">
    <div style="display: none">
        <div id="nombre-usuario-plan">Experiencias de Vida</div>
        <div id="edad-usuario-plan"></div>
        <div id="relacion-usuario-plan"></div>
        <div id="estado-usuario-plan"></div>
        <div id="menu-derecha"></div>
    </div>
    <div class="span-13 last" style="margin-top: 10px; margin-left: 5px">
        <?php foreach($tags as $tag): ?>
            <?php $numero = count_tags_experience($tag->nombre); ?>
            <?php if($numero <= 5): ?>
                <?php echo anchor('experienciasnegocios/ver_etiquetas/'.$tag->nombre,
                                  $tag->nombre, array('style'=>'padding-right: 8px; font-size: 12px', 'class'=>'experienciaNube')); ?>
            <?php elseif($numero <= 10 && $numero > 5): ?>
                <?php echo anchor('experienciasnegocios/ver_etiquetas/'.$tag->nombre,
                                  $tag->nombre, array('style'=>'padding-right: 8px; font-size: 14px', 'class'=>'experienciaNube')); ?>
            <?php elseif($numero <= 15 && $numero > 10): ?>
                <?php echo anchor('experienciasnegocios/ver_etiquetas/'.$tag->nombre,
                                  $tag->nombre, array('style'=>'padding-right: 8px; font-size: 16px', 'class'=>'experienciaNube')); ?>
            <?php elseif($numero <= 20 && $numero > 15): ?>
                <?php echo anchor('experienciasnegocios/ver_etiquetas/'.$tag->nombre,
                                  $tag->nombre, array('style'=>'padding-right: 8px; font-size: 18px', 'class'=>'experienciaNube')); ?>
            <?php elseif($numero > 25): ?>
                <?php echo anchor('experienciasnegocios/ver_etiquetas/'.$tag->nombre,
                                  $tag->nombre, array('style'=>'padding-right: 8px; font-size: 20px', 'class'=>'experienciaNube')); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
