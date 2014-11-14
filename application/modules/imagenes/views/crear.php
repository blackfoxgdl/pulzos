<?php
/**
 * Crear nuevas imagenes, agregando metadata y subiendolas a la plataforma
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 08 March, 2011
 * @package Imagenes
 **/
if(! isset($flag))
{
    $flag = 0;
}
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#albums-cancelar").click(function(event){
    event.preventDefault();
    urlToLoad = $(this).attr("href");
});

$("#imagenes-captura").submit(function(event){
    event.preventDefault();
    options = {
        success: loadView
    };
    $(this).ajaxSubmit(options);
    return false;
});

function loadView(responseText, statusText, xhr, $form)
{
    urlToLoad = $("#albums-cancelar").attr("href");
    urlToCall = $("#get-imagen-url").attr("href");
    flag = $("#get-imagen-url").attr("flag");
    if(flag == 1){
        $.get(urlToCall+'/'+responseText, function(data){
            $("#avatar-photo-block").attr('src', data);
        });
    }
        urlProfile = $("#returnProfile").attr("href");
    	location.href = urlProfile;
    
}

$(document).ready(function(){
    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
});
</script>
<div id="form" class="formulario">
    <div style="display: none">
    	<?php if($flag==0){?>
        <div id="nombre-usuario-plan">Cargar imagen</div>
        <?php }else{?>
        <div id="nombre-usuario-plan">Cambiar Avatar</div>
        <?php }?>
    </div>
    <p>
<?php if($flag==0){?>
       <?php echo anchor('albums/ver_albums/'.$this->session->userdata('id'), '', array('id'=>'returnProfile','style'=>'display:none')); ?>
        <?php }else{?>
        <?php echo anchor('usuarios/perfil', '', array('id'=>'returnProfile','style'=>'display:none')); ?>
        <?php }?>


<?php echo anchor('imagenes/get_imagen_url', 'Obtener URL de carga', array('id'=>'get-imagen-url', 'style'=>'display: none;', 'flag'=>$flag)); ?>
    </p>
    <p>
        <?php echo form_open_multipart('imagenes/crear/'.$idAlbum.'/'.$flag, array('id'=>'imagenes-captura')); ?>
    </p>
    <p>
        <?php echo form_label('Imagen', 'imagenRuta', array('style'=>'color: #660066'));?>
            <?php echo form_upload(array('id'=>'imagenRuta',
                                         'name'=>'imagen',
                                        ));?>
    </p>
    <p>
        <?php echo form_submit(array('id'=>'enviar',
                                     'value'=>'Subir Foto',
                                     )); ?>
        <?php echo form_close(); ?>
    </p>
</div>
