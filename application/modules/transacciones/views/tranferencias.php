<?php
/**
 * Metodo que se usa para solamente recibir o colocar su
 * clave para que puedar recibir los transfer que ha
 * solicitado una vez que se entra a esta parte del sistema
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){

	mainmenu(); 

});

$("#transfer-trans").submit(function(event){
    event.preventDefault();
    clabeUno = $("#clabeBancaria").val();
    clabeDos = $("#clabeBancariaCheck").val();
    nombre = $("#nombre_completo").val();
    apellido_p = $("#apellido_paterno").val();
    apellido_m = $("#apellido_materno").val();
    banco = $("#bank").val();
    tamano = clabeUno.length;
    tamano2 = clabeDos.length;

    if(tamano == 18 && tamano2 == 18)
    {
        if(nombre != '' && apellido_p != '' && apellido_m != '')
        {
            if((clabeUno == clabeDos) && (clabeUno != '') && (clabeDos != ''))
            {   
                if(banco != 1)
                {
                    opciones = {
                        success: cargarVista
                    }
                    $(this).ajaxSubmit(opciones);
                    return false;
                }
                else
                {
                    $("#message-error-two").slideDown('slow', function(){
                        setTimeout(function(){
                            $("#message-error-two").slideUp('slow');
                        }, 2000);
                    });
                }
            }
            else
            {
                $("#message-error-one").slideDown('slow', function(){
                    setTimeout(function(){
                        $("#message-error-one").slideUp('slow');
                    }, 2000);
                });
            }
        }
        else
        {
            $("#message-error-main").slideDown('slow', function(){
                        setTimeout(function(){
                            $("#message-error-main").slideUp('slow');
                        }, 2000);
                    });
        }
    }
    else
    {
        $("#message-error-clabe").slideDown('slow', function(){
            setTimeout(function(){
                $("#message-error-clabe").slideUp('slow');
            }, 2000);
        });
    }
});

function cargarVista()
{
    $("#message-success").slideDown('slow', function(){
        setTimeout(function(){
            $("#message-success").slideUp('slow');
        }, 2000);
    });
}

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
<div class="span-14" style="display: none; color: #FFFFFF; background-color: #660068; margin-top: 10px" id="message-error-clabe">
   El tama&ntilde;o de la Clabe debe ser de 18 caracteres 
</div>
<div class="span-14" style="display: none; color: #FFFFFF; background-color: #660068; margin-top: 10px" id="message-error-main">
    Favor de llenar los campos nombre o apellido paterno o apellido materno
</div>
<div class="span-14" style="display: none; color: #FFFFFF; background-color: #660068; margin-top: 10px" id="message-error-one">
    Error en la Clabe, los datos no coinciden
</div>
<div class="span-14" style="display: none; color: #FFFFFF; background-color: #660068; margin-top: 10px" id="message-error-two">
    Seleccion el banco de tu cuenta
</div>
<div class="span-14" style="display: none; color: #FFFFFF; background-color: #660068; margin-top: 10px" id="message-success">
    Tus datos se han guardado exitosamente
</div>
<div class="span-14">
    <?php $total = count_total_register_tranfer($this->session->userdata('id')); ?>
    <?php if($total == 0): ?>
        <?php echo form_open('transacciones/save_transfer', array('id'=>'transfer-trans')); ?>
            <div class="span-13">
                <div class="span-3">
                    <?php echo form_label('Nombre completo: ', 'nombre'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'nombre_completo',
                                                'name'=>'Transfer[transferenciaNombreCompleto]',
                                                'class'=>'nombres',
                                                'style'=>'')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Apellido paterno: ', 'apellidop'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'apellido_paterno',
                                                'name'=>'Transfer[transferenciaApellidoPaterno]',
                                                'class'=>'apellidos',
                                                'style'=>'')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Apellido materno: ', 'apellidom'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'apellido_materno',
                                                'name'=>'Transfer[transferenciaApellidoMaterno]',
                                                'class'=>'apellidos',
                                                'style'=>'')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Email: ', 'email'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo $usuarios->email; ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('No. CLABE:', 'noClabe'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'clabeBancaria',
                                                'class'=>'',
                                                'name'=>'Transfer[llaveUsuarioTransferencia]',
                                                'value'=>'',
                                                'style'=>'')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Repita el No. CLABE:', 'noClabeAgain'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'clabeBancariaCheck',
                                                'class'=>'',
                                                'name'=>'Transfer[llaveUsuarioTransferencia2]',
                                                'value'=>'',
                                                'style'=>'')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Banco:', 'banco'); ?>
                </div>
                <div class="span-10 last">
                    <?php $optionsBank = 'id="bank"
                                          class="banks"'; ?>
                    <?php echo form_dropdown('Transfer[idBancoTransferenciaUsuario]',
                                             $bancos,
                                             '',
                                             $optionsBank); ?>
                </div>
            </div>
            <div class="span-13 last">
                <?php echo form_submit('Guardar', 'guardar'); ?>
            </div>
        <?php echo form_close(); ?>
    <?php else: ?>
        <?php $datos_transfer = get_all_data_transfers($this->session->userdata('id')); ?>
        <?php echo form_open('transacciones/update_transfer', array('id'=>'transfer-trans')); ?>
            <div class="span-13">
                <div class="span-3">
                    <?php echo form_label('Nombre completo: ', 'nombre'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'nombre_completo',
                                                'name'=>'Transfer[transferenciaNombreCompleto]',
                                                'class'=>'nombres',
                    							'value'=>$datos_transfer->transferenciaNombreCompleto )); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Apellido paterno: ', 'apellidoP'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'apellido_paterno',
                                                'name'=>'Transfer[transferenciaApellidoPaterno]',
                                                'class'=>'apellidos',
                    							'value'=>$datos_transfer->transferenciaApellidoPaterno)); ?>
                </div>
            </div>
            <div class="span-13 last">
            	<div class="span-3">
            		<?php echo form_label('Apellido materno: ', 'apellidoM'); ?>
            	</div>
            	<div class="span-10 last">
            		<?php echo form_input(array('id'=>'apellido_materno',
                                          		'name'=>'Transfer[transferenciaApellidoMaterno]',
		                                        'class'=>'apellidos',
        		                                'value'=>$datos_transfer->transferenciaApellidoMaterno)); ?>
            	</div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Email: ', 'email'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo $usuarios->email; ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('No. CLABE:', 'noClabe'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'clabeBancaria',
                                                'class'=>'',
                                                'name'=>'Transfer[llaveUsuarioTransferencia]',
                                                'value'=>$datos_transfer->llaveUsuarioTransferencia,
                                                'style'=>'')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Repita el No. CLABE:', 'noClabeAgain'); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'clabeBancariaCheck',
                                                'class'=>'',
                                                'name'=>'Transfer[llaveUsuarioTransferencia2]',
                                                'value'=>$datos_transfer->llaveUsuarioTransferencia,
                                                'style'=>'')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-3">
                    <?php echo form_label('Banco:', 'banco'); ?>
                </div>
                <div class="span-10 last">
                    <?php $optionsBank = 'id="bank"
                                          class="banks"'; ?>
                    <?php echo form_dropdown('Transfer[idBancoTransferenciaUsuario]',
                                             $bancos,
                                             $datos_transfer->idBancoTransferenciaUsuario,
                                             $optionsBank); ?>
                </div>
            </div>
            <div class="span-13 last">
                <?php echo form_submit('Guardar', 'guardar'); ?>
            </div>
        <?php echo form_close(); ?> 
    <?php endif; ?>
    <div class="span-13 last" style="color: RED">
        *NOTA: Por cada transferencia bancaria se cobra una comision de $15.00 pesos.
    </div>
</div>
