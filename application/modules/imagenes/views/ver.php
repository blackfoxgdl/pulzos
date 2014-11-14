<?php
/**
 * Ver todas las imágenes de un albúm
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 09 March, 2011
 * @package Imagenes
 **/
?>
<script type="text/javascript">
$("#imagenes-regresar").click(function(event){
    event.preventDefault();
    urlToLoad = $(this).attr("href");
    $("#tabs").load(urlToLoad);
});
$("#imagenes-avatar").click(function(event){
    event.preventDefault();
    urlToCall = $(this).attr("href");
    imagenUrl = $("#imagen-full-size").attr("src");
    $.get(urlToCall);
    $(this).hide("fast");
    $("#imagenes-borrar").hide("fast");
    $("#imagen-principal-avatar").attr("src", imagenUrl);
});
$("#imagenes-borrar").click(function(event){
    event.preventDefault();
    urlToReturn = $("#imagenes-regresar").attr("href");
    urlToCall = $(this).attr("href");
    $.get(urlToCall);
    $("#tabs").load(urlToReturn);
});
</script>
<div class="slideshow span-24">
<h3><?php echo anchor('imagenes/index/'.$imagen[0]->imagenAlbumId, 'Regresar', array('id'=>'imagenes-regresar')); ?></h3>
    <div class="prepend-3 span-16 box last">
        <h3><?php echo $imagen[0]->imagenNombre; ?></h3>
        <div class="imagen"><?php echo img(array('src'=>$imagen[0]->imagenRuta, 'width'=>"500", 'id'=>'imagen-full-size')); ?></div>
        <div class="descripcion"><?php echo $imagen[0]->imagenDescripcion; ?></div>
    </div>
    <div class="prepend-3 span-16 box menu last">

    <?php if($imagen[0]->imagenAvatar != 1): ?>
    <p><?php echo anchor('imagenes/avatar/'.$imagen[0]->imagenId, 'Hacerla mi avatar', array('id'=>"imagenes-avatar")); ?></p>
    <p><?php echo anchor('imagenes/borrar/'.$imagen[0]->imagenId, 'Borrar imagen', array('id'=>'imagenes-borrar')); ?></p>
    <?php endif; ?>
    </div>
</div>
