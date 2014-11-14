<?php
/**
 * View for edit the company's
 * data for show in the profile
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital February 22, 2011
 * @package Core
 **/
echo doctype(); 
?>
<script type="text/javascript">
$(document).ready(function(){
});

//PERSONAL DATA
$(".menu-editar").click(function(event){
    event.preventDefault();
    urlDatosNegocios = $("#negocios-datos").attr("href");
    $(event.currentTarget).hide();
    $(".menu-ocultar").show();
    $("#datosN").load(urlDatosNegocios);
});

$(".menu-ocultar").click(function(event){
    event.preventDefault();
    $(event.currentTarget).hide();
    $("#desplegable").hide();
    $(".menu-editar").show();
});

//SERVICE DATA
$(".menu-editar-S").click(function(event){
    event.preventDefault();
    urlServiciosNegocios = $("#negocios-servicios").attr("href");
    $(event.currentTarget).hide();
    $(".menu-ocultar-S").show();
    $("#servicios").load(urlServiciosNegocios);
});

$(".menu-ocultar-S").click(function(event){
    event.preventDefault();
    $(event.currentTarget).hide();
    $("#desplegable-S").hide();
    $(".menu-editar-S").show();
});

//UBICATION
$(".mostrarUbicacion").click(function(event){
    event.preventDefault();
    urlServiciosNegocios = $("#negocios-ubicacion").attr("href");
    $(event.currentTarget).hide();
    $(".ocultar_ubicacion").show();
    $("#ubicacion").load(urlServiciosNegocios);
});


$(".ocultar_ubicacion").click(function(event){
    event.preventDefault();
    $(event.currentTarget).hide();
    $("#desplegable-U").hide();
    $(".mostrarUbicacion").show();
});
 
//SAVE
$(".mostrarSeguridad").click(function(event){
    event.preventDefault();
    urlSeguridad = $("#negocios-seguridad").attr("href");
    $(event.currentTarget).hide();
    $(".ocultar_seguridad").show();
    $("#seguridad").load(urlSeguridad);
});

$(".ocultar_seguridad").click(function(event){
    event.preventDefault();
    $(event.currentTarget).hide();
    $("#desplegable-C").hide();
    $(".mostrarSeguridad").show();
});
</script>
<div style="display: none">
</div>
<div class="span-13" style="margin-top: 10px; border-bottom: 1px solid #DFCBDF;"><!-- DIV DATOS EMPRESA -->
    <div class="span-12 last">
        <span class="span-11 last" style="color: #660066"> Datos del negocio </span>
        <a href="<?php echo base_url(); ?>index.php/negocios/personal_negocios/<?php echo $this->session->userdata('idN'); ?>" id="negocios-datos" class="editar-negocio" style="text-decoration: none">
            <span style="color: #996699" class="menu-editar">Editar</span>
            <span style="color: #996699; display: none" class="menu-ocultar">Ocultar</span>
        </a>
        <div id="datosN" style="margin-top: 10px"></div>
    </div>
</div>
<div class="span-13" style="margin-top: 10px; border-bottom: 1px solid #DFCBDF;"><!-- DIV UBICACION SERVICIOS -->
    <div class="span-12 last">
        <div class="span-11 last" style="color: #660066"> Ubicacion </div>
        <a href="<?php echo base_url(); ?>index.php/negocios/ubicacionNegocio/<?php echo $this->session->userdata('idN'); ?>" id="negocios-ubicacion" class="editar-negocio-A" style="text-decoration: none">
            <span style="color: #996699" class="mostrarUbicacion"> Editar </span>
            <span style="color: #996699; display: none" class="ocultar_ubicacion"> Ocultar </span>
        </a>
        <div id="ubicacion" style="margin-top: 10px"></div>
    </div>
</div>
<div class="span-13" style="margin-top: 10px; border-bottom: 1px solid #DFCBDF;"><!-- DIV SEGURIDAD NEGOCIOS -->
    <div class="span-12 last">
        <div class="span-11 last" style="color: #660066"> Cambio de contrase&ntilde;a</div>
        <a href="<?php echo base_url(); ?>index.php/negocios/seguridadNegocio/<?php echo $this->session->userdata('idN'); ?>" style="text-decoration: none" class="editar-negocio-B" id="negocios-seguridad">
            <span class="mostrarSeguridad" style="color: #996699">Editar</span>
            <span class="ocultar_seguridad" style="color: #996699; display: none">Ocultar</span>
        </a>
        <div id="seguridad" style="margin-top: 10px"></div>
    </div>
</div>
