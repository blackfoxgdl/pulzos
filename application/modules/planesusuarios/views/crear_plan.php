<?php 
/**
 * Vista para la creacion de los planes de usuario
 * pero con alguna empresa de interes que esten
 * siguiendo en su perfil
 **/
?>
<div class="span-24"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="span-4" style="margin-top: 12px"><!-- DIV DE LA DERECHA -->
        <?php echo img(array('src'=>get_avatar_negocios($negocios->negocioId),
                             'width'=>'160px',
                             'height'=>'160px')); ?>
    </div><!-- DIV DE LA DERECHA -->
    <div class="span-19 last" style="margin-left: 20px"><!-- DIV DEL CENTRO DERECHA -->
        <div class="span-20 last"><!-- DIV DEL FORMULARIO -->
            <?php echo form_open('planesusuarios/guardar_plan_con_empresa/'.$usuario->id.'/'.$negocios->negocioId); ?>
                <?php $atributos = array('class'=>'verLabel', 'style'=>'color: #660066'); ?>
                <div class="span-14"><!-- INICIO DEL FORMULARIO -->
                    <div class="span-13 last" style="margin-top: 10px">
                        <div class="span-2" style="margin-top: 22px">
                            <?php echo form_label('Fecha Inicio:', 'fechaInicio', $atributos); ?>
                        </div>
                        <div class="span-11 last" style="margin-top: 10px">
                            <div class="span-5 last" style="margin-top: 7px">
                                <?php $diaI = 'id="diaInicio"
                                               class="dia_inicio"'; ?>
                                <?php echo form_dropdown('PlanN[planDiaInicio]',
                                                         $dias,
                                                         date('d'),
                                                         $diaI); ?>
                                <?php $mesI = 'id="mesInicio"
                                               class="mes_inicio"'; ?>
                                <?php echo form_dropdown('PlanN[planMesInicio]',
                                                          $meses,
                                                          date('m'),
                                                          $mesI); ?>
                            </div>
                            <div class="span-1" style="margin-top: 10px">
                                <?php echo form_label('Hora:', 'horaInicio', $atributos); ?>
                            </div>
                            <div class="span-5 last" style="margin-top: 7px">
                                <?php $horasI = 'id="horaInicio"
                                                class="hora_inicio"'; ?>
                                <?php echo form_dropdown('PlanN[planHoraInicio]',
                                                          $horas,
                                                          '',
                                                          $horasI); ?>
                            </div>
                        </div>
                    </div>
                    <div class="span-13">
                        <div class="span-2" style="margin-top: 16px">
                            <?php echo form_label('Lugar:', 'planLugar', $atributos); ?>
                        </div>
                        <div class="span-11 last" style="margin-top: 16px">
                            <?php echo form_input(array('id'=>'planLugar',
                                                        'class'=>'lugar',
                                                        'name'=>'PlanN[planLugar]',
                                                        'value'=>$negocios->negocioNombre,
                                                        'style'=>'color: #666666; width: 428px; border: 1px solid #CDCDCD',
                                                        'readonly'=>'readonly')); ?>
                        </div>
                    </div>
                    <div class="span-13 last" style="margin-top: 7px">
                        <?php echo form_label('Direcci&oacute;n:', 'direccion', $atributos); ?>
                    </div>
                    <div class="span-13 last" style="margin-top: 2px">
                        <?php echo form_input(array('id'=>'descripcionLugar',
                                                    'class'=>'descripcion',
                                                    'name'=>'PlanN[planDireccion]',
                                                    'style'=>'color: #666666; width: 510px; border: 1px solid #CDCDCD',
                                                    'value'=>$negocios->negocioDireccion,
                                                    'readonly'=>'readonly')); ?>
                    </div>
                    <div class="span-13 last" style="margin-top: 10px">
                        <div class="span-13" style="margin-top: 16px">
                            <?php echo form_label('Descripci&oacute;n:', 'descripcion', $atributos); ?>
                        </div>
                        <div class="span-13 last">
                            <?php echo form_textarea(array('id'=>'planDescripcion',
                                                           'class'=>'descripcion',
                                                           'name'=>'PlanN[planDescripcion]',
                                                           'style'=>'color: #666666; width: 510px; border: solid 1px #CDCDCD',
                                                           'cols'=>'55',
                                                           'rows'=>'6')); ?>
                        </div>
                    </div>
                    <div class="span-13 last" style="margin-top: 10px">
                        <?php echo form_label('Amigos:', 'amigos'); ?>
                    </div>
                    <div class="span-13 last">
                        <?php $i = 1; ?>
                        <?php foreach($amigos as $amigo): ?>
                            <div class="span-2 last">
                                <?php echo img(array('src'=>get_avatar($amigo->id),
                                                     'width'=>'30',
                                                     'height'=>'30',
                                                     'title'=>$amigo->nombre)); ?>
                                <br />
                                <?php echo form_checkbox('amigos[]', $amigo->id, FALSE); ?>
                                <?php echo cut_name_user($amigo->nombre); ?>
                                <?php $i = $i + 1; ?>
                            </div>
                        <?php endforeach; ?>
                    <input type="hidden" name="amigos[]" value="<?php echo $this->session->userdata('id')?>" />
                    </div>
                    <div class="span-13 last" style="margin-top: 10px">
                        <?php echo form_submit(array('id'=>'',
                                                     'class'=>'',
                                                     'style'=>'background-color: #660066; border: none; color: #FFFFFF; cursor: pointer',
                                                     'value'=>'Pulzar')); ?>
                    </div>
                </div><!-- FIN DEL FORMULARIO -->
        </div><!-- DIV DEL FORMULARIO -->
            </div><!-- DIV DEL CENTRO DERECHA -->
</div><!-- DIV PRINCIPAL **FIN** -->
