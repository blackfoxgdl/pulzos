<?php
/**
* Mostrar el listado de autorizaciones pendientes
*
* @author blackfoxgdl <ruben.alonso21@gmail.com>
* @version 0.1
* @copyright Zavordigital, 22 March, 2011
* @package amigos
**/
?>
<script type="text/javascript">
$(document).ready(function(event){
    $('.menu-izq-menor').click(function(event){
        event.preventDefault();
        urlCall = $(event.currentTarget).attr("href");
        $.get(urlCall);
        $(event.currentTarget).parent().parent().parent().hide();
        textoLink = $(event.currentTarget).text();
        if(textoLink == "Autorizar")
        {
            $("#aceptar").show("fast").fadeOut(5000);
        }
        else
        {
            $("#rechazar").show("fast").fadeOut(5000);
        }
    });
});
</script>
<div class="span-14 last">
    <div class="span-14 last" id="aceptar" style="display: none">
        <div class="soft-header">
            Se ha aceptado la solicitud de amistad
        </div>
    </div>
    <div class="span-14 last" id="rechazar" style="display: none">
        <div class="soft-header">
            Se ha rechazado la solicitud de amistad
        </div>
    </div>
    <?php foreach($no_autorizados as $pendientes): ?>
        <div class="span-4 last" style="margin-top: 10px">
            <div align="center">
                <span class="menu-izq-menor">
                    <?php echo $pendientes->nombre; ?>    
                </span> 
                <p style="margin-top: 5px; margin-bottom: 5px">
                    <?php echo anchor('usuarios/perfil/'.$pendientes->id,
                                      img(array('src'=>get_avatar($pendientes->id),
                                                'width'=>'90',
                                                'height'=>'90'))); ?>
                </p>
                <p>
                    <?php echo anchor('amigos/autorizar/'.$pendientes->id.'/'.$this->session->userdata('id'),
                                      'Autorizar', array('class'=>'menu-izq-menor', 'style'=>'text-decoration: none')); ?>
                    <br />
                    <?php echo anchor('amigos/rechazar/'.$pendientes->id.'/'.$this->session->userdata('id'),
                                      'Rechazar', array('class'=>'menu-izq-menor', 'style'=>'text-decoration: none')); ?>
                </p> 
            </div>
        </div>
    <?php endforeach; ?>
</div>
