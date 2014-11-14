<!DOCTYPE html>
<html>

<head>
</head>
<body>
<?php 
include('get_config.php');
?>
<script type="text/javascript" src="js/mapGoogle.js"></script>
<script type="text/javascript">
    
//VARIABLES GENERALES
    $('input:submit').button();
    idNegocio=$('#idNegocio').attr('value');
    $('a').css({'text-align':'left'});
    $('span').css({'color':'#666666','margin-left':'10px'});
    $('p').css('color','#666666');
    var icons = {header: "ui-icon-circle-arrow-e", headerSelected: "ui-icon-circle-arrow-s" };   
/*
 *
 *SECCION DE EMPLEADOS
 *
 */
$.get('modules/cuenta/get_config.php',{empleados:idNegocio}, function(empleados){
                $('#cAcord').html(empleados);
                
                $("#accordion, #mostrador").accordion({
                
            autoHeight: false,
            navigation: true, 
            collapsible: true,
            animated: '',
            active: false, 
            minHeight: 140}); 
       $('#editarAccordion').animate({
            opacity:'1'
       });         
            });     
/*
 *
 *SECCION DE OFERTAS
 *
 */     
//opciones para ofertas activas-inactivas             
    $('.cb-slider').chkbntOf();
    initCheckBoxes();
//botton drop oferta
   $('.erase-btn-bn').click(function(){
        var id=$(this).attr('id');
        $('#alert-dialog').dropUpOf({
                                    update:true,
                                    id:id,
                                    change:'0',
                                    dialog:'Deseas eliminar la Oferta?',
                                    url:'modules/cuenta/get_config.php'
                            });
   });
   
initMap();
</script>


<div id="editarAccordion" style="margin-left:3%;margin-right: 3%;margin-top: 2%;font-size:95%;width:92%;opacity:0;">    
    <div id="accordion"  style="height:80%;text-align: left;">
           <h3><a>Datos del negocio</a></h3>
           <div id="datosNegocio" style="height:250px;display:none;">
               <form id="formDatos" action="modules/cuenta/get_config.php" method="post" onsubmit="frmCuenta(event, id);">
                    <input type="hidden" name="datosNegocio[idNegocio]" id="idNegocio" value="<?php echo $idNegocio; ?>" />
                    <div>
                        <p>Nombre:   
                            <input class="div-input redondeo input-conf" type="text" name="datosNegocio[nombre]" id="nombre" value="<?php echo $info->negocioNombre; ?>" style="border: 1px solid #A8A8A8;" />
                        </p>
                        <p>Direccion:
                            <input class="div-input redondeo input-conf" type="text" name="datosNegocio[direccion]" id="direccion" value="<?php echo $info->negocioDireccion; ?>" style="border: 1px solid #A8A8A8;"/>
                        </p>

                        <p>Descripcion:</p>
                        <p>
                            <textarea class="input-conf redondeo" name="datosNegocio[descripcion]" id="descripcion" cols="28" rows="4" value="<?php echo $info->negocioDescripcion; ?> "></textarea>
                        </p>
                        <p>Email:

                            <input class="div-input redondeo input-conf" type="text" name="datosNegocio[email]" id="email" value="<?php echo $info->negocioEmail; ?>" style="border: 1px solid #A8A8A8;"/>
                            </p>
                        <p>Telefono:

                            <input class="div-input redondeo input-conf" type="text" name="datosNegocio[telefono]" id="telefono" value="<?php echo $info->negocioTelefono; ?>" style="border: 1px solid #A8A8A8;"/>
                        </p>
                        <p>Sitio web:
                            <input class="div-input redondeo input-conf" type="text" name="datosNegocio[sitioweb]" id="sitioweb" value="<?php echo $info->negocioSitioWeb; ?>" style="border: 1px solid #A8A8A8;"/>
                        </p>
                        <p>
                            <input type="submit" value="Guardar" />
                        </p>
                    </div>
            </form>
      </div>
           <h3 id="ubicacion"><a>Ubicación</a></h3>
           <form id="formUbicacion" action="modules/cuenta/get_config.php" method="post" onsubmit="frmCuenta(event, id);">
              <input type="hidden" name="geo[idN]" id="idNegocio" value="<?php echo $_GET['idNegocio']; ?>"  />
              <input type="hidden" name="geo[latitud]" id="latitud" value="" />
              <input type="hidden" name="geo[longitud]" id="longitud" value="" />
              <img id="mapImagen" src="img/pin.png" style="display: none;"/>
              
                  <div id="mapa-pulzos" style="width:430px;height:330px;margin-left:auto;margin-right:auto;"></div>
                     <p style="text-align:center;">
                      <input type="submit" name="button" id="btnUbicacion" value="Actualizar Ubicación" />
                    </p>
          </form>
            <h3><a>Offer:</a></h3>
        <div id="Promociones">
