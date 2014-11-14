<?php
/**
 * Carga las imagenes de los albums
 * del negocio que se ha creado con
 * las imagenes disponibles en dicho
 * album
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 01 March, 2011
 * @package albumNegocios
 **/
?>
<script type="text/javascript">
$(".menu").click(function(event){
    var url = $(event.currentTarget).attr('href');
    $("#texto-menu").load(url);
});

$(".borrarA").click(function(event){
                event.preventDefault();
                var urlA = $(event.currentTarget).attr("href");
                $.get(urlA);
                $(event.currentTarget).parent().parent().hide("fast");
});
</script>
<div class="span-14 last">
    <div class="span-13 last" style="margin-left: 10px; margin-top: 20px;">
        <div class="soft-header" style="margin-right: -10px;">
            Albums de <?php $name = get_name_company($negocios); echo $name->negocioNombre; ?>
        </div>
        <div class="span-13" style="margin-top: 10px;">
            <?php if($this->session->userdata('idN') == $negocios): ?>
                <?php echo anchor('albumnegocios/crear/'.$negocios,
                                  'Crear Album', array('id'=>'', 'class'=>'menu')); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="span-14 prepend-top" style="margin-left: 10px;">
        <?php foreach($albums as $album): ?>
            <div class="grid-element span-4">
                <br />
                <?php echo $album->albumNombre; ?>
                <br />
                <?php echo img(array('src'=>get_ultima_imagen_albumN($album->albumId),
                                     'width'=>'90',
                                     'height'=>'90')); ?>
                <br />
                <?php echo $album->albumDescripcion; echo $this->session->userdata('idN').'='.$album->albumNegocioId;?>
                <br />
                <br />
                <div class="span-3 last" style="display: block">
                    <?php echo anchor('imagennegocios/index/'.$album->albumId.'/'.$album->negocioId, 
                                      'Ver Album', array('id'=>'verImagenesAlbum',
                                                         'class'=>'menu')); ?>
                    <br />
                    <?php if($this->session->userdata('idN') == $album->albumNegocioId): ?>
                        <?php echo anchor('imagennegocios/crear/'.$album->albumId.'/'.$album->albumNegocioId, 
                                          'Agregar Imagen', array('id'=>'agregarImagen',
                                                                  'class'=>'menu')); ?>
                        <br />
                        <?php echo anchor('albumnegocios/editar/'.$album->albumId, 
                                          'Editar Album', array('id'=>'editarAlbum',
                                                                'class'=>'menu')); ?>
                        <br />
                        <?php echo anchor('albumnegocios/borrar/'.$album->albumId, 
                                          'Borrar Album', array('id'=>'borrarAlbum', 
                                                                'class'=>'borrarA')); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
