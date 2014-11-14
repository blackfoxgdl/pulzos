<?php
/**
 * Editar los albums que cree el
 * negocio, formulario.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 03 March, 2011
 * @package albumNegocios
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#NegociosC").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    };
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    var url = $("#regresar").attr("href");
    $("#texto-menu").load(url);
}

$(".menu").click(function(event){
    event.preventDefault();
    var urlR = $(this).attr("href");
    $("#texto-menu").load(urlR);
});
</script>
<div class="span-14 last" style="margin-left: 10px; margin-top:20px;">
    <div class="span-14 last">
        <div class="soft-header" style="margin-right: 30px">
            Editar album <?php echo $edicionAlbum->albumNombre; ?>
        </div>
        <p>
            <h3>
            </h3>
        </p>
        <br />
    </div>
    <div class="span-14">
        <?php echo form_open('albumnegocios/editar/'.$edicionAlbum->albumId, array('id'=>'NegociosC','class'=>'negociosN')); ?>
            <p>
                <div class="span-3">
                    <?php echo form_label('Nombre del Album: ', 'albumNombre',array('style'=>"margin-left:20px; font-size:11px;color:#660068;")); ?>
                </div>
                <?php echo form_input(array('id'=>'albumNombre',
                                            'name'=>'EditarA[albumNombre]',
                                            'value'=>$edicionAlbum->albumNombre)); ?>
            </p>
            <p>
                <div class="span-3">
                    <?php echo form_label('Lugar: ', 'albumLugar',array('style'=>"margin-left:20px; font-size:11px;color:#660068;")); ?>
                </div>
                <?php echo form_input(array('id'=>'albumLugar',
                                            'name'=>'EditarA[albumLugar]',
                                            'value'=>$edicionAlbum->albumLugar)); ?>
            </p>
            <p>
                <div class="span-3">
                    <?php echo form_label('Descripcion: ', 'albumDescripcion',array('style'=>"margin-left:20px; font-size:11px;color:#660068;")); ?>
                </div>
                <?php echo form_input(array('id'=>'albumDescripcion',
                                            'name'=>'EditarA[albumDescripcion]',
                                            'value'=>$edicionAlbum->albumDescripcion)); ?>
            </p>
            <p>
            <?php if(!($edicionAlbum->albumNegocioDefault==1)){?>
				<?php echo form_label('Borrar àlbum', '',array('style'=>' margin-left:20px; font-size:11px;','class'=>'title-name')); ?>&nbsp &nbsp &nbsp 
                <?php echo anchor('albumnegocios/borrar/'.$edicionAlbum->albumId, img(array('src'=>'statics/img/cerrar.jpg')),array('style'=>'text-decoration:none; color:#999999;','title'=>'borrar àlbum','class'=>'borrarA'))?>
  		  <?php }?>
            </p>
            <p>
                <?php echo form_submit(array('id'=>'editar',
                                             'name'=>'editar',
                                             'class'=>'boton-perfil',
                                             'value'=>'Editar Album','style'=>'border:3px  solid #660068; background:#660068; color:#FFFFFF; font-size:9px;')); ?>
            </p>
        <?php echo form_close(); ?>
    </div>
</div>
