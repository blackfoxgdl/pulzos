<?php
/**
* La vista general del apartado de crear albumes.
*
* @author axoloteDeAccion
* @version 0.1
* @copyright ZavorDigital, 07 March, 2011
* @package Albums
**/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#albums-cancelar").click(function(event){
        event.preventDefault();
        urlToLoad = $(this).attr("href");
        $("#tabs").load(urlToLoad);
});
$("#captura-albums").submit(function(event){
        event.preventDefault();
        options = {
            success: emptyFields
        };
        $(this).ajaxSubmit(options);
        return false;
});

function emptyFields(responseText){
    $("#albumNombre").val("");
    $("#albumLugar").val("");
    $("#albumDescripcion").val("");
    cargaFotos(responseText);
}

function cargaFotos(responseText){
    urlToLoad = $("#albums-crear-imagenes").attr("href");
    $(".carga-fotos").load(urlToLoad+'/'+responseText);
	$("#id_personales").fadeIn(1000);
 	$("#id_personales").fadeOut(2000);
 	
	
}


</script>
<div class="span-13" style="background-color: #A71E9F; color: #FFFFFF; display: none;" id="id_personales">
       Albùm de fotos creado.
    </div>
<ul style="display: none;">
<li><?php echo anchor('imagenes/crear', 'cargar vista imagenes', array('id'=>'albums-crear-imagenes')); ?></li>
<li></li>
<li></li>
</ul>
<div class="formulario">
    <p>
    	<?php echo form_open('albums/crear', array('id'=>'captura-albums')); ?>
    </p>
    <p>
    	<?php echo form_label('Nombre del albúm', 'albumNombre',array('style'=>' margin-left:20px; font-size:11px;','class'=>'title-name')); ?>
    	<?php echo form_input(array(
    		'id'=>'albumNombre',
    		'name'=>'Albums[albumNombre]',
    		'value'=>'',
    	)); ?>
    </p>
    <p>
    	<?php echo form_hidden(array(
    		'id'=>'albumLugar',
    		'name'=>'Albums[albumLugar]',
    		'value'=>'Aqui',
    	));?>
    </p>
    <p>
    	<?php echo form_hidden(array(
    		'id'=>'albumDescripcion',
    		'name'=>'Albums[albumDescripcion]',
    		'value'=>'Mi Album',
    	));?>
    </p>
    <p>
        <?php echo form_submit(array('id'=>'albumSubmit',
                                             'value'=>'Crear Albúm',
                                             'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
    </p>
    <?php echo form_close(); ?>

<!--- Formulario de captura de fotos -->
    <div class="carga-fotos"></div>
</div>
