<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulario</title>
<script type="text/javascript" src="js/desktop.js"></script>
</head>
<body>
<?php 

if($_REQUEST['porcentaje']!=''){
?>
<script type="text/javascript">
    $("input:submit").button();
    
    $('form :input[type=text]').blur(function(){
           $(this).hbInput(); 
    });
    
    $('select').selectmenu({style:'dropdown', maxHeight: 150, menuWidth: 213 });
    
    var idmos=$('#mostradorId').val();
    $('input#sEmp').attr('value',idmos);

//Agregar email
    $('#otroEmail').click(function(){
        var emailDiv=$("div #dvEmail").length+1;
       
        $('#muchsMails').append('<p><div id="dvEmail" style="margin-top: 15px" class="div-input redondeo">\n\
                                        <input class="input_text" placeholder="Correo Electronico:" type="text" name="email['+emailDiv+']" id="email'+emailDiv+'" onblur="chkMail(this.id)" />\n\
                                        <img id="erase'+emailDiv+'" class="erase-btn-bn" src="img/erase.png" onclick="eraseMail(event, '+emailDiv+')" />\n\
                                </div></p>');
        
        if($('#bonificacion').attr('value')!='0.00'){
            var valorBonificacion=$('#bonificacion').attr('value');
            var division=valorBonificacion/emailDiv;
            
            $('#bonificacion').val(division.toFixed(2));
        }
        
    });
//Borrar email's
$('#erase').click(function(event){
    event.preventDefault();
    $(this).remove();
});
   
</script>
<br/>
<?php

$r=$_REQUEST['ofer'];
$j=json_decode($r, true);

if(isset($_REQUEST['mostr'])){
    $mo=$_REQUEST['mostr'];
    $m=json_decode($mo, true);
}
 ?>
<div style="margin-top: 4%">
    <input id="porcentaje" type="hidden" value="<?php echo $_REQUEST['porcentaje']; ?> " />
    <input id="consumo" type="hidden" value="<?php echo $_REQUEST['consumo']; ?>" />
    <input id="status" type="hidden" value="" />
    <input id="tipoStatus" type="hidden" value="" />
    
    <form id="formMoney" action="modules/bonificacion/bonificacion_aceptada.php" method="post" onsubmit="frmMoney(event);" >
        <input id="idNegocio" name="idNegocio" type="hidden" value="<?php echo $_REQUEST['idNegocio']; ?>" />
        <input id="usuarioId" name="usuarioId" type="hidden" value="" />
        <input id="idEmpleado" name="idEmpleado" type="hidden" value="" />

<?php if(isset($m)){ ?>
    
        <div style="margin-left:auto;margin-right: auto;width:213px;height:33px;">
        <select id="sEmp" name="empleado" style="width: 213px;" onchange="empleadoSelect($('select#sEmp option:selected').attr('class'));" >
                    <option value="nada" selected="true">Elige Empleado</option>
                    <?php foreach($m as $p){
                            echo '<option class="'.$p['idUsuarioPulzos'].'" value='.$p['idusuarios_mostrador'].'>'.$p['nCompleto'].'</option>';  
                          }
                    ?>
        </select>
        </div>
        
<?php }else{ ?> 
        <input id="sEmp" type="hidden" value="nada" name="empleado" />
<?php } ?>         
<!--       </p><div id="otroEmail" style="margin-right: 0px;cursor: pointer;width: 87px;margin-left:auto;margin-right: auto;">Agregar Email</div>-->
        <br/><div id="dvEmail" style="margin-top: 15px" class="div-input redondeo"><input class="input_text" placeholder="Email: " type="text" name="email[0]" id="email" onblur="chkMail(this.id)" /></div>
        <div id="muchsMails"></div>
        <p>
        <br/>
        </p>
            <div id="selecta" class="div-input redondeo" style="background-color: #511E59;">

                <select id="sOfer" name="oferta" style="width: 213px;" onchange="ofertaSelect($('select#sOfer option:selected').attr('value'), this.id);" >
                    <option value="false" selected="true">Select Offer</option>
                    <?php foreach($j as $h){
                            echo '<option value='.$h['ofertaId'].'>'.$h['planDescripcion'].'</option>';  
                          } ?>
                </select>
                
            </div>
        </p>
<!--        <p><br /><div class="div-input redondeo">--><input class="input_text" placeholder="Ticket Number / Folio:" type="hidden" value="0" name="folio" id="folio" /><!--</div></p> -->
        <p><br /><div class="div-input redondeo"><input class="input_text" placeholder="Purchase amount :" type="text" name="monto" id="monto" onkeypress="return onlyNumbers(event);" onkeyup="montoComsumido();" /></div></p>
        <p style="display: none" id="iva_show"><br /><input class="input_text" placeholder="IVA:" type="text" name="iva" id="iva" value="0.00" style="border:none; background-color:#511E59;color:#FFF;cursor:default;width: 60px" size="6" readonly="true" /><span> IVA</span></p>
        <p><br /><input class="input_text" placeholder="Bonificacion Otorgada:" type="text" name="bonificacion" id="bonificacion" value="0.00" style="border:none; background-color:#511E59;color:#FFF;cursor:default;width: 60px" size="6" readonly="true" /><span> TOTAL</span></p>
        <p><input type="submit" value="Send" /></p>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
<?php 
}else{
    echo "<div style='margin-top:35px;'>NO TIENES NINGUNA PROMOCION ACTIVA ACTUALMENTE</div>";
}
?>
</body>
</html>
