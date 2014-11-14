<?php
/**
 * Vista principal en la cual se 
 * mostraran los albums que se tienen
 * creados, en caso de que no se tenga
 * ningun album, esta vista no se mostrara.
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package ImagenNegocios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
?>
<script type="text/javascript">
$(".menu").click(function(event){
    event.preventDefault();
    var url = $(event.currentTarget).attr("href");
    $("#texto-menu").load(url);
});

$(".borrar").click(function(event){
    event.preventDefault();
    var urlB = $(event.currentTarget).attr("href");
    $.get(urlB);
    $(event.currentTarget).parent().hide("fast");
});
</script>
<div class="span-14 last" style="margin-top:20px; margin-left:10px;">
    <div class="span-14 last">
        <div class="soft-header" style="margin-right: 30px;">
            Imagenes del Album del Negocio
        </div>
        <p>
            <div class="span-13" style="margin-top:10px">
                <?php echo anchor('albumnegocios/ver/'.$this->session->userdata('idN'), 
                                  'Regresar', array('id'=>'regresa',
                                                    'class'=>'menu')); ?>
            </div>
            <h4>
                <?php if($this->session->userdata('idN') == $idNegocios): ?>
                    <?php echo anchor('imagennegocios/crear/'.$datosImg,
                                      'Agregar imagen', array('id'=>'nueva-imagen', 'class'=>'menu')); ?>
                <?php endif; ?>
            </h4>
        </p>
    </div>
    <div class="span-18 prepend-top">
        <?php foreach($imagenes as $imagen): ?>
            <div class="prepend-1 box span-5 prepend-top">
                <?php echo anchor('imagennegocios/ver/'.$imagen->imagenId, 
                                  $imagen->imagenNegocioNombre, array('id'=>'imagenAlbumN',
                                                                      'class'=>'menu')); ?>
                <br />
                <?php echo anchor('imagennegocios/ver/'.$imagen->imagenId, 
                                   img(array('src'=>$imagen->imagenNegocioRuta,
                                             'width'=>100,
                                             'height'=>100)),array('id'=>'imagenAlbumN',
                                                                  'class'=>'menu')); ?>
                <br />
                <?php echo anchor('imagennegocios/ver/'.$imagen->imagenId, 
                                  $imagen->imagenNegocioDescripcion, array('id'=>'imagenAlbumD',
                                                                           'class'=>'menu')); ?>
                <br />
                <br />
                <?php if($this->session->userdata('idN') == $idNegocios): ?>
                    <?php echo anchor('imagennegocios/editar/'.$imagen->imagenId,
                                      'Editar Informacion de Imagen', array('id'=>'ImagenEditar',
                                                                            'class'=>'menu')); ?>
                    <br />
                    <?php echo anchor('imagennegocios/borrar/'.$imagen->imagenId.'/'.$imagen->imagenNegocioAlbumId, 
                                      'Borrar Imagen del Album', array('id'=>'ImagenBorrar',
                                                                       'class'=>'borrar')); ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
