<?php
/**
* Editar
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#albums-cancelar").click(function(event){
    event.preventDefault();
    urlToLoad = $(this).attr("href");
    $("#tabs").load(urlToLoad);
});
$("#albums-edicion").submit(function(event){
    event.preventDefault();
    options = {
        target: "#tabs"
    };
    $(this).ajaxSubmit(options);
	$("#id_personales").fadeIn(1000);
 	$("#id_personales").fadeOut(2000);
    return false;
});
</script>
<div class="span-13" style="background-color: #A71E9F; color: #FFFFFF; display: none;" id="id_personales">
       Albùm de fotos editado.
    </div>
<div class="formulario">
    <p>
    <?php echo form_open('albums/editar/'.$album[0]->albumId, array('id'=>'albums-edicion')); ?>
    </p>
    <p>&nbsp 
    <?php echo form_label('Nombre del albúm', 'albumNombre',array('style'=>' margin-left:20px; font-size:11px;','class'=>'title-name')); ?>
    <?php echo form_input(array(
    'id'=>'albumNombre',
    'name'=>'Albums[albumNombre]',
    'value'=>$album[0]->albumNombre,
    )); ?>
    </p>
    <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
    <?php echo form_label('Lugar', 'albumLugar',array('style'=>' margin-left:20px; font-size:11px;','class'=>'title-name')); ?>
    <?php echo form_input(array(
    'id'=>'albumLugar',
    'name'=>'Albums[albumLugar]',
    'value'=>$album[0]->albumLugar,
    ));?>
    </p>
    <p>&nbsp &nbsp &nbsp &nbsp &nbsp 
    <?php echo form_label('Descripción', 'albumDescripcion',array('style'=>' margin-left:20px; font-size:11px;','class'=>'title-name')); ?>
    <?php echo form_input(array(
    'id'=>'albumDescripcion',
    'name'=>'Albums[albumDescripcion]',
    'value'=>$album[0]->albumDescripcion,
    ));?>
    </p>
    <p>&nbsp &nbsp &nbsp &nbsp 
    <?php if(!($album[0]->albumDefault==1 || $album[0]->albumDefault==2)){?>
		<?php echo form_label('Borrar àlbum', '',array('style'=>' margin-left:20px; font-size:11px;','class'=>'title-name')); ?>&nbsp &nbsp &nbsp 
        <?php echo anchor('albums/borrar/'.$album[0]->albumId, img(array('src'=>'statics/img/cerrar.jpg')),array('style'=>'text-decoration:none; color:#999999;','title'=>'borrar àlbum','class'=>'borrarA'))?>
    <?php }?>
    </p>
    <p>
    <?php echo form_submit(array('id'=>'albumSubmit',
                                             'value'=>'Guardar',
                                             'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
    </p>
    <?php echo form_close(); ?>
</div>
