<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">

                       
               
$(document).ready(function(){ 


	mainmenu();

    //cargas generales
    //cargas
    nombre_usuario = $("#nombre-usuario-plan").text();
    $("#nombre-profile").text(nombre_usuario);
    $("div#money span").css({'color':'#996699','font-family':'Arial, Helvetica, sans-serif','font-size':'11px'});
    $('.inputs').css({'border':'1px solid #CDCDCD','width':'210px','height':'18px','font-size':'11px'});
    $('#important').css({'color':'crimson','font-family':'Arial, Helvetica, sans-serif','font-size':'9px'})
        .html('*Capture the amount consumed');
    //.html('*Capture el monto consumido sin cargos de impuestos');    
    $('.inputs input').css({'width':'209px','height':'17px','color':'#666666','border':'none'}).attr('autocomplete','off');
    if($('#bonificacion').val()=='')
    {
        $('#bonificacion').val('0.00');
    }
    if($('#iva').val() == '')
    {
        $("#iva").val('0.00');
    }
    
    //Opciones iniciales *Cuando bonificas como negocio
    if($('#negocio').attr('value')=='negocio'){
        setTimeout('$("#important").slideDown("slow");',1500);
        id= $('#idNegocio').attr('value');
        var actionAttr=$('#ofertasNegocio').attr('href');
        $.ajax({
            type: "POST",
            cache: false,
            url: actionAttr,
            data: "idOferta="+id,
            complete: function(){
                cargarOfertas(id)  
            }
        });
        
    }
    
    function cargarOfertas(id)
    {
        urlReturn=$('#ofertasNegocio').attr('href');
        urlRet=urlReturn+'/'+id;
        urlOferta=replaceAll(urlRet,' ','');
        $('#descuentos').load(urlOferta);
    }
    
});
//Cuando bonificas como negocio
$('#email').blur(function(){
    validar=$('#validarEmail').attr('href');
    email=$(this).val();
    $.post(validar,{email:email}, function(data){
        if(data!=''){
            var action=$('#formMoney').attr('action')+'/'+data;
            $('#email').parent().removeAttr('style');
            $('#email').css({'border':'1px solid #CDCDCD'});
            $('#formMoney').attr('action',action);
            $('#cargador').html("<div style='text-align: left'><img src='<?php echo base_url().'/statics/img/true.png'; ?>'  width='13' height='13'/><\div>");
        }else{
            
            $('#cargador').html("<div style='text-align: left'><img src='<?php echo base_url().'/statics/img/false.png'; ?>'  width='13' height='13'/><\div>");
        }
    });
});
                                                                                                                                                                                                                                                                                                                                                                                  //Cuando bonifica como usuario
    $("#empresas").keyup(function(event)
    {
          if($(this).attr('value')!=''){
              $('#listaE').show().addClass('autoComplete-Money');
          }else{
              $('#listaE').slideUp('slow',function(){

                 $('#contenido').fadeOut(1000);
              });
          }
          event.preventDefault();
          tempo=750;
          var actionAttr = $("#lnkEmpresa").attr("href");
          var dataAction = $(this).attr("value");
          busqueda(dataAction);  
            $.ajax({
                type: "POST",
                cache: false,
                url: actionAttr,
                data: "buscar="+dataAction,
                complete: function(){
                      setTimeout(cargarEmpresa,tempo);
                }
            });
    });
