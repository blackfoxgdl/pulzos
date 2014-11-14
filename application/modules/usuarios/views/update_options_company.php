<?php
/**
 * Vista que se encarga de actualizar los links de 
 * los negocios, esto debido a que se necesita actualizar
 * al momento de seleccionar otra ciudad de algun pais
 * donde esta registrado originalmente el usuario
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
    $(".menu-usuarios1").click(function(event){
        event.preventDefault();
        urlMenu = $(event.currentTarget).attr("href");
        $("#texto-menu").load(urlMenu);
    });

    $(".links1").click(function(event){
        event.preventDefault();
        urlLink = $(event.currentTarget).attr("href");
        $("#texto-menu").load(urlLink);
    });
});
</script>
<div style="margin-left: 9px; margin-top: 3px">
    <?php echo anchor('seguidores/mostrar_negocios/'.$id,
                      'Negocios',
                      array('class'=>'menu-usuarios1', 'id'=>'negocios_perfil_usuarios', 'style'=>'text-decoration: none; color: #83547F;','onclick'=>"dhtmlHistory.add('".base_url()."index.php/seguidores/mostrar_negocios/".$id."',null),''")); ?>
    <span class="ver-todos-link right" id="ver_todos_negocios_perfil_usuarios">
        <?php echo anchor('seguidores/mostrar_negocios/'.$id,
                          'Ver todos',
                           array('class'=>'links1', 'id'=>'negocios_perfil_usuarios', 'style'=>'text-decoration: none; margin-right: 5px; font-size: 10px; color: #8D6E98','onclick'=>"dhtmlHistory.add('".base_url()."index.php/seguidores/mostrar_negocios/".$id."',null),''")); ?>
    </span>
</div>
