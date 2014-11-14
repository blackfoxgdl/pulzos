<?php
/** 
 * Vista para crear poder subir una
 * imagen al album que el usuario desee
 * con solo seleccionarla en el formulario.
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package imagenNegocios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
if(! isset($flag)){
    $flag = 0;
}
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#imagen-captura").submit(function(event){
    event.preventDefault();
    var options = {
        success: cargarVista
    };
    $(this).ajaxSubmit(options);
    return false;
});

$("#cancelar").click(function(event){
    event.preventDefault();
    var urlR = $(this).attr("href");
    $("#texto-menu").load(urlR);
});

function cargarVista(responseText, statusText, xhr, $form){
    var urlR = $("#cancelar").attr("href");
    var urlCall = $("#get-imagen-url").attr("href");
    var flag = $("#get-imagen-url").attr("flag");
    if(flag == 1){
        $.get(urlCall+'/'+responseText, function(data){
            $("#avatar-photo-block").attr('src', data);
        });
    }
    urlReturn = $("#returnProfile").attr('href');
    location.href = urlReturn;
}
</script>
<div class="span-14 last" style="margin-left: 10px; margin-top: 20px">
    <div class="span-14 last">
        <div class="soft-header" style="margin-right: 30px; margin-bottom: 10px">
            
        </div>
        <p>
            <?php echo anchor('negocios/perfil/#http://www.pulzos.com/index.php/negocios/principal/'.$this->session->userdata('id').'/'.$this->session->userdata('idN'), '', array('id'=>'returnProfile','style'=>'display:none')); ?>
            <?php echo anchor('imagennegocios/get_imagen_url', 'Obtener', array('id'=>'get-imagen-url','style'=>'display: none','flag'=>$flag)); ?>
        </p>
    </div>
    <div class="span-18 last prepend-top">
        <?php echo form_open_multipart('imagennegocios/crear/'.$idAlbum.'/'.$flag, array('id'=>'imagen-captura', 'class'=>'SubirIF')); ?>
            <p>
                <div class="span-3">
                </div>
                <?php  echo form_input(array('id'=>'imagenNombre',
                                            'type'=>'hidden',
                                            'name'=>'Imagenes[imagenNegocioNombre]',
                                            'value'=>'null'));  ?>
            </p>
            <p>
                <div class="span-3">
                </div>
                <?php  echo form_input(array('id'=>'imagenDescripcion',
                                            'type'=>'hidden',
                                            'name'=>'Imagenes[imagenNegocioDescripcion]',
                                            'value'=>'null')); ?>
            </p>
            <p>
                <div class="span-3">
                    <?php echo form_label('Imagen: ', 'imagenRuta',array('style'=>'color:#660068')); ?>
                </div>
                <?php echo form_upload(array('id'=>'imagenRuta',
                                             'name'=>'imagen',
                                             'value'=>'')); ?>
            </p>
            <p>
                <?php echo form_submit(array('id'=>'subirImagen',
                                             'class'=>'subir',
                                             'value'=>'Subir Imagen','style'=>'border:3px  solid #660068; background:#660068; color:#FFFFFF; font-size:9px;')); ?>
            </p>
        <?php echo form_close(); ?>
</div>