//envio de formulario
     $('#formMoney').submit(function(event)
     {
        if($('#negocio').attr('value')=='negocio'){
             if($("#email").val()==''){
                $('#eventos').html('Ingresa Email').slideDown('slow', function(){
                $('#email').parent().removeAttr('style');
                $('#email').css('border','1px solid red').focus();
                    setTimeout(function(){
                        $('#eventos').slideUp('slow');
                    },1500);
                });
            
        return false;
             }
         }
         else if($("select option:selected").attr('value')==0){
            $('#eventos').html('Elige al menos una categoria de descuento').slideDown('slow', function(){
                $('#values').css('border','1px solid red');
                setTimeout(function(){
                    $('#eventos').slideUp('slow');
                    $('input[type="submit"]').removeAttr('disabled');
               
                },2000);
            });
            return false;
         }else{ $('#values').css('border','none'); }
         
         /*if(($('#folio').val()=='')){
            $('#eventos').html('Capture el folio').slideDown('slow', function(){
                $('#folio').parent().removeAttr('style');
                $('#folio').css('border','1px solid red').focus();
                setTimeout(function(){
                    $('#eventos').slideUp('slow');
                    $('input[type="submit"]').removeAttr('disabled');
                    
                },1500);
            });
        return false;
        
        }else*/ if($('#monto').val()==''){
            $('#eventos').html('Capture el monto').slideDown('slow', function(){
                $('#monto').parent().removeAttr('style');
                $('#monto').css('border','1px solid red').focus();
                setTimeout(function(){
                    $('#eventos').slideUp('slow');
                    $('input[type="submit"]').removeAttr('disabled');
                    
                },1500);
            });
        return false;
        
        }else if($(':checkbox').is(':checked')==false){ 
            $('#eventos').html('Elige al menos una categoria de descuento').slideDown('slow', function(){
                $('#checkBox').css('border','1px solid red');
                setTimeout(function(){
                    $('#eventos').slideUp('slow');
                    $('input[type="submit"]').removeAttr('disabled');
               
                },2000);
            });
        return false;
        
        }/*else if(parseInt($('#monto').attr('value')) <= parseInt($('#consumoMin').attr('value')-1)){
            $('#eventos').html('El monto consumido debe de ser mayor').slideDown('slow', function(){
                $('#monto').parent().removeAttr('style');
                $('#monto').css('border','1px solid red').select();
                setTimeout(function(){
                    $('#eventos').slideUp('slow', function(){
                        $('input[type="submit"]').removeAttr('disabled');
                    });
                },1500);
            });
        return false;

     }*/else{
            $('input[type="submit"]').removeAttr('disabled');
            event.preventDefault();
            var opciones = {
                success: sendForm
            }
        $(this).ajaxSubmit(opciones);
        return false;
        }
        
     });

function sendForm(responseText)
{
    var textSend = eval("(" + responseText + ")");
    urlSendSocial = $("#urlSocialSend").attr('href')+'/'+textSend.idUsuario+'/'+textSend.idOferta+'/'+textSend.idBonificacion;
    $.ajax({
            url: urlSendSocial,
            type: "GET"
           });
    $('#money').slideUp('slow', function(){
        $('#noDescuentos').html('The post was written successfully').slideDown('slow'); 
    });
}

//*
//opciones generales de formularios
/*$("#folio").blur(function(){
    var actionAttr=$('#hrefFolio').attr('href');
    var folio=$(this).attr('value');
    var idNegocio=$('input[name="moneyUser[moneyNegocioId]"]').attr('value');
    $.post(actionAttr,{folio:folio,idNegocio:idNegocio}, function(data){
        //si existe el folio
        if(data=='1'){
            $('#eventos').html('El Folio ya fue capturado').slideDown('slow', function(){
                $('#folio').parent().removeAttr('style');
                $('#folio').css('border','1px solid red').select(); 
                setTimeout(function(){
                    $('#eventos').slideUp('slow', function(){  
                    });
                },2500);
            });
        }else{
        //si no exite el folio
        $('#folio').parent().removeAttr('style');
        $('#folio').css({'border':'1px solid #CDCDCD','width':'210px','height':'18px','font-size':'11px'});
           
        }
        
    }); 
})*/
function busqueda(valor)
{
    if(valor!='')
    {
        $('#listaE').each(function(){
            $(this).addClass('autoComplete-Money').show()
            .html("<div style='text-align: center'><img src='<?php echo base_url().'/statics/img/Loading.gif'; ?>'  width='20' height='20'/><\div>");
        });
    }else
    {
        $('#listaE').hide();
    }
}

function cargarEmpresa()
{
    urlReturn= $("#lnkEmpresa").attr("href");
    var texto = $("#empresas").attr("value");
    texto1=replaceAll(texto,' ','_');
    urlMain = urlReturn + '/' + texto1;
    $("#listaE").load(urlMain);
}

