<?php
 /**
  * Header for the users
  * with open session
  *
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  * @version 0.1
  * @copyright Zavordigital February 22, 2011
  * @package Core
  **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/sessvars.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/json2005.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/rsh.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>
<script type="text/javascript">

function update() {
    urlReloadSecond = $("#reloadSecond").attr("href");
    $.ajax({
        type: 'GET',
        url: urlReloadSecond,
        timeout: 5000,
        success: function(data) {
           
            if(data.length > 2273)
            {	
				if($.browser.msie){}else{
               $("#header-container").html(data);
			   }
                window.setTimeout(update, 300000);
            }
            else
            {
                window.setTimeout(update, 180000);
            }
          
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
             
              window.setTimeout(update, 60000);
        }
    });
}

$(document).ready(function(){

update();




     $('#busquedaNegocios').blur(function(){
          setTimeout(function(){$('#autoC').hide();desenfoque();},300)
      });
      tempo=750;
      $("#busquedaNegocios").keyup(function(event)
      {
        event.preventDefault();
        var actionAttr = $("#FormBusqueda").attr("action");
        var dataAction = $("#busquedaNegocios").attr("value");
        busqueda(dataAction);  
          $.ajax({
            type: "POST",
            url: actionAttr,
            data: "buscar="+dataAction,
            complete: function(){
                setTimeout(cargarBusqueda,tempo);
            }
        });
      });

function validar(e) 
{ 
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
//patron = /\d/; // Solo acepta números
//patron = /\w/; // Acepta números y letras
//patron = /\D/; // No acepta números
//patron =/[A-Za-zñÑ\s]/; // igual que el ejemplo, pero acepta también las letras ñ y Ñ
      function busqueda(valor)
      {
        if(valor!='')
        {
            $('#autoC').each(function(){
                $(this).addClass('autoComplete').show()
                .html("<div style='text-align: center'><img src='<?php echo base_url().'/statics/img/Loading.gif'; ?>'  width='20' height='20'/><\div>");
            });
        }else
        {
            $('#autoC').hide();
        }
      }
      
      function cargarBusqueda()
      {
          urlC = $("#busqueda").attr("href");
          var texto = $("#busquedaNegocios").attr("value");
          texto1=replaceAll(texto,' ','_');
          urlMain = urlC + '/' + texto1;
          $("#autoC").load(urlMain);
      }
      
       $("#FormBusqueda").submit(function(event)
       {
        event.preventDefault();
        var actionAttr = $("#FormBusqueda").attr("action");
        var dataAction = $("#busquedaNegocios").attr("value"); 
        if(dataAction=='Buscar'){
            dataAction='';
        }
          $.ajax({
            type: "POST",
            url: actionAttr,
            data: "buscar="+dataAction,
            success: cargarBusquedaC
            });
            
      });

      function cargarBusquedaC()
      {
          urlC = $("#busqueda").attr("href");
          var texto = $("#busquedaNegocios").attr("value");
          texto1=replaceAll(texto,' ','_');
          urlMain = urlC + '/' + texto1;
          $("#texto-menu").load(urlMain);
      }
      
    

      function replaceAll(t, r, c) {
        return t.replace(new RegExp(r, 'g'),c);
      }

     
  });

function desenfoque()
{
     document.getElementById('busquedaNegocios').value = 'Buscar';
}
function poner()
{
    if(document.getElementById('busquedaNegocios').value == '')
    {
        document.getElementById('busquedaNegocios').value = 'Buscar';
    }
}

function quitar()
{
    if(document.getElementById('busquedaNegocios').value == 'Buscar')
    {
        document.getElementById('busquedaNegocios').value = '';
    }
}

//funcion para recargar el div
 
function Enviar(pagina,capa) {

				sessvars.pagina1=pagina;
				sessvars.capa1=capa;
				$(capa).load(pagina);
}

// sicript para que el usuario navegue utilizando los enlaces internos de la página ajax.

window.dhtmlHistory.create({

	toJSON: function(o){
		return JSON.stringify(o);
	}
	, fromJSON: function(s){
		return JSON.parse(s);
	}
});

var yourListener = function(newLocation, historyData){

//cargar mis_planes cuando la variable newLocation no tenga historial.
	if (!newLocation){
	
			$(document).ready(function() {
            urlMain='<?php echo base_url()?>index.php/money/index/<?php echo $this->session->userdata('id'); ?>';
            //planesusuarios/ver/<?php echo $this->session->userdata('id');?>';
			$("#texto-menu").load(urlMain);
			
		});
	
	}else{
//cargar en el div texto-menu si la variable newLocation tiene historial.
	Enviar(newLocation,'#texto-menu'); 
	
	}

}
window.onload = function(){

	dhtmlHistory.initialize();
	dhtmlHistory.addListener(yourListener);

};

</script>
<?php echo anchor('usuarios/reload_header/'.$this->session->userdata('id'), '', array('id'=>'reloadSecond', 'style'=>'display:none')); ?>
<div id="header1-1"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="container"><!-- MAIN -->
        <!--div class="header_profile" --><!-- DIV DE LA INFORMACION **INICIO** -->
            <div class="span-4">
                <?php //echo anchor('usuarios/',
				echo anchor('#',
                    img(array('src'=>'statics/img/logo-blanco.jpg',
                              'width'=>'160',
                              'height'=>'68','onclick'=>"dhtmlHistory.add('".base_url()."index.php/money/index/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/money/index/".$this->session->userdata('id')."','#texto-menu');return false;"))); ?>
            </div>
            <div class="span-14">
                <div class="span-14" style="margin-top: 17px">
                    &nbsp;
                </div>
                <div class="span-13 last" id="header-menu" style="margin-top: 10px; width: 290px"><!-- 510px" -->
               
                    <!--div style="float: left; width: 60px; margin-top: 8px">
                        <?php /*echo anchor('#',
                                          'Inicio', array('style'=>'margin-left: 15px; text-decoration: none; color: #FFFFFF', 'id'=>'inicio','onclick'=>"dhtmlHistory.add('".base_url()."index.php/planesusuarios/ver/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/planesusuarios/ver/".$this->session->userdata('id')."','#texto-menu');return false;")); */?>
                    </div>
                    <div style="float: left; margin-top: 8px">
                        |
                    </div>
                    <div style="float: left; width: 70px; margin-top: 9px">
                        <?php /*echo anchor('#',
                                          'Mi perfil', array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'mi-perfil','onclick'=>"dhtmlHistory.add('".base_url()."index.php/planesusuarios/mis_planes/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/planesusuarios/mis_planes/".$this->session->userdata('id')."','#texto-menu');return false;"));*/ ?>
                    </div>
                    <div style="float: left; margin-top: 8px">
                        |
                    </div-->

                    <div style="float: left; margin-top: 9px; width: 85px">
                   
                       <?php echo anchor('#',
                                          'Mi cartera',
                                          array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'cartera-user', 'onclick'=>"dhtmlHistory.add('".base_url()."index.php/money/index/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/money/index/".$this->session->userdata('id')."','#texto-menu');return false;")); ?>
                      
                       
                    </div>
                    <div style="float: left; margin-top: 8px">
                        |
                    </div>
                    <div style="float: left; margin-top: 9px; width: 105px">
                     &nbsp;
                        <?php echo anchor('#',
                                          'Notificaciones', 
                                          array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'notificacion-user','onclick'=>"dhtmlHistory.add('".base_url()."index.php/notificaciones/index/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/notificaciones/index/".$this->session->userdata('id')."','#texto-menu');return false;")); ?>
                                           &nbsp;
                     
                    </div>
                    <div style="float: left; margin-top: 8px;">
                        |                        
                    </div>
                    <div style="float: left; margin-top: 9px">
                     &nbsp; 
                          <?php echo anchor('#',
                                          'Mensajes',
                                          array('id'=>'inbox-user', 'style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF','onclick'=>"dhtmlHistory.add('".base_url()."index.php/inboxusuarios/index/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/inboxusuarios/index/".$this->session->userdata('id')."','#texto-menu');return false;")); ?>
                    </div>
                </div>
            </div>
            <div class="span-5">
                <div class="span-6 last" style="width: 28px; margin-top: 10px; margin-left: 14px; margin-bottom: 16px">
                    <div class="span-6" align="right">
                        <span style="margin-right: 5px; color: #660066;" id="nombre-header">
                            <?php echo $usuarios2->nombre; ?>
                        </span>
                        <span style="color: #999999" id="localid">
                        <?php if($usuarios2->ciudad != 0): ?>
                            <?php echo anchor('#',
                                              $localidades2->nombre, 
                                              array('style'=>'text-decoration: none;margin-right: 5px; color: #999999;','id'=>'ubicacion-user','onclick'=>"dhtmlHistory.add('".base_url()."index.php/usuarios/ubicacion_usuario_header/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/usuarios/ubicacion_usuario_header/".$this->session->userdata('id')."','#texto-menu');return false;")); ?>
                                
                        <?php endif; ?>
                        </span>
                    </div>
                </div>
                <div class="span-6" style="border: 1px solid #CDCDCD; width: 215px; margin-left: 25px">
                    <?php echo anchor('usuarios/busqueda', '', array('id'=>'busqueda','style'=>'display:none')); ?>
                    <?php echo form_open('usuarios/busqueda', array('id'=>'FormBusqueda')); ?>
                        <?php echo form_input(array('id'=>'busquedaNegocios',
                                                    'name'=>'buscar',
                                                    'autocomplete'=>'off',
                                                    'onblur'=>"return poner()",
                                                    'onfocus'=>"return quitar()",
                                                    'onkeypress'=>'return validar(event)',
                                                    'value'=>'Buscar',
                                                    'style'=>'height:18px; width: 175px; border: none; color: #999999')); ?>
                        <?php echo form_submit(array('id'=>'buscarA',
                                                     'class'=>'buscar')); ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        <!-- /div--><!-- DIV DE LA INFORMACION **FIN** -->
    </div><!-- MAIN -->
    
