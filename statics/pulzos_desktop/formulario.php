<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulario</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.min.js"></script>
<script type="text/javascript" src="library/js/desktop.js"></script>
<script type="text/javascript" src="library/js/form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.input_text').attr('autocomplete','off');
    if($('#bonificacion').val()=='')
    {
        $('#bonificacion').val('0.00');
    }
    
//BUSCAR OFERTAS DEL NEGOCIO
    url='library/get_ofertas.php';
    var idNegocio=$('#idNegocio').attr('value');
    $.post(url,{idNegocio:idNegocio},function(data){
        $('#porcentaje').attr('value',data);
    });
    $.post(url,{negocioId:idNegocio},function(data){
        $('#consumo').attr('value',data);
    });
    
//VERIFICAR EMAIL SI EXISTE
        $('#email').blur(function(){
            url='library/verificar_mail.php';
            email=$(this).val();
            if(email!=''){
                $.post(url,{email:email},function(data){
                    //retorna el id del usuario
                    $('#usuarioId').attr('value',data);
                    if(data==''){
                       alertas('Email Incorrecto');
                       $('#email').css('border','1px solid red').select();
                    }else{
                        $('#email').removeAttr('style');
                    }
                });
            }
        });
        
//ENVIO DE FORMULARIO
        $('#formMoney').submit(function(event)
        {
        
        if($("#email").val()==''){
                alertas('Ingresa Email');
                $('#email').removeAttr('style');
                $('#email').css('border','1px solid red').focus();
        return false;
        
             
        }else if(($('#folio').val()=='')){
                alertas('Capture el folio');
                $('#folio').removeAttr('style');
                $('#folio').css('border','1px solid red').focus();
        return false;
        
        }else if($('#monto').val()==''){
                alertas('Capture el monto');
                $('#monto').removeAttr('style');
                $('#monto').css('border','1px solid red').focus();
        return false;
        
        }else if(parseInt($('#consumo').val()-1) >= parseInt($('#monto').val()) ){
                alertas('El monto de consumo debe ser mayor');
                $('#monto').css('border','1px solid red').select();
        return false;
        }else{
            
            event.preventDefault();
            var opciones = {
                success: sendForm
            }
        $(this).ajaxSubmit(opciones);
        return false;
        }
    });
    
//CHECAR FOLIO
    $("#folio").blur(function(){
        var actionAttr='library/get_folio.php';
        var folio=$(this).attr('value');
        var idNegocio=$('#idNegocio').attr('value');
        if(folio!=''){
            $.post(actionAttr,{folio:folio,idNegocio:idNegocio}, function(data){
                //si existe el folio
                if(data=='1'){
                    alertas('El Folio ya fue capturado');
                    $('#folio').removeAttr('style');
                    $('#folio').css('border','1px solid red').select();
                }else{
                //si no exite el folio
                $('#folio').removeAttr('style');
                //$('#folio').css('border','1px solid #CDCDCD');
                }
            });
        }
    });
    
});

function montoComsumido()
{
    var porciento=$('#monto').attr('value')*parseFloat('.'+$('#porcentaje').attr('value'));
    $('#bonificacion').val(porciento.toFixed(2));
}

</script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
    

<input id="porcentaje" type="hidden" value="" />
<input id="consumo" type="hidden" value="" />

<div id="alertas"></div>
<div id="imagen"></div>
<form id="formMoney" action="library/bonificacion.php" method="post" >
  <input id="idNegocio" name="idNegocio" type="hidden" value="<?php echo $_GET['negocioId']; ?>" />
  <input id="usuarioId" name="usuarioId" type="hidden" value="" />
  <p>Email:<br /><input class="input_text" type="text" name="email" id="email"  /></p>
  <p>Folio/Factura : <br /><input class="input_text" type="text" name="folio" id="folio" /></p>
  <p>Monto consumido :<br /><input class="input_text" type="text" name="monto" id="monto" onkeypress="return onlyNumbers(event);" onkeyup="montoComsumido();"  /></p>
  <p>Bonificacion Otorgada :<br /><input class="input_text" type="text" name="bonificacion" id="bonificacion" style="border:none; background-color:#511E59;color:#FFF;cursor:default;" size="6" readonly="true" /><span> Pesos MX</span></p>
  <p><input type="submit" value="Capturar" /></p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>