function montoComsumido()
{    
    if($('#statusOfer').attr('value')==6)
    {
        var inpute = $('#porcentaje').attr('value');
        var tipoOferta = $('#tipoOferta').attr('value');
        //alert('tipo: ' + tipoOferta);
        /*if(tipoOferta == '1')
        {
            $("#ivas").show();
            var iva_por = $("#monto").attr('value') / 1.16;
            var iva_desc_por = $("#monto").attr('value') - iva_por;
            $("#iva").val(iva_desc_por.toFixed(2));

            if(inpute.length < 2){
                var porciento=iva_por*parseFloat('.0'+inpute);
            }else{
                var porciento=iva_por*parseFloat('.'+inpute);
            }
        }
        else
        {
            $("#ivas").hide();
            
            if(inpute.length < 2){
                var porciento=$('#monto').attr('value')*parseFloat('.0'+inpute);
            }else{
                var porciento=$('#monto').attr('value')*parseFloat('.'+inpute);
            }
        }*/
        
        total1 = (inpute * 100)/$('#monto').val();
        totalFinal = $("#monto").val() - total1;
        //$('#bonificacion').val(porciento.toFixed(2));
        $('#bonificacion').val(totalFinal.toFixed(2));
    }
    if($('#statusOfer').attr('value')==5)
    {
        $("#ivas").hide();
        
    }
}

function onlyNumbers(evt)
{
        var keyPressed = (evt.which) ? evt.which : event.keyCode;
         return (keyPressed <= 13 || (keyPressed >= 48 && keyPressed <= 57) || keyPressed == 46);
}
function validar(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 
    patron =/[A-Za-z\s]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}
function replaceAll(t, r, c) { return t.replace(new RegExp(r, 'g'),c); }

$('select#ofertas_empresa').change(function(event){
    event.preventDefault();
    if($("select option:selected").attr('value') !=0 ){ 
        var actionAttr = $("#ofertaId").attr("href");
        var id = $("select option:selected").attr('value');

        $.post(actionAttr,{ofertaId:id}, function(data){
            $('#descuentos').html(data);
            chkOptions();
        });
    }else{ return false; }
});
function chkOptions(){
    if($('.statusOferta').attr('value')==5){
        var fijo=$('#porcentaje').attr('value')+'.00';
        $('#bonificacion').attr('value', fijo);
        
    }else if($('.statusOferta').attr('value')==6){
        $('#bonificacion').attr('value', '0.00');
    }
}

$("#movimientos_pend").click(function(event){
    event.preventDefault();
    urlMovimientos = $(this).attr('href');
    $('#texto-menu').load(urlMovimientos);
});

$("#edo_cuenta").click(function(event){
    event.preventDefault();
    urlEdoCuenta = $(this).attr('href');
    $("#texto-menu").load(urlEdoCuenta);
});
$("#cantidad-tran").click(function(event){
    event.preventDefault();
    urlCantidad = $(this).attr('href');
    $("#texto-menu").load(urlCantidad);
});

$("#informacion-tran").click(function(event){
    event.preventDefault();
    urlInformacion = $(this).attr('href');
    $("#texto-menu").load(urlInformacion);
});

function mainmenu(){
// Oculto los submenus
$(" #nav ul ").css({display: "none"});
// Defino que submenus deben estar visibles cuando se pasa el mouse por encima
$(" #nav li").hover(function(){
    $(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
    },function(){
        $(this).find('ul:first').slideUp(400);
    });
}

function eventos()
{
    $("#monto").val('');
    $("#ivas").hide();
}
</script>
<style type="text/css">
#menu {
    height:30px; 
    width:400px; 
    margin: 0px;
}
#nav { 
    list-style:none; 
}
#nav li { 
    float:left; 
	margin:0 1px;
	background:#dccedd;
	color:#660068;
}
#nav li a { 
    display:block; 
    padding:7px 10px;
    text-decoration:none; 
    color:#660068;  
}
#nav li a:hover { 
	background:#660068;
	color:#FFFFFF;
	
}

/* Submenu */
#nav ul.submenu { 
    border:1px solid; 
    position:absolute; 
    list-style:none; 
}
#nav ul.submenu li { 
    float:none;
    margin-left: -20px;
    border-bottom:1px solid #FFFFFF; 
    width:98px;
}


</style>
<div style="display: none">
    <div id="nombre-usuario-plan">
        Mi cartera
    </div>
