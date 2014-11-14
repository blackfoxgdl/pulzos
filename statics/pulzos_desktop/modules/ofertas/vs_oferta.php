<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
    
<script type="text/javascript">
        //ICONO AL BOTON
        //$('p').css('text-align','left');
        $('input:submit').button({
            icons: { primary: "ui-icon-gear", secondary: "ui-icon-triangle-1-s" },
            text: false
        });
        
        $('form :input[type=text]').blur(function(){
           $(this).hbInput(); 
        });
        $('input[name=fijo]').click(function(){
           $('#tipoBonficacion').css('border','none');
        })
</script>
     <p>&nbsp;</p>
    <form id="frmOfer" name="frmOfer" method="post" action="modules/ofertas/ofertas.php" onsubmit="frmOferta(event, id);">
        <input id="idNegocio" name="idNegocio" type="hidden" value="<?php echo $_GET['idNegocio']; ?>" />
        <input id="idNUsuario" name="idNUsuario" type="hidden" value="<?php echo $_GET['idNUsuario']; ?>" />
        <div>
            <p> 
                <div class="div-input redondeo"><input name="titulo" type="text" id="titulo" placeholder="Offer ID: " style="outline:none;font-size:15px;" /></div>
           <div id="tipoBonficacion" style="width: 215px;margin-left: auto;margin-right: auto;margin-top: 5px;margin-bottom:5px;padding-bottom: 5px;padding-top: 5px;">
                <!-- parte de bonificacion definida por default -->
                    <input type="hidden" name="fijo" id="fijo_d" value="6" />
                    <input type="hidden" name="iva" id="ivaS" value="2" />
                <!-- parte de bonificacion definida por defualt -->
               <!--p style="margin-left: -72px">
                   <input type="radio" name="fijo" id="fijo" value="5" onclick="chked('f');" />
                
                Bonificacion Fija 
              <p>
                  <input type="radio" name="fijo" id="porcentaje" value="6" onclick="chked('p');" />
                
                Bonificacion por Porcentaje            -->
           </div>
            </p>
            <!-- div id="ivas" style="display: none"><! - - PART OF CHECK IF YOU WANT TAKE OFF IVA - ->
                <div>
                    <p>
                        <input type="radio" name="iva" id="con_iva" value="1" />
                        Con Iva Desglosado
                    </p>
                </div>
                <div>
                    <p>
                        <input type="radio" name="iva" id="sin_iva" value="2" />
                        Sin Iva Desglosado
                    </p>
                </div>
            </div --><!-- PART OF CHECK IF YOU WANT TAKE OFF IVA -->
           <!--<div class="div-input redondeo" ><input style="outline:none;" type="text" placeholder="Fee:                              $" name="consumo" id="consumo" onkeypress="return onlyNumbers(event);"/></div>
            </p> -->
                       
          <div class="div-input redondeo" ><input  name="porcentaje" type="text" id="tipoBonificacion" placeholder="Discount:                                 %" style="outline:none;" onkeypress="return onlyNumbers(event);" maxlength="2" />
          </div>
            
        </div>

        <div id="redesSoc" style="margin-top: 2%">

            <div id="facebook" style="">
                <p>
                    <img src="img/facebook.png" width="64" height="25" />
                </p>
                <p>
                    <textarea class="redondeo" style="border:none;" name="facebook" placeholder=" Message to be published on Facebook: " id="facebook" cols="38" rows="3"></textarea>
                </p>
            </div>

            <p>&nbsp;</p>

            <div>
                <p>
                    <img src="img/twitter.png" width="64" height="25" /></p>
                <p>
                    <textarea class="redondeo" style="border:none" placeholder=" Message to be published on Twitter: " name="twitter" id="twitter" cols="38" rows="3"></textarea>
                </p>
                <p>
                    <input type="submit" name="button" id="button" value="Save Offer!" />
                </p>
            </div>
       </div>
</form>
</body>
</html>
