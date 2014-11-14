<?php
/**
 * Metodo que se usa para cargar la vista de inicio
 * cuando se logguea el usuario que es el dueño
 * del perfil de negocios
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
var posiciones= new Array(5);
var i=0;

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

$(".ver-mas").click(function(event){
    event.preventDefault();
    verMasInicio = $(event.currentTarget).attr("href");
    $("#texto-menu").load(verMasInicio);
});

function cambio_radio()
{
    var radio_button = '';
    $(".radios_ofertas").change(function(event){
        radio_button = $(event.currentTarget).val();
    });
    return radio_button;
}

$("#forma_comment_1").submit(function(event){
    event.preventDefault();
    bandera = $(this).attr('flag');
    if(bandera == 1)
    {
        if(($('#main-comment').attr('value')=='Que quieres Geo-etiquetar?')){
                    $('#eventos').html('Escribe que quieres compartir').slideDown('slow', function(){
                        setTimeout(function(){
                            $('#eventos').slideUp('slow');
                            $('#main-comment').focus();
                        },1500);
                    });
        }
       /*else if($("input[class=radios_ofertas]:checked").val() == 6 && $('input[name=tipo_oferta]:checked').val() == undefined)
       {
                $("#eventos").html('Selecciona un tipo de desglose').slideDown('slow', function(){
                    setTimeout(function(){
                        $("#eventos").slideUp('slow');
                        $("#main-comment").focus();
                    }, 1500);
                }); 
        } */
        else if($("#facebookMessage").val() == '' && $("#twitterMessage").val() == '')
        {
            $("#eventos").html('Ingresa por lo menos una red social').slideDown('slow', function(){
                setTimeout(function(){
                    $("#eventos").slideUp('slow');
                    $("#facebookMessage").focus();
                }, 1500);
            });
        }
        else if($("#minimoConsumo").val() == '')
        {
            $("#eventos").html('Ingresa el monto minimo de consumo.').slideDown('slow', function(){
                setTimeout(function(){
                    $("#eventos").slideUp('slow');
                    $("#minimoConsumo").focus();
                }, 1500);
            });
        }
        else if($("#minimoConsumo").val() < 50)
        {
            $("#eventos").html('El monto minimo de consumo debe ser mayor a $ 50.').slideDown('slow', function(){
                setTimeout(function(){
                    $("#eventos").slideUp('slow');
                    $("#minimoConsumo").focus();
                }, 1500);
            });
        }
        else if($("#montoFijoBonificacion").val() == '')
        {
            $("#eventos").html('Ingresa el monto a bonificar.').slideDown('slow',function(){
                setTimeout(function(){
                    $("#eventos").slideUp('slow');
                    $("#montoFijoBonificacion").focus();
                }, 1500);
            });
        }
        else{
                var opciones = {
                    success: cargarVista
                }
                $(this).ajaxSubmit(opciones);
                return false;
            }
    }
    else
    { //else flag
        if(($('#main-comment').attr('value')=='Que quieres Geo-etiquetar?')){
                    $('#eventos').html('Escribe que quieres compartir').slideDown('slow', function(){
                        setTimeout(function(){
                            $('#eventos').slideUp('slow');
                            $('#main-comment').focus();
                        },1500);
                    });
        }
        else if($("#imagenRuta").attr('value') == '')
        {
            $("#eventos").html('Selecciona la imagen a cargar').slideDown('slow', function(){
                setTimeout(function(){
                    $("#eventos").slideUp('slow');
                    $("#imagenRuta").focus();
                }, 1500);
            });
        }
        else
        {
            var opciones = {
                success: cargarVistaI
            }
            $(this).ajaxSubmit(opciones);
            return false;
        }
    } //else flag*/
});

function cargarVista()
{
   $('#eventos').html('Tu comenario a sido Geo-posicionado').slideDown('slow', function(){
                    setTimeout(function(){
                        $('#eventos').slideUp('slow',function(){
                            urlRedireccionar = $("#redirectMain").attr("href");
                            $("#texto-menu").load(urlRedireccionar);
                        });
                    },2000);
   });
}

