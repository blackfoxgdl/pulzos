<?php
/**
 * Vista que vera la empresa para poder hacer sus promociones
 * de los pulzos que tienen que promocionar o las ofertas a dar
 * a los usuarios que los siguen. Si no los siguen no pueden tomar
 * el pulzo o la oferta del negocio.
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 6, 2011
 * @package pulzosEmpresas
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#comment").focus(function(event){
    event.preventDefault();
    $("#extras").show("fast");
});

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
    $("#dinamica").load(url);
}

$(".menu").click(function(event){
    event.preventDefault();
    var url = $(this).attr("href");
    $("#dinamica").load(url);
});

$(".eliminarPulzo").click(function(event){
    event.preventDefault();
    var url = $(event.currentTarget).attr("href");
    $.get(url);
    $(event.currentTarget).parent().parent().parent().hide("fast");
});

//FECHA
$("#mesInicio").change(function(event){
    event.preventDefault();
    var mes = $(this).attr("value");
    var tamano = $("select[id=diaInicio] > option").size();
    if(mes == "02")
    {
        $("#diaInicio option[value='29']").remove();
        $("#diaInicio option[value='30']").remove();
        $("#diaInicio option[value='31']").remove();
    }
    if(mes == "04" || mes == "06" || mes == "09" || mes == "11")
    {
        $("#diaInicio option[value='31']").remove();
    }
    if(tamano == "29" && (mes == "04" || mes == "06" || mes == "09" || mes == "11"))
    {
        $("#diaInicio").append("<option value='29'>29</option>");
        $("#diaInicio").append("<option value='30'>30</option>");
    }
    if(tamano == "31" && (mes == "01" || mes == "03" || mes == "05" || mes == "07" || mes == "08" || mes == "10" || mes =="12"))
    {
        $("#diaInicio").append("<option value='31'>31</option>");
    }
    if(tamano == "29" && (mes == "01" || mes == "03" || mes == "05" || mes == "07" || mes == "08" || mes == "10" || mes =="12"))
    {
        $("#diaInicio").append("<option value='29'>29</option>");
        $("#diaInicio").append("<option value='30'>30</option>");
        $("#diaInicio").append("<option value='31'>31</option>");
    }
});

$("#mesFinal").change(function(event){
    event.preventDefault();
    var mes = $(this).attr("value");
    var tamano = $("select[id=diaFinal] > option").size();
    if(mes == "02")
    {
        $("#diaFinal option[value='29']").remove();
        $("#diaFinal option[value='30']").remove();
        $("#diaFinal option[value='31']").remove();
    }
    if(mes == "04" || mes == "06" || mes == "09" || mes == "11")
    {
        $("#diaFinal option[value='31']").remove();
    }
    if(tamano == "29" && (mes == "04" || mes == "06" || mes == "09" || mes == "11"))
    {
        $("#diaFinal").append("<option value='29'>29</option>");
        $("#diaFinal").append("<option value='30'>30</option>");
    }
    if(tamano == "31" && (mes == "01" || mes == "03" || mes == "05" || mes == "07" || mes == "08" || mes == "10" || mes =="12"))
    {
        $("#diaFinal").append("<option value='31'>31</option>");
    }
    if(tamano == "29" && (mes == "01" || mes == "03" || mes == "05" || mes == "07" || mes == "08" || mes == "10" || mes =="12"))
    {
        $("#diaFinal").append("<option value='29'>29</option>");
        $("#diaFinal").append("<option value='30'>30</option>");
        $("#diaFinal").append("<option value='31'>31</option>");
    }
});
</script>
<div class="span-18">
    <?php echo anchor('pulzos/index/'.$datosNeg->negocioId,
                 '',
                 array('class'=>'returnP','id'=>'return','style'=>'display:none')); ?>
    <?php echo form_open('pulzos/index/'.$datosNeg->negocioId, array('id'=>'pulzosForm','class'=>'formaPulzar')); ?>
        <div class="span-18 append-bottom">
            <?php echo form_input(array('name'=>'Pulzos[pulzoAccion]',
                                        'id'=>'comment',
                                        'class'=>'comentar',
                                        'value'=>set_value('Pulzos[pulzoAccion]', 'Cual es tu plan'),
                                        'class'=>'pulzador_negocios')); ?>
            <?php echo form_submit(array('id'=>'pulzar_boton',
                                         'class'=>'pulzos',
                                         'value'=>'Pulzar')); ?>
        </div>
        <div class="span-18" id="extras" style="display:none">
            <div class="span-18" id="datos_mas">
                <p>
                    Fecha de Inicio:
                    <?php $diaFI = 'id="diaInicio",
                                  class="diaIni"';   
                          echo form_dropdown('Pulzos[dia]',$dias, date('d'),$diaFI); ?>
                    <?php $mesFI = 'id="mesInicio",
                                    class="mesIni"';
                          echo form_dropdown('Pulzos[mes]',$meses, date('m'),$mesFI); ?>
                </p>
                <p>
                    Fecha de Termino:
                    <?php $diaFF = 'id="diaFinal",
                                    class="diaFin"';
                          echo form_dropdown('Pulzos[diaT]',$dias,'',$diaFF); ?>
                    <?php $mesFF = 'id="mesFinal",
                                    class="mesFin"';
                          echo form_dropdown('Pulzos[mesT]',$meses,'',$mesFF); ?>
                </p>
                <p>
                    Ubicacion:
                    <?php echo form_input(array('id'=>'ubicacionP',
                                                'class'=>'ubicacionPulzos',
                                                'name'=>'Pulzos[pulzoUbicacion]')); ?>
                </p>
            </div>
        </div>
    <?php echo form_close(); ?>
        <div class="span-18 prepend-top">
            <?php foreach($pulzos as $ofertas): ?>
                <div class="span-16 box">
                    <div class="prepend-1 span-2">
                        <?php echo img(array('src'=>get_avatar_negocios($ofertas->negocioUsuarioId),
                            'width'=>'100',
                            'height'=>'100')); ?>
                    </div>
                    <div class="prepend-1 span-12 last">
                        <?php if($this->session->userdata('id') == $ofertas->negocioUsuarioId): ?>
                            <div class="span-1 last right">
                                <?php echo anchor('pulzos/borrar/'.$ofertas->pulzoId,
                                                  'X', array('id'=>'eliminarP','class'=>'eliminarPulzo')); ?>
                            </div>
                            <br />
                        <?php endif; ?>
                        <b>
                            <?php echo $ofertas->pulzoAccion; ?>
                        </b>
                    </div>
                    <div class="prepend-1 span-11 prepend-top">
                        <b>
                            Pulzo hecho por: <?php echo $ofertas->negocioNombre; ?>
                        </b>
                        <div class="span-3 right">
                            <?php echo anchor('pulzos/ver/'.$ofertas->pulzoId, 
                                              'ver promocion', array('id'=>'pulzoOferta','class'=>'menu')); ?>  
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>
