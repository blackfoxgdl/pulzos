<?php
 /**
  * Header for the users
  * with open session
  * NOTA EN MENSAJES SE USA EL ID DE EMPRESA EN LA
  * TABLA DE USUARIOS NO EL DE NEGOCIOS
  *
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  * @version 0.1
  * @copyright Zavordigital February 22, 2011
  * @package Core
  **/
  
echo doctype();
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#buscar').blur(function(){
         setTimeout(function(){$('#autoC').hide();},300)
      });
      tempo=750;
      $("#buscar").keyup(function(event)
      {
       
        event.preventDefault();
        var actionAttr = $("#FormBusqueda").attr("action");
        var dataAction = $("#buscar").attr("value");
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

      function busqueda(valor)
      {
        if(valor!='')
        {
            $('#autoC').each( function(){
                $(this).addClass('autoComplete').show()
                .html("<div style='text-align: center'><img src='<?php echo base_url().'/statics/img/Loading.gif'; ?>'  width='20' height='20'/></div>");
            });
        }else
        {
           $('#autoC').hide();
        }
      }
      
      function cargarBusqueda()
      {
          urlC = $("#busqueda").attr("href");
          var texto = $("#buscar").attr("value");
          texto1=replaceAll(texto,' ','_');
          urlMain = urlC + '/' + texto1;
          $("#autoC").load(urlMain);
      }
      
       $("#FormBusqueda").submit(function(event)
       {
        event.preventDefault();
        var actionAttr = $("#FormBusqueda").attr("action");
        var dataAction = $("#buscar").attr("value");
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
          var texto = $("#buscar").attr("value");
          texto1=replaceAll(texto,' ','_');
          urlMain = urlC + '/' + texto1;
          $("#texto-menu").load(urlMain);
      }
    

    $("#mensajeInboxN").click(function(event){
        event.preventDefault();
        urlMain = $(this).attr("href");
        $("#texto-menu").load(urlMain);
    });
    
    $("#editar-negocios").click(function(event){
        event.preventDefault();
        url = $(this).attr("href");
        $("#texto-menu").load(url);
    });

    //funcion para redireccionar al index
    $("#inicioPerfil").click(function(){
        urlPerfil = $(this).attr("href");
        location.href = urlPerfil;
    });


    $(".submenu-negocios").click(function(event){
        event.preventDefault();
        urlSubmenu = $(event.currentTarget).attr("href");
        $("#texto-menu").load(urlSubmenu);
    });

    $(".submenu-negocios-aparte").click(function(event){
        event.preventDefault();
        pulzos = $(event.currentTarget).attr("href");
        location.href = pulzos;
    });
    function replaceAll(t, r, c) {
        return t.replace(new RegExp(r, 'g'),c);
    }
});





//aqui inicia
function Enviar(pagina,capa) {
			$("#botonPulzar").hide();
			$("#cargainicio").show();
			
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
	
			$("#botonPulzar").show();
			$("#cargainicio").hide();
		urlMain='<?php echo base_url()?>index.php/empresainicio';
	

	
	
	}else{
//cargar en el div texto-menu si la variable newLocation tiene historial.
	
	Enviar(newLocation,'#cargainicio'); 
		
	}

}
window.onload = function(){

	dhtmlHistory.initialize();
	dhtmlHistory.addListener(yourListener);

};
//aqui termina



