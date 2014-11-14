<?php
/**
 * Vista que se usa para poder contar el numero
 * de registros que se tiene en la base de datos,
 * y asi poder saber si se mostraran los datos o no
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

urlPrimerForm = $("#url_formulario").attr('href');
$("#forma_creacion").load(urlPrimerForm);
</script>
<?php 
    $valor = count_results($this->session->userdata('idN'));
    if($valor != 0){
        $datos = get_social_empresa($this->session->userdata('idN'));
    }

    if($valor != 0)
    {
        if($datos->mensajeFacebook == null)
        {
            $texto1 = '';
        }
        else
        {
            $texto1 = $datos->mensajeFacebook;
        }

        if($datos->mensajeTwitter == null)
        {
            $texto2 = '';
        }
        else
        {
            $texto2 = $datos->mensajeTwitter;
        }
    }
    else
    {
        $texto1 = '';
        $texto2 = '';
    }
?>
<?php echo anchor('redessociales/primer_formulario', '', array('id'=>'url_formulario', 'style'=>'display: none')); ?>
<?php echo anchor('redessociales/segunda_vista', '', array('id'=>'url_creacion', 'style'=>'display: none')); ?>
<div class="span-13" style="margin-top: 10px; margin-bottom: 10px; margin-left: 5px; word-wrap: break-word">
    <div class="prepend-1 span-12 last" id="mensaje" style="background-color: #660066; color: #FFFFFF; display: none; margin-left: -5px">
        Tu oferta ha sido creada exitosamente
    </div>
    <div class="prepend-1 span-11 last" id="primer_formulario"><!-- FORMA CREACION FORMULARIO **INICIO** -->
        <div class="social_media span-11 last">

            <span style="color: #660066; font-size: 16px"> Defina los mensajes de promocion </span>
        </div>
        <div id="forma_creacion">
        </div> 
    </div><!-- FORMA CREACION FORMULARIO **FIN** -->
    <div id="segundo_formulario" style="display: none"><!-- FORMA FORMULARIO **INICIO** -->
    </div><!-- FORMA FORMULARIO **FIN** -->
</div>
