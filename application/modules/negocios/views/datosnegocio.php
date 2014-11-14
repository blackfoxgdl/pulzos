<?php
/**
 * Datos generales para la edicion de los
 * negocios, asi personalizar su perfil y 
 * los datos de ubicacion y seguridad
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#forma-servicios").submit(function(event){
    event.preventDefault();
    opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    $("#id_servicios").fadeIn(1000);
    $("#id_servicios").fadeOut(2000);
    $("#desplegable-S").delay(3000).hide('slow');
    $(".menu-ocultar-S").hide();
    $(".menu-editar-S").show();
}
</script>
<div class="span-14 last" id="desplegable-S">
    <div class="span-13" style="background-color: #A71E9F; color: #FFFFFF; display: none" id="id_servicios">
        Tus servicios han sido guardados
    </div>
    <div class="span-13">
        <?php echo form_open('negocios/datos_servicios/'.$negocios->negocioId, array('id'=>'forma-servicios')); ?>
            <div class="span-13">
                <div class="span-3">
                    <?php echo form_label('Horario: ', 'serviciosHorario', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'negocioHorario',
                                                'name'=>'Servicios[serviciosHorario]',
                                                'value'=>$negocios->negocioHorario)); ?>
                </div>
            </div>
            <div class="span-13">
                <div class="span-5">
                    <?php echo form_label('Tarjeta de Credito: ' , 'tarjetaCredito', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-4 last" style="color: #666666">
                    <?php if($status_servicios == 0): ?>
                        Si<?php echo form_radio('Servicios[serviciosTarjeta]', '1', FALSE); ?>
                        No<?php echo form_radio('Servicios[serviciosTarjeta]', '0', TRUE); ?>   
                    <?php else: ?>
                        <?php if($servicios->serviciosTarjeta == 1): ?>
                            Si<?php echo form_radio('Servicios[serviciosTarjeta]', '1', TRUE); ?>
                            No<?php echo form_radio('Servicios[serviciosTarjeta]', '0', FALSE); ?>  
                        <?php else: ?>
                            Si<?php echo form_radio('Servicios[serviciosTarjeta]', '1', FALSE); ?>
                            No<?php echo form_radio('Servicios[serviciosTarjeta]', '0', TRUE); ?> 
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span-13">
                <div class="span-5">
                    <?php echo form_label('Reservacion necesaria: ', 'reservacionNecesaria', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-4 last" style="color: #666666">
                    <?php if($status_servicios == 0): ?>
                        Si<?php echo form_radio('Servicios[serviciosReservacion]', '1', FALSE); ?>
                        No<?php echo form_radio('Servicios[serviciosReservacion]', '0', TRUE); ?>   
                    <?php else: ?>
                        <?php if($servicios->serviciosReservacion == 1): ?>
                            Si<?php echo form_radio('Servicios[serviciosReservacion]', '1', TRUE); ?>
                            No<?php echo form_radio('Servicios[serviciosReservacion]', '0', FALSE); ?>  
                        <?php else: ?>
                            Si<?php echo form_radio('Servicios[serviciosReservacion]', '1', FALSE); ?>
                            No<?php echo form_radio('Servicios[serviciosReservacion]', '0', TRUE); ?>  
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span-13">
                <div class="span-5">
                    <?php echo form_label('Estacionamiento: ', 'estacionamientos', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-4 last" style="color: #666666">
                    <?php if($status_servicios == 0): ?>
                        Si<?php echo form_radio('Servicios[serviciosEstacionamiento]', '1', FALSE); ?>
                        No<?php echo form_radio('Servicios[serviciosEstacionamiento]', '0', TRUE); ?>
                    <?php else: ?>
                        <?php if($servicios->serviciosEstacionamiento == 1): ?>
                            Si<?php echo form_radio('Servicios[serviciosEstacionamiento]', '1', TRUE); ?>
                            No<?php echo form_radio('Servicios[serviciosEstacionamiento]', '0', FALSE); ?>
                        <?php else: ?>
                            Si<?php echo form_radio('Servicios[serviciosEstacionamiento]', '1', FALSE); ?>
                            No<?php echo form_radio('Servicios[serviciosEstacionamiento]', '0', TRUE); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span-13">
                <div class="span-5">
                    <?php echo form_label('WiFi: ', 'serviciosWifi', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-4 last" style="color: #666666">
                    <?php if($status_servicios == 0): ?>
                        Si<?php echo form_radio('Servicios[serviciosWifi]', '1', FALSE); ?>
                        No<?php echo form_radio('Servicios[serviciosWifi]', '0', TRUE); ?>
                    <?php else: ?>
                        <?php if($servicios->serviciosWifi == 1): ?>
                            Si<?php echo form_radio('Servicios[serviciosWifi]', '1', TRUE); ?>
                            No<?php echo form_radio('Servicios[serviciosWifi]', '0', FALSE); ?>
                        <?php else: ?>
                            Si<?php echo form_radio('Servicios[serviciosWifi]', '1', FALSE); ?>
                            No<?php echo form_radio('Servicios[serviciosWifi]', '0', TRUE); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span-13">
                <div class="span-5">
                    <?php echo form_label('Servicio a domicilio: ', 'serviciosADomicilio', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-4 last" style="color: #666666">
                    <?php if($status_servicios == 0): ?>
                        Si<?php echo form_radio('Servicios[serviciosDomicilio]', '1', FALSE); ?>
                        No<?php echo form_radio('Servicios[serviciosDomicilio]', '0', TRUE); ?>
                    <?php else: ?>
                        <?php if($servicios->serviciosDomicilio == 1): ?>
                            Si<?php echo form_radio('Servicios[serviciosDomicilio]', '1', TRUE); ?>
                            No<?php echo form_radio('Servicios[serviciosDomicilio]', '0', FALSE); ?>
                        <?php else: ?>
                            Si<?php echo form_radio('Servicios[serviciosDomicilio]', '1', FALSE); ?>
                            No<?php echo form_radio('Servicios[serviciosDomicilio]', '0', TRUE); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span-13">
                <div class="span-5">
                    <?php echo form_label('Acceso a silla de ruedas: ', 'serviciosDiscapacitados', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-4 last" style="color: #666666">
                    <?php if($status_servicios == 0): ?>
                        Si<?php echo form_radio('Servicios[serviciosDiscapacidad]', '1', FALSE); ?>
                        No<?php echo form_radio('Servicios[serviciosDiscapacidad]', '0', TRUE); ?>
                    <?php else: ?>
                        <?php if($servicios->serviciosDiscapacidad == 1): ?>
                            Si<?php echo form_radio('Servicios[serviciosDiscapacidad]', '1', TRUE); ?>
                            No<?php echo form_radio('Servicios[serviciosDiscapacidad]', '0', FALSE); ?>
                        <?php else: ?>
                            Si<?php echo form_radio('Servicios[serviciosDiscapacidad]', '1', FALSE); ?>
                            No<?php echo form_radio('Servicios[serviciosDiscapacidad]', '0', TRUE); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span-8" style="text-align: center; margin-bottom: 20px">
                <?php echo form_submit(array('id'=>'guardarDatos',
                                             'value'=>'Guardar',
                                             'class'=>'guarda_datos',
                                             'style'=>'background-color: #660066; color: #FFFFFF; border: none; font-size: 12px; height: 20px; margin-top: 8px')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
