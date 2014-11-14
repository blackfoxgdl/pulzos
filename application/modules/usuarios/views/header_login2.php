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
    urlReloadThird = $("#reloadSecond").attr("href");
    $.ajax({
        type: 'GET',
        url: urlReloadThird,
        timeout: 5000,
        success: function(data) {
            if(data.length > 2273)
            {
                $("#header-container").html(data);
                window.setTimeout(update, 800000);
            }
            else
            {
                window.setTimeout(update, 400000);
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
//function validar(e) { // 1
//    tecla = (document.all) ? e.keyCode : e.which; // 2
//    if (tecla==8) return true; // 3
//    patron =/[A-Za-z\s]/; // 4
//    te = String.fromCharCode(tecla); // 5
//    return patron.test(te); // 6
//}
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
}


</script>
<?php echo anchor('usuarios/reload_header/'.$this->session->userdata('id'), '', array('id'=>'reloadSecond', 'style'=>'display:none')); ?>
<div id="header1-1"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="container"><!-- MAIN -->
        <!--div class="header_profile" --><!-- DIV DE LA INFORMACION **INICIO** -->
            <div class="span-4">
                <?php //echo anchor('usuarios/',
				echo anchor('usuarios/perfil',
                    img(array('src'=>'statics/img/logo-blanco.jpg',
                              'width'=>'160',
                              'height'=>'68','onclick'=>"Enviar('".base_url()."index.php/money/index/".$this->session->userdata('id')."','#texto-menu');"))); ?>
            </div>
            <div class="span-14">
                <div class="span-14" style="margin-top: 17px">
                    &nbsp;
                </div>
                <div class="span-13 last" id="header-menu" style="margin-top: 10px;">
                    <div style="float: left; width: 60px; margin-top: 8px">
                        <?php echo anchor('usuarios/perfil',
                                          'Inicio', array('style'=>'margin-left: 15px; text-decoration: none; color: #FFFFFF', 'id'=>'inicio','onclick'=>"Enviar('".base_url()."index.php/planesusuarios/ver/".$this->session->userdata('id')."','#texto-menu');")); ?>
                    </div>
                    <div style="float: left; margin-top: 8px">
                        |
                    </div>
                    <div style="float: left; width: 70px; margin-top: 9px">
                        <?php echo anchor('usuarios/perfil',
                                          'Mi perfil', array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'mi-perfil','onclick'=>"Enviar('".base_url()."index.php/planesusuarios/mis_planes/".$this->session->userdata('id')."','#texto-menu');")); ?>
                    </div>
                    <div style="float: left; margin-top: 8px">
                        |
                    </div>

                    <div style="float: left; margin-top: 9px; width: 85px">
 
                        <?php echo anchor('usuarios/perfil',
                                          'Mensajes',
                                          array('id'=>'inbox-user', 'style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF','onclick'=>"Enviar('".base_url()."index.php/inboxusuarios/index/".$this->session->userdata('id')."','#texto-menu');")); ?>

                    </div>
                    <div style="float: left; margin-top: 8px">
                        |
                    </div>
                    <div style="float: left; margin-top: 9px; width: 110px">
                        <?php echo anchor('usuarios/perfil',
                                          'Notificaciones', 
                                          array('style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF', 'id'=>'notificacion-user','onclick'=>"Enviar('".base_url()."index.php/notificaciones/index/".$this->session->userdata('id')."','#texto-menu');")); ?>

                    </div>
                    <div style="float: left; margin-top: 8px">
                        |
                    </div>
                    <div style="float: left; margin-top: 9px">
                        <?php echo anchor('#',
                                          'Mi cartera',
                                          array('style'=>'text-decoration: none; color: #FFFFFF; margin-left: 10px', 'id'=>'cartera-user',  'onclick'=>"Enviar1('".base_url()."index.php/money/index/".$this->session->userdata('id')."/".$this->session->userdata('idN')."','#texto-menu');")); ?>
                    </div>
                </div>
            </div>
            <div class="span-5">
                <div class="span-6 last" style="width: 28px; margin-top: 10px; margin-left: 14px; margin-bottom: 16px">
                    <div class="span-6" align="right">
                        <span style="margin-right: 5px; color: #660066">
                            <?php echo $usuario->nombre; ?>
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
            <div class="span-8">
                &nbsp;
            </div>
            <div class="span-2">
                <?php if($notificaciones > 0): ?>
                    <div class="notificaciones" style="margin-left: 15px; margin-top: -4px"></div>
                    <div style="margin-top: -16px; color: #FFFFFF">
                        <?php if($notificaciones > 99): ?>
                            <span style="margin-left: 17px">
                                <?php echo "99"; ?>
                            </span>
                        <?php else: ?>
                            <span style="margin-left: 17px">
                                <?php echo $notificaciones; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    &nbsp;
                <?php endif; ?>
            </div>
            <div class="span-2">
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
            <div class="span-1">
                &nbsp;
            </div>
            <div class="span-2">

            </div>
            <div class="span-4">
                &nbsp;
            </div>
            <div class="span-4 last">
                <div class="span-8" style="margin-left: 0px">
                    <span style="color: #FFFFFF; margin-left: 80px">
                        <?php echo anchor('usuarios/perfil',
                                          'Editar Cuenta', 
                                          array('class'=>'middle-menu-link1', 'id'=>'top-menu-editar-datos', 'style'=>'margin-right: 10px; text-decoration: none; color: #FFFFFF','onclick'=>"Enviar('".base_url()."index.php/usuarios/editar_datos','#texto-menu');")); ?>
                    </span>
                    <span style="color: #FFFFFF; margin-right: 10px">
                        |
                    </span>
                    <span style="color: #FFFFFF">
                        
                        <?php echo anchor('#',
                            'Ayuda', array('class'=>'middle-menu-link', 'id'=>'top-menu-amigos', 'style'=>'color: #FFFFFF; text-decoration: none; margin-right: 10px')); ?>
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

    </div><!-- DIV DEL CONTAINER DEL SUBMENU **FIN** -->
</div><!-- DIV DEL HEADER DEL SUBMENU **FIN** -->
 <li class="span-2" id="autoC" style="list-style: none"></li>
