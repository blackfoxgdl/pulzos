<?php
/**
 * mostrar formulario de captura de Pulzos nuevos
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright Zavordigital, 10 March, 2011
 * @package Pulzos
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
 <script type="text/javascript">
 $("#pulzosForm").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: loadView
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function loadView(){

    var url = $("#return").attr("href");
    var urlC = $("#cargarVista").attr("href");
    $("#pulzos_hecho").load(url);
    $("#texto-menu").load(urlC);
}
</script>
<div class="span-14 last" style="margin-top: 20px; margin-left: 10px">
    <div class="soft-header" style="margin-right:30px; margin-bottom: 10px">
        Pulzos
    </div>
    <div class="span-13 last">
        <?php echo anchor('negocios/get_pulzos_nuevos/'.$negocios->negocioId,
                     '',
                     array('class'=>'returnP','id'=>'return','style'=>'display:none')); ?>
        <?php echo anchor('pulzos/ver/'.$negocios->negocioId,
                          '',array('class'=>'', 'id'=>'cargarVista', 'style'=>'display: none')); ?>
        <?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
                <?php echo form_open_multipart('pulzos/guardar_pulzo/'.$negocios->negocioId, array('id'=>'pulzosForm','class'=>'formaPulzar')); ?>
                    <div class="span-3">
                        <?php echo form_label('Titulo:','tituloPulzo'); ?>
                    </div>
                    <div class="span-10 last">
                        <?php echo form_input(array('id'=>'tituloPulzos',
                                                    'name'=>'Pulzos[pulzoTitulo]',
                                                    'class'=>'',
                                                    'value'=>'')); ?>
                    </div>
                    <div class="span-3">
                        <?php echo form_label('Inicia:','fechaInicio'); ?>
                    </div>
                    <div class="span-10 last">
                        <?php $diaFI = 'id="diaInicio",
                                      class="diaIni"';   
                            echo form_dropdown('Pulzos[dia]',$dias, date('d'),$diaFI); ?>
                        <?php $mesFI = 'id="mesInicio",
                                        class="mesIni"';
                              echo form_dropdown('Pulzos[mes]',$meses,'',$mesFI); ?>
                    </div>
                    <div class="span-3">
                        <?php echo form_label('Termina:','fechaFin'); ?>
                    </div>
                    <div class="span-10 last">
                        <?php $diaFF = 'id="diaFinal",
                                        class="diaFin"';
                              echo form_dropdown('Pulzos[diaT]',$dias,'',$diaFF); ?>
                        <?php $mesFF = 'id="mesFinal",
                                        class="mesFin"';
                              echo form_dropdown('Pulzos[mesT]',$meses,'',$mesFF); ?>
                    </div> 
                    <div class="span-3">
                        <?php echo form_label('Descripcion:','promo'); ?>
                    </div>
                    <div class="span-10 last">
                        <?php echo form_textarea(array('id'=>'comment',
                                                       'name'=>'Pulzos[pulzoAccion]',
                                                       'class'=>'',
                                                       'cols'=>'30',
                                                       'rows'=>'5')); ?>
                    </div>
                    <div class="span-3">
                        <?php echo form_label("Aviso Legal:","aviso"); ?>
                    </div>
                    <div class="span-10 last">
                        <?php echo form_textarea(array('id'=>'pulzoLegal',
                                                       'class'=>'',
                                                       'name'=>'Pulzos[pulzoAvisoLegal]',
                                                       'cols'=>'30',
                                                       'rows'=>'5')); ?>
                    </div>
                    <div class="span-3">
                        <?php echo form_label('Tipo de Comunicacion:','tipoComunicacion'); ?>
                    </div>
                    <div class="span-10 last">
                        <?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '1', TRUE); ?>Privada
                        <br />
                        <?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '2', FALSE); ?>Publica
                        <br />
                        <?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '3', FALSE); ?>Nacional
                    </div>
                    <div class="span-3">
                        <?php echo form_label('Imagen del Evento:','imagenPulzo'); ?>
                    </div>
                    <div class="span-10 last">
                        <?php echo form_upload(array('id'=>'imagenPulzo',
                                                     'name'=>'imagenP',
                                                     'value'=>'')); ?>
                    </div>
                    <?php echo form_submit(array('id'=>'pulzarPulzo',
                                                 'value'=>'Pulzar',
                                                 'name'=>'pulzarButton')); ?>
                <?php echo form_close(); ?>
            <?php endif; ?>
    </div>
</div>
