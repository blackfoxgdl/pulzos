<?php
/**
 * View for edit the user's
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

    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
});

    //desplegable A
    $('.menu-editar').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        carga = $('.editar-usuario').attr('id');
        url = $('.editar-usuario').attr('href');
        $(event.currentTarget).hide();
        $('.menu-ocultar').show();
        $('div#'+carga).load(url);
    });

    $('.menu-ocultar').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        $('.menu-editar').show();
        $('.desplegable').hide();
    });    

    //desplegable B
    $('.menu-editar-A').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        carga = $('.editar-usuario-A').attr('id');
        url = $('.editar-usuario-A').attr('href');
        $(event.currentTarget).hide();
        $('.menu-ocultar-A').show();
        $('div#'+carga).load(url);
    });

    $('.menu-ocultar-A').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        $('.menu-editar-A').show();
        $('.desplegable-A').hide();
    });

    //desplegable C
    $('.menu-editar-B').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        carga = $('.editar-usuario-B').attr('id');
        url = $('.editar-usuario-B').attr('href');
        $(event.currentTarget).hide();
        $('.menu-ocultar-B').show();
        $('div#'+carga).load(url);
    });

    $('.menu-ocultar-B').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        $('.menu-editar-B').show();
        $('.desplegable-B').hide();
    });

    //desplegable D
    $('.menu-editar-C').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        carga = $('.editar-usuario-C').attr('id');
        url = $('.editar-usuario-C').attr('href');
        $(event.currentTarget).hide();
        $('.menu-ocultar-C').show();
        $('div#'+carga).load(url);
    });

    $('.menu-ocultar-C').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        $('.menu-editar-C').show();
        $('.desplegable-C').hide();
    });

    //desplegable E
    $('.menu-editar-D').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        carga = $('.editar-usuario-D').attr('id');
        url = $('.editar-usuario-D').attr('href');
        $(event.currentTarget).hide();
        $('.menu-ocultar-D').show();
        $('div#'+carga).load(url);
    });

    $('.menu-ocultar-D').click(function(event){
        event.preventDefault();
        $(event.currentTarget).hide();
        $('.menu-editar-D').show();
        $('.desplegable-D').hide();
    });
</script>
    <div style="display: none">
        <div id="nombre-usuario-plan">Cuenta</div>
    </div>
    <div class="span-13 last" style="margin-top: 10px;border-bottom:1px solid #DFCBDF;"> <!-- DIV DATOS PERSONALES-->
            
            <span class="span-12 last" style="color:#660066;">Datos personales</span>
            
            <a style="text-decoration:none" href="<?php echo base_url(); ?>index.php/usuarios/personales/<?php echo $datosP->usuarioId; ?>" id="datos" class="editar-usuario">
                  <span style="color:#996699;" class="menu-editar">Editar</span>
                  <span style="color:#996699; display: none" class="menu-ocultar">Ocultar</span>
            </a>
            <div id="datos" style="margin-top: 10px;"></div>
    </div>

    <div class="span-13 last" style="margin-top:10px; border-bottom:1px solid #DFCBDF;"> <!-- DIV ACERCA DE MI -->
        <span class="span-12 last" style="color:#660066;">Acerca de mi</span>
          <a style="text-decoration:none" href="<?php echo base_url(); ?>index.php/usuarios/acerca_de_mi/<?php echo $datosP->usuarioId; ?>" id="acerca" class="editar-usuario-A">
                    <span style="color:#996699; text-decoration:none;" id="acerca" class="menu-editar-A">Editar</span>
                    <span style="color:#996699; text-decoration: none; display: none" class="menu-ocultar-A">Ocultar</span>
                </a>
        <div id="acerca" style="margin-top: 10px;"></div>
    
   </div>
    
    <div class="span-13 last" style="margin-top:10px; border-bottom:1px solid #DFCBDF;"> <!-- DIV ESTUDIOS -->
        <span class="span-12 last" style="color:#660066;">Estudios</span>
        <a style="text-decoration:none" href="<?php echo base_url(); ?>index.php/usuarios/estudios_usuario/<?php echo $datosP->usuarioId; ?>" id="estudios" class="editar-usuario-B">
                   <span style="color:#996699" id="estudios" class="menu-editar-B">Editar</span>
                   <span style="color: #996699; display: none" class="menu-ocultar-B">Ocultar</span>
        </a>
        
        <div id="estudios" style="margin-top: 10px;"></div>
    </div>
    
    <div class="span-13 last" style="margin-top:10px; border-bottom:1px solid #DFCBDF;"> <!-- DIV UBICACION -->
       <span class="span-12 last" style="color:#660066;">Ubicacion</span>
           <a style="text-decoration:none" href="<?php echo base_url(); ?>index.php/usuarios/ubicacion_usuario/<?php echo $datosP->usuarioId; ?>" id="ubicacion" class="editar-usuario-C">
                <span style="text-decoration: none; color: #996699" id="ubicacion" class="menu-editar-C">Editar</span>
                <span style="text-decoration: none; color: #996699; display: none" class="menu-ocultar-C">Ocultar</span>
            </a>
        <div id="ubicacion" style="margin-top: 10px;"></div>
    </div>
    
    <?php 
        //PART WHERE THE CHANGE OF PASSWORD GOING TO SHOW IF THE USER DON'T LOGGIN WITH FB
        $userLoginFB = checkLoginFB($this->session->userdata('id'));
    ?>
    <?php if($userLoginFB->password != '0'): ?>
        <div class="span-13 last lista-editPersDiv" style="margin-top:10px; border-bottom:1px solid #DFCBDF;"> <!-- DIV SEGURIDAD -->
            <span class="span-12 last" style="color:#660066;">Cambio de Contrase&ntilde;a</span>
            <a style="text-decoration:none" href="<?php echo base_url(); ?>index.php/usuarios/privacidad_usuario/<?php echo $datosP->usuarioId; ?>" id="seguridad" class="editar-usuario-D">
                <span style="color: #996699" id="seguridad" class="menu-editar-D">Editar</span>
                <span style="color: #996699; display: none" class="menu-ocultar-D">Ocultar</span>
            </a>
            <div id="seguridad" style="margin-top: 10px;"></div>
        </div>
    <?php endif; ?>


