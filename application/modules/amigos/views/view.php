<?php
/**
 * Mostrar el grid de amigos de los que consta el usuario
*
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 17 March, 2011
 * @package Amigos
 **/
?>
<script type="text/javascript">
</script>
<script type="text/javascript">
$(document).ready(function(){
    urlLoad = $("#ver-amigos").attr("href");
    $("#amigos-usuarios").load(urlLoad);

    $(".menu-amigos").click(function(event){
        event.preventDefault();
        urlA = $(event.currentTarget).attr("href");
        $("#amigos-usuarios").load(urlA);
    });
});
</script>
<div class="span-14 last">
    <?php echo anchor('amigos/amigos_ver/'.$amigos, '', array('id'=>'ver-amigos','style'=>'display:none')); ?>
    <div class="span-14 last">
        <div class="soft-header" style="margin-top: 10px">
            Amigos de <?php echo get_name_user($this->session->userdata('id')); ?>
        </div>
    </div>
    <div class="span-14 last tabs-menu" style="margin-bottom: 10px">
        <ul class="tab-3">
            <li>
            <a href="<?php echo base_url(); ?>index.php/amigos/amigos_ver/<?php echo $amigos; ?>" class="menu-amigos">
                    Amigos
                </a>
            </li>
            <li>
            <a href="<?php echo base_url(); ?>index.php/amigos/ver_no_autorizados/<?php echo $amigos; ?>" class="menu-amigos">
                    Solicitudes
                </a>
            </li>
            <li>
            <a href="<?php echo base_url(); ?>index.php/amigos/buscar_amigos/<?php echo $amigos; ?>" class="menu-amigos">
                    Invitaciones Enviadas
                </a>
            </li>
        </ul>
    </div>
    <div id="amigos-usuarios">
    </div> 
</div>
