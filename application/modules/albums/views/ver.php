<?php
/**
* Muestra todos los albumes en no sé. Un grid? Habrá que ver
*
* @author axoloteDeAccion <mario.r.vallejo@gmail.com>
* @version 0.1
* @copyright ZavorDigital, 07 March, 2011
* @package Albums
**/
?>
<script type="text/javascript">
$(".agregar-imagenes").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#tabs").load(urlToLoad);
});
$(".ver-imagenes").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#tabs").load(urlToLoad);
});
$(".borrar-albums").click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().parent().parent().hide("fast");
});
$(".editar-albums").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#tabs").load(urlToLoad);
});
$("#agregar-albums").click(function(event){
    event.preventDefault();
    urlToLoad = $(this).attr("href");
    $("#tabs").load(urlToLoad);
});
$("#tabs-albums").tabs({
    select: function(event, ui){
        elementId = ui.panel.id;
        if(elementId == "tab-1"){
            $("#tab-1").load($("#albums-ver-todos").attr("href"));
        }else if(elementId == "tab-2"){
            $("#tab-2").load($("#albums-crear-form").attr("href"));
        }
    }
});
$("#tab-2").load($("#albums-crear-form").attr("href"));
$("#tab-1").load($("#albums-ver-todos").attr("href"));
</script>
<ul id="site-map">
    <li><?php echo anchor('albums/crear', 'Crear Albums', array('id'=>'albums-crear-form')); ?></li>
    <li><?php echo anchor('albums/ver_albums/', 'Ver Albums', array('id'=>'albums-ver-todos')); ?></li>
</ul>
<div id="tabs-albums" class="span-14 last">
    <ul>
        <li><a href="#tab-1">Ver Albums</a></li>
        <li><a href="#tab-2">Crear Album</a></li>
        <li><a href="#tab-3">Borrar Albums</a></li>
        <li><a href="#tab-4">Editar Albums</a></li>
    </ul>
    <div id="tab-1">
    </div>
    <div id="tab-2">
        Fill up
    </div>
    <div id="tab-3">
        Fill up
    </div>
    <div id="tab-4">
        Fill up
    </div>
</div>
