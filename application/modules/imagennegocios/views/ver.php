<?php
/** 
 * Vista en la cual se vera la imagen en grande
 * y se podra seleccionarla para poder hacerla
 * avatar en caso de que el usuario dueño del
 * album lo desee
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package imagenNegocios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
?>
<script type="text/javascript">
$(".menu").click(function(event){
    event.preventDefault();
    var regresar = $(this).attr("href");
    $("#texto-menu").load(regresar);
});

$("#getavatar").click(function(event){
    event.preventDefault();
    var imgA = $("#imagenGrande").attr("src");
    var urlAv = $(this).attr("href");
    $.get(urlAv);
    $(this).hide("fast");
    $("#borrar-imagen").hide("fast");
    $("#imagen").attr("src",imgA);
});

$("#borrar-imagen").click(function(event){
    event.preventDefault();
    var url = $(this).attr("href");
    var urlR = $("#regresarA").attr("href");
    $.get(url);
    $("#texto-menu").load(urlR);
});
</script>
<div class="span-14 last" style="margin-top: 20px; margin-left:10px;">
    <div class="span-14 last">
        <div class="soft-header" style="margin-right:30px">
           Imagenes del album
        </div>
        <p>
            <?php echo anchor('imagennegocios/index/'.$imagen->albumId.'/'.$imagen->albumNegocioId, 
                              'Regresar', array('class'=>'menu',
                                                'id'=>'regresarA')); ?>
        </p>
    </div>
    <div class="span-14 prepend-top">
    <div class="prepend-1 span-12 box last">
        <?php echo $imagen->imagenNegocioNombre; ?>
        <br />
        <?php $imagenAtributos = array('id'=>'imagenGrande',
                                       'class'=>'imagenG',
                                       'src'=>$imagen->imagenNegocioRuta,
                                       'width'=>'300'); ?>
        <?php echo img($imagenAtributos); ?>
        <br />
    </div>
    <div class="prenpend-1 span-12 box menu last">
        <br />
        <?php echo $imagen->imagenNegocioDescripcion; ?>
        <br />
        <br />
        <?php if($this->session->userdata('idN') == $imagen->albumNegocioId): ?>
            <?php if($imagen->imagenNegocioAvatar != 1): ?>
                <?php echo anchor('imagennegocios/avatar/'.$imagen->imagenId.'/'.$imagen->imagenNegocioAlbumId, 
                                  'Hacerla mi Avatar', array('class'=>'opciones',
                                                             'id'=>'getavatar')); ?>
                <br />
                <?php echo anchor('imagennegocios/borrar/'.$imagen->imagenId,
                                  'Borrar Imagen', array('id'=>'borrar-imagen',
                                  'class'=>'borrarI')); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    </div>
</div>
