<?php
/**
 * Vista que se usa para poder realizar los datos necesarios
 * para el retiro con el cual el usuario podra solicitar la
 * cantidad que se necesita o que necesita retirar pero
 * con los datos ya especificados
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){ 
	mainmenu();
});

function onlyNumbers(evt)
{
    var keyPressed = (evt.which) ? evt.which : event.keyCode;
    return (keyPressed <= 13 || (keyPressed >= 48 && keyPressed <= 57) || keyPressed == 46);
}

$("#recursos-usuarios").submit(function(event){
    event.preventDefault();
    disponible = $("#moneyTotalUsuario").val();
    retiro = $("#cantidadRetirarUsuario").val();
    dinero_disponible = parseFloat(disponible);
    dinero_retiro = parseFloat(retiro);
    if(dinero_disponible >= dinero_retiro)
    {
        opciones = {
            success: cargarVista
        }
        $(this).ajaxSubmit(opciones);
        return false;
    }
    else
    {
        $("#message-error").slideDown('slow', function(){
            setTimeout(function(){
                $("#message-error").slideUp('slow');
            }, 2000);
        });
        return false;
    }
});

function cargarVista()
{
    $("#message-success").slideDown(function(){
        setTimeout(function(){
            $("#message-success").slideUp('slow', function(){
                $("#texto-menu").load($("#cantidad-tran").attr('href'));
            });
        }, 2000);
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
<div class="span-14" style="margin-top: 10px; color: #FFFFFF; background-color: #660068; display: none" id="message-error">
    El monto a retirar es mayor al monto disponible
</div>
<div class="span-14" style="margin-top: 10px; color: #FFFFFF; background-color: #660068; display: none" id="message-success">
    La solicitud de transferencia ha sido enviada exitosamente
</div>
<div class="span-14">
	<?php if(!empty($recursos)): ?>
	    <?php echo form_open('transacciones/guardar_recursos_usuarios', array('id'=>'recursos-usuarios')); ?>
    	    <div class="span-13 last">
        	    <div class="span-3">
            	    <?php echo form_label('Disponible:', 'disponible'); ?>
	            </div>
    	        <div class="span-10 last">
                    <?php echo '$ ' . number_format($recursos->moneyTotalGanadoUsuario, 2, '.', '') . ' MX'; ?>   
                    <input type="hidden" value="<?php echo $recursos->moneyTotalGanadoUsuario; ?>" id="moneyTotalUsuario" />
	            </div>
    	    </div>
        	<div class="span-13 last">
            	<div class="span-3">
                	<?php echo form_label('Cantidad: ', 'cantidadRetiro'); ?>
	            </div>
    	        <div class="span-10 last">
        	        <?php echo form_input(array('id'=>'cantidadRetirarUsuario',
            	                                'class'=>'',
                	                            'name'=>'Retiro[retiroMovimiento]',
                                                'style'=>'',
                                                'onkeypress'=>'return onlyNumbers(event)')); ?>
	            </div>
    	    </div>
        	<div class="span-13 last">
            	<?php echo form_submit('Retirar', 'retirar'); ?>
	        </div>
        <?php echo form_close(); ?>
        <div class="span-13 last" style="color: RED">
            *NOTA: Por cada transferencia bancaria se cobra una comision de $15.00 pesos.
        </div>
    <?php else: ?>
    	<div class="span-13 last">
    		No hay dinero disponible a retirar
    	</div>
    <?php endif; ?>
</div>
