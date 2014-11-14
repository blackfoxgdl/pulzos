<?php
/**
 * Metodo que se usa para realizar todos los temas
 * relacionados a la seccion social media
 **/
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>
<script type="text/javascript">
$(document).ready(function(event){
    mainLoad = $("#explicacion").attr("href");
    $("#social_media").load(mainLoad);

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
        urlExplicacionSocial = $(this).attr("href");
        $("#social_media").load(urlExplicacionSocial);
    });

    $("#funciona").click(function(event){
        event.preventDefault();
        urlFuncionaSocial = $(this).attr("href");
        $("#social_media").load(urlFuncionaSocial);
    });

    $("#redessociales").click(function(event){
        event.preventDefault();
        urlRedesSociales = $(this).attr("href");
        $("#social_media").load(urlRedesSociales);
    });

    $("#ofertasactivas").click(function(event){
        event.preventDefault();
        urlOfertasActivas = $(this).attr("href");
        $("#social_media").load(urlOfertasActivas);
    });
});
</script>
<?php echo link_tag('statics/css/ext/tabs.css'); ?>
<div class="span-14 last" style="margin-top: 20px">
    <div class="span-14">
        <ul class="tabs">
            <li>
                <a href="<?php echo base_url(); ?>index.php/alianzassociales/explicacion_social_media" id="explicacion">
                    Explicaci&oacute;n
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/alianzassociales/pasos_social" id="funciona">
                    Como funciona ?
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/redessociales/index/<?php echo $this->session->userdata('id') ?>" id="redessociales">
                    Redes Sociales
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/redessociales/ofertas_activas/<?php echo $this->session->userdata('idN'); ?>" id="ofertasactivas">
                    Ofertas Activas
                </a>
            </li>
        </ul>
    </div>
    <div class="span-13" style="border: 1px solid #660066; width: 535px" id="social_media"><!-- DIV DONDE SE CARGARA EL ARCHIVO **INICIO** -->
    </div><!-- DIV DONDE SE CARGARA EL ARCHIVO **FIN** -->
</div>