<?php       if(empty($ofertas)){ echo '<span>No Tienes Ninguna promocion Actualmente</span>'; }else{
                foreach($ofertas as $oferta){
                    //ofertas activadas
                    if($oferta['ofertaActivacion']==1){
?>                  <!--ofertas activas-->
                        <div id="activadas" class="oferta-activada">
                            <h4><?php echo $oferta['nombreOferta']; ?></h4>
                            <img id="<?php echo $oferta['ofertaId']; ?>" class="erase-btn-bn" src="img/erase.png" style="float:right;position:relative;height:20px;width:20px;margin-top:-58px" />
                            <!--<br/>
                                <span>Consumo Minimo: $</span>
                                <?php //echo $oferta['consumoMinimo']; ?> 
                                Pesos
                                
                            <br/><br/>-->
                                <span>Discount: </span>
                                <?php echo $oferta['bonificaPorcentaje']; ?>
                                %

                            <br/><br/>
                                <span>Message to be published on Facebook: </span>
                                <?php echo $oferta['mensajeFacebook']; ?>

                            <br/><br/>
                                <span>Message to be published on Twitter:</span> 
                                <?php echo $oferta['mensajeTwitter']; ?> 
                                
                            <br/>
                           
                            <div  class="cb-bg"><div id="<?php echo $oferta['ofertaId']; ?>" class="cb-slider" cb-status="<?php echo $oferta['ofertaActivacion']; ?>"></div></div>
                        </div>
 <?php              //ofertas desactivadas
                    }else if($oferta['ofertaActivacion']==2){
?>                   <!-- Ofertas desactivadas-->
                        <div id="desactivadas" class="oferta-desactivada">
                            <h4><?php echo $oferta['nombreOferta']; ?></h4>
                            <img id="<?php echo $oferta['ofertaId']; ?>" class="erase-btn-bn" src="img/erase.png" style="float:right;position:relative;height:20px;width:20px;margin-top:-58px" />
                            <!--<br/>
                                <span>Consumo Minimo: $</span>
                                <?php echo $oferta['consumoMinimo']; ?> 
                                Pesos
                        <br/><br/>-->
                                <span>Discount: </span>
                                <?php echo $oferta['bonificaPorcentaje']; ?>
                                %

                        <br/><br/>
                                <span>Message to be published on Facebook: </span>
                                <?php echo $oferta['mensajeFacebook']; ?>

                        <br/><br/>
                                <span>Message to be published on Twitter:</span> 
                                <?php echo $oferta['mensajeTwitter']; ?> 
                        <br/>
                        <div class="cb-bg"><div id="<?php echo $oferta['ofertaId']; ?>"  class="cb-slider" cb-status="<?php echo $oferta['ofertaActivacion']; ?>"></div></div>
                        </div>
<?php               }
                }
            } 
?>          
        </div>
            <h3 id="empleadosE"><a>Empleados:</a></h3>
                <div>
                    <form id="frmMostrador" method="post" action="modules/cuenta/get_config.php" onsubmit="frmMstrdor(event, id)" >
                        <p>&nbsp;</p>
                        <p>
                        <input type="hidden" name="mostrador[idNegocio]" id="idNegocio" value="<?php echo $_REQUEST['idNegocio']; ?>" />
                        <input type="hidden" name="mostrador[idUsuarioPulzos]" id="uPulzos" value="" />
                        <div id="correoE" class="div-input redondeo input-conf"><input type="text" name="mostrador[email]" placeholder="Email :" id="correo" onblur="chkMailPriv();" /></div>
                        </p>
                        <p>

                            <div class="div-input redondeo input-conf"><input type="password" name="mostrador[password]" placeholder="Password:" id="pass" /></div>
                        </p>
                        <p>

                            <div class="div-input redondeo input-conf"><input type="password" name="mostrador[confPass]" placeholder="Confirma Password: " id="confPass" /></div>
                        </p>
                        <p>&nbsp;</p>
                        <div style="width:233px;margin-left:auto;margin-right: auto">
                        <input type="submit" name="button" id="button" value="Registrar" />
                        </div>
                        </p>
                     </form><p>&nbsp;</p>

                <div id="mostrador" style="margin-left: auto;margin-right: auto;margin-top:2%;width:75%">
                    <h3><a><strong>Mostrador</strong></a></h3>
                    <div id="contA">
                        <div id="cAcord" style="margin-left:auto;margin-right:auto"></div>
                    </div>
                </div>
                </div>
    </div>


</div>

</body>
</html>
