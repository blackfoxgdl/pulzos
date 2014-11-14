<?php
/**
 * Vista para editar los datos de
 * las imagenes que estaran dentro de
 * los albums
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 1.0
 * @copyright ZavorDigital S.C, April 30, 2011
 * @package imagennegocios
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#formEditarImagen").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    };
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    var url = $("#regresar").attr("href");
    $("#dinamica").load(url);
}

$(".menu").click(function(event){
    event.preventDefault();
    var urlR = $(event.currentTarget).attr("href");
    $("#dinamica").load(urlR);
});
</script>
<div class="span-18">
    <div class="span-18">
        <h2>
            Editar Informacion de la Imagen
        </h2>
        <h3>
            <?php echo anchor('imagennegocios/index/'.$imagenes->albumId.'/'.$imagenes->albumNegocioId, 
                              'Cancelar', array('id'=>'regresar',
                                                'class'=>'menu')); ?>
        </h3>
    </div>
    <div class="span-18 prepend-top">
        <?php echo form_open(base_url().'index.php/imagennegocios/editar/'.$imagenes->imagenId.'/'.$imagenes->imagenNegocioAlbumId.'/'.$imagenes->albumNegocioId, array('id'=>'formEditarImagen','class'=>'editarImagenF')); ?>
            <p>
                <?php echo form_label('Nombre de la Imagen: ', 'nombreImagen'); ?>
                <?php echo form_input(array('id'=>'nombreImagen',
                                            'name'=>'EditarI[imagenNegocioNombre]',
                                            'class'=>'imagenNombre',
                                            'value'=>$imagenes->imagenNegocioNombre)); ?>
            </p>
            <p>
                <?php echo form_label('Descripcion de la Imagen: ', 'descripcionImagen'); ?>
                <?php echo form_input(array('id'=>'descripcionImagen',
                                            'name'=>'EditarI[imagenNegocioDescripcion]',
                                            'class'=>'imagenDescripcion',
                                            'value'=>$imagenes->imagenNegocioDescripcion)); ?>
            </p>
            <p>
                <?php echo form_submit(array('id'=>'editarImagen',
                                             'class'=>'editar',
                                             'value'=>'Guardar Cambios')); ?>
            </p>
        <?php echo form_close(); ?>
    </div>
</div>
