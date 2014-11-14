<?php
/**
 * Ver los negocios que un usuario sigue en particular.
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright ZavorDigital, 17 May, 2011
 * @package empresas
 **/
?>
<script type="text/javascript">
    $(".menu-empresas").click(function(event){
        event.preventDefault();
        urlToLoad = $(event.currentTarget).attr("href");
        $("#canvas").load(urlToLoad);
    });
$(".empresa-deseguir").click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().parent().hide("fast");
});
</script>
<h1>Empresas que sigo</h1>
<?php foreach($empresas AS $empresa): ?>
<div class="grid span-18">
    <div class="grid_element span-5 box">
        <?php
        echo img(array(
        'src'=>get_avatar_negocios($empresa->negocioId),
        'width'=>'90',
        'height'=>'90',
        ));
        ?>
        <ul>
            <li><?php echo $empresa->negocioNombre; ?></li>
            <li><?php echo $empresa->negocioEmail; ?></li>
            <li><?php echo anchor('planes/index/'.$empresa->negocioId, 'Planear algo aqui', array('class'=>'menu-empresas')); ?></li>
            <li><?php echo anchor('negocios/perfil/'.$empresa->negocioId, 'Ver Perfil'); ?></li>
            <li><?php echo anchor('seguidores/borrar/'.$empresa->negocioId, 'Deseguir', array('class'=>'empresa-deseguir')); ?></li>
        </ul>
    </div>
</div>
<?php endforeach; ?>