</script>
<div id="header1-1"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="container"><!-- MAIN **FIN** -->
        <div class="span-4">
            <?php echo anchor('usuarios/',
                              img(array('src'=>'statics/img/logo-blanco.jpg',
                                        'width'=>'160',
                                        'height'=>'68',
                                        'onclick'=>"dhtmlHistory.add('".base_url()."index.php/negocios/principal/".$this->session->userdata('id')."/".$this->session->userdata('idN')."',null);Enviar('".base_url()."index.php/negocios/principal/".$this->session->userdata('id')."/".$this->session->userdata('idN')."','#texto-menu');return false;"))); ?>
        </div>
        <div class="span-14">
            <div class="span-14" style="margin-top: 17px">
                &nbsp;
            </div>
            <div class="span-11 last" id="header-menu" style="margin-top: 10px">
                <div style="float: left; width: 60px; margin-top: 8px">
                    <?php echo anchor('',
                                      'Inicio', array('style'=>'margin-left: 15px; text-decoration: none; color: #FFFFFF', 'id'=>'inicioPerfil')); ?>
                </div>
                <div style="float: left; margin-top: 8px">
                    |
                </div>
                <div style="float: left; margin-top: 9px; width: 70px">
                    <?php echo anchor('',
                                      'Mi perfil', array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'miPerfil')); ?>
                </div>
                <div style="float: left; margin-top: 8px">
                    |
                </div>
                <div style="float: left; margin-top: 9px; width: 95px; color: #FFFFFF">
                    Alianzas
                </div>
                <div style="float: left; margin-top: 8px">
                    |
                </div>
                <div style="float: left; margin-top: 9px; width: 85px">
                    <?php echo anchor('',
                                      'Mensajes', array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'inbox-empresa','onclick'=>"dhtmlHistory.add('".base_url()."index.php/inboxusuarios/index/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/inboxusuarios/index/".$this->session->userdata('id')."','#centro');return false;")); ?>
                </div>
                <div style="float: left; margin-top: 8px">
                    |
                </div>
                <div style="margin-top: 9px; float: left">
                    <?php echo anchor('',
                                      'Notificaciones', array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'notificaciones-empresa')); ?>
                </div>
            </div>
        </div>
        <div class="span-5">
            <div class="span-6 last" style="width: 28px; margin-top: 10px; margin-left: 14px; margin-bottom: 16px">
                <div class="span-6">
                        <span style="margin-right: 5px; color: #666666">
                            <?php echo $negociosN->negocioNombre; ?>
                        </span>
                        <span style="color: #999999">
                        </span>
                </div>
            </div>
            <div class="span-6" style="border: 1px solid #CDCDCD; width: 215px">
                <?php echo anchor('negocios/busqueda', '', array('id'=>'busqueda','style'=>'display:none')); ?>
                <?php echo form_open('negocios/busqueda', array('id'=>'FormBusqueda')); ?>
                    <?php echo form_input(array('name'=>'buscar',
                                                'id'=>'buscar',
                                                'onblur'=>'',
                                                'onfocus'=>'',
				    			                'style'=>'height:18px; width: 175px; border: none; color: #999999',
                                                'autocomplete'=>'off',
					    			    )); ?>
                    <?php echo form_submit(array('id'=>'buscar',
	    	    		               	         'class'=>'buscar'
		    	    			                )); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div><!-- MAIN **FIN** -->
    <div id="header-container"><!-- DIV DEL HEADER DEL SUBMENU **INICIO** -->
        <div class="container">
            <div class="span-24 last">
                <div class="span-8">
                    &nbsp;
                </div>
                <div class="span-2">
                    &nbsp; <!-- INVITACIONES -->
                </div>
                <div class="span-2">
                    &nbsp; <!-- MENSAJES -->
                </div>
                <div class="span-1">
                    &nbsp;
                </div>
                <div class="span-2">
                    &nbsp; <!-- NOTIFICACION -->
                </div>
                <div class="span-4">
                    &nbsp;
                </div>
                <div class="span-4 last">
                    <div class="span-8" style="margin-left: -20px">
                        <span style="color: #FFFFFF">
                            <?php echo anchor('',
                                              'Editar Cuenta',
                                              array('class'=>'submenu-negocios', 'style'=>'margin-right: 10px; text-decoration: none; color: #FFFFFF')); ?>
                        </span>
                        <span style="color: #FFFFFF; margin-right: 10px">
                            |
                        </span>
                        <span style="color: #FFFFFF">
                            <?php echo anchor('#',
                                              'Ayuda', array('class'=>'submenu-negocios', 'style'=>'color: #FFFFFF; text-decoration: none; margin-right: 10px;')); ?>
                        </span>
                        <span style="color: #FFFFFF; margin-right: 10px;">
                            |
                        </span>
                        <span style="color: #FFFFFF;">
                            <?php echo anchor('usuarios/cerrar_sesion',
                                              'Salir', array('style'=>'text-decoration: none; color: #FFFFFF')); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- DIV DEL HEADER DEL SUBMENU **FIN** -->
</div><!-- DIV PRINCIPAL **FIN** -->