</div><!-- DIV PRINCIPAL **FIN** -->
<div id="header-container"><!-- DIV DEL HEADER DEL SUBMENU **INICIO** -->
    <div class="container"><!-- DIV DEL CONTAINER DEL SUBMENU **INICIO** -->
        <div class="span-24 last">
            <div class="span-5"><!--<div class="span-8"> -->
                &nbsp;
            </div>

        <div id="division">



            <div id="header-container1"><!-- DIV DEL HEADER DEL SUBMENU **INICIO** -->

                    <div class="span-2">
                        &nbsp;
                    </div>
             </div><!-- DIV DEL CONTAINER DEL SUBMENU **FIN** -->
            <div class="span-1">
                &nbsp;
            </div>
            <div class="span-2">
                <?php if($notificacion > 0): ?>
                    <div class="notificaciones" style="margin-top: -4px; margin-left: -15px"></div>
                    <div style="margin-top: -18px; color: #FFFFFF; margin-left: -9px">
                        <?php if($notificacion > 99): ?>
                            <?php echo "99"; ?>
                        <?php else: ?>
                            <?php echo $notificacion; ?>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    &nbsp;
                <?php endif; ?>
            </div>
            <div class="span-6">
               <?php if($inboxT > 0): ?>
                            <div class="notificaciones" style="margin-left: 2px; margin-top: -4px"></div>
                                <div style="margin-top: -18px; margin-left: 8px; color: #FFFFFF">
                                    <?php if($inboxT > 99): ?>
                                        <?php echo "99"; ?>
                                    <?php else: ?>
                                        <?php echo $inboxT; ?>
                                    <?php endif; ?>
                                </div>
                        <?php else: ?>
                            &nbsp;
                        <?php endif; ?>
            </div>
 
            <div class="span-4 last">
                <div class="span-8" style="margin-left: 0px">
                     <span style="color: #FFFFFF; margin-left: 0px">              
                        <?php echo anchor('#',
                                          'Editar Cuenta', 
                                           array('id'=>'invitacion-user', 'style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF','onclick'=>"dhtmlHistory.add('".base_url()."index.php/usuarios/editar_datos/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/usuarios/editar_datos/".$this->session->userdata('id')."','#texto-menu');return false;")); ?>                  
                    </span>
                    <span style="color: #FFFFFF; margin-right: 10px">
                        |
                    </span>
                    <span style="color: #FFFFFF">

                        <?php echo anchor('#',
                                          'Ayuda', 
                                          array('id'=>'ayuda-user', 'style'=>'text-decoration: none; margin-left: 0px; margin-right: 10px; color: #FFFFFF','onclick'=>"dhtmlHistory.add('".base_url()."index.php/notificaciones/ayuda/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/notificaciones/ayuda/".$this->session->userdata('id')."','#texto-menu');return false;"));?>
                    </span>
                    <span style="color: #FFFFFF; margin-right: 10px">
                        |
                    </span>
                    <span style="color: #FFFFFF">
                        <?php echo anchor('usuarios/cerrar_sesion',
                                          'Salir', array('style'=>'text-decoration: none; color: #FFFFFF','onclick'=>"sessvars.$.clearMem();")); ?>
                    </span>
                </div>
            </div>

        </div>

        </div>

    </div><!-- DIV DEL CONTAINER DEL SUBMENU **FIN** -->
</div><!-- DIV DEL HEADER DEL SUBMENU **FIN** -->

 <li class="span-2" id="autoC" style="list-style: none"></li>