</div>

<?php
echo anchor('money/guardar_bonificacion_usuario/','',array('id'=>'sendForm','style'=>'display:none')); 
echo anchor('money/buscar_negocio','', array('id'=>'lnkEmpresa','style'=>'display:none'));
echo anchor('money/index/'.$this->session->userdata('id'),'',array('id'=>'index','style'=>'display:none')); 
echo anchor('money/buscar_oferta_negocio','',array('id'=>'ofertasNegocio','style'=>'display:none')); 
echo anchor('money/validarEmail','',array('id'=>'validarEmail','style'=>'display:none'));
echo anchor('money/validar_folio','',array('id'=>'hrefFolio','style'=>'display:none'));
echo anchor('money/oferta_busqueda_Id','',array('id'=>'ofertaId', 'style'=>'display:none'));
?>
<div id="eventos" class="span-12 redondeo-div-inferior" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#FFFFFF;display:none;text-align:center;margin-top: 0px;background-color:#996699;width: 370px;height: 25px;line-height:24px;margin-left:85px"></div>

<!--Inicio Seccion de Negocio-->

<?php
if(isset($negocio)): ?>
<div class="span-12" id="money" style="margin-top: 30px;margin-left: 20px; margin-bottom: 30px">
    <?php echo form_open('money/guardar_bonificacion_usuario/', array('id'=>'formMoney')); ?>
    <?php echo anchor('redessociales/post_social_media_2', '', array('style'=>'display: none', 'id'=>'urlSocialSend')); ?>
    <input id="negocio" type="hidden" name="moneyUser[moneyRuta]" value="negocio" />
    <input id="idNegocio" type="hidden" name="moneyUser[moneyNegocioId]" value="<?php echo $this->session->userdata('idN'); ?>" /> 
    <div class="span-12">
        <div class="span-6 last">
        <span>User Email:</span>
        <div class="inputs">
            <input id="email" type="text" name="" autocomplete="off" onBlur="return validarMail();"/>
        </div>
        </div>
        <div id="cargador" class="span-4" style="margin-top: 20px;margin-left: -15px"></div>
        
    </div>
  <div id="contenido">
  <div id="idHidden"></div>
            <div class="span-12" style="margin-top: 10px">
                <span>Select Offer:</span>
                <div class="" id="values">
                    <?php $ofertas_registro = get_all_data_offerts($this->session->userdata('idN')); ?>
                    <?php //var_dump($ofertas_registro); ?>
                    <select  name="moneyUser[moneyBackOfertaId]" id="ofertas_empresa" onchange="eventos();">
                        <option value="0" selected="selected">Selecciona una oferta</option>
                        <?php foreach($ofertas_registro as $data): ?>
                            <option value="<?php echo $data->ofertaId; ?>">
                                <?php echo $data->planDescripcion; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!--div class="span-12" style="margin-top: 10px">
                <span>Folio/Factura :</span>
                <div class="inputs">
                    <input type="text" name="moneyUser[moneyFolioFactura]" id="folio" />
                </div>
            </div-->
            <input type="hidden" name="moneyUser[moneyFolioFactura]" value="0" id="" />

            <div id="descuentos" class="span-10" style="margin-top:10px;margin-bottom: 10px;display:none;">
                
            </div>
        
            <div class="span-12">
                <span>Purchase amount:</span>
                <div id="important" style="display:none"></div>
                <div class="span-10" style="margin-top: 5px">
                    <div class="span-1" style="margin-right: -20px;margin-left: -2px">$</div>
                    <div class="span-5 inputs">
                        <input type="text" name="moneyUser[moneyMontoConsumo]" id="monto" onKeyPress="return onlyNumbers(event);" onKeyUp="montoComsumido();"/>
                    </div>
                </div>
            </div>
            <div class="span-12" style="margin-top: 10px; display: none" id="ivas">
                <span> IVA : </span>$
                <input id="iva" name="iva" value="" style="border: none;background-color: #F0F0F0;color:#666666;" size="6" /><span> Pesos MX</span>
            </div>
            <div class="span-12" style="margin-top: 10px">
                        <span>Total:</span>$ 
                        <input id="bonificacion" name="moneyUser[moneyBackOtorgado]" value="" style="border: none;background-color: #F0F0F0;color:#666666;" size="6" /><span> USD</span>
            </div>
  <div class="span-12" id="boton" style="margin-top:30px;background-color: #660066; width: 72px; height: 20px;font-size: 11px;margin-left:200px;text-align:center"> 
         <?php echo form_submit(array('id'=>'',
                                             'class'=>'',
                                             'style'=>'border: none;background-color: #660066;cursor:pointer;color: #FFFFFF;',
                                             'value'=>'Pulzar')); ?>
  </div>
                    
         <?php echo form_close(); ?>
        
        
              
    </div>
