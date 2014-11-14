/* 
 * Functiones Generales
 */
//document.write('<script src="js/jquery.js" type="text/javascript"><\/script>');
//document.write('<script src="js/form.js" type="text/javascript"><\/script>');
//document.write('<script src="js/notificaciones.js" type="text/javascript"><\/script>');
//document.write('<script src="js/getConector.js" type="text/javascript"><\/script>');
//document.write('<script src="js/jquery-ui-1.8.16.min.js" type="text/javascript"><\/script>');


//ALERTAS GENERALES
function inicio(){
      $('#getHome').fadeOut('slow');
      $('#imagen').show();
//    setInterval(function () {
//    var statusElem = document.getElementById('status');
//    statusElem.className = navigator.onLine ? 'online' : 'offline';
//    statusElem.innerHTML = navigator.onLine ? 'online' : 'offline';  
//    }, 250);
        setTimeout(function(){
                $('#contenido').load('modules/home.html', function(responseText, textStatus, XMLHttpRequest){
                        if(textStatus=='success'){
                            $('.home').fadeIn('1000', function(){
                            });
                        }else if(textStatus=='error'){
                            
                            $("#contenido").html('<div id="circleG"> <div id="circleG_1" class="circleG" ></div><div id="circleG_2" class="circleG"></div><div id="circleG_3" class="circleG"></div><p>&nbsp;</p><span style="font-family: Verdana, Geneva, sans-serif;font-size: 20px;margin-left:15px;"><span></div>');
                            setTimeout(function(){
                                reLoad();
                            },3000);
                        }
                        
                });
            
        },180);    
}
//Inicio para los empleados
function inicioA(){ 
    $('#getHome').fadeOut('slow');
    $('#imagen').show();
   
    setTimeout(function(){
                $('#contenido').load('modules/home.html', function(responseText, textStatus, XMLHttpRequest){
                        if(textStatus=='success'){
                            $('#inicio, #mensaje, #oferta, #editarCuenta, #privilegios, #depositos').hide();
                            $('#registro, #bonificacion').removeClass('img-principales').attr({'width':'100px','height':'100px','style':'margin-left:10%;margin-right:10%;cursor:pointer;margin-top:55px'});
                            //$('#depositos').removeClass('img-principales').attr({'width':'350px','height':'350px'});
                            $('.home').fadeIn('1000', function(){
                            });
                        }else if(textStatus=='error'){
                          
                            $("#contenido").html('<div id="circleG"> <div id="circleG_1" class="circleG" ></div><div id="circleG_2" class="circleG"></div><div id="circleG_3" class="circleG"></div><p>&nbsp;</p><span style="font-family: Verdana, Geneva, sans-serif;font-size: 20px;margin-left:15px;"><span></div>');
                            setTimeout(function(){
                                //reLoad();
                            },3000);
                        }
                        
                });
            
        },180);
}
function reLoad(){
    $('#getHome').fadeOut('slow');
    $('#imagen').trigger('click');
}
function alertas(alerta){
    $('#alertas').html('<strong>'+alerta+'</strong>')
                    .slideDown('slow', function(){
              setTimeout(function(){
                    $('#alertas').slideUp('slow', function(){
                    });
              },1500);  
    });
}
function alertaRedirect(msj){
    $('#alertas').html('<strong>'+msj+'</strong>')
                    .slideDown('slow', function(){
                    setTimeout(function(){
                    $('#alertas').slideUp('slow', function(){
                       if($('#mostradorId').attr('value')==undefined){
                           inicio();    
                       }else{
                           inicioA();
                       }
                       
                    });
              },1500);  
    });
}
//ENVIO DE FORMULARIOS EN GENERAL!!!
function sndForms(event, id){
     event.preventDefault();
     var opciones = {
                success: sendFormOferta
            }
        $('#'+id).ajaxSubmit(opciones);
		return false;
	}
//ONLY NUMBRERS	
function onlyNumbers(evt)
{
        var keyPressed = (evt.which) ? evt.which : event.keyCode
        return (keyPressed <= 13 || (keyPressed >= 48 && keyPressed <= 57) || keyPressed == 46);
}
//REMPLAZO DE CADENA
function remplazo(t, r, c) 
{ 
    return t.replace(new RegExp(r, 'g'),c); 
}
function validar(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 
    patron =/[A-Za-z\s]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}
