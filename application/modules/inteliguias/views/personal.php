<?php
/**
 * Demo view for personal functionality
 **/
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
var geoCode = new google.maps.Geocoder();

$(document).ready(function(){
 									if($('#latitud').attr('value') != '' && $('#longitud').attr('value') != '')
									{ 
										var latLng = new google.maps.LatLng($('#latitud').attr('value'),  $('#longitud').attr('value'));
									}
									else
									{ 
										var latLng = new google.maps.LatLng(20.673040, -103.375854);
									}

                                    var myOptions = {
                                        zoom: 15,
                                        center: latLng,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                    };
                                    var map = new google.maps.Map($(".mapa").get(0), myOptions);
/*                                    var markerImage = new google.maps.MarkerImage('http://www.gettyicons.com/free-icons/108/gis-gps/png/24/needle_left_yellow_2_24.png',
                                                      new google.maps.Size(40, 40),
                                                      new google.maps.Point(0, 0),
                                                      new google.maps.Point(0, 32));*/
                                    var marker = new google.maps.Marker({
                                            position: latLng,
                                            map: map,
                                            //icon: markerImage
                                    });     
                               
        });
        

</script>
<div class="content-primary"  data-fullscreen="true" data-dom-cache="true" style="text-align:center">
            <?php echo img(array('src'=>get_avatar_negocios($data->negocioId),
                                 'id'=>'img-follow',
                                 'width'=>'250px',
                                 'style'=>'display: bolck')); ?>
            <br />
            <?php echo $data->negocioNombre; ?><br/>
            <?php echo $data->negocioDescripcion; ?><br/>
            <?php //echo '<a href="mailto:'.$data->negocioEmail.'">'.$data->negocioEmail.'</a>'; ?><br />
            <?php echo '<a href="tel:'.$data->negocioTelefono.'">'.$data->negocioTelefono.'</a>'; ?><br />
            <?php echo $data->negocioSitioWeb; ?><br />
            <div class="" id="mapa-pulzos"></div>
            <?php echo form_input(array('id'=>'latitud',
                                               'class'=>'latitud',
                                               'style'=>'display:none',
											   'value'=>$data->negocioLatitud
											   )); ?>
            <?php echo form_input(array('id'=>'longitud',
                                                'class'=>'longitud',
                                                'style'=>'display:none',
						                        'value'=>$data->negocioLongitud)); ?> 
        <div style="text-align:center;height:auto;width: auto;">
            <div class="mapa" style="width: 250px; height: 150px; margin-top:40px; margin-left: auto; margin-right: auto;"></div>
        </div>
</div> 