function cargarVistaI()
{
    $("#eventos").html('Tu imagen ha sido Geo-posicionada').slideDown('slow', function(){
        setTimeout(function(){
            $("#eventos").slideUp(function(){
                var urlRedireccionar_uno = $("#redirectMain").attr('href');
                $("#texto-menu").load(urlRedireccionar_uno);
            });
        }, 1500);
    });
}

function ponerTexto(val)
{
    if(document.getElementById('main-comment').value == '')
    {
        document.getElementById('main-comment').value = val;
    }
}

function quitarTexto(val)
{
    if(document.getElementById('main-comment').value == 'Que quieres Geo-etiquetar?')
    {
        document.getElementById('main-comment').value = '';
    }
}

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

$(".eliminar-pulzo").click(function(event){
    event.preventDefault();
    urlDelete = $(event.currentTarget).attr("href");
    $.get(urlDelete);
    $(event.currentTarget).parent().parent().parent().parent().hide().remove();
});

$(".links-c").click(function(event){
    event.preventDefault();
    $("#post-image").hide();
    actionComentario = $("#guardarComentario").attr("href");
    $("#forma_comment_1").attr('action', actionComentario);
    $("#forma_comment_1").attr('flag', '1');
    $("#pasar_voz_form").show();
});

$(".link-i").click(function(event){
    event.preventDefault();
    actionImagen = $("#guardar-imagen").attr('href');
    $("#forma_comment_1").attr('action', actionImagen);
    $("#forma_comment_1").attr('flag', '2');
    $("#pasar_voz_form").hide();
    $("#post-image").show();
});

$(".links-p").click(function(event){
    event.preventDefault();
    $('#mapa-pulzos').hide();
    urlPulzos = $("#pulzosForm").attr("href");
    actionPulzo = $("#guardarPulzo").attr("href");
    $("#forma_comment").attr('action', actionPulzo);
    $("#formularios").show().load(urlPulzos);
});

$(".links-r").click(function(event){
    event.preventDefault();
    $('#mapa-pulzos').hide();
    urlRetos = $("#retosForm").attr("href");
    actionRetos = $("#guardarReto").attr("href");
    $("#forma_comment").attr('action', actionRetos);
    $("#formularios").show().load(urlRetos);
});

$(".links-edv").click(function(event){
    event.preventDefault();
    $('#mapa-pulzos').hide();
    urlExperiencias = $("#experienciaForm").attr("href");
    actionExperiencias = $("#guardarExperiencia").attr("href");
    $("#forma_comment").attr("action", actionExperiencias);
    $("#formularios").show().load(urlExperiencias);
});

$(".comentar-pulzo").click(function(event){
    event.preventDefault();
    idUrlOpen = $(event.currentTarget).attr("id");
    $(".comentarios-"+idUrlOpen).show();
});

