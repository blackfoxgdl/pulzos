<div class="span-13 last desplegable" id="a1">
        <p id="registro">
            <div class="span-2 textFormLogin">
			    <?php echo form_label('Nombre:', 'nombre'); ?>
            </div>
                <?php echo form_input(array('name'=>'EditarU[nombre]',
                                            'id'=>'nombre',
                                            'value'=>$datos->nombre,
											'style'=>'width:217px')); ?>
            	<span id="Error">
					<?php echo form_error('Editar[nombre]'); ?>
                </span>
        </p>
        <p id="registro">
            <div class="span-2 textFormLogin">
                <?php echo form_label('Apellido:','apellidoUsuario'); ?>
            </div>
            <?php echo form_input(array('id'=>'apellido',
                                        'name'=>'EditarU[apellidos]',
                                        'value'=>$datos->apellidos,
                                        'style'=>'width:217px;')); ?>
        </p>
        <p id="registro">
            <div class="span-2 textFormLogin">
				<?php echo form_label('E-mail:','email'); ?>
            </div>
            <?php echo form_input(array('id'=>'email',
                                        'name'=>'EditarU[email]',
                                        'value'=>$datos->email,
			    						'style'=>'width:217px',
										)); ?>
            <span id="Error">
				<?php echo form_error('EditarU[email]'); ?>
            </span>
        </p>
        <p class="registro">
            <div class="span-2 textFormLogin">
                <?php echo form_label('Sexo:', 'sexo'); ?>
            </div>
                <?php $options = 'id="sexo" 
	    		      			  style="width:217px"
		    				      value=""'; ?>
                <?php echo form_dropdown('EditarU[sexo]',
                                        array(2=>'Seleccione su sexo',
                                              0=>'Femenino',
			    			        		  1=>'Masculino'),
				    		        	  $datos->sexo, $options); ?>
                <?php echo form_error('EditarU[sexo]'); ?>
        </p>
        <p id="registro">
            <div class="span-2 textFormLogin">
                <?php echo form_label('Estado Civil:','relaciones'); ?>
            </div>
            <?php $optionsRelations = 'id="relaciones"
                                       style="width: 217px"
                                       value=""'; ?>
            <?php echo form_dropdown('EditarP[relaciones]', $relaciones, $datosP->relaciones, $optionsRelations); ?>
            <span id="Error">
			    <?php echo form_error('EditarP[relaciones]'); ?>
            </span>
        </p>
    </div>
