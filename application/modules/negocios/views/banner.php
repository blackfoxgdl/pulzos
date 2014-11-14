<?php
/**
 * Formulario para cambiar el banner principal
 * del negocio con las medidas que se especifiquen
 * en el mismo para que las respeten los usuario
 *
 * @version 0.1
 * @author blackfoxgdñ <ruben.alonso21@gmail.com>
 * @Copyright ZavorDigital, June 5, 2011
 * @package negocios
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#formaBanner").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista(){
    urlBanner = $('#returnB').attr("href");
    $("#texto-menu").load(urlBanner);
}

$(document).ready(function(){
    $("#informacion-miperfil").hide();
    $("#comentarios-todos-miperfil").hide();
});
</script>
<div class="span-14 last" style="margin-top: 20px; margin-left: 10px">
    <?php echo anchor('negocios/miperfil/'.$this->session->userdata('idN'), '', array('id'=>'returnB','class'=>'returnbanner', 'style'=>'display: none')); ?>
    <?php echo form_open_multipart('negocios/banner_negocio/'.$this->session->userdata('idN'), array('id'=>'formaBanner','class'=>'forma_banner')); ?>
        <?php echo form_hidden('Banner[extraNombreBanner]','hola'); ?>
        <div class="span-14">
            <div class="span-3">
                <?php echo form_label('Imagen:','imagenRuta', array('style'=>'color: #660068')); ?>
            </div>
            <div class="span-11 last">
                <?php echo form_upload(array('id'=>'imagenRuta',
                                             'name'=>'imagen',
                                             'class'=>'imagen_ruta')); ?>
            </div>
            <div class="span-3">
                &nbsp;
            </div>
            <div class="span-11 last" style="color: #FF0000">
                Medidas del Banner 520px X 240px
            </div>
        </div>
        <div class="span-14">
            <?php echo form_submit(array('id'=>'subirImagen',
                                         'class'=>'subir',
                                         'value'=>'Subir Imagen')); ?>
        </div>
    <?php echo form_close(); ?>
</div>