$(".eliminar-sub").click(function(event){
    event.preventDefault();
    urlDeleteSub = $(event.currentTarget).attr("href");
    $.get(urlDeleteSub);
    $(event.currentTarget).parent().parent().parent().parent().parent().hide().remove();
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

//VAMOS PARA LOS SIGUIENTES PULZOS
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


//Ubicar comentario en Mapa
var geoCode = new google.maps.Geocoder();

function listos()
{
    $("#overlay").fadeIn('fast', function(){
        $("#form").animate({'top':'80px'}, 500);
    });
}

$(document).ready(function(){

//PART WHERE CALL THE FUNCTION
/*var active_account = $("#ActiveAccount").val();
if(active_account == '0' || active_account == '1')
{
    listos();
}*/

//PLACE WHERE SHOW THE OVERLAY
$("#login").click(function(event){
        event.preventDefault();
        $("#overlay").fadeIn('fast', function(){
            $("#form").animate({'top':'80px'}, 500);
        });
    });

    $("#closeform").click(function(event){
        event.preventDefault();
        $("#form").animate({'top':'-450px'}, 500, function(){
            $("#overlay").fadeOut('fast');
        });
    });
//PLACE WHERE SHOW THE OVERLAY




        if($(".latitud").html() != '' && $(".longitud").html() != '')
        {
            var latLng = new google.maps.LatLng($(".latitud").html(), $(".longitud").html());
        }
        else
        {
            var latLng = new google.maps.LatLng(20.6729955725656, -103.37604224681854);
        }

        var posOne = new google.maps.LatLng(20.6729955725656, -103.37604224681854); 

        var myOptions = {
            zoom: 10,
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
            title: 'Seleccione su ubicacion',
            map: map,
            icon: markerImage,
            draggable: true
        });
        
        
    //ACTUALIZAR LA INFORMACION DE LA POSICION ACTUAL
        updateMarkerPosition(latLng);
        geocodePosition(latLng);

        //AGREGAR EL EVENTO DE ARRASTRAR LOS DATOS
        google.maps.event.addListener(marker, 'dragstart', function(){
            updateMarkerAddress('...');
        });

        google.maps.event.addListener(marker, 'drag', function(){
            updateMarkerStatus('.....');
            updateMarkerPosition(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function(){
            updateMarkerStatus('....');
            geocodePosition(marker.getPosition());
        });
        
/** 
 *AGREGAR MAS MARCADORES   
**/

    $('#cambiarP').click(function(){
//CREAR MARCADOR
        if(i<4){
            var lon = "longitud_"+i;
            var lat = "latitud_"+i;    
            var latLng = new google.maps.LatLng(20.67241336675683-(i*(-.00010)), -103.37516248226166-(i*(-.00020)));
            var marker = new google.maps.Marker({
                    position: latLng,
                    title: 'Seleccione su ubicacion',
                    map: map,
                    icon: markerImage,
                    draggable: true
                });

                $('#posicionamiento').append('<input id=latitud_'+i+' name="Scribble[scribbleLat]" type="hidden" /><input id="longitud_'+i+'" name="Scribble[scribbleLng]" type="hidden" />');
//AGREGAR EL EVENTO DE ARRASTRAR LOS DATOS
                google.maps.event.addListener(marker, 'dragstart', function(){
                    updateMarkerAddress('...');
                });

                google.maps.event.addListener(marker, 'drag', function(){
                    updateMarkerStatus('.....');
                    updateMarkerPositions(marker.getPosition());
                });

                google.maps.event.addListener(marker, 'dragend', function(){
                    updateMarkerStatus('....');
                    geocodePosition(marker.getPosition());
                });


                function updateMarkerPositions(latLng)
                {
                   var uno = latLng.lng();
                   var dos = latLng.lat();
                   document.getElementById(lon).value = uno;
                   document.getElementById(lat).value = dos;
                }
                i++;
            }else{
                $('#eventos').html('Limite Maximo de Geo-Posiciones').slideDown('slow', function(){
                    setTimeout(function(){
                        $('#eventos').slideUp('slow');
                    },1500);
                });
            }
        });      
    });

    /**
     * METODO QUE SE USA PARA EL CODIGO
     * DE LA POSICION
     **/
    function geocodePosition(pos)
    {
        geoCode.geocode({
                latLng: pos
            }, function(responses){
                if(responses && responses.lenght > 0){
                    updateMarkerAddress(responses[0].formatted_address);
                } else {
                    updateMarkerAddress('');
                }
            }
        );
    }
    //**MANDARLE APARTE EL ID DEL ELEMENTO A EVALUAR
    function updateMarkerPosition(latLng)
    {
        var uno = latLng.lng();
        var dos = latLng.lat();
        document.getElementById('longitud').value = uno;
        document.getElementById('latitud').value = dos;
    }
    function updateMarkerAddress(str){
    }
    
    function updateMarkerStatus(str){
    }

$(".opcion-radio").change(function(event){
    event.preventDefault();
    valorDado = $(event.currentTarget).attr('value');
    if(valorDado == '1')
    {
        $("#numero-usuarios-content").show();
    }
    else if(valorDado == '2')
    {
        $("#numero-usuarios-content").hide();
    }
});

$(".radios_ofertas").change(function(event){
    id_group = $(event.currentTarget).val();
    if(id_group == 5)
    {
        $("#text_porcentaje").hide();
        $("#montoPorcentajeBonificacion").val('');
        $("#pct").hide();
        $("#pfj").show();
        $("#fj").show();
        $("#text_fijo").show();
        $("#ivas_options").hide();
        $(".radios_opciones").attr('checked', '');
    }
    else
    {
        $("#text_fijo").hide();
        $("#fj").hide();
        $("#montoFijoBonificacion").val('');
        $("#pfj").hide();
        $("#pct").show();
        $("#text_porcentaje").show();
        $("#ivas_options").show();
    }
});

function just_numbers(evt)
{
    var keyPressed = (evt.which) ? evt.which : event.keyCode
    return (keyPressed <= 13 || (keyPressed >= 48 && keyPressed <= 57) || keyPressed == 46);
}

</script>
<style>
/** CSS FOR OVELAYS FUNCTIONALITY **/

.overlay_style{
    background:transparent url(http://www.posticking.com/statics/img_posticking/overlay.png) repeat top left;
    position:fixed;
    top:0px;
    bottom:0px;
    left:0px;
    right:0px;
    z-index:100;
}

.form{
    position:fixed;
    top: -450px;
    left:30%;
    right:30%;
    background-color:#fff;
    color:#7F7F7F;
    padding:20px;
    border:2px solid #ccc;
    -moz-border-radius: 20px;
    -webkit-border-radius:20px;
    -khtml-border-radius:20px;
    -moz-box-shadow: 0 1px 5px #333;
    -webkit-box-shadow: 0 1px 5px #333;
    z-index:101;
}

.form_search {
    position:fixed;
    top: -450px;
    left:30%;
    right:30%;
    background-color:#fff;
    color:#7F7F7F;
    padding:20px;
    border:2px solid #ccc;
    -moz-border-radius: 20px;
    -webkit-border-radius:20px;
    -khtml-border-radius:20px;
    -moz-box-shadow: 0 1px 5px #333;
    -webkit-box-shadow: 0 1px 5px #333;
    z-index:101;
}

a.closeform{
    float:right;
    width:26px;
    height:26px;
    background:transparent url(http://www.posticking.com/statics/img_posticking/cancel.png) repeat top left;
    margin-top:-30px;
    margin-right:-30px;
    cursor:pointer;
}

a.closeFormS {
    float: right;
    width: 26px;
    height: 26px;
    background:transparent url(http://www.posticking.com/statics/img_posticking/cancel.png) repeat top left;
    margin-top:-30px;
    margin-right:-30px;
    cursor:pointer;
}

.form h1{
    /*border-bottom: 1px dashed #7F7F7F;*/
    margin:-20px -20px 0px -20px;
    padding:10px;
    background-color: #FFFFFF;/*#FFEFEF;*/
    color: #003F14;/*#EF7777;*/
    -moz-border-radius:20px 20px 0px 0px;
    -webkit-border-top-left-radius: 20px;
    -webkit-border-top-right-radius: 20px;
    -khtml-border-top-left-radius: 20px;
    -khtml-border-top-right-radius: 20px;
}

.form_search h1 {
    /*border-bottom: 1px dashed #7F7F7F;*/
    margin:-20px -20px 0px -20px;
    padding:10px;
    background-color: #FFFFFF;/*#FFEFEF;*/
    color: #003F14;/*#EF7777;*/
    -moz-border-radius:20px 20px 0px 0px;
    -webkit-border-top-left-radius: 20px;
    -webkit-border-top-right-radius: 20px;
    -khtml-border-top-left-radius: 20px;
    -khtml-border-top-right-radius: 20px;
}

#login-button-overlay {
    background-image: url(http://www.posticking.cpom/statics/img_posticking/botonLogin.png);
    background-repeat: none;
    width: 173px;
    height: 48px;
    border: none;
    background-color: #FFFFFF;
}

.overlay_style {
    display: none;
}

.font-titles-forms-login {
    color: #666666;
    text-align: left;
    margin-left: 0px;
}
</style>
<?php $posicionamientos=array(); ?>
<?php echo anchor('planesusuarios/reload_comment/', '', array('style'=>'display: none', 'id'=>'recarga_comentario')); ?>
<?php echo anchor('negocios/reload_comment_company/', '', array('style'=>'display: none', 'id'=>'recargar_comentario_empresa')); ?>
<?php echo anchor('negocios/principal/'.$this->session->userdata('id').'/'.$this->session->userdata('idN'), '', array('id'=>'redirectMain', 'style'=>'display: none')); ?>
<?php echo anchor('negocios/ubicacion_comentario/','', array('style'=>'display: none', 'id'=>'ubicacionComentario')); ?>
<div id="eventos" class="redondeo-div-inferior" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#FFFFFF;display:none;text-align:center;margin-top: 1px;background-color:#996699;width: 370px; height: 28px;margin-left: 85px;line-height:28px;"></div>
<div class="span-14 last" style="margin-top: 20px">
    <div class="span-13 last"><!-- DIV CONTENEDOR **INICIO** -->
        <?php echo form_open_multipart('negocios/guardar_comentario/'.$this->session->userdata('idN'), array('id'=>'forma_comment_1', 'flag'=>'1')); ?> 
            <div class="span-12 last">
                <?php echo form_textarea(array('id'=>'main-comment',
                                               'name'=>'Pulzos[pulzoTitulo]',
                                               'class'=>'area-textoPublicar',
                                               'style'=>'width: 519px; height: 16px; border: 1px solid',
                                               'value'=>'Que quieres Geo-etiquetar?',
                                               'onkeypress'=>'',
                                               'onblur'=>"return ponerTexto('Que quieres Geo-etiquetar?')",
                                               'onfocus'=>"return quitarTexto('Que quieres Geo-etiquetar?')")); ?>
            </div>
            <div class="span-12 last">
                <div id="verPos" class="span-4"></li></div>
                <div class="prepend-8 span-5 last" style="margin-left: 40px">
                    <span style="margin-right: 10px; color: #8D6E98">
                        <?php echo anchor('negocios/principal/'.$this->session->userdata('id'), '', array('id'=>'', 'style'=>'display: none')); ?>
                        <?php echo anchor('negocios/guardar_comentario/'.$this->session->userdata('idN'), '', array('id'=>'guardarComentario', 'style'=>'display: none')); ?>
                        <?php echo anchor('#',
                                          img(array('src'=>'statics/img/ico_empresas_post/pin.png',
                                                    'width'=>'16px',
                                                    'height'=>'12px')),
                                          array('class'=>'links-c')); ?>
                        <?php echo anchor('#',
                                          /*'Pasa la voz'*/'Spread the word',
                                          array('class'=>'links-c', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </span>
                    <span style="">
                        <?php echo anchor('negocios/guardar_imagen_negocio/'.$this->session->userdata('idN'), '', array('style'=>'display: none', 'id'=>'guardar-imagen')); ?>
                        <?php echo anchor('#',
                                          img(array('src'=>'statics/img/ico_empresas_post/foto.png',
                                                    'width'=>'16px',
                                                    'height'=>'12px')),
                                          array('class'=>'link-i')); ?>
                        <?php echo anchor('#',
                                          'Image',
                                          array('class'=>'link-i', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </span>
                </div>
            </div>
        <div id="formularios" class="span-13 last" style="display: none"></div>
            <div class="span-13 last">
                <div class="span-13" style="margin-top: 10px; margin-left: 30px; color: #660066; font-size: 12px">
                  <!--  Selecciona la Geo-posicion de tu etiqueta:-->
                  Select Geo-position your label
                </div>
                <div class="span-13" id="mapa-pulzos" style="width: 450px; height: 300px;margin-left: 30px;margin-bottom: 5px;"></div>
                <div class="prepend-10" style="margin-bottom:25px">
                </div>
                <div class="prepend-9 last" id="posicionamiento">
                   <?php echo form_input(array('id'=>'latitud',
                                               'name'=>'Scribble[scribbleLat]',
                                               'style'=>'display:none')); ?>
                    <?php echo form_input(array('id'=>'longitud',
                                                'name'=>'Scribble[scribbleLng]',
                                                'style'=>'display:none')); ?> 
               </div>
            </div>

            <!-- EMPIEZAN LAS COSAS -->
            <div id="pasar_voz_form">
                <div class="span-13 last" style="color: #660066; margin-left: 30px; margin-top: 20px">
                    <?php //echo form_label('Que quieres comunicar en las redes sociales:', 'redesSocialCom', array('style'=>'color: #660066')); ?>
                    <?php echo form_label('You want to communicate in social networks:', 'redesSocialCom', array('style'=>'color: #660066')); ?>
                    <div class="span-13">
                        <?php echo img(array('src'=>'statics/img/facebook.png',
                                 'width'=>'64px',
                                 'height'=>'25px')); ?>
                    </div>
                    <div class="span-13 last">
                        <?php echo form_textarea(array('id'=>'facebookMessage',
                                                       'class'=>'',
                                                       'name'=>'Redes[mensajeFacebook]',
                                                       'value'=>'',
                                                       'style'=>'width:400px; height:60px')); ?>
                    </div>
                    <div class="span-13">
                        <?php echo img(array('src'=>'statics/img/twitter.png',
                                 'width'=>'64px',
                                 'height'=>'25px')); ?>
                    </div>
                    <div class="span-13">
                        <?php echo form_textarea(array('id'=>'twitterMessage',
                                                       'class'=>'',
                                                       'name'=>'Redes[mensajeTwitter]',
                                                       'value'=>'',
                                                       'style'=>'width:400px; height:60px')); ?>
                    </div>
                    <div class="span-13" style="margin-top: 10px">
                        <?php //echo form_label('Define tu promocion:', 'definePromo', array('style'=>'color: #660066; font-size: 14px')); ?>
                         <?php echo form_label('Define your promotion:', 'definePromo', array('style'=>'color: #660066; font-size: 14px')); ?>
                    </div>
                    <div class="span-13">
                        <input type="hidden" name="Oferta[statusTipoBonificacion]" id="radios_ofertasH" value="6" />
                        <!-- div class="span-4">
                            <?php echo form_radio(array('id'=>'fijo_promo',
                                                        'class'=>'radios_ofertas',
                                                        'name'=>'Oferta[statusTipoBonificacion]',
                                                        'value'=>'5',
                                                        'checked'=>'checked',
                                                        'style'=>'margin-top: 5px')); ?> Bonificacion Fija
                        </div>
                        <div class="span-5">
                            <?php echo form_radio(array('id'=>'porcentaje_promo',
                                                        'class'=>'radios_ofertas',
                                                        'name'=>'Oferta[statusTipoBonificacion]',
                                                        'value'=>'6',
                                                        'checked'=>'',
                                                        'style'=>'margin-top: 5px')); ?> Bonificacion por Porcentaje
                        </div -->
                    </div>
                    <div class="span-13" id="ivas_options" style="display: none">
                        <input type="hidden" name="tipo_oferta" id="con_ivaH" value="2" />
                        <!-- div class="span-4">
                            <?php echo form_radio(array('id'=>'con_iva',
                                                        'class'=>'radios_opciones',
                                                        'name'=>'tipo_oferta',
                                                        'value'=>'1',
                                                        'checked'=>'',
                                                        'style'=>'margin-top: 5px')); ?>Con Iva Desglosado
                        </div>
                        <div class="span-5">
                            <?php echo form_radio(array('id'=>'sin_iva',
                                                        'class'=>'radios_opciones',
                                                        'name'=>'tipo_oferta',
                                                        'value'=>'2',
                                                        'checked'=>'',
                                                        'style'=>'margin-top: 5px')); ?>Sin Iva Desglosado
                        </div -->
                    </div>
                    <div class="span-13">
                        <div class="span-4" style="color: #660066">
                            <!--Enlace:-->
                            Link:
                        </div>
                        <div class="span-6" style="color: #660066">
                            http://<?php echo form_input(array('id'=>'',
                                                        'class'=>'',
                                                        'name'=>'Scribble[scribbleAnexos]',
                                                        'value'=>'')); ?> <span style="color: #FF0000">*</span>
                        </div>
                    </div>
                    <div class="span-13">
                        <div class="span-4">
                            <?php //echo form_label('Minimo de Consumo: ', 'consumoMinimo', array('style'=>'color: #660066')); ?>
                        </div>
                        <div class="span-5 last" style="color: #660066">
                            <?php echo form_hidden(array('id'=>'minimoConsumo',
                                                        'class'=>'minimo-consumo',
                                                        'value'=>'0',
                                                        'style'=>'text-align: right',
                                                        'onkeypress'=>'return just_numbers(event)',
                                                        'name'=>'Oferta[consumoMinimo]')); ?> <!--MX.-->
                        </div>
                    </div>
                    <div class="span-13" id="1text_fijo" style="">
                        <!-- div class="span-4" style="" id="text_fijo">
                            <?php echo form_label('Monto Fijo:', 'montoFijoTotal', array('style'=>'color: #660066')); ?>
                        </div -->
                        <div class="span-4" id="text_porcentaje">
                            <?php //echo form_label('Porcentaje de Bonificacion:', 'porcentajeBonificacion', array('style'=>'color: #660066')); ?>
                            <?php echo form_label('Discount:', 'porcentajeBonificacion', array('style'=>'color: #660066')); ?>
                        </div>
                        <div class="span-6 last" style="color: #660066">
                            <span id="pfj" style="display: none">$</span>
                            <?php echo form_input(array('id'=>'montoFijoBonificacion',
                                                        'name'=>'Oferta[bonificaPorcentaje]',
                                                        'value'=>'',
                                                        'style'=>'text-align: right',
                                                        'onkeypress'=>'return just_numbers(event)',
                                                        'class'=>'')); ?><span id="fj" style="display: none">MX.</span><span id="pct" style="">%</span>
                        </div>
                    </div>
                    <div class="span-13" style="margin-bottom: 10px; color: #FF0000; font-size: 10px">
                        <!--* Este campo es opcional.-->* This field is optional.<br /> * <!--Ejem-->e.g.: www.pulzos.com, http://www.youtube.com/watch?v=cU69BalaI80.
                    </div>
                </div>
            </div>
            <!-- AQUI TERMINA ESTA PARTE -->
            <!-- BEGIN IMAGE -->
            <div id="post-image" style="display: none">
                <div class="span-13 last" style="color: #660066; margin-left: 30px; margin-top: 20px">
                    <div class="span-4">
                        <?php echo form_label('Image to load:', 'imagenCargar'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_upload(array('id'=>'imagenRuta',
                                                     'name'=>'image')); ?>
                    </div>
                </div>
            </div>
            <!-- END IMAGE -->
            <?php //if($negocio_usuario->codigoActivacion != '0'): ?>
                <div class="span-13 last" style="border-bottom: 1px solid #8D6E98; margin-bottom: 5px; text-align: right">
                    <?php echo form_submit(array('id'=>'',
                                                 'class'=>'',
                                                 'style'=>'margin-bottom: 5px; background-color: #660066; color: #FFFFFF; border: none; width: 72px; height: 20px; font-size: 11px;margin-left: 48px;cursor:pointer ',
                                                 'value'=>'Pulzar')); ?>
                </div>
            <?php //endif; ?>
        <?php echo form_close(); ?>
        
        <div class="span-13 last" style="margin-top: 10px; margin-bottom: 10px"><!-- DIV DE CALIFICACION **INICIO** -->
        </div><!-- DIV CALIFICACIONES RECIENTES **FIN**--><?php $a=0;?>
    </div><!-- DIV CONTENEDOR **FIN** -->
</div>
<input type="hidden" id="ActiveAccount" value="<?php echo $negocios->negocioImagenId; ?>" />
<!-- div overlay ** start ** -->
<!-- OVERLAY SEARCHS -->
<div class="overlay_style" id="overlay"></div>
<div class="form" id="form">
    <!-- a class="closeform" id="closeform"></a -->
    <span style="" id="value"></span>
    <h1 align="center" style="margin-top: 10px">
        <?php if($negocios->negocioImagenId == 0): ?>
            <span>
                <?php echo anchor('negocios/contract',
                                  'Contract',
                                  array('style'=>'text-decoration: none; color: #531F5B')); ?>
            </span>
            <span style="margin-left: 20px">
                Download APP
            </span>
        <?php else: ?>
            <span>
                Contract
            </span>
            <span style="margin-left: 20px">
                <?php echo anchor('negocios/download_app',
                                  'Download App',
                                  array('style'=>'text-decoration: none; color: #531F5B')); ?>
            </span>
        <?php endif; ?>
    </h1>
</div>
<!-- div overlay ** end ** -->
