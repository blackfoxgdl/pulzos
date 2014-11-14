<?php 
/**
 * Vista que se encarga de mostrar el formulario que tendran
 * que llenar los negocios para mostrar las ofertas de que se
 * tienen en en el momento
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#pulzosForm").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
urlLoad = $("#returnLoad").attr("href");
   location.href = urlLoad;
}

    });
</script>
<div class="span-24 last" s><!-- DIV PRINCIPAL DE ESTA VISTA -->
    <?php echo anchor('pulzos/crear_pulzo', '', array('id'=>'returnLoad', 'style'=>'display: none')); 
            $atributo=(array('class'=>'verLabel')); ?>
    <?php echo form_open('pulzos/guardar_pulzo/'.$negocios->negocioId, array('id'=>'pulzosForm')); ?>
        <div class="span-4 last" style="margin-left: 10px; margin-top: 36px"><!-- DIV DE LA IZQUIERDA **INICIO** -->
            <?php echo img('statics/img/default/planes.jpg'); ?>
        </div><!-- DIV DE LA IZQUIERDA **FIN** -->
        <div class="span-14" style="margin-left: 30px; margin-top: 37px"><!-- DIV DEL CENTRO **INICIO** -->
            <div class="span-13 last">
                <div class="span-3" style="margin-top: 3px;">
                    <?php echo form_label('¿Qu&eacute; vas a pulzar?','vasPulzar',$atributo); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'pulzosTitulo',
                                                'class'=>'',
                                                'name'=>'Pulzos[pulzoTitulo]',
                                                'style'=>'width: 407px')); ?>
                </div>
                <div class="span-2" style="margin-top:20px">
                    <?php echo form_label('Fecha Inicio:','fechaInicio',$atributo); ?>
                </div>
                <div class="span-11 last" style="margin-top: 20px">
                    <div class="span-5 last">
                        <?php $diaI = 'id="diaInicio"
                                       class="dia_inicio"'; ?>
                        <?php echo form_dropdown('Pulzos[dia]',$dias,'',$diaI); ?>
                        <?php $mesI = 'id="mesInicio"
                                       class="mes_inicio"'; ?>
                        <?php echo form_dropdown('Pulzos[mes]',$meses,'',$mesI); ?>
                    </div>
                    <div class="span-1" style="margin-top: 4px">
                        <?php echo form_label('Hora:','horaInicio',$atributo); ?>
                    </div>
                    <div class="span-3 last">
                        <?php echo form_input(array('id'=>'',
                                                    'class'=>'',
                                                    'name'=>'Pulzos[pulzoHora]',
                                                    'style'=>'width: 70px')); ?>
                    </div>
                    <div class="span-2 last">
                        &nbsp;
                    </div>
                </div>
                <div class="span-2" style="margin-top: 16px;">
                    <?php echo form_label('Fecha Final:','fechaFin',$atributo); ?>
                </div>
                <div class="span-11 last" style="margin-top: 10px">
                    <div class="span-5 last">
                        <?php $diaF = 'id="diaFinal"
                                       class="dia_final"'; ?>
                        <?php echo form_dropdown('Pulzos[diaT]',$dias,'',$diaF); ?>
                        <?php $mesF = 'id="mesFinal"
                                       class="mes_final"'; ?>
                        <?php echo form_dropdown('Pulzos[mesT]',$meses,'',$mesF); ?>
                    </div>
                    <div class="span-1" style="margin-top: 3px">
                        <?php echo form_label('Hora:','horaFin',$atributo); ?>
                    </div>
                    <div class="span-3 last">
                        <?php echo form_input(array('id'=>'',
                                                    'class'=>'',
                                                    'name'=>'Pulzos[pulzoHoraFin]',
                                                    'style'=>'width: 70px')); ?>
                    </div>
                    <div class="span-2 last">
                        &nbsp;
                    </div>
                </div>
                <div class="span-15" style="margin-top:20px">
                    <?php echo form_label('Tipo de pulzo: ', 'tipoPulzos',$atributo); ?>
                </div>
                <div class="span-10 last">
                    <?php $tipoP = 'id="tipoPulzoSub"
                                    name="subcategorias_pulzos"'; ?>
                    <?php echo form_dropdown('Pulzos[pulzoSubcategoria]', $subcategorias, '', $tipoP); ?>
                </div>
                <div class="span-13 last" style="margin-top: 16px">
                    <?php echo form_label('Descripci&oacute;n:','planDescripciones',$atributo); ?>
                </div>
                <div class="span-13 last">
                    <?php echo form_textarea(array('id'=>'',
                                                   'class'=>'',
                                                   'name'=>'Pulzos[pulzoAccion]',
                                                   'cols'=>'60',
                                                   'rows'=>'6')); ?>
                </div>
                <div class="span-13 last" style="margin-top: 5px">
                    <?php echo form_label('Aviso Legal:','avisoLegalNegocios',$atributo); ?>
                </div>
                <div class="span-13 last">
                    <?php echo form_textarea(array('id'=>'',
                                                   'class'=>'',
                                                   'name'=>'Pulzos[pulzoAvisoLegal]',
                                                   'cols'=>'60',
                                                   'rows'=>'3')); ?>
                </div>
                <div class="span-13 last" style="margin-top: 20px">
                    <?php echo form_label('Tipo de Comunicacion: ', 'tipoComunicacion',$atributo); ?>
                </div>
                <div class="span-13 last" style="color: #000">
                    <?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '1', TRUE); ?>Privada (Solo a tus seguidores)
                    <br />
                    <?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '2', FALSE); ?>Publica (Solo en tu ciudad)
                    <br />
                    <?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '3', FALSE); ?>Nacional (A todo el pais) Aplica costo
                </div>
                <div class="span-13 last" style="margin-top: 10px">
                    <?php echo form_submit(array('id'=>'',
                                                 'class'=>'',
                                                 'value'=>'Pulzar')); ?>
                </div>
            </div>
        </div><!-- DIV DEL CENTRO **FIN** -->
    <?php echo form_close(); ?>
    <div class="span-5 last"><!-- DIV DE LA DERECHA **INICIO** -->
        <div class="span-6" style="background-color: #DED2DE">
            <div class="span-6 last" style="margin-top: 23px">
                <div class="span-6 last" style="background-color: #DED2DE">
                <div class="span-6 last" style="background-color: #8D6E98; margin-bottom: 30px">
                    <div class="soft-header" style="margin-bottom: 10px">
                        Pulzos
                        
                    </div>
                </div>
                <?php $pulzosNegocios = get_pulzo_data($negocios->negocioId, '0'); ?>
                <?php foreach($pulzosNegocios as $pulzoN): ?>
                    <div class="span-6">
                        <div class="soft-header">
                            <?php echo $pulzoN->pulzoTitulo; ?>
                        </div>
                        <div class="span-6" style="background-color: #BAA7DB; color: #FFFFFF;">
                            <span style="margin-left: 10px">
                                <?php echo $pulzoN->pulzoAccion; ?>
                            </span>
                        </div>
                        <div class="prepend-4" style="background-color: #BAA7DB; margin-bottom: 20px;">
                            <?php echo anchor('',
                                              'ver mas', array('class'=>'links')); ?>
                        </div>
                    </div>
                <?php endforeach; ?> 
                </div>
            </div>
        </div>
    </div><!-- DIV DE LA DERECHA **FIN** -->
</div><!-- DIV PRINCIPAL DE ESTA VISTA -->
