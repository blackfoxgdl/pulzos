<?php
/**
 * Vista de las pestañas de las alianzas que se tienen
 * en la parte del negocio
 **/
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>
<script type="text/javascript">
$(document).ready(function(){
    mainLoad = $("#explicacion").attr("href");
    $("#cargar-alianzas").load(mainLoad);
    $(".tabs_content").hide();
    $("ul.tabs li:first").addClass("active").show();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function(){
        $("ul.tabs li").removeClass("active");
        $(this).addClass("active");
        $(".tab_content").hide();

        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });

    $("#explicacion").click(function(event){
        event.preventDefault();
        urlExplicacion = $(this).attr("href");
        $("#cargar-alianzas").load(urlExplicacion);
    });
    
    $("#pasos").click(function(event){
        event.preventDefault();
        urlPasos = $(this).attr("href");
        $("#cargar-alianzas").load(urlPasos);
    });
});
</script>
<?php echo link_tag('statics/css/ext/tabs.css'); ?>
<div class="span-14 last" style="margin-top: 20px"><!-- DIV CONTENEDOR **INICIO** -->
    <div class="span-13"><!-- DIV CUERPO TABS **INICIO** -->
        <ul class="tabs">
            <li>
                <a href="<?php echo base_url(); ?>index.php/alianzassociales/explicacion_alianzas/" id="explicacion">
                    Explicaci&oacute;n
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/alianzassociales/pasos_alianzas/" id="pasos">
                    Como funciona?
                </a>
            </li>
        </ul>
    </div><!-- DIV CUERPO TABS **FIN** -->
    <div class="span-13 last" id="cargar-alianzas" style="border: 1px solid #660066;"><!-- DIV CON EL ARCHIVO A CARGAR **INICIO** -->
    </div><!-- DIV CON EL ARCHIVO A CARGAR **FIN** -->
</div><!-- DIV CONTENEDOR **FIN** -->
