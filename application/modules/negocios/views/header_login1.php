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
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/sessvars.js'; ?> "></script>
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

    $(".submenu-negocios-aparte").click(function(event){
        event.preventDefault();
        pulzos = $(event.currentTarget).attr("href");
        location.href = pulzos;
    });
    function replaceAll(t, r, c) {
        return t.replace(new RegExp(r, 'g'),c);
    }
});


function Enviar1(pagina,capa) {
			sessvars.pagina2=pagina;
			sessvars.capa2=capa;
				
}
</script>
<div id="header1-1"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="container"><!-- MAIN **FIN** -->
        <div class="span-4">
            <?php echo anchor('',
                              img(array('src'=>'statics/img/logo-blanco.jpg',
                                        'width'=>'160',
                                        'height'=>'68','onclick'=>"Enviar1('".base_url()."index.php/negocios/principal/".$this->session->userdata('id')."/".$this->session->userdata('idN')."','#texto-menu');"))); ?>
        </div>
        <div class="span-14">
            <div class="span-14" style="margin-top: 17px">
                &nbsp;
            </div>
            <div class="span-7 last" id="header-menu" style="margin-top: 10px; width: 240px">
                <div style="float: left; width: 60px; margin-top: 8px">
                    <?php echo anchor('',
                                      'Inicio', array('style'=>'margin-left: 15px; text-decoration: none; color: #FFFFFF', 'id'=>'inicioPerfil','onclick'=>"Enviar1('".base_url()."index.php/negocios/principal/".$this->session->userdata('id')."/".$this->session->userdata('idN')."','#texto-menu');")); ?>
                </div>
                <div style="float: left; margin-top: 8px">
                    |
                </div>
                <div style="float: left; margin-top: 9px; width: 85px">
                    <?php echo anchor('negocios/perfil',
                                      'Mensajes', array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'inbox-empresa','onclick'=>"Enviar1('".base_url()."index.php/inboxusuarios/index/','#texto-menu');")); ?>
                </div>
                <div style="float: left; margin-top: 8px">
                    |
                </div>
                <div style="margin-top: 9px; float: left">
                    <?php echo anchor('',
                                      'Historial',
                                       array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'notificaciones-empresa','onclick'=>"Enviar1('".base_url()."index.php/notificaciones/index/','#texto-menu');")); ?>
                </div>
            </div>
        </div>
        <div class="span-5">
            <div class="span-6 last" style="width: 28px; margin-top: 10px; margin-left: 14px; margin-bottom: 16px">
                <div class="span-6">
                    <?php if($usuariosU->statusEU == 0): ?>
                        <span style="margin-right: 5px; color: #660066">
                            <?php echo $usuariosU->nombre; ?>
                        </span>
                        <span style="color: #999999">
                        </span>
                    <?php else: ?>
                        <span style="margin-right: 5px; color: #666666">
                             <?php echo $usuariosU->nombre; ?>
                        </span>
                        <span style="color: #999999">
                        <?php  if($negocioCiudad->ciudad != 0){?>
                            <?php if(isset($localidadN)){ echo $localidadN; }else{ echo $localidadesN->nombre; } ?>
                        <?php }?>    
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
                            <?php echo anchor('negocios/perfil',
                                              'Editar Cuenta',
                                              array('class'=>'submenu-negocios', 'style'=>'margin-right: 10px; text-decoration: none; color: #FFFFFF','onclick'=>"Enviar1('".base_url()."index.php/negocios/editar/','#texto-menu');")); ?>
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
