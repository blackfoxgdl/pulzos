<?php
/**
 * vista para la parte del perfil del negocio
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_tools/jquery.tools.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){

$("#bannerPrincipal, .banner-block").hover(function(event){
        $(".banner-block").css('display', 'block');
        $(".banner-block").css('position', 'absolute');
    }, function(event){
        $(".banner-block").css('display', 'none');
    });
});
$('.ver-aviso').click(function(event){
    event.preventDefault();
    attrName = $(event.currentTarget).attr("name");
    $(event.currentTarget).hide();
    $("#ocultar-"+attrName).show();
    $("#aviso-legal-"+attrName).show();
});

$('.ocultar-aviso').click(function(event){
    event.preventDefault();
    attrNameO = $(event.currentTarget).attr("name");
    $(event.currentTarget).hide();
    $("#ver-"+attrNameO).show();
    $("#aviso-legal-"+attrNameO).hide();
});

$("#forma-perfil-neg").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    urlEnlaceRefresh = $("#enlace").attr("href");
    $("#texto-menu").load(urlEnlaceRefresh);
}

$(".comentar-pulzo").click(function(event){
    event.preventDefault();
    idUrlOpen = $(event.currentTarget).attr("id");
    $(".comentarios-"+idUrlOpen).show();
});

$(".eliminar-pulzo").click(function(event){
    event.preventDefault();
    urlDelete = $(event.currentTarget).attr("href");
    $.get(urlDelete);
    $(event.currentTarget).parent().parent().parent().parent().hide();
});

$(".ver-mas").click(function(event){
    event.preventDefault();
    verMas = $(event.currentTarget).attr('href');
    $("#texto-menu").load(verMas);
});

function ponerTexto(val)
{
    if(document.getElementById('main-comment').value == '')
    {
        document.getElementById('main-comment').value = val;
    }
}

function quitarTexto(val)
{
    if(document.getElementById('main-comment').value == 'Que quieres comunicar?')
    {
        document.getElementById('main-comment').value = '';
    }
}

function start(fecha_inicio, fecha_final,div) 
{
	displayCountDown(setCountDown(fecha_inicio, fecha_final),div);
}

function setCountDown(inicio, tiempoactual) 
{	
		
	var fechainicio=new Date(Date.parse(inicio));
	var nuevo =new Date(0);
	var finf=(nuevo.setMilliseconds(fechainicio)+86400000);	
	var nuevo2 =new Date(0);	
	return Math.floor((nuevo2.setMilliseconds(finf-tiempoactual)/1000)+3600);
}

function displayCountDown(countdown,nameDiv) 
{	
    if (countdown < 0) document.getElementById(nameDiv).innerHTML = "<span style=' font-size:15px; color:#FF0000;'>Reto terminado </span>"; //Mensaje de ejemplo para deal finalizado
	else {
		
        var secs = countdown % 60; 
        if (secs < 10) secs = '0'+secs;
        var countdown1 = (countdown - secs) / 60;
        var mins = countdown1 % 60; 
        if (mins < 10) mins = '0'+mins;
        countdown1 = (countdown1 - mins) / 60;
        var hours = countdown1 % 24;
        var days = (countdown1 - hours) / 24;
        
        hours = days * 24 + hours;
        
        document.getElementById(nameDiv).innerHTML ="<span style=' font-size:17px; color:#660068; '>"+'tiempo restante: '+hours+ 'h : ' +mins+ 'm : '+secs+'s'+"</span>";
        setTimeout('displayCountDown('+(countdown-1)+',\''+nameDiv+'\');',999);
		
	}
}

$(document).ready(function(){
    if($(".latitud").html() != '' && $(".longitud").html() != '')
    {
        var latLng = new google.maps.LatLng($(".latitud").html(), $(".longitud").html());
    }
    else
    {
        var latLng = new google.maps.LatLng(20.673040, -103.375854);
    }

    var posOne = new google.maps.LatLng(20.675096, -103.346529); 

    var myOptions = {
        zoom: 15,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map($("#mapa-pulzos").get(0), myOptions);
    var markerImage = new google.maps.MarkerImage($("#imagen").attr('src'),
                                                  new google.maps.Size(34, 32),
                                                  new google.maps.Point(0, 0),
                                                  new google.maps.Point(0, 32));
    var marker = new google.maps.Marker({
        position: latLng,
        map: map,
        icon: markerImage
    });
    marker.setMap(map);

    $("div[rel]").overlay({
        closeOnClick: true,
        onLoad: function(){
             mapOverlay = new google.maps.Map($("#show-map").get(0), myOptions); 
                var titulo = $(".negocioNombre").text();
                var markerOverlay = new google.maps.Marker({
                        position: latLng,
                        title: titulo,
                        map: map,
                        icon: markerImage
                });
                var direccion = "Nombre: " + titulo + "<br />" +
                                "Direccion: " + $(".negocioDireccion").text();
                var informacion = new google.maps.InfoWindow({content:direccion});
                markerOverlay.setMap(mapOverlay);
       
                var map = new google.maps.Map($(".mapa<?php echo $is; ?>").get(0), myOptions);
        }
    });
});

function subcomentar_enter(event, idplan)
{
    if(event.keyCode == 13)
    {
        var accionAtr = $(".forma-comentar-muro"+idplan).attr("action");
        var datosAccion = $(".secondary-comment"+idplan).attr("value");
        //desenfocada inicio
        $(".secondary-comment"+idplan).blur();
        $("#oct"+idplan).val(datosAccion).focus();
        //desenfocada fin
        var clase = "comentarios"+idplan;
        urlReloadC = $("#recarga_comentario").attr("href");
        urlReloadComentario = urlReloadC + '/' + idplan;
        if(datosAccion != "Comentar")
        {//if inicio
            $.post(accionAtr, 
                   {comentar_negocios:datosAccion},
                   function(data){
                        $(".comentarios-"+idplan).hide();
                        $("."+clase).load(urlReloadComentario);
                        $(".secondary-comment"+idplan).val("Comentar");
            });
           
        }//if final
    }
}


function subcomentar_enter_company(event, idplan, idpulzo)
{
    if(event.keyCode == 13)
    {
        var accionAtr = $(".forma-comentar-muro"+idplan).attr("action");
        var datosAccion = $(".secondary-comment"+idplan).attr("value");
        //desenfocada inicio
        $(".secondary-comment"+idplan).blur();
        $("#oct"+idplan).val(datosAccion).focus();
        //desenfocada fin
        var clase = "comentarios"+idpulzo;
        urlReloadC = $("#recargar_comentario_empresa").attr("href");
        urlReloadComentario = urlReloadC + '/' + idpulzo;
        if(datosAccion != "Comentar")
        {//if inicio
            $.post(accionAtr, 
                   {comentar_negocios:datosAccion},
                   function(data){
                        $(".comentarios-"+idplan).hide();
                        $("."+clase).load(urlReloadComentario);
                        $(".secondary-comment"+idplan).val("Comentar");
            });
        }//if final
    }
}

//CARGAR 10 MAS
$(".ver-mas-publicaciones").click(function(event){
    event.preventDefault();
    urlPrimera = $(event.currentTarget).attr("href");
    ultimos = $("#ultimos").text();
    urlGet = $("#urlGet").attr("href");
    urlSendFirst =  urlPrimera + '/' + ultimos;
    urlSendSecond = urlGet + '/' + ultimos;
    clases = "ver"+ultimos;
    $.ajax({
           type: "POST",
           url: urlSendFirst,
           success: function(html){
               $("#verMas").append($("<div></div>").addClass(clases));
               $("."+clases).html(html);
            }
    });
    $.ajaxSetup({cache: false})
    $.get(urlSendSecond,
        function(data){
              $("#ultimos").text(data);
          }, 
         "json"
     );
});

function poner(val, id)
{
    if(document.getElementById('sub-comentario'+id).value == '')
    {
        document.getElementById('sub-comentario'+id).value = 'Comentar';
    }
}

function quitar(val, id)
{
    if(document.getElementById('sub-comentario'+id).value == 'Comentar')
    {
        document.getElementById('sub-comentario'+id).value = '';
    }
}
</script>
<?php echo anchor('planesusuarios/reload_comment/', '', array('style'=>'display: none', 'id'=>'recarga_comentario')); ?>
<?php echo anchor('negocios/reload_comment_company/', '', array('style'=>'display: none', 'id'=>'recargar_comentario_empresa')); ?>
<?php echo anchor('negocios/miperfil/'.$negocios->negocioId, '', array('id'=>'enlace', 'style'=>'display: none')); ?>
<div style="display: none">
    <?php echo img(array('id'=>'imagen',
                         'src'=>'statics/img/pin.png')); ?>
    <span class="latitud"><?php echo $negocios->negocioLatitud; ?></span>
    <span class="longitud"><?php echo $negocios->negocioLongitud; ?></span>
    <span class="negocioNombre"><?php echo $negocios->negocioNombre; ?></span>
    <span class="negocioDireccion"><?php echo $negocios->negocioDireccion; ?></span>
</div>
<div class="span-14 last" style="background-color: #EEEDF4; width: 780px">
    <div class="span-14"  style="margin-left: 0px; background-color: #EEEDF4">
        <div class="span-14" style="margin-top: 10px">
            <div class="span-12">
                <!--div class="banner-block" -->
                    <?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
                        <div class="banner-block"><!-- cargainicio -->
                            <?php echo anchor('#',
                                              'Cambiar tu Banner', array('class'=>'bannersNegocios','onclick'=>"dhtmlHistory.add('".base_url()."index.php/negocios/banner_negocio/".$negocios->negocioId."',null);Enviar('".base_url()."index.php/negocios/banner_negocio/".$negocios->negocioId."','#forma-cambiar-banner');return false;")); ?>
                        </div>
                    <?php echo anchor('#',
                                      img(array('src'=>get_banner_company($negocios->negocioId))),
                                          array('id'=>'bannerPrincipal','class'=>'bannersNegocios','onclick'=>"dhtmlHistory.add('".base_url()."index.php/negocios/banner_negocio/".$negocios->negocioId."',null);Enviar('".base_url()."index.php/negocios/banner_negocio/".$negocios->negocioId."','#forma-cambiar-banner');return false;")); ?>
                    <?php else: ?>
                        <?php echo img(array('src'=>get_banner_company($negocios->negocioId),
                                             'id'=>'bannerPrincipal',
                                             'class'=>'bannersNegocios')); ?>
                    <?php endif; ?>
        </div>

    <div id="forma-cambiar-banner">
    </div>

    <div id="informacion-miperfil"><!-- informacion -->
        <div class="span-13" style="margin-top: 20px; border-bottom: 1px solid #DBDBDB;">
            <span class="span-2" style="color: #660066">
                Descripci&oacute;n:
            </span>
            <span class="span-9 last" style="margin-left: 16px; margin-bottom: 22px; color: #7F7D7D">
                <?php echo $negocios->negocioDescripcion; ?>
            </span>
        </div>
        <div class="span-14" style="border-bottom: 1px solid #DBDBDB;">
            <div class="span-8" style="margin-top:30px;">
            	<?php if(!empty($negocios->negocioDireccion)): ?>
	                <div class="span-9" style="">
    	                <span class="span-2" style="color: #660066">
        	                Direcci&oacute;n:
            	        </span>
                	    <span class="span-6 last" style="color: #7F7D7D">
                    	    <?php echo $negocios->negocioDireccion; ?>
	                    </span>
    	            </div>
    	        <?php endif; ?>
    	        <?php if(!empty($negocios->negocioTelefono)): ?>
	                <div class="span-9" style="">
    	                <span class="span-2" style="color: #660066">
        	            Tel&eacute;fono:
            	        </span>
                	    <span class="span-6 last" style="color: #7F7D7D">
                    	    <?php echo $negocios->negocioTelefono; ?>
	                    </span>
    	            </div>
    	        <?php endif; ?>
    	        <?php if(!empty($negocios->negocioSitioWeb)): ?>
	                <div class="span-9" style="">
    	                <span class="span-2" style="color: #660066">
        	                Sitio web:
            	        </span>
                	    <span class="span-6 last" style="color: #7F7D7D">
                    	    <?php echo $negocios->negocioSitioWeb; ?>
	                    </span>
    	            </div>
    	        <?php endif; ?>
            </div>
            <div class="span-4 last" style="margin-top: 10px; margin-bottom: 8px">
                <div class="span-4" style="margin-left: 60px;">
                    <div id="mapa-pulzos" rel="#maping-overlay"></div>
                </div>
            </div>
        </div>
        <?php $contadores = get_count_data_services($negocios->negocioId); ?>
        <?php if($contadores > 0): ?>
            <?php $valores = get_data_services($negocios->negocioId); //valores para saber que servicios tiene el negocio ?>
        <?php endif; ?>
        <div class="span-14 last" style="border-top: 1px solid #DBDBDB; margin-bottom: 20px;">
            <div class="span-3" style="margin-top: 13px">
                <span class="span-3" style="color: #660066">
                    <?php echo img(array('src'=>'statics/img/ico_empresas/ico-horario.png',
                                         'width'=>'16px',
                                         'height'=>'12px')); ?>
                    Horario:
                </span>
                <span class="span-3" style="color: #7F7D7D">
                    <?php echo $negocios->negocioHorario; ?>
                </span>
            </div>
            <div clasS="span-5" style="margin-top:13px">
                <span class="span-4" style="color: #660066">
                    <?php echo img(array('src'=>'statics/img/ico_empresas/ico-tarjeta.png',
                                         'width'=>'16px',
                                         'height'=>'12px')); ?>
                    Tarjeta de credito:
                </span>
                <span class="span-1 last" style="color: #7F7D7D">
                    <?php if($contadores > 0): ?>
                        <?php if($valores->serviciosTarjeta == 1): ?>
                            Si
                        <?php elseif($valores->serviciosTarjeta == 0): ?>
                            No
                        <?php else: ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
                <span class="span-4" style="color: #660066">
                    <?php echo img(array('src'=>'statics/img/ico_empresas/ico-reserv.png',
                                         'width'=>'16px',
                                         'height'=>'12px')); ?>
                    Reservaci&oacute;n necesaria:
                </span>
                <span class="span-1 last" style="color: #7F7D7D">
                    <?php if($contadores > 0): ?>
                        <?php if($valores->serviciosReservacion == 1): ?>
                            Si
                        <?php elseif($valores->serviciosReservacion == 0): ?>
                            No
                        <?php else: ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
                <span class="span-4" style="color: #660066">
                    <?php echo img(array('src'=>'statics/img/ico_empresas/ico-estac.png',
                                         'width'=>'16px',
                                         'height'=>'12px')); ?>
                    Estacionamiento:
                </span>
                <span class="span-1 last" style="color: #7F7D7D">
                    <?php if($contadores > 0): ?>
                        <?php if($valores->serviciosEstacionamiento == 1): ?>
                            Si
                        <?php elseif($valores->serviciosEstacionamiento == 0): ?>
                            No
                        <?php else: ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
                <span class="span-4" style="color: #660066">
                    <?php echo img(array('src'=>'statics/img/ico_empresas/ico-wifi.png',
                                         'width'=>'16px',
                                         'height'=>'12px')); ?>
                    Wifi:
                </span>
                <span class="span-1 last" style="color: #7F7D7D">
                    <?php if($contadores > 0): ?>
                        <?php if($valores->serviciosWifi == 1): ?>
                            Si
                        <?php elseif($valores->serviciosWifi == 0): ?>
                            No
                        <?php else: ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
            </div>
            <div class="span-5" style="margin-top: 13px">
                <span class="span-4" style="color: #660066">
                    <?php echo img(array('src'=>'statics/img/ico_empresas/ico-entrega.png',
                                         'width'=>'16px',
                                         'height'=>'12px')); ?>
                    Servicio a domicilio:
                </span>
                <span class="span-1 last" style="color: #7F7D7D">
                    <?php if($contadores > 0): ?>
                        <?php if($valores->serviciosDomicilio == 1): ?>
                            Si
                        <?php elseif($valores->serviciosDomicilio == 0): ?>
                            No
                        <?php else: ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
                <span class="span-4" style="color: #660066">
                    <?php echo img(array('src'=>'statics/img/ico_empresas/ico-minus.png',
                                         'width'=>'16px',
                                         'height'=>'12px')); ?>
                    Acceso silla de ruedas:
                </span>
                <span class="span-1 last" style="color: #7F7D7D">
                    <?php if($contadores > 0): ?>
                        <?php if($valores->serviciosDiscapacidad == 1): ?>
                            Si
                        <?php elseif($valores->serviciosDiscapacidad == 0): ?>
                            No
                        <?php else: ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
                <span class="span-4" style="color: #660066">
                    <?php echo img(array('src'=>'statics/img/ico_empresas/ico-sucurs.png',
                                         'width'=>'16px',
                                         'height'=>'12px')); ?>
                     Sucursal:
                </span>
            </div>
         </div>
        </div><!-- informacion -->
    </div>

<div id="comentarios-todos-miperfil">

    <div class="span-13 last" style=" margin-top:10px;">
        <?php /*echo form_open('negocios/guardar_comentario_perfil/'.$negocios->negocioUsuarioId.'/'.$negocios->negocioId,
                             array('id'=>'forma-perfil-neg')); ?>
            <div class="span-13 last">
                <?php echo form_textarea(array('id'=>'main-comment',
                                               'name'=>'Perfil[pulzoTitulo]',
                                               'class'=>'area-textoPublicar',
                                               'style'=>'width: 524px; height: 16px; border: 1px solid',
                                               'value'=>'Que quieres comunicar?',
                                               'onblur'=>"return ponerTexto('Que quieres comunicar?')",
                                               'onfocus'=>"return quitarTexto('Que quieres comunicar?')")); ?>
            </div>
            <div class="prepend-11 last">
                <?php echo form_submit(array('id'=>'',
                                             'value'=>'Pulzar',
                                             'style'=>'border: none; color: #FFFFFF; background-color: #660066; width: 72px; height: 20px; margin-left: 20px; font-size: 11px')); ?>
            </div>
        <?php echo form_close();*/ ?>
    </div><?php $a=0;?>
    <div id="cargainicio"><!-- CARGA INICIO -->
    </div><!-- FIN DE CARGA INICIO -->
    <div class="span-14 last" style="margin-top: 40px"><!-- PARTE DONDE SE PONDRAN LOS PULZOS DE LA EMPRESA Y COMENTARIOS DEL USUARIO **INICIO** -->
        <?php /*$valores = obtain_array_company($pulzo_perfil); ?>
        <?php foreach($pulzo_perfil as $pulzo): ?>
            <?php if($pulzo->pulzoTipo == 3): ?><!-- IF PARA CONOCER SI ES COMENTARIO O NO **INICIO** -->
                <?php $datosPost = get_data_planesusuarios($pulzo->pulzoId); ?>
                <?php if(!empty($datosPost)): ?>
                    <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
                        <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO POST PRINCIPAL **INICIO** -->
                            <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                                <?php if($datosPost->planAmigoUsuarioId == 0): ?>
                                    <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                                         'width'=>'37',
                                                         'height'=>'37')); ?>
                                <?php else: ?>
                                    <?php echo img(array('src'=>get_avatar($datosPost->planAmigoUsuarioId),
                                                         'width'=>'37',
                                                         'height'=>'37')); ?>
                                <?php endif; ?>
                            </div><!-- DIV AVATAR **FIN** -->
                            <div class="interlineado span-12 last"><!-- DIV DEL CUERPO DEL MENSAJE DE POST **INICIO** -->
                                <div style="margin-left: 10px">
                                    <?php if($datosPost->planAmigoUsuarioId == 0): ?>
                                        <span class="pulzos_titulo1">
                                            <?php echo anchor('negocios/perfil/'.$pulzo->pulzoUsuarioId,
                                                              get_complete_username($datosPost->planUsuarioId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="pulzos_titulo1">
                                            <?php echo anchor('usuarios/perfil/'.$datosPost->planAmigoUsuarioId,
                                                              get_complete_username($datosPost->planAmigoUsuarioId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                            a
                                            <?php echo anchor('negocios/perfil/'.$pulzo->pulzoUsuarioId,
                                                              get_complete_username($datosPost->planUsuarioId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div style="margin-top: 6px; margin-left: 10px; word-wrap: break-word">
                                    <span class="pulzos_titulo2">
                                        <?php echo $datosPost->planDescripcion; ?>
                                    </span>
                                </div>
                            </div><!-- DIV DEL CUERPO DEL MENSAJE DE POST **FIN** -->
                            <div class="prepend-1 span-14 last" style="margin-top: 8px"><!-- DIV DEL MENU **INICIO** -->
                                <div class="span-1" style="margin-left: 10px">
                                    <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                         'width'=>'16px',
                                                         'height'=>'12px')); ?>
                                </div>
                                <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                                    <?php $fecha = unix_to_human($pulzo->pulzoFechaCreacion);
                                          $fechaCreacion = fecha_acomodo($fecha);
                                          echo $fechaCreacion; ?>
                                </div>
                                <?php if($this->session->userdata('id') == $datosPost->planUsuarioId): ?>
                                    <div class="prepend-4 span-2">
                                        <?php echo anchor('#',
                                                          'Comentar',
                                                          array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$datosPost->planId, 'class'=>'comentar-pulzo')); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('negocios/borrar_comentarios_pulzos/'.$pulzo->pulzoId.'/'.$datosPost->planId,                                                                                   'Eliminar',
                                                          array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'eliminar-pulzo', 'name'=>$datosPost->planId)); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="prepend-6 span-2">
                                        <?php echo anchor('#',
                                                          'Comentar',
                                                          array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'comentar-pulzo', 'id'=>$datosPost->planId)); ?>
                                    </div>
                                <?php endif; ?>
                            </div><!-- DIV DEL MENU **FIN** -->
                            <div class="comentarios<?php echo $datosPost->planId; ?>"><!-- DIV QUE MUESTRA LOS COMENTARIOS **INICIO** -->
                                <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                    <?php $comentarios = get_subcomments_wall($datosPost->planId, '1'); ?>
                                    <?php foreach($comentarios as $comentario): ?>
                                        <div class="span-12 last" style="background-color: #DCCEDD; margin-left: 50px; margin-bottom: 10px">
                                            <div class="span-11 last"><!-- DIV INICIAL SUBCOMENTARIOS **INICIO** -->
                                                <?php $status = get_complete_userdata($comentario->comentarioSimpleUsuarioId); ?>
                                                <div class="span-1">
                                                    <?php if($status->statusEU == 0): ?>
                                                        <?php echo img(array('src'=>get_avatar($comentario->id),
                                                                             'width'=>'37px',
                                                                             'height'=>'37px',
                                                                             'style'=>'margin-top: 5px; margin-left: 5px')); ?>
                                                    <?php else: ?>
                                                        <?php $datos = datos_negocios($comentario->id); ?> 
                                                        <?php echo img(array('src'=>get_avatar_negocios($datos->negocioId),
                                                                             'width'=>'37px',
                                                                             'height'=>'37px',
                                                                             'style'=>'margin-top: 5px; margin-left: 5px')); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="span-9 last" style="margin-top: 6px; margin-left: 14px">
                                                    <div class="span-12">
                                                        <div class="span-9">
                                                            <span class="pulzos_titulo1">
                                                                <?php if($status->statusEU == 0): ?>
                                                                    <?php echo anchor('usuarios/perfil/'.$comentario->id,
                                                                                      get_complete_username($comentario->id),
                                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                <?php else: ?>
                                                                    <?php echo anchor('negocios/perfil/'.$datos->negocioId,
                                                                                      get_complete_username($comentario->id),
                                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                    <?php endif; ?>
                                                            </span>
                                                        </div>
                                                        <div class="span-2 last">
                                                            <?php if($this->session->userdata('id') == $datosPost->planUsuarioId): ?>
                                                                <?php echo anchor('negocios/delete_subcomments_specific/'.$datosPost->planId.'/'.$comentario->comentarioSimpleId,
                                                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                                                            'width'=>'14px',
                                                                                            'height'=>'12px')),
                                                                                  array('class'=>'eliminar-sub')); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                        <?php echo $comentario->comentarioSimple; ?>
                                                    </span>
                                                </div>
                                                <div clasS="span-9 last" style="margin-top: 12px">
                                                    <div class="span-1" style="margin-left: 20px">
                                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                             'width'=>'14px',
                                                                             'height'=>'12px')); ?>
                                                    </div>
                                                    <div class="span-4 last" style="margin-left: -22px; margin-top: -3px; font-size: 9pt; color: #999999">
                                                        <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);                                                                                                   $fechaCreacionSub = fecha_acomodo($fecha);
                                                              echo $fechaCreacionSub; ?>
                                                    </div>
                                                </div>
                                            </div><!-- DIV INICIAL SUBCOMENTARIOS **FIN** -->
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div><!-- DIV QUE MUESTRA LOS COMENTARIOS **FIN** -->
                            <div class="comentarios-<?php echo $datosPost->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                <?php echo form_open('negocios/guardar_comentarios_pulzo/'.$this->session->userdata('id').'/'.$datosPost->planId,
                                                     array('class'=>'forma-comentar-muro'.$datosPost->planId)); ?>
                                    <div class="span-8" style="margin-left: 6px">
                                        <?php echo form_textarea(array('id'=>'sub-comentario'.$datosPost->planId,
                                                                       'class'=>'secondary-comment'.$datosPost->planId,
                                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                                       'onkeypress'=>'subcomentar_enter(event,' . $datosPost->planId . ')',
                                                                       'onfocus'=>"return quitar('Comentar'," . $datosPost->planId . ")",
                                                                       'onblur'=>"return poner('Comentar'," . $datosPost->planId . ")",
                                                                       'value'=>'Comentar',
                                                                       'name'=>'comentar_negocios')); ?>
                                    </div>
                                <?php echo form_close(); ?>
                                <input type="hidden" id="oct<?php echo $datosPost->planId; ?>" />
                            </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                        </div><!-- DIV DEL CUERPO POST PRINCIPAL **FIN** -->
                    </div><!-- DIV CONTENEDOR **FIN** -->
                <?php endif; ?>
            <?php elseif($pulzo->pulzoTipo == 2): ?><!-- IF PARA SABER QUE ES UNA EXPERIENCIA DE VIDA **INICIO** -->
                <?php $datosPost = get_data_planesusuarios($pulzo->pulzoId); ?>
                <?php if(! empty($datosPost)): ?>
                    <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
                        <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                            <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                                <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                                     'width'=>'37px',
                                                     'height'=>'37px')); ?>
                            </div><!-- DIV AVATAR **FIN** -->
                            <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!-- DIV DEL CUERPO DEL MENSAJE **INICIO** -->
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('negocios/perfil/'.$pulzo->pulzoUsuarioId,
                                                      get_complete_username($datosPost->planUsuarioId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo2">
                                    <?php echo $pulzo->pulzoTitulo; ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo1">
                                    Fecha Inicio:
                                </span>
                                <span class="pulzos_titulo2">
                                    <?php $fechaI = unix_to_human($pulzo->pulzoFechaInicio);
                                          $inicio = fecha_acomodo($fechaI);
                                          echo $inicio; ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo1">
                                    Tipo:
                                </span>
                                <span class="pulzos_titulo2">
                                    Experiencia de Vida
                                </span>
                            </div><!-- DIV DEL CUERPO DEL MENSAJE **FIN** -->
                            <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION DE LA EXPERIENCIA **INICIO** -->
                                <div class="span-2">
                                    <?php if($pulzo->pulzoImagenRuta == '0'): ?>
                                        <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                                             'width'=>'100px',
                                                             'height'=>'100px')); ?>
                                    <?php else: ?>
                                        <?php echo img(array('src'=>$pulzo->pulzoImagenRuta,
                                                             'width'=>'100px',
                                                             'height'=>'100px')); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="prepend-1 span-9 last" style="margin-top: 5px">
                                    <span class="pulzos_titulo2">
                                        <?php echo anchor('experienciasnegocios/ver_experiencia/'.$pulzo->pulzoId,
                                                          $pulzo->pulzoAccion,
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas')); ?>
                                    </span>
                                </div>                    
                            </div><!-- DIV DEL CUERPO DESCRIPCION DE LA EXPERIENCIA **FIN** -->
                            <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                                <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                                    <?php echo anchor('#',
                                                      'Aviso Legal:',
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$pulzo->pulzoId, 'id'=>'ver-'.$pulzo->pulzoId)); ?>
                                    <?php echo anchor('#',
                                                      'Aviso Legal:',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$pulzo->pulzoId, 'id'=>'ocultar-'.$pulzo->pulzoId)); ?>
                                </div>
                           </div>
                            <div style="display: none" id="aviso-legal-<?php echo $pulzo->pulzoId; ?>">
                                <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                    <?php echo $pulzo->pulzoAvisoLegal; ?>    
                                </div>
                            </div><!-- DIV AVISO LEGAL **FIN** -->
                            <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                <div class="span-6">
                                    &nbsp;
                                </div>
                                <div class="prepend-1 span-2">
                                    <?php echo anchor('experienciasnegocios/ver_experiencia/'.$pulzo->pulzoId,
                                                      'Ver mas',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas')); ?>
                                </div>
                                <div class="span-2">
                                    <?php echo anchor('#',
                                                      'Comentar',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px', 'class'=>'comentar-pulzo', 'id'=>$datosPost->planId)); ?>
                                </div>
                                <?php if($this->session->userdata('id') == $datosPost->planUsuarioId): ?>
                                    <div class="span-1">
                                        <?php echo anchor('negocios/borrar_pulzos/'.$pulzo->pulzoId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px;', 'class'=>'eliminar-pulzo')); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="span-1">
                                        <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$datosPost->planId.'/'.$pulzo->pulzoId,
                                                          'Reservar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="comentarios<?php echo $pulzo->pulzoId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                                <?php $pulzos_post = get_pulzos_subcomments($pulzo->pulzoId); ?>
                                <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                    <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                                        <div class="span-12 last" style="background-color: #DCCEDD; margin-left: 50px; margin-bottom: 10px">
                                            <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                                <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                                    <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                                    <?php if($datos_like_user->statusEU == 0): ?>
                                                        <?php echo img(array('src'=>get_avatar($posteos->comentarioUsuarioId),
                                                                             'width'=>'36px',
                                                                             'height'=>'36px')); ?>
                                                    <?php else: ?>
                                                        <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                                        <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                                             'width'=>'36px',
                                                                             'height'=>'36px')); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                                    <div class="span-12">
                                                        <div class="span-9">
                                                            <span class="pulzos_titulo1">
                                                                <?php if($datos_like_user->statusEU == 0): ?>
                                                                    <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                                      get_complete_username($posteos->comentarioUsuarioId),
                                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                <?php else: ?>
                                                                    <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                                      get_complete_username($posteos->comentarioUsuarioId),
                                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                <?php endif; ?>
                                                            </span>
                                                        </div>
                                                        <div class="span-2 last">
                                                            <?php if($this->session->userdata('idN') == $pulzo->pulzoUsuarioId): ?>
                                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$pulzo->pulzoId.'/'.$posteos->comentarioId,
                                                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                                                            'width'=>'14px',
                                                                                            'height'=>'12px')),
                                                                                  array('class'=>'eliminar-pulzo')); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                        <?php echo $posteos->comentarioTexto; ?>
                                                    </span>
                                                </div>
                                                <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                                    <div class="span-1" style="margin-left: 20px">
                                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                             'width'=>'14px',
                                                                             'height'=>'12px')); ?>
                                                    </div>
                                                    <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                                        <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                                              $fechaCreacionSub = fecha_acomodo($fecha);
                                                              echo $fechaCreacionSub;
                                                         ?>
                                                    </div>
                                                </div>
                                            </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                                        </div>
                                    <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
                                </div>
                            </div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **FIN** -->
                            <div class="comentarios-<?php echo $datosPost->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                <?php echo form_open('negocios/subcomentarios_post_pulzos/'.$pulzo->pulzoId.'/'.$pulzo->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                                     array('class'=>'forma-comentar-muro'.$datosPost->planId)); ?>
                                    <div class="span-8" style="margin-left: 6px">
                                        <?php echo form_textarea(array('id'=>'sub-comentario'.$datosPost->planId,
                                                                       'class'=>'secondary-comment'.$datosPost->planId,
                                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                                       'onkeypress'=>'subcomentar_enter_company(event,' . $datosPost->planId . ', ' . $pulzo->pulzoId . ')',
                                                                       'value'=>'Comentar',
                                                                       'onfocus'=>"return quitar('Comentar'," . $datosPost->planId . ")",
                                                                       'onblur'=>"return poner('Comentar'," . $datosPost->planId . ")",
                                                                       'name'=>'comentar_negocios')); ?>
                                    </div>
                                <?php echo form_close(); ?>
                                <input type="hidden" id="oct<?php echo $datosPost->planId; ?>" />
                            </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                        </div><!-- DIV DEL CUERPO **FIN**-->
                    </div><!-- DIV CONTENEDOR **FIN** -->
                <?php endif; ?>
            <?php elseif($pulzo->pulzoTipo == 1): ?>
                <?php $datosPost = get_data_planesusuarios($pulzo->pulzoId); ?>
                <?php if(! empty($datosPost)): ?><?php $a=$a+1;?>
                    <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
                        <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                            <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                                <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                                     'width'=>'37px',
                                                     'height'=>'37px')); ?>
                            </div><!-- DIV AVATAR **FIN** -->
                            <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!-- DIV DEL CUERPO DEL MENSAJE PULZO **RETO** -->
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('negocios/perfil/'.$pulzo->pulzoUsuarioId,
                                                      get_complete_username($datosPost->planUsuarioId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo2">
                                    <?php echo $pulzo->pulzoTitulo; ?>
                                </span>
                                <br />
                                <?php if($pulzo->pulzoTipoEventoId == 1): ?>
                                    <span class="pulzos_titulo2">
                                        Reto de Consumo
                                    </span>
                                <?php elseif($pulzo->pulzoTipoEventoId == 2): ?>
                                    <span class="pulzos_titulo1">
                                        Vence en:
                                    </span>
                                    <span>
                                        <!--reloj-->
                                <script language="javascript">
								var tiempotras=new Date();
								var textofecha='<?php echo $pulzo->pulzoDuracionReto; ?>';
								var auxf=textofecha.split("-");
									if(auxf[0]==01){auxf[0]='January'}
									if(auxf[0]==02){auxf[0]='February'}
									if(auxf[0]==03){auxf[0]='March'}
									if(auxf[0]==04){auxf[0]='April'}
									if(auxf[0]==05){auxf[0]='May'}
									if(auxf[0]==06){auxf[0]='June'}
									if(auxf[0]==07){auxf[0]='July'}
									if(auxf[0]==08){auxf[0]='August'}
									if(auxf[0]==09){auxf[0]='September'}
									if(auxf[0]==10){auxf[0]='October'}
									if(auxf[0]==11){auxf[0]='November'}
									if(auxf[0]==12){auxf[0]='December'}
								var nueva=auxf[0]+" "+auxf[1]+","+auxf[2]+" "+auxf[3]+":"+auxf[4]+":00";
								maniana=new Date(nueva);
									maniana1=new Date();
									if(maniana<=maniana1){start(nueva,tiempotras,'countdowncontainera<?php echo $a;?>');}
								
                                </script>
                                <div id="countdowncontainera<?php echo $a;?>" style=" background:#DDEACF;  border:0px; border: 0px solid #399210; color:#006600; width:250px; height:27px;">aun falta para empezar </div>
                                    </span>
                                <?php elseif($pulzo->pulzoTipoEventoId == 3): ?>
                                    <span class="pulzos_titulo2">
                                        Reto de Actividad
                                    </span>
                                <?php elseif($pulzo->pulzoTipoEventoId == 4): ?>
                                    <span class="pulzos_titulo1">
                                        No. de Integrantes:
                                    </span>
                                    <span class="pulzos_titulo2">
                                        <?php echo $pulzo->pulzoNumeroAsistentes; ?>
                                    </span>
                                <?php elseif($pulzo->pulzoTipoEventoId == 5): ?>
                                    <span class="pulzos_titulo2">
                                        Otros
                                    </span>
                                <?php endif; ?>
                                <br />
                                <span class="pulzos_titulo1">
                                    Tipo:
                                </span>
                                <span class="pulzos_titulo2">
                                    Reto
                                </span>
                            </div><!-- DIV DEL CUERPO DEL MENSAJE DEL RETO **FIN** -->
                            <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION PULZO **INICIO** -->
                                <div class="span-2">
                                    <?php if($pulzo->pulzoImagenRuta == '0'): ?>
                                        <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                                             'width'=>'100px',
                                                             'height'=>'100px')); ?>
                                    <?php else: ?>
                                        <?php echo img(array('src'=>$pulzo->pulzoImagenRuta,
                                                             'width'=>'100px',
                                                             'height'=>'100px')); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="prepend-1 span-10 last" style="margin-top: 5px">
                                    <span class="pulzos_titulo2">
                                        <?php echo anchor('retosnegocios/ver_reto/'.$pulzo->pulzoId,
                                                          $pulzo->pulzoAccion,
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas')); ?>
                                    </span>
                                </div>                    
                            </div><!-- DIV DEL CUERPO DESCRIPCION DEL PULZO **FIN** -->
                            <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                                <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                                    <?php echo anchor('#',
                                                      'Aviso Legal:',
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$pulzo->pulzoId, 'id'=>'ver-'.$pulzo->pulzoId)); ?>
                                    <?php echo anchor('#',
                                                      'Aviso Legal:',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$pulzo->pulzoId, 'id'=>'ocultar-'.$pulzo->pulzoId)); ?>
                                </div>
                            </div>
                            <div style="display: none" id="aviso-legal-<?php echo $pulzo->pulzoId; ?>">
                                <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                    <?php echo $pulzo->pulzoAvisoLegal; ?>    
                                </div>
                            </div><!-- DIV AVISO LEGAL **FIN** -->
                            <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                <div class="span-6">
                                    &nbsp;
                                </div>
                                <div class="prepend-1 span-2">
                                    <?php echo anchor('retosnegocios/ver_reto/'.$pulzo->pulzoId,
                                                      'Ver mas',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas')); ?>
                                </div>
                                <div class="span-2">
                                    <?php echo anchor('#',
                                                      'Comentar',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px', 'class'=>'comentar-pulzo', 'id'=>$datosPost->planId)); ?>
                                </div>
                                <?php if($this->session->userdata('id') == $datosPost->planUsuarioId): ?>
                                    <div class="span-1">
                                        <?php echo anchor('negocios/borrar_pulzos/'.$pulzo->pulzoId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px;', 'class'=>'eliminar-pulzo')); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="span-1">
                                        <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$datosPost->planId.'/'.$pulzo->pulzoId,
                                                          'Reservar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="comentarios<?php echo $pulzo->pulzoId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                                <?php $pulzos_post = get_pulzos_subcomments($pulzo->pulzoId); ?>
                                <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                    <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                                        <div class="span-12 last" style="background-color: #DCCEDD; margin-left: 50px; margin-bottom: 10px">
                                            <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                                <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                                    <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                                    <?php if($datos_like_user->statusEU == 0): ?>
                                                        <?php echo img(array('src'=>get_avatar($posteos->comentarioUsuarioId),
                                                                             'width'=>'36px',
                                                                             'height'=>'36px')); ?>
                                                    <?php else: ?>
                                                        <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                                        <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                                             'width'=>'36px',
                                                                             'height'=>'36px')); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                                    <div class="span-12">
                                                        <div class="span-9">
                                                            <span class="pulzos_titulo1">
                                                                <?php if($datos_like_user->statusEU == 0): ?>
                                                                    <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                                      get_complete_username($posteos->comentarioUsuarioId),
                                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                <?php else: ?>
                                                                    <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                                      get_complete_username($posteos->comentarioUsuarioId),
                                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                <?php endif; ?>
                                                            </span>
                                                        </div>
                                                        <div class="span-2 last">
                                                            <?php if($this->session->userdata('idN') == $pulzo->pulzoUsuarioId): ?>
                                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$pulzo->pulzoId.'/'.$posteos->comentarioId,
                                                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                                                            'width'=>'14px',
                                                                                            'height'=>'12px')),
                                                                                  array('class'=>'eliminar-pulzo')); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                        <?php echo $posteos->comentarioTexto; ?>
                                                    </span>
                                                </div>
                                                <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                                    <div class="span-1" style="margin-left: 20px">
                                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                             'width'=>'14px',
                                                                             'height'=>'12px')); ?>
                                                    </div>
                                                    <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                                        <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                                              $fechaCreacionSub = fecha_acomodo($fecha);
                                                              echo $fechaCreacionSub;
                                                         ?>
                                                    </div>
                                                </div>
                                            </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                                        </div>
                                    <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
                                </div>
                            </div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **FIN** -->
                            <div class="comentarios-<?php echo $datosPost->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                <?php echo form_open('negocios/subcomentarios_post_pulzos/'.$pulzo->pulzoId.'/'.$pulzo->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                                     array('class'=>'forma-comentar-muro'.$datosPost->planId)); ?>
                                    <div class="span-8" style="margin-left: 6px">
                                        <?php echo form_textarea(array('id'=>'sub-comentario'.$datosPost->planId,
                                                                       'class'=>'secondary-comment'.$datosPost->planId,
                                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                                       'onkeypress'=>'subcomentar_enter_company(event,' . $datosPost->planId . ', ' . $pulzo->pulzoId . ')',
                                                                       'value'=>'Comentar',
                                                                       'onfocus'=>"return quitar('Comentar'," . $datosPost->planId . ")",
                                                                       'onblur'=>"return poner('Comentar'," . $datosPost->planId . ")",
                                                                       'name'=>'comentar_negocios')); ?>
                                    </div>
                                <?php echo form_close(); ?>
                                <input type="hidden" id="oct<?php echo $datosPost->planId; ?>" />
                            </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                        </div><!-- DIV DEL CUERPO **FIN** -->
                    </div><!-- DIV CONTENEDOR **FIN** -->
                <?php endif; ?>
            <?php elseif($pulzo->pulzoTipo == 0): ?><!-- IF PARA SABER QUE ES UN PULZO **INICIO** -->
                <?php $datosPost = get_data_planesusuarios($pulzo->pulzoId); ?>
                <?php if(! empty($datosPost)): ?>
                    <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
                        <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                            <div class="span-1"><!-- DIV DE AVATAR **INICIO** -->
                                <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                                     'width'=>'37px',
                                                     'height'=>'37px')); ?>
                            </div><!-- DIV DE AVATAR **FIN** -->
                            <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word;"><!-- DIV DEL CUERPO DEL MENSAJE PULZO **INICIO** -->
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('negocios/perfil/'.$pulzo->pulzoUsuarioId,
                                                      get_complete_username($datosPost->planUsuarioId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo2">
                                    <?php echo $pulzo->pulzoTitulo; ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo1">
                                    Fecha Inicio:
                                </span>
                                <span class="pulzos_titulo2">
                                    <?php $fechaI = unix_to_human($pulzo->pulzoFechaInicio);
                                          $inicio = fecha_acomodo($fechaI);
                                          echo $inicio; ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo1">
                                    Tipo:
                                </span>
                                <span class="pulzos_titulo2">
                                    Pulzo
                                </span>
                            </div><!-- DIV DEL CUERPO DEL MENSAJE PULZO **FIN** -->
                            <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION PULZO **INICIO** -->
                                <div class="span-2">
                                    <?php if($pulzo->pulzoImagenRuta == '0'): ?>
                                        <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                                             'width'=>'100px',
                                                             'height'=>'100px')); ?>
                                    <?php else: ?>
                                        <?php echo img(array('src'=>$pulzo->pulzoImagenRuta,
                                                             'width'=>'100px',
                                                             'height'=>'100px')); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="prepend-1 span-10 last" style="margin-top: 5px">
                                    <span class="pulzos_titulo2">
                                        <?php echo anchor('pulzos/ver_simple/'.$pulzo->pulzoId,
                                                          $pulzo->pulzoAccion,
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas')); ?>
                                    </span>
                                </div>                    
                            </div><!-- DIV DEL CUERPO DESCRIPCION DEL PULZO **FIN** -->
                            <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                                <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                                    <?php echo anchor('#',
                                                      'Aviso Legal:',
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$pulzo->pulzoId, 'id'=>'ver-'.$pulzo->pulzoId)); ?>
                                    <?php echo anchor('#',
                                                      'Aviso Legal:',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$pulzo->pulzoId, 'id'=>'ocultar-'.$pulzo->pulzoId)); ?>
                                </div>
                            </div>
                            <div style="display: none;" id="aviso-legal-<?php echo $pulzo->pulzoId; ?>">
                                <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                    <?php echo $pulzo->pulzoAvisoLegal; ?>    
                                </div>
                            </div><!-- DIV AVISO LEGAL **FIN** -->
                            <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                <div class="span-6">
                                    &nbsp;
                                </div>
                                <div class="prepend-1 span-2">
                                    <?php echo anchor('pulzos/ver_simple/'.$pulzo->pulzoId,
                                                      'Ver mas',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas')); ?>
                                </div>
                                <div class="span-2">
                                    <?php echo anchor('#',
                                                      'Comentar',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px', 'class'=>'comentar-pulzo', 'id'=>$datosPost->planId)); ?>
                                </div>
                                <?php if($this->session->userdata('id') == $datosPost->planUsuarioId): ?>
                                    <div class="span-1">
                                        <?php echo anchor('negocios/borrar_pulzos/'.$pulzo->pulzoId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px;', 'class'=>'eliminar-pulzo')); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="span-1">
                                        <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$datosPost->planId.'/'.$pulzo->pulzoId,
                                                          'Reservar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="comentarios<?php echo $pulzo->pulzoId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                                <?php $pulzos_post = get_pulzos_subcomments($pulzo->pulzoId); ?>
                                <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                    <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                                        <div class="span-12 last" style="background-color: #DCCEDD; margin-left: 50px; margin-bottom: 10px">
                                            <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                                <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                                    <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                                    <?php if($datos_like_user->statusEU == 0): ?>
                                                        <?php echo img(array('src'=>get_avatar($posteos->comentarioUsuarioId),
                                                                             'width'=>'36px',
                                                                             'height'=>'36px')); ?>
                                                    <?php else: ?>
                                                        <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                                        <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                                             'width'=>'36px',
                                                                             'height'=>'36px')); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                                    <div class="span-12">
                                                        <div class="span-9">
                                                            <span class="pulzos_titulo1">
                                                                <?php if($datos_like_user->statusEU == 0): ?>
                                                                    <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                                      get_complete_username($posteos->comentarioUsuarioId),
                                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                <?php else: ?>
                                                                    <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                                      get_complete_username($posteos->comentarioUsuarioId),
                                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                <?php endif; ?>
                                                            </span>
                                                        </div>
                                                        <div class="span-2 last">
                                                            <?php if($this->session->userdata('idN') == $pulzo->pulzoUsuarioId): ?>
                                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$pulzo->pulzoId.'/'.$posteos->comentarioId,
                                                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                                                            'width'=>'14px',
                                                                                            'height'=>'12px')),
                                                                                  array('class'=>'eliminar-pulzo')); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                        <?php echo $posteos->comentarioTexto; ?>
                                                    </span>
                                                </div>
                                                <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                                    <div class="span-1" style="margin-left: 20px">
                                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                             'width'=>'14px',
                                                                             'height'=>'12px')); ?>
                                                    </div>
                                                    <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                                        <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                                              $fechaCreacionSub = fecha_acomodo($fecha);
                                                              echo $fechaCreacionSub;
                                                         ?>
                                                    </div>
                                                </div>
                                            </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                                        </div>
                                    <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
                                </div>
                            </div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **FIN** -->
                            <div class="comentarios-<?php echo $datosPost->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                <?php echo form_open('negocios/subcomentarios_post_pulzos/'.$pulzo->pulzoId.'/'.$pulzo->pulzoUsuarioId.'/'.$this->session->userdata('id'),
                                                     array('class'=>'forma-comentar-muro'.$datosPost->planId)); ?>
                                    <div class="span-8" style="margin-left: 6px">
                                        <?php echo form_textarea(array('id'=>'sub-comentario'.$datosPost->planId,
                                                                       'class'=>'secondary-comment'.$datosPost->planId,
                                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                                       'onkeypress'=>'subcomentar_enter_company(event,' . $datosPost->planId . ', ' . $pulzo->pulzoId . ')',
                                                                       'value'=>'Comentar',
                                                                       'onfocus'=>"return quitar('Comentar'," . $datosPost->planId . ")",
                                                                       'onblur'=>"return poner('Comentar'," . $datosPost->planId . ")",
                                                                       'name'=>'comentar_negocios')); ?>
                                    </div>
                                <?php echo form_close(); ?>
                                <input type="hidden" id="oct<?php echo $datosPost->planId; ?>" />
                            </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->                        
                        </div><!-- DIV DEL CUERPO **FIN** -->
                    </div><!--  DIV CONTENEDOR **FIN** -->
                <?php endif; ?>
            <?php else: ?>
            <?php endif; ?><!-- IF PARA CONOCER SI ES COMENTARIO O NO **FIN** -->
        <?php endforeach;*/ ?>
    </div><!-- PARTE DONDE SE PONDRAN LOS PULZOS DE LA EMPRESA Y COMENTARIOS DEL USUARIO **FIN** -->
    <div class="span-14 last"><!-- DIV DONDE SE PONDRAN LOS REGISTROS DE VER MAS **INICIO** -->
            <div id="verMas">
            </div>
    </div><!-- DIV DONDE SE PONDRAN LOS REGISTROS DE VER MAS **FIN** -->
    <!-- div class="span-14" style="display: none">
        <span id="ultimos"><?php echo $valores; ?></span>
        <?php echo anchor('negocios/get_pulzos_next_ten/'.$negocios->negocioId, '', array('style'=>'display: ', 'id'=>'urlGet')); ?>
    </div>
    <div class="span-14">
        <div class="prepend-12 last">
            <?php echo anchor('negocios/siguientes_pulzos/'.$negocios->negocioId,
                              'Ver mas',
                              array('style'=>'text-decoration: none; color: #660066', 'class'=>'ver-mas-publicaciones')); ?>
        </div>
    </div -->
    
 <div>

  <div>
        <div id="maping-overlay" class="kewl-overlay-style"><div id="show-map"></div></div>
<div>
