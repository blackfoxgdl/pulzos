<?php
/**
 * Vista de la creacion de un nuevo album
 * para que el negocio pueda meter ahi sus
 * fotos
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 01 March, 2011
 * @package albumNegocios
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#NegociosC").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista(){
    var url = $("#cancelar").attr("href");
    $("#texto-menu").load(url);
}


$(".menu").click(function(event){
    event.preventDefault();
    var urlR = $(this).attr("href");
    $("#texto-menu").load(urlR);
});
</script>
<div class="span-14 last" style="margin-left: 10px; margin-top: 20px;">
    <div class="span-13">
        <div class="soft-header" style="margin-right: -10px;">
            Crear Nuevo Album
        </div>
        <div class="span-13 last" style="margin-top:10px">
            <?php echo anchor('albumnegocios/ver/'.$user_id->negocioId, 
                              'Cancelar', array('id'=>'cancelar','class'=>'menu','style'=>"display:none")); ?>
        </div>
    </div>
    <div class="span-14">
        <?php echo form_open('albumnegocios/crear/'.$user_id->negocioId, array('id'=>'NegociosC','class'=>'negociosN')); ?>
            <p>
                <div class="span-3">
                    <?php echo form_label('Nombre del Album: ', 'albumNombre',array('style'=>"margin-left:20px; font-size:11px;color:#660068;")); ?>
                </div>
                <?php echo form_input(array('id'=>'albumNombre',
                                            'name'=>'Albums[albumNombre]',
                                            'value'=>''
											)); ?>
            </p>
            <p>
                <div class="span-3">
                    <?php echo form_label('Lugar: ', 'albumLugar',array('style'=>"margin-left:20px; font-size:11px;color:#660068;")); ?>
                </div>
                <?php echo form_input(array('id'=>'albumLugar',
                                            'name'=>'Albums[albumLugar]',
                                            'value'=>'')); ?>
            </p>
            <p>
                <div class="span-3">
                    <?php echo form_label('Descripcion: ', 'albumDescripcion',array('style'=>"margin-left:20px; font-size:11px;color:#660068;")); ?>
                </div>
                <?php echo form_input(array('id'=>'albumDescripcion',
                                            'name'=>'Albums[albumDescripcion]',
                                            'value'=>'')); ?>
            </p>
            <p>
                <?php echo form_submit(array('id'=>'guardar',
                                             'name'=>'crear',
                                             'class'=>'boton-perfil',
                                             'value'=>'Crear Album','style'=>'border:3px  solid #660068; background:#660068; color:#FFFFFF; font-size:9px;')); ?>
            </p>
        <?php echo form_close(); ?>
    </div>
</div>
