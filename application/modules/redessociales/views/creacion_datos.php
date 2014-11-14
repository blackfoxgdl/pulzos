<?php
/**
 * vista para la creacion de los datos del usuario
 * para guardar sus promociones
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$('#forma_social').submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargar
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

$("#txt-ofertas").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargar2
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargar()
{
    urlCargaSegunda = $("#url_creacion").attr('href');
    $("#segundo_formulario").load(urlCargaSegunda);
    $("#primer_formulario").hide();
    $("#segundo_formulario").show();
}

function cargar2()
{
    $("#primer_formulario").hide();
    $("#segundo_formulario").hide();
    $("#tercer_formulario").show();
}

$("#regresar-dos").click(function(event){
    event.preventDefault();
    alert('holas');
    $("#segundo_formulario").hide();
    $("#primer_formulario").show();
});


$(".categorias").change(function(event){
    event.preventDefault();
    valores = $(event.currentTarget).attr('id');
    if(valores == "toda-la-tienda")
    {
        $("#categoriasAdd").val('');
        $("#clonadas").empty();
        $("#productosAdd").val('');
        $("#clonados").empty();
        $("#selProd").hide();
        $("#selCat").hide();
    }
    if(valores == "por-producto")
    {
        $("#categoriasAdd").val('');
        $("#clonadas").empty();
        $("#selCat").hide();
        $("#selProd").show();
    }
    if(valores == "por-categoria")
    {
        $("#productosAdd").val('');
        $("#clonados").empty();
        $("#selProd").hide();
        $("#selCat").show();
    }
});

$("#otro").click(function(event){
    event.preventDefault();
    $("#categoriasAdd").val('');
    $("#productosAdd").clone().val('').appendTo("#clonados");
});

$("#otra").click(function(event){
    event.preventDefault();
    $("#productosAdd").val('');
    $("#categoriasAdd").clone().val('').appendTo("#clonadas");
});

function just_numbers(evt)
{
    var keyPressed = (evt.which) ? evt.which : event.keyCode
    return (keyPressed <= 13 || (keyPressed >= 48 && keyPressed <= 57) || keyPressed == 46);
}
</script>
<?php if($band == 0): ?>
    
        <?php echo form_open('redessociales/guardar/'.$this->session->userdata('idN').'/0', array('id'=>'forma_social')); ?>

    <div class="span-10">
        <?php echo img(array('src'=>'statics/img/facebook.png',
                             'width'=>'64px',
                             'height'=>'25px')); ?>
    </div>
    <div class="span-10">
        <?php echo form_textarea(array('id'=>'',
                                       'class'=>'',
                                       'name'=>'Redes[mensajeFacebook]',
                                       'value'=>'',
                                       'style'=>'width:400px; height:60px')); ?>
    </div>
    <div class="span-10">
        <?php echo img(array('src'=>'statics/img/twitter.png',
                             'width'=>'64px',
                             'height'=>'25px')); ?>
    </div>
    <div class="span-10">
        <?php echo form_textarea(array('id'=>'',
                                       'class'=>'',
                                       'name'=>'Redes[mensajeTwitter]',
                                       'value'=>'',
                                       'style'=>'width:400px; height:60px')); ?>
    </div>
    <div class="span-10">
        <?php echo img(array('src'=>'statics/img/logo-pulzos1.jpg',
                             'width'=>'64px',
                             'height'=>'25px')); ?>
    </div>
    <div class="span-10">
        <?php echo form_textarea(array('id'=>'',
                                       'class'=>'',
                                       'name'=>'Redes[mensajePulzos]',
                                       'value'=>'',
                                       'style'=>'width: 400px; height: 60px')); ?>
    </div>
    <div class="span-10 last">
        <div class="span-4">
            <?php echo form_label('Minimo de Consumo: ', 'consumoMinimo', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-5 last" style="color: #660066">
            <?php echo form_input(array('id'=>'minimoConsumo',
                                        'class'=>'minimo-consumo',
                                        'value'=>'',
                                        'style'=>'text-align: right',
                                        'onkeypress'=>'return just_numbers(event)',
                                        'name'=>'Oferta[consumoMinimo]')); ?>MX.
        </div>
    </div>
    <div class="span-10 last">
        <div class="span-4">
            <?php echo form_label('Porcentaje de Bonificacion:', 'porcentajeBonificacion', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-5 last" style="color: #660066">
            <?php echo form_input(array('id'=>'defineBonificacion',
                                        'name'=>'Oferta[bonificaPorcentaje]',
                                        'value'=>'',
                                        'style'=>'text-align:right',
                                        'onkeypress'=>'return just_numbers(event)',
                                        'class'=>'defina-bonificacion')); ?>%
        </div>
    </div>

    <div class="span-10" style="text-align: center">
        <?php echo form_submit(array('id'=>'guardarRedesSociales',
                                     'class'=>'guardar_redessociales',
                                     'value'=>'Guardar',
                                     'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
    </div>

        <?php echo form_close(); ?>
<?php else: ?>
        <?php echo form_open('redessociales/guardar/'.$this->session->userdata('idN').'/1', array('id'=>'forma_social')); ?>

    <div class="span-10">
        <?php echo img(array('src'=>'statics/img/facebook.png',
                             'width'=>'64px',
                             'height'=>'25px')); ?>
    </div>
    <div class="span-10">
        <?php echo form_textarea(array('id'=>'',
                                       'class'=>'',
                                       'name'=>'Redes[mensajeFacebook]',
                                       'value'=>$social_media->mensajeFacebook,
                                       'style'=>'width:400px; height:60px')); ?>
    </div>
    <div class="span-10">
        <?php echo img(array('src'=>'statics/img/twitter.png',
                             'width'=>'64px',
                             'height'=>'25px')); ?>
    </div>
    <div class="span-10">
        <?php echo form_textarea(array('id'=>'',
                                       'class'=>'',
                                       'name'=>'Redes[mensajeTwitter]',
                                       'value'=>$social_media->mensajeTwitter,
                                       'style'=>'width:400px; height:60px')); ?>
    </div>
    <div class="span-10">
        <?php echo img(array('src'=>'statics/img/logo-pulzos1.jpg',
                             'width'=>'64px',
                             'height'=>'25px')); ?>
    </div>
    <div class="span-10">
        <?php echo form_textarea(array('id'=>'',
                                       'class'=>'',
                                       'name'=>'Redes[mensajePulzos]',
                                       'value'=>$social_media->mensajePulzos,
                                       'style'=>'width: 400px; height: 60px')); ?>
    <div class="span-10 last">
        <div class="span-4">
            <?php echo form_label('Minimo de Consumo: ', 'consumoMinimo', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-5 last" style="color: #660066">
            <?php echo form_input(array('id'=>'minimoConsumo',
                                        'class'=>'minimo-consumo',
                                        'value'=>$oferta_negocio->consumoMinimo,
                                        'style'=>'text-align: right',
                                        'onkeypress'=>'return just_numbers(event)',
                                        'name'=>'Oferta[consumoMinimo]')); ?>MX.
        </div>
    </div>
    <div class="span-10 last">
        <div class="span-4">
            <?php echo form_label('Porcentaje de Bonificacion:', 'porcentajeBonificacion', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-5 last" style="color: #660066">
            <?php echo form_input(array('id'=>'defineBonificacion',
                                        'name'=>'Oferta[bonificaPorcentaje]',
                                        'value'=>$oferta_negocio->bonificaPorcentaje,
                                        'style'=>'text-align: right',
                                        'onkeypress'=>'return just_numbers(event)',
                                        'class'=>'defina-bonificacion')); ?>%
        </div>
    </div>

    <div class="span-10" style="text-align: center">
        <?php echo form_submit(array('id'=>'guardarRedesSociales',
                                     'class'=>'guardar_redessociales',
                                     'value'=>'Guardar',
                                     'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
    </div>

        <?php echo form_close(); ?>
<?php endif; ?>
