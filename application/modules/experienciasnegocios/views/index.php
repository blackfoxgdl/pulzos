<?php
/**
 * Vista que se usara para mostrar el formulario
 * de la creacion de las experiencias de vida
 **/
?>
<script type="text/javascript">
$("#mas").click(function(event){ 
    event.preventDefault();
    $(this).hide();
    $("#segundo_tipo").show();
    $("#menos").show();
});

$("#menos").click(function(event){
    event.preventDefault();
    $(this).hide();
    $("#segundo_tipo").hide();
    $("#mas").show();
});
</script>
<div class="span-14 last" style="margin-top: 10px">
    <div class="span-13 last">
        <div class="span-4">
            <?php echo form_label('Tipo de Experiencia: ', 'tipoExp', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-8 last">
            <?php echo form_input(array('id'=>'tipoExperiencia1',
                                        'name'=>'Experiencia1[tipoExperiencia1]',
                                        'class'=>'tipo_experiencias')); ?>
            <?php echo form_button(array('id'=>'mas',
                                         'class'=>'mostrar_div',
                                         'value'=>'otro',
                                         'content'=>'Otro','style'=>'border:3px  solid #660068; background:#660068; color:#FFFFFF; font-size:9px;')); ?>
            <?php echo form_button(array('id'=>'menos',
                                         'class'=>'mostrar_div',
                                         'value'=>'ocultar',
                                         'style'=>'display: none; border:3px  solid #660068; background:#660068; color:#FFFFFF; font-size:9px;',
                                         'content'=>'Ocultar')); ?>        
        </div>
    </div>
    <div class="span-13 last" style="display: none" id="segundo_tipo" >
        <div class="span-4">
            &nbsp;
        </div>
        <div class="span-8 last" style="margin-top: 10px">
            <?php echo form_input(array('id'=>'tipoExperiencia2',
                                        'name'=>'Experiencia1[tipoExperiencia2]',
                                        'class'=>'tipo_experiencias')); ?>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-3">
            <?php echo form_label('Fecha Inicio: ', 'fechaInicio', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-10 last">
            <?php $diaFI = 'id="diaInicio",
                            class="diaIni"';   
                  echo form_dropdown('Pulzos[dia]',$dias, date('d') ,$diaFI); ?>
            <?php $mesFI = 'id="mesInicio",
                            class="mesIni"';
                  echo form_dropdown('Pulzos[mes]',$meses, date('m') ,$mesFI); ?>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-3">
            <?php echo form_label('Fecha Fin: ', 'fechaFin', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-10 last">
            <?php $diaFF = 'id="diaFinal",
                            class="diaFin"';
                  echo form_dropdown('Pulzos[diaT]',$dias,'',$diaFF); ?>
            <?php $mesFF = 'id="mesFinal",
                            class="mesFin"';
                  echo form_dropdown('Pulzos[mesT]',$meses,'',$mesFF); ?>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-13 last">
            <?php echo form_label('Descripci&oacute;n', 'descripcionExp', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-13 last">
            <?php echo form_textarea(array('id'=>'descripcionExperiencias',
                                           'name'=>'Pulzos[pulzoAccion]',
                                           'class'=>'descripcion_experiencia',
                                           'style'=>'width: 524px; height: 80px')); ?>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-13 last">
            <?php echo form_label('El paquete incluye: ', 'paqueteIncluye', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-13 last">
            <?php echo form_textarea(array('id'=>'paqueteIncluyeExperiencias',
                                           'name'=>'Pulzos[pulzoPaqueteIncluye]',
                                           'class'=>'paquete_incluye_experiencia',
                                           'style'=>'width: 524px; height: 80px')); ?>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-13 last">
            <?php echo form_label('Aviso Legal: ', 'avisoLegal', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-13 last">
            <?php echo form_textarea(array('id'=>'avisoLegalExperiencia',
                                           'class'=>'avisoLegalExperiencias',
                                           'name'=>'Pulzos[pulzoAvisoLegal]',
                                           'style'=>'width: 524px; height: 60px')); ?>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-13 last">
            <?php echo form_label('Tipo de Comunicaci&oacute;n: ', 'tipocomunicacion', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-13 last" style="color: #660066">
            &nbsp &nbsp &nbsp &nbsp<?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '1', TRUE); ?> Privada  (solo a tu seguidores) <br />
            &nbsp &nbsp &nbsp &nbsp<?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '2', FALSE); ?> P&uacute;blica  (solo en tu ciudad) <br />
        </div>
    </div>
    <div class="span-14 last">
        <?php $datosDelNegocio = datos_negocios($this->session->userdata('id')); ?>
        <?php echo form_hidden('Pulzos[pulzoSubcategoria]', $datosDelNegocio->negocioSubgiro); ?>
        <?php echo form_hidden('Pulzos[pulzoCategoria]', $datosDelNegocio->negocioGiro); ?>
    </div>
    <div class="span-13 last">
        <div class="span-3">
            <?php echo form_label('Cargar Imagen: ', 'cargarImagen', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-10 last">
            <?php echo form_upload(array('id'=>'',
                                         'name'=>'imagenE',
                                         'value'=>'Cargar Imagen',
                                         'style'=>'')); ?>
        </div>
    </div>
</div>
