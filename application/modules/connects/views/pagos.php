<?php
/**
 * Vista que refleja los datos del usuario que realizara los 
 * pagos con el dinero que tiene en su cuenta de pulzos, esto
 * para que el usuario pueda pagar cosas que compra y vean
 * bien los datos de los usuarios que ya han recibido bonificaciones
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
    $("#rechazarTransaccion").click(function(event){
        event.preventDefault();
        location.href = 'http://<?php echo str_replace('%2F', '/', $url); ?>';
    });
});
</script>
<div class="span-24">
    <div class="span-14 last" id="margen" style="margin-top: 50px; margin-bottom: 20px; margin-left: 160px; color: #511E59">
        <div class="prepend-3">
            <div class="prepend-2 span-10" style="margin-top: 25px">
                <?php echo img(array('src'=>'statics/img/PaypulzosBlanco.png',
                                     'width'=>'146px',
                                     'height'=>'39px')); ?>
            </div>
            <?php echo form_open('connects/save_payments'); ?>
                <div clasS="span-10" style="margin-top: 10px">
                    <div class="span-3">
                        <?php echo form_label('Nombre: ', 'nombre', array('style'=>'font-size: 14px')); ?>
                    </div>
                    <div class="span-7 last">
                        <?php echo form_input(array('name'=>'Payments[transaccionNombreUsuario]',
                                                    'id'=>'',
                                                    'value'=>$usuarios->nombre . ' ' . $usuarios->apellidos,
                                                    'class'=>'',
                                                    'readonly'=>'readonly',
                                                    'style'=>'')); ?>
                        <?php echo form_hidden('Payments[transaccionUsuarioId]', $usuarios->id); ?>
                    </div>
                </div>
                <div class="span-10">
                    <div class="span-3">
                        <?php echo form_label('E-mail', 'email', array('style'=>'font-size: 14px')); ?>
                    </div>
                    <div class="span-7 last">
                        <?php echo form_input(array('name'=>'Payments[transaccionEmailUsuario]',
                                                    'id'=>'',
                                                    'class'=>'',
                                                    'style'=>'',
                                                    'readonly'=>'readonly',
                                                    'value'=>$usuarios->email)); ?>
                    </div>
                </div>
                <div class="span-10">
                    <div class="span-3">
                        <?php echo form_label('Concepto: ', 'concepto', array('style'=>'font-size: 14px')); ?>
                    </div>
                    <div class="span-7 last">
                        <?php echo form_input(array('class'=>'',
                                                    'name'=>'Payments[transaccionNombreEmpresa]',
                                                    'id'=>'',
                                                    'style'=>'',
                                                    'value'=>$empresas->negocioNombre,
                                                    'readonly'=>'readonly')); ?>
                        <?php echo form_hidden('Payments[transaccionNegocioId]', $empresas->negocioId); ?>
                    </div>
                </div>
                <div class="span-10">
                    <div class="span-3">
                        <?php echo form_label('Total a pagar: ', 'totalPagar', array('style'=>'font-size: 14px')); ?>
                    </div>
                    <div class="span-7 last" style="margin-left: -10px">
                        $
                        <?php echo form_input(array('name'=>'Payments[transaccionTotalPagar]',
                                                    'style'=>'',
                                                    'value'=>$total,
                                                    'readonly'=>'readonly',
                                                    'id'=>'',
                                                    'class'=>'')); ?>
                        MX.
                    </div>
                </div>
                <div class="span-10" style="margin-bottom: 35px; margin-top: 10px">
                    <div class="prepend-1 span-3">
                        <?php $disponibilidad = check_disponibility($usuarios->id);
                            //echo "hola. " . $disponibilidad->;
                        ?>
                        <?php if($disponibilidad > $total): ?>
                            <?php echo form_submit(array('name'=>'aceptar',
                                                         'class'=>'aceptar_trans',
                                                         'id'=>'aceptarTransaccion',
                                                         'style'=>'margin-left: 40px',
                                                         'value'=>'')); ?>
                        <?php else: ?>
                            <?php echo form_submit(array('name'=>'aceptar',
                                                         'class'=>'aceptar_trans',
                                                         'id'=>'aceptarTransaccion',
                                                         'style'=>'margin-left: 40px',
                                                         'disabled'=>'disabled',
                                                         'value'=>'')); ?>
                        <?php endif; ?>
                    </div>
                    <div class="span-3">
                        <?php echo form_reset(array('name'=>'rechazar',
                                                    'class'=>'rechazar_trans',
                                                    'id'=>'rechazarTransaccion',
                                                    'value'=>'',
                                                    'style'=>'margin-left: -10px')); ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
