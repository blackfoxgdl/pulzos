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
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/sessvars.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/json2005.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/rsh.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>

<script type="text/javascript">

function updatee() {
    urlReloadSecond = $("#reloadSecond1").attr("href");
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
                window.setTimeout(updatee, 300000);
            }
            else
            {
                window.setTimeout(updatee, 180000);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
              window.setTimeout(updatee, 60000);
        }
    });
}

$(document).ready(function(){
updatee();

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
			sessvars.pagina2=pagina;
			sessvars.capa2=capa;
			
			$(capa).load(pagina);
 }

// sicript para que el usuario navegue utilizando los enlaces internos de la p�gina ajax.

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
			
			<?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
                     urlMain=<?php echo 'negocios/principal/'.$negocios->negocioUsuarioId.'/'.$negocios->negocioId; ?>
                    
                <?php else: ?>
                    urlMain=<?php echo 'negocios/principal/'.$negocios->negocioUsuarioId.'/'.$negocios->negocioId; ?>
                    //miperfil/'.$negocios->negocioId; ?>
                    
                <?php endif; ?>
				$('#texto-menu').load(urlMain);
				alert(urlMain);
	

	
	
	}else{
//cargar en el div texto-menu si la variable newLocation tiene historial.
	
	Enviar(newLocation,'#texto-menu'); 	
	}

}
window.onload = function(){

	dhtmlHistory.initialize();
	dhtmlHistory.addListener(yourListener);

};
//aqui termina

</script>

<?php echo anchor('negocios/update_header_notifications/'.$this->session->userdata('id'), '', array('id'=>'reloadSecond1', 'style'=>'display:none')); ?>
<div id="header1-1"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="container"><!-- MAIN **FIN** -->
        <div class="span-4">
            <?php echo anchor('negocios/perfil',
                              img(array('src'=>'statics/img/logo-blanco.jpg',
                                        'width'=>'160',
                                        'height'=>'68',
                                        'onclick'=>"dhtmlHistory.add('".base_url()."index.php/negocios/principal/".$this->session->userdata('id')."/".$this->session->userdata('idN')."',null);Enviar('".base_url()."index.php/negocios/principal/".$this->session->userdata('id')."/".$this->session->userdata('idN')."','#texto-menu');return false;"))); ?>
        </div>
        <div class="span-14">
            <div class="span-14" style="margin-top: 17px">
                &nbsp;
            </div>
            <div class="span-7 last" id="header-menu" style="margin-top: 10px; width: 240px">
                <div style="float: left; width: 60px; margin-top: 8px">
                    <?php echo anchor('',
                                      'Inicio', array('style'=>'margin-left: 15px; text-decoration: none; color: #FFFFFF', 'id'=>'inicioPerfil','onclick'=>"dhtmlHistory.add('".base_url()."index.php/negocios/principal/".$negocios->negocioUsuarioId."/".$negocios->negocioId."',null);Enviar('".base_url()."index.php/negocios/principal/".$negocios->negocioUsuarioId."/".$negocios->negocioId."','#texto-menu');return false;")); ?>
                </div>
                <div style="float: left; margin-top: 8px">
                    |
                </div> 
                <div style="float: left; margin-top: 9px; width: 85px">
                    <?php echo anchor('',
                                      'Mensajes', array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'inbox-empresa','onclick'=>"dhtmlHistory.add('".base_url()."index.php/inboxusuarios/index/".$negocios->negocioId."',null);Enviar('".base_url()."index.php/inboxusuarios/index/".$negocios->negocioId."','#texto-menu');return false;")); ?>
                </div>
                <div style="float: left; margin-top: 8px">
                    |
                </div>
                <div style="margin-top: 9px; float: left; width: 80px">
                    <?php echo anchor('',
                                      'Historial',
                                       array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'notificaciones-empresa','onclick'=>"dhtmlHistory.add('".base_url()."index.php/transacciones/transacciones_completas/".$this->session->userdata('idN')."',null);Enviar('".base_url()."index.php/transacciones/transacciones_completas/".$this->session->userdata('idN')."','#texto-menu');return false;")); ?>
                </div>
            </div>
        </div>
        <div class="span-5">
            <div class="span-6 last" style="width: 28px; margin-top: 10px; margin-left: 14px; margin-bottom: 16px">
                <div class="span-6">
                    <?php if($negociosN->statusEU == 0): ?>
                        <span style="margin-right: 5px; color: #660066">
                            <?php echo $negociosN->nombre; ?>
                        </span>
                        <span style="color: #999999">
                            <?php echo ciudad_usuario($negociosN->ciudad); ?>
                        </span>
                    <?php else: ?>
                        <span style="margin-right: 5px; color: #666666">
                            <?php echo $negocios->negocioNombre; ?>
                        </span>
                        <span style="color: #999999">
                            <?php if(!empty($ciudades)): ?>
                                <?php if($negocios->negocioCiudad != 0): ?>
                                    <?php echo $ciudades->nombre; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span-6" style="width: 215px">
                <?php echo anchor('negocios/busqueda', '', array('id'=>'busqueda','style'=>'display:none')); ?>
                <?php echo form_open('negocios/busqueda', array('id'=>'FormBusqueda')); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div><!-- MAIN **FIN** -->
    <div id="header-container"><!-- DIV DEL HEADER DEL SUBMENU **INICIO** -->
        <div class="container">
            <div class="span-24 last">
                <div class="span-4">
                    &nbsp;
                </div>
                <div class="span-2">
                    &nbsp;<!-- INICIO -->
                </div>
                 <div class="span-2">
                   <!-- MENSAJES -->
                        <?php if(!empty($inboxT)): ?>
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
                        <?php endif; ?>
                </div>
                <div class="span-2">
                    &nbsp; <!-- HISTORIAL -->
                </div>
                <div class="span-2">
                    &nbsp; <!--  -->
                </div>
                <div class="span-1">
                    &nbsp;
                </div>
                <div class="span-2">
                    &nbsp; <!--  -->
                </div>
                <div class="span-4">
                    &nbsp;
                </div>
                <div class="span-4 last">
                    <div class="span-8" style="margin-left: -20px">
                        <span style="color: #FFFFFF">
                            <?php echo anchor('#',
                                              'Editar Cuenta',
                                              array('class'=>'submenu-negocios', 'style'=>'margin-right: 10px; text-decoration: none; color: #FFFFFF','onclick'=>"dhtmlHistory.add('".base_url()."index.php/negocios/editar/".$negocios->negocioId."',null);Enviar('".base_url()."index.php/negocios/editar/".$negocios->negocioId."','#texto-menu');return false;")); ?>
                        </span>
                        <span style="color: #FFFFFF; margin-right: 10px">
                            |
                        </span>
                        <span style="color: #FFFFFF">
                        	 <?php echo anchor('developers/index',
                                          'API',
                                          array('style'=>'margin-left: 0px; text-decoration: none; margin-right: 10px; color: #FFFFFF')); ?>
                        </span>
                        <span style="color: #FFFFFF; margin-right: 10px;">
                            |
                        </span>
                        <span style="color: #FFFFFF;">
                            <?php echo anchor('usuarios/cerrar_sesion',
                                              'Salir', array('style'=>'text-decoration: none; color: #FFFFFF','onclick'=>"sessvars.$.clearMem();")); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- DIV DEL HEADER DEL SUBMENU **FIN** -->
</div><!-- DIV PRINCIPAL **FIN** -->