</div>


<!--Fin de Seccion de Negocio-->

<!-- Inicio Seccion de usuario--><?php    
else: 


if(!empty($checkSocial)):
    
    if($checkSocial->tokenFacebook!='' || $checkSocial->twitter_oauth!='' && $checkSocial->twitter_oauth_secret!=''): ?>

    <div class="span-12" id="money" style="margin-top: 1px;margin-left: 20px; margin-bottom: 30px">

<div class="span-14" style="margin-left: -20px">
    <div id="menu">
        <ul id="nav">
            <li style="width: 110px">
                <a href="http://www.pulzos.com/redessociales/intermedio.php?id=<?php echo base64_encode($this->session->userdata('id')); ?>" style="text-decoration: none;font-family: Arial, Helvetica, sans-serif;"><!-- http://www.pulzos.com/inicio.php/redessociales/redes_sociales_usuarios/ -->
                    Redes Sociales
                </a>
            </li>
            <li>
                <?php echo anchor('transacciones/movimientos_pendientes/'.$this->session->userdata('id'),
                                  'Movimientos', 
                                   array('style'=>' text-decoration: none; margin-left: 0px', 'id'=>'movimientos_pend')); ?>
            </li>
            <li>
                <?php echo anchor('transacciones/movimientos_cuenta/'.$this->session->userdata('id'),
                                  'Edo. Cuenta',
                                   array('style'=>'text-decoration: none; margin-left: 0px', 'id'=>'edo_cuenta')); ?>

            </li>
            <li style="color: #FFFFFF; text-decoration: none; margin-left: 0px">
            	
                <a style="text-decoration: none; margin-left: 0p">Retiros</a>
                    <ul class="submenu">
                        <li style="border-bottom: 1px solid #FFFFFF">
                            <?php echo anchor('transacciones/transfer',
                                              'Informacion',
                                              array('style'=>'text-decoration: none; ', 'id'=>'informacion-tran')); ?>
                        </li>
                        <li>
                            <?php echo anchor('transacciones/retirar_recursos/',
                                              'Cantidad',
                                              array('style'=>'text-decoration: none; ', 'id'=>'cantidad-tran')); ?>
                        </li>
                    </ul>
            </li>
        </ul>
    </div>
