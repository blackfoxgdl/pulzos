<?php
/**
 * Vista para mostrarle al usuario lo que es la parte
 * de los estados de cuenta en la que los usuarios podran
 * visualizar todos los movimientos que se han realizado
 * con sus datos disponibles
 **/
?>
<script type="text/javascript">
nombre_edo = $("#nombre-usuario-plan").text();
$("#nombre-profile").text(nombre_edo);

$(document).ready(function(){

    mainmenu();    

    nombre_edo = $("#nombre-usuario-plan").text();
    $("#nombre-profile").text(nombre_edo);

    $("#filtrar").click(function(event){
        //event.preventDefault();
        dia = $("#dia").val();
        mes = $("#mes").val();
        ano = $("#ano").val();
        //alert('mes: ' + mes + ' año: ' + ano);
        if((mes == '0' || ano == '0') || (mes == '0') || (ano == '0'))
        {
            $("#error-show-filter").show();
            $("#show_states").hide();
        }
        else
        {
            url = $("#url").attr('href');
            url_send = url + '/1/' + mes + '/' + ano;
            $("#error-show-filter").hide();
            $.get(url_send, function(data){
                $("#desglose").html(data);
            });
        }
    });
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
    <?php echo anchor('transacciones/get_off_transactions', '', array('id'=>'url')); ?>
    <div id="nombre-usuario-plan">
        Estado de Cuenta
    </div>
</div>
<div class="span-14">
     <div id="menu">
        <ul id="nav">
            <li style="width: 110px">
                <a href="http://www.pulzos.com/inicio.php/redessociales/redes_sociales_usuarios/<?php echo $this->session->userdata('id'); ?>" style="text-decoration: none;font-family: Arial, Helvetica, sans-serif;">
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
<div class="span-14 last" style="margin-top: 10px">
    <div class="span-2" style="color: #660068">
        Nombre:
    </div>
    <div class="span-12 last" style="color: #000000">
        <?php echo get_complete_username($this->session->userdata('id')); ?>
    </div>
</div>
<div class="span-14" style="margin-top: 10px">
    <div class="span-14 last">
        <select name="mes" id="mes">
            <option value="0">
                Mes
            </option>
            <option value="01">
                Enero
            </option>
            <option value="02">
                Febrero
            </option>
            <option value="03">
                Marzo
            </option>
            <option value="04">
                Abril
            </option>
            <option value="05">
                Mayo
            </option>
            <option value="06">
                Junio
            </option>
            <option value="07">
                Julio
            </option>
            <option value="08">
                Agosto
            </option>
            <option value="09">
                Septiembre
            </option>
            <option value="10">
                Octubre
            </option>
            <option value="11">
                Noviembre
            </option>
            <option value="12">
                Diciembre
            </option>
        </select>
        <select name="ano" id="ano">
            <option value="0">
                A&ntilde;o
            </option>
            <?php
                for($i=2011; $i<=date('Y'); $i++)
                {
                    echo "<option value='" . $i . "'>" .
                            $i .
                        "</option>";
                }
            ?>
        </select>
        <input type="button" id="filtrar" value="Ver" />
    </div>
</div>
<div class="span-14 last" style="margin-top: 10px">

    <div class="span-13 last" style="display: none; color: #FFFFFF; background-color: #660068; text-align: center" id="error-show-filter">
        Falta seleccionar el mes o el a&ntilde;o
    </div>
    <div id="desglose">
    </div>
</div>

