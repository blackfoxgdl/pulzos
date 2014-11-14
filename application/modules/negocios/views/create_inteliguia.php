<?php
/**
 * Vista para la creacion
 * de un perfil de empresa
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package Usuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
echo doctype();
echo link_tag('statics/css/ext/noregistro.css');
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/validate/jquery.validate.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_tools/jquery.tools.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<!-- script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script -->
<script type="text/javascript">
    var geoCode = new google.maps.Geocoder();    

    function initialize()
    {
        /**
         * PARTE QUE SE USA PARA LA DECLARACION DE LAS VARIABLES A USAR
         * EN EL MAPA DE GOOGLE MAPS PARA SELECCIONAR LA DIRECCION DEL NEGOCIO
         **/
        var latLng = new google.maps.LatLng(20.673040, -103.375854);
        var map = new google.maps.Map(document.getElementById('mapa-direccion'),{
            zoom: 8,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: latLng,
            title: 'hola',
            map: map,
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
    }

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
                    updateMarkerAddress('putos');
                }
            }
        );
    }

    /**
     * ACTUALIZAR EL DATO DE LOS MARKERS
     * EN EL GOOGLE MAPS
     **/
    function updateMarkerStatus(str){
        document.getElementById('markerStatus').innerHTML = str;
    }

    /**
     * ACTUALIZA LA POSICION DEL MARCADOR PARA
     * QUE CAPTURAR SU LATITUD Y LONGITUD
     **/
    function updateMarkerPosition(latLng)
    {
        document.getElementById('info').innerHTML = [
            latLng.lat(),
            latLng.lng()
            ].join(', ');
    }

    /**
     * ACTUALIZA LA DIRECCION DEL MARCADOR PARA
     * MOSTRARLA LA USUARIO
     **/
    function updateMarkerAddress(str){
        document.getElementById('address').innerHTML = str;
    }
	
    //EVENTO ONLOAD PARA ACTIVAR LA APLICACION
    google.maps.event.addDomListener(window, 'load', initialize);
	//SELECCIONA EL SUBGIRO
	$(document).ready(function(){
    var giro = document.getElementById("giro");
	if(giro.value == 28){
			$("#subgiro").hide();
	}
	
	
	$("#giro").change(function(event){
    event.preventDefault();
    val = $(this).attr("value");
    link = $("#subgiro_link").attr('href');
    if(val==28){
            $("#subgiro").hide();
            $("#auxiliar").show();
    }else{
        $("#subgiro").show();$("#auxiliar").hide();}
    $.post(link, 
           {subgiro:val},
           function(data){
               
               $("#subgiro > option").remove();
               $.each(data, function(index, value){
                   $("#subgiro").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
           },
           "json"
    );
});

$("#pais").change(function(event){
    event.preventDefault();
    val = $(this).attr("value");
    link = $("#estado_link").attr('href');
    
    $.post(link, 
           {ciudad:val},
           function(data){
               
               $("#ciudad > option").remove();
               $.each(data, function(index, value){
                   $("#ciudad").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
           },
           "json"
    );
});    
    });

//FUNCTION WHERE VALIDATE THE REGISTER FORM
function checkData()
{
    var totalesE = 0;

    if($("#nombreUsuario").val() == '')
    {
        $("#nameCompanyM").text('Please, type the company name.').show();
        totalesE++;
    }
    else
    {
        $("#nameCompanyM").hide();
    }

    if($("#apellidoUsuario").val() == '')
    {
        $("#dirCompanyM").text('Please, type the company address.').show();
        totalesE++;
    }
    else
    {
        $("#dirCompanyM").hide();
    }

    if($("#emailUsuario").val() == '')
    {
        $("#emailUserM").text('Please, type a company email').show();
        totalesE++;
    }
    else
    {
        if(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($("#emailUsuario").val()))
        {
            urlEmail = $("#verificarEmail").attr('href');
            urlComplete = urlEmail + '/' + $("#emailUsuario").val();
            totalE = $.ajax({
                                type: "GET",
                                url: urlComplete,
                                async: false
                            }).responseText;
            if(totalE == 0)
            {
                $("#emailUserM").hide();
            }
            else
            {
                $("#emailUserM").text('This email is taken').show();
                totalesE++;
            }
        }
        else
        {
            $("#emailUserM").text('The email has a format wrong').show();
            totalesE++;
        }
    }

    if($("#emailConfirm").val() == '')
    {
        $("#emailConfirmM").text('Please, type the email again').show();
        totalesE++;
    }
    else
    {
        if(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($("#emailConfirm").val()))
        {
            if($("#emailConfirm").val() == $("#emailUsuario").val())
            {
                $("#emailConfirmM").hide();
            }
            else
            {
                $("#emailConfirmM").text('The email dont match').show();
                totalesE++;
            }
        }
        else
        {
            $("#emailConfirmM").text('The email has a format wrong').show();
            totalesE++;
        }
    }

    if($("#passwordUsuario").val() == '')
    {
        $("#passUserM").text('Please, type the password').show();
        totalesE++;
    }
    else
    {
        $("#passUserM").hide();
    }

    if($("#giro").val() == '28')
    {
        $("#categoryM").text('Please, select a category').show();
        totalesE++;
    }
    else
    {
        $("#categoryM").hide();
    }

    if($("#subgiro").val() == '148')
    {
        $("#subcategoryM").text('Please, select a subcategory').show();
        totalesE++;
    }
    else
    {
        $("#subcategoryM").hide();
    }

    if($("#ciudad").val() == '0')
    {
        $("#cityM").text('Please, select a city').show();
        totalesE++;
    }
    else
    {
        $("#cityM").hide();
    }

    if(totalesE != 0)
    {
        return false;
    }
    else
    {
        return true;
    }
}
</script>
 <?php echo anchor('negocios/create_estados', '', array('id'=>'estado_link', 'style'=>'display: none')); ?>
 <?php echo anchor('negocios/create_subgiros', '', array('id'=>'subgiro_link', 'style'=>'display: none')); ?>
<div class="container colorbody">
    <div class="span-12" style="margin-bottom: 60px" id="mapa_back1">
        <div class="prepend-1 span-11" id="text_slogan">
            <div class="span-11" style="margin-left: 100px; margin-top: 26px">
                <?php echo img(array('src'=>'statics/img/empresa_badge.png',
                                     'width'=>'242px',
                                     'height'=>'238px')); ?>
                <!--iframe width="470" height="290" src="http://www.youtube.com/embed/8KrlPgAtU2c" frameborder="0" allowfullscreen>
                </iframe -->
            </div>
        </div>
    </div>
    <div class="prepend-12"><!-- INICIA LA FORMA DE REGISTRO -->
        <div class="span-11 last" style="margin-top: -12px">
            <?php echo form_open('negocios/crear_inteliguia', array('id'=>'registro-negocio', 'onsubmit'=>'return checkData();')); ?>
                <div class="span-10 last">
                    <div class="span-4 first">
                        &nbsp;
                    </div>
                    <div class="prepend-4 first span-7 last" id="top_registro">
                        <!-- font id="aunTexto">¿A&uacute;n no estas inscrito?</font><font id="registrateTexto"> ¡Reg&iacute;strate!</font -->
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Name of business:','nombreNegocio'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_input(array('id'=>'nombreUsuario',
                                                    'class'=>'inputRegistro',
                                                    'name'=>'Negocio[negocioNombre]')); ?>
                        <br />
                        <span style="display: none; color: #FFFFFF" id="nameCompanyM"></span>
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Address:','direccionNegocio'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_input(array('id'=>'apellidoUsuario',
                                                    'class'=>'inputRegistro',
                                                    'name'=>'Negocio[negocioDireccion]')); ?>
                        <br />
                        <span style="display: none; color: #FFFFFF" id="dirCompanyM"></span>
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <?php $giros = 'id="giro"
                                    style="width:180px;"
                                    value=""' ; ?>
                    <div class="span-4 first textForm">
                        <?php echo form_label('Giro:','giro'); ?>
                    </div>
                    <div class="span-6 last">
                    	<?php krsort($giro); 
								foreach($giro as $key=>$val)
								{
    								$aux[$key] = $val;
								}
						?>
                        <?php echo form_dropdown('Negocio[negocioGiro]', $aux, '28', $giros); ?>
                        <br />
                        <span style="color: #FFFFFF; display: none" id="categoryM"></span>
                    </div>
                    <!-- ------------------------ -->
                    <?php $subgiro = 'id="subgiro"
                                    style="width:180px;"
                                    value=""'; ?>
                    <div class="span-4 first textForm">
                        <?php echo form_label('Subgiro:','subgiro'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_dropdown('Negocio[negocioSubgiro]', $subgiros, '148', $subgiro); ?>
                        <!--- - auxiliar -->
                         <?php $auxiliar = 'id="auxiliar"
                                    style="width:180px;display: block"
                                    value="" disabled="disabled" ' ; ?>
                        <?php echo form_dropdown('Negocio[negocioSubgiro]', $subgiros,'148', $auxiliar); ?>
                        <!---------------->
                        <br />
                        <span style="display: none; color: #FFFFFF" id="subcategoryM"></span>
                    </div>
                    
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('E-mail address:','emailNegocio'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_input(array('id'=>'emailUsuario',
                                                    'class'=>'inputRegistro',
                                                    'name'=>'Negocio[negocioEmail]')); ?>
                        <br />
                        <span style="display: none; color: #FFFFFF" id="emailUserM"></span>
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo anchor('negocios/checkEmailExists', '', array('id'=>'verificarEmail', 'style'=>'display: none')); ?>
                        <?php echo form_label('Confirm E-mail address:','emailConfirm'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_input(array('id'=>'emailConfirm',   
                                                    'class'=>'inputRegistro',
                                                    'name'=>'Negocio[emailConfirm]')); ?>
                        <br />
                        <span style="color: #FFFFFF; display: none" id="emailConfirmM"></span>
                    </div>
                </div>
                <div class="span-10 last separacion2">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Password: ','passwordNegocio'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_password(array('id'=>'passwordUsuario',
                                                       'class'=>'inputRegistro',
                                                       'name'=>'Negocio[password]')); ?>
                        <br />
                        <span style="display: none; color: #FFFFFF" id="passUserM"></span>
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Ciudad: ','ciudadNegocio'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php $optionsCity = 'id="ciudad",
                                              class="inputRegistro"'; ?>
                        <?php $ciudad = array('0'=>'Selecciona una Ciudad',
                                              '1740'=>'Colima',
                                              '1746'=>'Jalisco'); ?>
                        <?php echo form_dropdown('Negocio[negocioCiudad]',
                                                 $ciudad,
                                                 '',
                                                 $optionsCity); ?>
                        <br />
                        <span style="display: none; color: #FFFFFF" id="cityM"></span>
                    </div>
                </div>
                <div class="span12 last">
                    &nbsp;
                </div>
                <div class="prepend-5" style="margin-left: 10px">
                            <?php echo form_submit(array('id'=>'registro',
                                                         'class'=>'',
                                                         'name'=>'registroDeUsuario')); ?>
                </div>
                <div class="prepend-2" style="margin-top: 25px">
                    <?php echo anchor('usuarios/login',
                                      img(array('src'=>'statics/img/alreadymember.png',
                                                'width'=>'349px',
                                                'height'=>'25px')),
                                      array('style'=>'text-decoration: none')); ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div><!-- FINALIZA LA FORMA DE REGISTRO -->
</div>