//PESTAÑA DE HOME EN TEMPLATE
function menuP(action){
    if(action=="over"){
        $('#getHome').stop().animate({'marginLeft':'1%'},200);
    }else if(action=='out'){
        $('#getHome').stop().animate({'marginLeft':'0%'},200);
    }
    else if(action=='click'){
        reLoad();
    }
    
}
//VALIDA FORMATO DE MAIL
function validarMail(e){
    if(e != ''){
        if (/^((([a-zA-Z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/.test(e)){
        //alertas('mail Correcto');
        return (true);
        }else {
            //$().attr('style','border: 1px solid red');
            alertas('El Correo Electronico no tiene formato valido');
        return false;
        }
    }
}

var Base64 = {

	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;

		input = Base64._utf8_encode(input);

		while (i < input.length) {

			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

		}

		return output;
	},

	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = Base64._utf8_decode(output);

		return output;

	},

	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}

}

/**
*
*OPCIONES DE FORMULARIO DE INGRESO
*
**/ 
function frmIngreso(event, id){
    event.preventDefault();
     var opciones = {
                success: sendFormRedes
            }
        $('#'+id).ajaxSubmit(opciones);
        return false;
}

/**
*
*OPCIONES DE HOME PANTALLA PRINCIPAL
*
**/ 
function home(href){
        $('#getHome').fadeIn('slow');
	var idNegocio=$('#negocioId').attr('value');
        var idNegocioUsuario=$('#negocioUsuario').attr('value');
	switch(href){
	    case 'inicio':
                $.post('modules/inicio/inicio.php',{idNegocio:idNegocio},function(data){
                    $('#contenido').html(data);
                });
                
	    break;
		
	    case 'bonificacion':
                        $.get('library/get_ofertas.php',{idNegocio:idNegocio},function(porcentaje){
                            $.get('library/get_ofertas.php',{negocioId:idNegocio},function(consumo){ 
                                $.get('library/get_ofertas.php',{idNStatus:idNegocio},function(status){ 
                                    $.get('library/get_ofertas.php',{idNOStatus:idNegocio},function(ofer){
                                         //IF Negocio
                                         //if($('#mostradorId').attr('value')==undefined){
                                             $.post('library/get_ofertas.php',{idNOMostrador:idNegocio},function(mostr){ 
                                                $.post('modules/bonificacion/formulario.php',{idNegocio:idNegocio,porcentaje:porcentaje,consumo:consumo,status:status,ofer:ofer,mostr:mostr},function(data){
                                                    $('#contenido').html(data);	
                                                });
                                             });
                                             //ELSE Empleado
                                         /*}else{        
                                            $.get('library/get_ofertas.php',{idNOMostrador:idNegocio},function(mostr){ 
                                                $.get('modules/bonificacion/formulario.php',{idNegocio:idNegocio,porcentaje:porcentaje,consumo:consumo,status:status,ofer:ofer},function(data){
                                                    $('#contenido').html(data);	
                                                });
                                            });
                                        } */
                                     })   
                                });
                            });
                        });
	    break;
		
            //Solicitudes aceptadas o declinadas
		case 'mensaje':
                    var solicitudes;
                    var aceptadas;
                    var declinadas;
                        $.get('library/get_solicitudes.php',{idNegocio:idNegocio},function(solicitudes){
                            $.get('library/get_solicitudes_aceptadas.php',{idNegocio:idNegocio},function(aceptadas){
                                $.get('library/get_solicitudes_declinadas.php',{idNegocio:idNegocio},function(declinadas){
                                    setTimeout(function(){
                                        $('#solicitudes').html(solicitudes);
                                        $('.aceptar').html(aceptadas);
                                        $('.declinar').html(declinadas);
                                    },10);
                                });
                            });
                        });
                        
                        $('#contenido').load('modules/solicitudes/vs_solicitudes.php');
	    break;
		
		case 'oferta':
			$('#contenido').load('modules/ofertas/vs_oferta.php?idNegocio='+idNegocio+'&idNUsuario='+idNegocioUsuario);
	    break;
		
		case 'editarCuenta':
                            $('#contenido').load('modules/cuenta/vs_editar.php?idNegocio='+idNegocio);
	    break;
		
		case 'registro':
			$('#contenido').load('modules/registro/vs_registro.php');
	    break;
		
		case 'depositos':
                    $.get('modules/depositos/depositos.php',{idNegocio:idNegocio},function(data){
                       $('#depositos').html(data);
                    });
                        $('#contenido').load('modules/depositos/vs_depositos.php');
	    break;
		
		case 'privilegios':
                    $.get('modules/cuenta/get_privilegios.php', {idNegocio:idNegocio}, function(data){
                         $('#cAcord').html(data);
                    });
                    $('#contenido').load('modules/privilegios/vs_mostrador.php?idNegocio='+idNegocio);
                   
			
	    break;
	}
}

/**
*
*OPCIONES PARA FORMULARIO DE BONIFICACION
*
**/     
   
//FUNCION EVALUAR BONIFICACION
function valBon(i, e){
    if(i==6 && e=='0.00' || e==''){
        $('#bonificacion').attr('value','0.00');
    }
}

//ENVIO DE FORMULARIO MONEY
function frmMoney(event){
        event.preventDefault();
        var id_usuario = $('#usuarioId').attr('value');
        var id_oferta = 
        $("form :input[value!'']").css('border','none');
        //$(":input:not(#bonificacion)").removeAttr('style');
        if($("#email").val()==''){
                alertas('Type Email');
                $('#email').removeAttr('style');
                $('#email').attr('style','border: 1px solid red');
               
        return false;
        
        //}else if(){
       
        }else if ($("select#sOfer option:selected").attr('value')=='false'){
            alertas('Choose one offer category');
            $('#selecta').attr('style','width:213px;height:29px;border: 1px solid red;');
        return false;
        /*}else if($("select#sOfer option:selected").attr('value')!='false'){
            $('#selecta').css('border','none');
        return false; */
        
        }else if(($('#folio').val()=='')){
                alertas('Type Ticket Number / folio');
                $('#folio').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else if($('#monto').val()==''){
                alertas('Type Amount');
                $('#monto').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        /*}else if(parseInt($('#consumo').val()-1) >= parseInt($('#monto').val()) ){
                alertas('Fee Amount have to be main');
                $('#monto').removeAttr('style').attr('style','border: 1px solid red');
        return false;*/
        
        }else if($('#idEmpleado').val()==$('#usuarioId').val()){
            alertas('Employees cannot be bonified');
             $('#email').attr('style','border: 1px solid red');
            
        return false;    
        
        
        }else{
            $('input:submit').attr('disabled','disabled');
            $('input:submit').fadeOut();
            var opciones = {
                success: function(data){
                    if(data.length <= 10){
                        data=data.replace( /[^-A-Za-z0-9]+/g , '' ).toLowerCase(); 
                    }
                    datas=jQuery.parseJSON(data);
                    if(datas.error=='false'){
                        var urlRed= 'http://www.pulzos.com/index.php/redessociales/post_social_media_2/'+datas.idUsuario+'/'+datas.idOferta+'/'+datas.idBonificacion;
                        
                        $.get(urlRed);
                        alertaRedirect('Datos Guardados con exito ');
                        return false;
                    }else{
                        sndEmpleado(data);
                    }
                    
                    /*
                    if(data != 'false'){
                        sndEmpleado(data);
                    
                    }else if(data == 'false'){
                        alertaRedirect('Datos Guardados con exito'); 
                        return false;
                    }else if(data==''){
                        alertaRedirect('Datos Guardados con exito');
                        return false;
                    }else{
                        alertas('Ocurrio un Error Grave Intentelo mas tarde');
                        return false;
                    }*/
                },
                error:function(){
                    alertas('Oops Ocurrio un Error Grave Intentelo mas tarde');
                }
                
            }
        $('#formMoney').ajaxSubmit(opciones);
        return false;
        }
    }
    
//ENVIO DE BONIFICACION AL EMPLEADO    
function sndEmpleado(data){
    
    $.getJSON('modules/bonificacion/bonificacion_aceptada.php', {data:data}, function(){
        alertaRedirect('Datos Guardados con exito');
    });
    
}
//CHECAR FOLIO
function chkFolio(){
    var actionAttr='library/get_folio.php';
        var folio=$('#folio').attr('value');
        var idNegocio=$('#idNegocio').attr('value');
        if(folio!=''){
            $.post(actionAttr,{folio:folio,idNegocio:idNegocio}, function(data){
                //si existe el folio
                if(data=='1'){
                    alertas('El Folio ya fue capturado');
                    //$('#folio').removeAttr('style').
                    $('#folio').attr('style','border: 1px solid red');
                }else{
                //si no exite el folio
                $('#folio').removeAttr('style');
                //$('#folio').css('border','1px solid #CDCDCD');
                }
            });
        }
}

//FUNCION ENVIO DE FORMULARIO 
function sendForm(){
    alertaRedirect('Datos Guardados con exito');
//    $('#email, #folio, #monto').attr('value','');
//    $('.input_text:not(#bonificacion)').removeClass();
//    $('#bonificacion').attr('value','0.00');
}
   

//FUNCION PARA CALCULAR BONIFICACION
function montoComsumido()
{
    var emailDiv=$("div #dvEmail").length;
    var inpute = $('#porcentaje').attr('value');
    
    if($("#status").val()=='5')
    {
        var iva_f = $("#monto").attr('value') / 1.16;
        var sin_iva_f = $("#monto").attr('value') - iva_f;
        //$("#iva").val(sin_iva_f.toFixed(2));
        $("#iva_show").hide();
    }
    if($('#status').val()=='6')
    {
        tipoStatus = $("#tipoStatus").val();
        //Con iva
        if(tipoStatus == 1)
        {
            $("#iva_show").show();
            var iva = $("#monto").attr('value') / 1.16;
            var sin_iva = $("#monto").attr('value') - iva;
            $("#iva").val(sin_iva.toFixed(2));
            if(inpute.length==2)
            {
                var porciento=iva*parseFloat('.'+inpute)/emailDiv;//$('#monto').attr('value')*parseFloat('.'+inpute)/emailDiv;
            }else{
                var porciento=iva*parseFloat('.0'+inpute)/emailDiv;//$('#monto').attr('value')*parseFloat('.0'+inpute)/emailDiv;
            }
        }
        //if(tipoStatus == 2)
        //SIN IVA
        else{
            $("#iva_show").hide();
            var iva = $("#monto").attr('value') / 1.16;
            var sin_iva = $("#monto").attr('value') - iva;
            $("#iva").val(sin_iva.toFixed(2));
            if(inpute.length==2){
                var porciento=$('#monto').attr('value')*parseFloat('.'+inpute)/emailDiv;
            }else{
                var porciento=$('#monto').attr('value')*parseFloat('.0'+inpute)/emailDiv;
            }
        }
            var total = $('#monto').attr('value')-porciento;
            $('#bonificacion').val(total.toFixed(2));
    }
}

// FUNCION PARA CHECAR EL MAIL EXISTE EN LA BONIFICACION -recive id id->Dom
function chkMail(id)
{
    url='library/verificar_mail.php';
            var email=$('#'+id).attr('value');
            if(email==''){
                $('#'+id).attr('style','border: 1px solid red');
            }else{
                $('#'+id).css('border','none');
            }
            var v=validarMail(email);
            (v==false)? $('#'+id).attr('style','border: 1px solid red') :'';
            if(email!='' && v==true){
                $.post(url,{email:email},function(data){
                    //retorna el id del usuario
                    $('#usuarioId').attr('value',Base64.decode(data));
                    if(data==''){
                        alertas('Email Incorrecto');
                        $('#'+id).attr('style','border: 1px solid red');
                    }
                    else{
                        $('#'+id).removeAttr('style');
                    }
                }); 
            }
}


// FUNCION PARA CHECAR EL MAIL INEXISTENTE EN  NUEVO USUARIO
function chkMailLog(){
    url='library/verificar_mail.php';
    var email=$('#correo').attr('value');
    var v=validarMail(email);
    (v==false)? $('#correo').attr('style','border: 1px solid red') :'';
    if(email!='' && v==true){
                $.post(url,{email:email},function(data){
                    //retorna el id del usuario
                    if(data!=''){
                        alertas('Ya existe un Usuario con el mismo Correo Electronico');
                        $('#correo').attr('style','border: 1px solid red');
                    }else{
                        $('#correo').removeAttr('style');
                    }
                });
            }
}

//Funcion para SELECT del formulario de bonificacion referente a las ofertas
function ofertaSelect(idOferta, id){
    
    if(idOferta!='false'){           
        $('#monto').attr('value','');
             $.get('library/get_ofertas.php',{idOferta:idOferta},function(oferta){ //console.log(jQuery.parseJSON(oferta));
       var jsonItem=[];
       jsonItem = jQuery.parseJSON(oferta);   
       //Porcentaje fijo 5
       var emailDiv=$("div #dvEmail").length;
                 if(jsonItem.statusTipoBonificacion==5){
                        var idOfertaFijo=idOferta;
                         $.get('library/get_ofertas.php',{idOfertaFijo:idOfertaFijo},function(fijo){
                             $('#status').attr('value','5');
                             if(emailDiv>1){
                                 fijo=fijo/emailDiv;
                             }
                             $('#bonificacion').attr('value', fijo+'.00');
                             $('#tipoStatus').attr('value', '3');
                         });
       //porcentaje 6 %           
                 }else if(jsonItem.statusTipoBonificacion==6){
                     $('#porcentaje').attr('value',jsonItem.bonificaPorcentaje);
                     $('#status').attr('value','6');
                     $("#tipoStatus").attr('value',jsonItem.statusIva);
                     $("#consumo").attr('value',jsonItem.consumoMinimo);
                     $('#bonificacion').attr('value', '0.00');
                 }
         });
    }else{
        return false;
    }
    //Quitar Marcado borde red
     if($('#selecta').attr('style','border: 1px solid red')){
        $('#selecta').css({'border':'none','background':'#511E59'});
    }
}

//Funcion para el SELECt del formulario de bonificacion referrente a los empleados
//donde se asigna un id para que el empleado no sea repetido
function empleadoSelect(idE){
//Cuando cambia el empleado a 'Seleccionar empleado se evalue en nada'    
    if(idE==undefined){ 
        $('#idEmpleado').attr('value','');
    }else{
        $('#idEmpleado').attr('value',idE);
    }
}

//Function para Borrar emails Agregados
function eraseMail(event, e){
    event.preventDefault();
    $('#email'+e).parent().fadeOut('slow', function(){
      $(this).remove(); 
    });
}

//*OPCIONES DE BONIFICAICON ACEPTAR, DECLINAR
function aceptar(event, id, idUsuario, idOferta, idBonificacion){
    event.preventDefault();
    redess="http://www.pulzos.com/inicio.php/redessociales/post_social_media/"+idUsuario+"/"+idOferta+"/"+idBonificacion;
    $.get(redess);
    $('#declinar'+id).slideUp('slow');
    $(event.currentTarget).slideUp('slow', function(){
        $('#aceptar'+id).css('margin-top','20px');
        $('#aceptar'+id).css('background-color',' #339900');
        $('#aceptar'+id).slideDown('slow');
    });
    var url='modules/solicitudes/solicitudes.php';
    var idNegocioU=$('#negocioUsuario').attr('value');
    var idNegocioNegocio=$('#negocioId').attr('value');

    var redirect='aceptar';
    $.ajax({
        type: "POST",
        url: url,
        data: {id:id, redirect:redirect, idUsuario:idUsuario, idOferta:idOferta, idBonificacion:idBonificacion, idNegocioU:idNegocioU, idNegocioNegocio:idNegocioNegocio},
        success: function(html){
            
        }
    });
}
function declinar(event, id, idUsuario, idOferta, idBonificacion){
    event.preventDefault();
    $('#aceptar'+id).slideUp('slow');
    $(event.currentTarget).slideUp('slow',function(){
                $('#declinar'+id).css({'margin-top':'20px'});
                $('#declinar'+id).css('background-color',' #D10D00');
                $('#declinar'+id).slideDown('slow');
            });
    var redirect='declinar';
    var idNegocioU=$('#negocioUsuario').attr('value');
    var idNegocioNegocio=$('#negocioId').attr('value');
    var url='modules/solicitudes/solicitudes.php';
    $.ajax({
        type: "POST",
        url: url,
        data: {id:id, redirect:redirect, idUsuario:idUsuario, idOferta:idOferta, idBonificacion:idBonificacion, idNegocioU:idNegocioU, idNegocioNegocio:idNegocioNegocio},
        success: function(html){
        }
    });
}


/**
*
*OPCIONES PARA CONFIGURACION 
*
**/

function frmCuenta(event, action){

    event.preventDefault();
            var opciones = {
                success: function(){
                    if(action=='formUbicacion'){
                         alertas('GeoPosición actualizados con exito');
                    }else if(action=='formDatos'){
                         alertas('Datos actualizados con exito');
                    }
                   
                }
        }
        $('#'+action).ajaxSubmit(opciones);
        return false;
}


function initCheckBoxes(){
    var slideSpeed = 150;
    var leftDist = 41;

    $( ".cb-slider" ).draggable({containment: "parent",
                                 stop: function() { 
                                     if($(this).attr('cb-status')=='2'){ 
                                         $.post('modules/cuenta/get_config.php',{change:'1',id:$(this).attr('id')},function(){alertas('Oferta desactivada con exito');});
                                     }else if($(this).attr('cb-status')=='1'){ 
                                         $.post('modules/cuenta/get_config.php',{change:'2',id:$(this).attr('id')},function(){alertas('Oferta activada con exito');});
                                     }
                                 }

                                });
    $(".cb-slider").mouseup(function(){
        var id = $(this).attr('id');
        var status = $(this).attr("cb-status"); 
        switch(status)
        {
            case "2":
            //its off, slide it by 41px;
            $(this).animate({left: leftDist}, slideSpeed);
            //change status to 1
            $(this).attr("cb-status", "1");
            //Send data in Update dataBase for the change status
            
            $.post('modules/cuenta/get_config.php',{change:'1', id:id},function(){alertas('Oferta activada con exito');});
            break;

            case "1":
            //its 'on', slide it to 0px;
            $(this).animate({left: "0"}, slideSpeed);
            //change status to 2
            $(this).attr("cb-status", "2");
            //send data in dataBase for the change status
            $.post('modules/cuenta/get_config.php',{change:'2', id:id},function(){alertas('Oferta desactivada con exito');});
            break;
        }
    });
}

/**
*
*FUNCION PARA EL FORMULARIO DE OFERTAS
*
**/        

function frmOferta(event, id){
   
    event.preventDefault();
    $("form :input[value!'']").css('border','none');
    
    if($("#titulo").val()==''){
        alertas('Ingresa título de la oferta del día');
        $('#titulo').css('border','1px solid red');
    return false;
    
    /*}else if($('input[name=fijo]:checked').val()==undefined){
         alertas('Elige algun tipo de bonificacion');
         $('#tipoBonficacion').css('border', '1px solid red');
    return false;*/
    
    }else if($("#consumo").val()==''){
                alertas('Ingresa Consumo Minimo');
                $('#consumo').removeAttr('style').attr('style','border: 1px solid red');
    return false;
    
    }else if($("#consumo").val()<= '0'){
        alertas('El consumo minimo debe de ser mayor');
         $('#consumo').removeAttr('style').attr('style','border: 1px solid red');
    return false;
    
    }else if(parseInt($("#consumo").val()) < '50'){
        alertas('El consumo minimo debe de ser mayor de $50');
         $('#consumo').removeAttr('style').attr('style','border: 1px solid red');
    return false;
    
    }else if(($('#tipoBonificacion').val()=='')){
                alertas('Ingresa porcentaje de bonificación');
                $('#tipoBonificacion').removeAttr('style').attr('style','border: 1px solid red');
    return false;
        
    }else if(($('#tipoBonificacion').val()<='0')){
                alertas('El porcentaje de bonificacion tiene que ser mayor');
                $('#tipoBonificacion').removeAttr('style').attr('style','border: 1px solid red');
    return false;
    
    }else{
        $('input:submit').attr('disabled','disabled');
        $('input:submit').fadeOut();
        var opciones = {
                success: sendFormOferta
        }
        $('#'+id).ajaxSubmit(opciones);
        return false;
    }
}
function sendFormOferta(){
    alertaRedirect('Datos Guardados con exito');
}
//Cambios en los check de ->Bonificacion fija/Bonificacion Porcentaje
function chked(c){
    if(c=='f'){
        $('input[placeholder]#tipoBonificacion').attr({'placeholder':'Bonificacion:                            $','maxlength':'5'});
        $("#ivas").hide();
    }else if(c=='p'){
        $('input[placeholder]#tipoBonificacion').attr({'placeholder':'Porcentaje de Bonificacion:    %','maxlength':'2'});
        $("#ivas").show();
    }
}

/**
*
*FUNCION FORMULARIO DE REGISTRO
*
**/

function frmRgstro(event, id){
	 event.preventDefault();
         $("form :input[value!'']").css('border','none');
         if($("#nombre").val()==''){
                alertas('Ingresa Nombre');
                $('#nombre').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else if(($('#apellido').val()=='')){
                alertas('Ingresa Apellido');
                $('#apellido').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else if($('#correo').val()==''){
                alertas('Capture Correo Electronico');
                $('#correo').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else if($('#correo').attr('style')=='border: 1px solid red'){
                alertas('Verifica el correo electronico');
        return false;
        
        }else if($('#pass').val()==''){
                alertas('Ingresa ContraseÃ±a');
                $('#pass').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else if($('#pass').val().length < '6'){
                alertas('La contraseÃ±a debe ser mayor de 6 caracteres');
                $('#pass').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        
        }else if($('#dia').val()== 'dia'){
                alertas('elige dia en la fecha de naciemiento');
                $('#pass').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else if($('#dia option:selected').val()== ''){
                 alertas('Elige Dia para la Fecha de Nacimiento');
                 $('#dia').css({'border': '1px solid red','height':'25px'});
        return false;
        
        }else if($('#mes option:selected').val()== ''){
                alertas('Elige Mes para la Fecha de Nacimiento');
                $('#mes').css({'border': '1px solid red','height':'25px'});
        return false;
        
        }else if($('#ano option:selected').val()== ''){
                alertas('Elige AÃ±o para la Fecha de Nacimiento');
                $('#ano').css({'border': '1px solid red','height':'25px'});
        return false;
        
        }else{
             $('input:submit').attr('disabled','disabled');
             $('input:submit').fadeOut();
             var opciones = {
                    success: sendRegistro
             }
             $('#'+id).ajaxSubmit(opciones);   
             return false;
        }
	}
function sendRegistro(){
	alertaRedirect('Registro Exitoso');
}

/*
 *
 *FUNCIONES PARA DEPOSITO
 *
 **/

/*opciones de boton ocultar y ver de tabla
* side => lugar dnd se abrira y cerrara
*/
function cuerpo(){
    //alert('hola');
}
function verBtn(side){
   //opcion Zebra
   $(".data tr:even td").css({"background-color":"#DCDCDC"});
   $('#ver'+side).hide();
   $('#ocultar'+side).show();
   $('#conD'+side).show();
}
function ocultarBtn(side){
    $('#ver'+side).show();
    $('#ocultar'+side).hide();
    $('#conD'+side).hide();
}
function depositoBtn(id, nr){
    $.get('library/get_numeroDeposito.php',{idN:id, rn:nr},function(data){
        $('#depositar'+id).fadeOut('slow',function(){
            $('#noR'+id).html(data);
        });
        
    });
}


/*
 *
 *FUNCIONES PARA PRIVILEGIOS
 *
 **/
function frmMstrdor(event, id){
        
event.preventDefault();

url='library/get_privilegios.php';
var email=$('#correo').attr('value');
var v=validarMail(email);
(v==false)? $('#correo').attr('style','border: 1px solid red') :'';

if(email!='' && v==true){
        $.post(url,{email:email}, function(data){
        //retorna el id del usuario
//INICIO DE VERIFICACION DE MAIL
        if(data==='0'){
            alertas('El Empleado ya esta registrado');
            $('#correo').attr('style','border: 1px solid red');
        return false;
        }else if(data=='1'){
            alertas('El Email Pertenece a un Negocio, Verifiquelo');
            $('#correo').attr('style','border: 1px solid red');
        return false;
        }else if(data=='2'){
            alertas('El Empleado Necesita estar registrado en Pulzos');
            $('#correo').attr('style','border: 1px solid red');
        return false;
//FIN DE VERIFICACION DE MAIL
        }else if($("#correo").val()==''){
                alertas('Ingresa Email');
                $('#correo').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else if($('#uPulzos')==0){
             alertas('El Usuario Necesita ser registrado en Pulzos');
             //$('#correo').attr('style','border: 1px solid red');
        return false;

        }else if(($('#pass').val()=='')){
                alertas('Ingresa Password');
                $('#pass').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else if(($('#pass').val().length <= '5')){
             alertas('El password debe ser mayo a 6 caracteres');
             $('#pass').attr('style','border: 1px solid red');
        return false;
        
        }else if($('#confPass').val() == ''){
            alertas('Confirma tu Password');
            $('#confPass').attr('style','border: 1px solid red');
        return false;
        
        }else if(($('#confPass').val().length <= '5')){
            alertas('El password debe ser mayo a 6 caracteres');
            $('#confPass').attr('style','border: 1px solid red');
        return false;
        
        }else if($('#pass').val() != $('#confPass').val() || $('#confPass').val() != $('#pass').val()){
           alertas('Su password no coincide, Verificalo');
           
        return false;
        
        }else if($('#passConf').val()==''){
                alertas('Ingresa confirmacion de Password');
                $('#passConf').removeAttr('style').attr('style','border: 1px solid red');
        return false;
        
        }else{
            $('input:submit').attr('disabled','disabled');
             var opciones = {
                    success: function (){
                        var idNegocio=$('#negocioId').attr('value');
                            $.ajax({
                                type: "POST",
                                cache: true,
                                data: 'empleados='+idNegocio,
                                url: 'modules/cuenta/get_config.php',
                                    success: function (data){
                                        $('input:submit').attr('disabled',false);
                                        $('#cAcord').html(data);
                                        $(':input[type=text],:input[type=password] ').attr('value','');
                                        alertas('Empleado Registrado Satisfactoriamente');
                                    }
                            });
                    }
             }
             $('#'+id).ajaxSubmit(opciones);
             return false;
         }
    });
    }
}


//function para checar mail y validar
function chkMailPriv(){
    $('#uPulzos').attr('value', '');
    url='library/verificar_mail.php';
    var email=$('#correo').attr('value');
    var v=validarMail(email);
    (v==false)? $('#correo').attr('style','border: 1px solid red') :'';
    if(email!='' && v==true){
                $.post(url,{email:email}, function(data){
                    //retorna el id del usuario
                    if(data!=''){
                        $('#uPulzos').attr('value', Base64.decode(data));
                        $('#correo').removeAttr('style');
                    }else{
                        alertas('El Empleado Necesita estar registrado en Pulzos.com');
                        $('#correo').attr('style','border: 1px solid red');
                    }
                });
            }
            
}
//function para eliminar los usuarios registrados
function options(id){
    $('#alert-dialog').dropUpOf(
                             {
                                id:id,
                                dialog:'deseas elimiar al empleado?',
                                url:'modules/cuenta/get_config.php',
                                drop:true
                              });
}
//Funcion para Validar el password que sea mayor de 6 char's
function chkPass(l, id){
    if(l!='' && l<6){
        alertas('El password debe ser mayo a 6 caracteres');
        $('#'+id).attr('style','border: 1px solid red');
        return false;
    }else{
        $('#'+id).removeAttr('style').focus();
    }
        
}