</div>
            <div class="span-14" style="margin-bottom: 35px">

                <div class="prepend-10" style="margin-bottom:5px;">
                </div>
                <div class="span-12">
                <?php //Manejo de el dinero que tenga pendiente (status 1)
                    if($totalPendiente == false)
                    {
                        echo '<div class="span-2 last" style="color:red"><div class="span-1 last" style="font-size:18px;margin-right:1px;">$ 0.</div><div class="span-1 last" style="font-size:12px;margin-top:6px">00</div><div class="span-3" style="font-size:16px;margin-top:2px"></div></div><div style="font-size:16px;color: rgb(102, 102, 102);">Pesos MX</div>';
                    }else{
                        echo '<div style="color:#FF9933;font-size:15px;">$ '.number_format($totalPendiente->totalPendiente, 2, '.', '').'  Pesos MX pendientes</div>';
                    }
                ?>
                <br />
                <?php //Manejo de el dinero que el negocio a depositado (status 3)
                    if($totalGanado == false)
                    {
                        echo '<div class="span-2 last" style="color:red"><div class="span-1 last" style="font-size:18px;margin-right:1px;">$ 0.</div><div class="span-1 last" style="font-size:12px;margin-top:6px">00</div><div class="span-3" style="font-size:16px;margin-top:2px"></div></div><div style="font-size:16px;color: #FF0000;">Pesos MX disponibles</div>';
                    }else{
						echo '<div style="color:#85a250;font-size:15px;">$ '.number_format($totalGanado->moneyTotalGanadoUsuario, 2, '.', '').'  Pesos MX disponibles</div>';
                    }
                ?>
                </div>
            </div>
   

            <div class="span-12">
                <span>Buscar negocio:</span>
                <div class="inputs">
                    <input id="empresas" type="text" autocomplete="off" onKeyPress="return validar(event);"/>
                </div>
              
            </div>


  <?php echo form_open('money/guardar_bonificacion_usuario/'.$this->session->userdata('id'), array('id'=>'formMoney')); ?>
  <div id="contenido" style="display: none;">
  <div id="idHidden"></div>
            <div class="span-12" style="margin-top: 10px">
            <span>Ofertas del negocio:</span>
                <div class="" id="values">
                    <select name="moneyUser[moneyBackOfertaId]" id="ofertas_empresa" onchange="eventos();">
                    </select>
                </div>
            </div>
            <div class="span-12" style="margin-top: 10px">
                <span>Folio/Factura :</span>
                <div class="inputs">
                    <input type="text" name="moneyUser[moneyFolioFactura]" id="folio" />
                </div>
            </div>

            <div id="descuentos" class="span-10" style="margin-top:10px;margin-bottom: 10px;display:none;">
                
            </div>
        
            <div class="span-12">
                <span>Monto consumido :</span>
                <div id="important" style="display:none;"></div>
                <div class="span-10" style="margin-top: 5px">
                    <div class="span-1" style="margin-right: -20px;margin-left: -2px">$</div>
                    <div class="span-5 inputs">
                        <input type="text" name="moneyUser[moneyMontoConsumo]" id="monto" onKeyPress="return onlyNumbers(event);" onKeyUp="montoComsumido();"/>
                    </div>
                </div>
            </div>
            <div class="span-12" style="margin-top: 10px; display: none" id="ivas">
                <span> IVA : </span>$
                <input id="iva" name="iva" value="" style="border: none;background-color: #F0F0F0;color:#666666;" size="6" /><span> Pesos MX</span>
            </div>
            <div class="span-12" style="margin-top: 10px">
                        <span>Bonificacion Otorgada :</span>$ 
                        <input id="bonificacion" name="moneyUser[moneyBackOtorgado]" value="" style="border: none;background-color: #F0F0F0;color:#666666;cursor:default;" size="6" readonly="true" /><span> Pesos MX</span>
            </div>
        
        <div id="boton">  
        <?php echo form_submit(array('id'=>'',
                                             'class'=>'',
                                             'style'=>'margin-top:30px;border: none; color: #FFFFFF; background-color: #660066; width: 72px; height: 20px;font-size: 11px;margin-left:200px;cursor:pointer',
                                             'value'=>'Pulzar')); ?>
  
       </div>
                    
        <?php echo form_close(); ?>
        <p>&nbsp;</p>
   </div>
</div>
<?php else: ?>
            <div class="prepend-4 last redSocial" style="margin-top: 50px"> 
                                <a href="http://www.pulzos.com/redessociales/intermedio.php?id=<?php echo base64_encode($this->session->userdata('id')); ?>" style="text-decoration: none;color:#660068;font-family: Arial, Helvetica, sans-serif;font-size: 18px;">
                                    Activa tus Redes Sociales
                                </a>
            </div>
<?php endif; ?>
<?php else: ?>
        <div class="prepend-4 last redSocial" style="margin-top: 50px"> 
                <a href="http://www.pulzos.com/redessociales/intermedio.php?id=<?php echo base64_encode($this->session->userdata('id')); ?>" style="text-decoration: none;color:#660068;font-family: Arial, Helvetica, sans-serif;font-size: 18px;">
                                    Activa tus Redes Sociales
                </a> 
        </div>
 
<?php endif; ?>
<div id="listaE" class="span-6"></div>
<?php
endif;
?>
<!--Fin de seccion de usuario-->
<div class="span-12 redondeo-menu" id="noDescuentos" style="display:none;margin-top: 20px;color:#FFFFFF;text-align: center;background-color:#996699;margin-left: 40px"></div>
