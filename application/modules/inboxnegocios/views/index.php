<?php
/**
 * Vista que mostrara los datos de
 * todos los inbox que se han enviado
 * al usuario del negocio. NOTA SE USA EL
 * ID DE EMPRESA EN LA TABLA DE USUARIOS NO
 * EN LA TABLA DE EMPRESAS
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 4, 2011
 * @package inboxNegocios
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
    $(".menu-inbox").click(function(event){
         event.preventDefault();
         urlI = $(event.currentTarget).attr("href");
         $("#inboxNegocios").load(urlI);
    });

    urlMainI = $("#principalM").attr("href");
    $("#inboxNegocios").load(urlMainI);
});
 </script>
<div class="span-14 last" style="margin-left:10px; margin-top:20px">
    <div class="soft-header" style="margin-right: 30px">
        Mensajes de <?php echo $datosNegocio->negocioNombre; ?>
    </div>
    <div class="span-13 last tabs-menu"><!-- INICIO DEL DIV DEL CUERPO DEL INBOX -->
        <ul class="tab-3">
            <li style="width: 169px">
            <a href="<?php echo base_url(); ?>index.php/inboxnegocios/ver_mensajes/<?php echo $datosNegocio->negocioUsuarioId; ?>" class="menu-inbox" id="principalM">
                    Mensaje Recibidos
                </a>
            </li>
            <li style="width: 168px">
            <a href="<?php echo base_url(); ?>index.php/inboxnegocios/crear/<?php echo $datosNegocio->negocioUsuarioId; ?>" class="menu-inbox">
                    Enviar Mensaje
                </a>
            </li>
            <li style="width: 168px">
                <a href="<?php echo base_url(); ?>index.php/inboxnegocios/ver_enviados/<?php echo $datosNegocio->negocioUsuarioId; ?>" class="menu-inbox">
                    Mensajes Enviados
                </a>
            </li>
        </ul>
        <div id="inboxNegocios">
        </div>
    </div><!-- FIN DEL DIV DEL CUERPO DEL INBOX -->
</div>
