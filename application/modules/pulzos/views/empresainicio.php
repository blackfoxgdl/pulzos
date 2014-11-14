<?php 
/**
 * Vista empresa inicio
 * 
 * 
 **/ ?>
<div class="span-13 last" style="margin-top: 20px"><!-- PRINCIPAL PARA EL FORM -->
    <div class="span-14 last">
        <div class="span-7">
            <span style="color:#660068" >
                Fecha Inicio:
            </span>
            <span>
                <?php $diaI = 'id="diaInicio"
                               class="dia_inicio"'; ?>
                <?php echo form_dropdown('Pulzos[dia]',$dias, date('d'), $diaI); ?>
                <?php $mesI = 'id="mesInicio"
                               class="mes_inicio"'; ?>
                <?php echo form_dropdown('Pulzos[mes]',$meses, date('m'), $mesI); ?>
            </span>
        </div>
        <div class="span-6 last">
            <span style="color: #660066">
                Hora
            </span>
            <span>
                <?php $horasI = 'id="horaInicio"
                                        class="hora_inicio"'; ?>
                <?php echo form_dropdown('Pulzos[pulzoHora]',$horas,'',$horasI); ?>
            </span>
        </div>
    </div>
    <div class="span-14 last">
        <div class="span-14 last">
            <div class="span-7">
                <span style="color: #660066">
                    Fecha Final:
                </span>
                <span>
                    <?php $diaF = 'id="diaFinal"
                                   class="dia_final"'; ?>
                    <?php echo form_dropdown('Pulzos[diaT]',$dias,'',$diaF); ?>
                    <?php $mesF = 'id="mesFinal"
                                   class="mes_final"'; ?>
                    <?php echo form_dropdown('Pulzos[mesT]',$meses,'',$mesF); ?>
                </span> 
            </div>
            <div class="span-6">
                <span style="color: #660066">
                    Hora:
                </span>
                <span>
                    <?php $horasI = 'id="horaInicio"
                                        class="hora_inicio"'; ?>
                    <?php echo form_dropdown('Pulzos[pulzoHoraFin]',$horas,'',$horasI); ?>
                </span>
            </div>
        </div>
    </div>
    <div class="span-14 last">
        <div class="span-13 last">
            <span style="color: #660066">
                Descripci&oacute;n
            </span>
        </div>
        <div class="span-13 last">
            <?php echo form_textarea(array('id'=>'comunicar',
                                           'name'=>'Pulzos[pulzoAccion]',
                                           'style'=>'width: 524px; height: 80px'
										  )); ?>
        </div>
    </div>
    <div class="span-14 last">
        <div class="span-13 last">
            <span style="color: #660066">
                Aviso Legal:
            </span>
        </div>
        <div class="span-13 last">
            <?php echo form_textarea(array('id'=>'comunicar',
                                           'name'=>'Pulzos[pulzoAvisoLegal]',
                                           'style'=>'width: 524px; height: 60px'
										  )); ?>
        </div>
    </div>
    <div class="span-14 last">
        <div class="span-13 last">
            <span style="color: #660066">
                Tipo de Comunicaci&oacute;n:
            </span>
        </div>
        <div class="span-13 last">
            <span style="color: #660066">
                &nbsp &nbsp &nbsp &nbsp<?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '1', TRUE); ?> Privada  (solo a tu seguidores)<br />
                &nbsp &nbsp &nbsp &nbsp<?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '2', FALSE); ?> P&uacute;blica  (solo en tu ciudad)<br />
            </span>
        </div>
    </div>
    <div class="span-14 last">
        <?php $datosDelNegocio = datos_negocios($this->session->userdata('id')); ?>
        <?php echo form_hidden('Pulzos[pulzoSubcategoria]', $datosDelNegocio->negocioSubgiro); ?>
        <?php echo form_hidden('Pulzos[pulzoCategoria]', $datosDelNegocio->negocioGiro); ?>
    </div>
    <div class="span-14 last" style="">
        <div class="span-13 last">
            <span style="color: #660066">
                Cargar Imagen:
            </span>
            <?php echo form_upload(array('id'=>'',
                                         'name'=>'imagenP',
                                         'value'=>'Cargar Imagen',
                                         'style'=>'')); ?>
        </div>
    </div>
</div><!-- PRINCIPAL PARA EL FORM -->
