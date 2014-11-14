<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#planes-form").submit(function(event){
    event.preventDefault();
    options = {
        success: loadView
    };
    $(this).ajaxSubmit(options);
    return false;
});

$(".planes-link").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#canvas").load(urlToLoad);
});

function loadView(responseText, statusText, xhr, $form){
    urlToLoad = $("#eventos-hechos").attr("href");
    $("#canvas").load(urlToLoad);
}
</script>
<?php
var_dump($idLugar);
?>
<?php echo form_open('planes/index', array('id'=>'planes-form')); ?>
<ul>
    <li><?php echo anchor('planes/hechas', 'Hechos', array('class'=>'planes-link', 'id'=>'eventos-hechos')); ?></li>
    <li><?php echo anchor('planes/recibidas', 'Recibidos', array('class'=>'planes-link')); ?></li>
    <li><?php echo anchor('planes/aceptadas', 'Aceptados', array('class'=>'planes-link')); ?></li>
</ul>
<div class="span-18">
    <h3>¿Que?</h3>
    <?php echo form_input(array('name'=>'Eventos[eventoAccion]', 'value'=>'¿Cual es tu plan?')); ?>
    <br />
    <?php echo form_textarea(array('name'=>'Eventos[eventoDescripcion]', 'value'=>'Describelo', 'cols'=>'80')); ?>
</div>
<?php if(! $idLugar): ?>
<div class="span-18">
    <h3>¿Donde?</h3>
    <?php foreach($negocios AS $negocio): ?>
    <div class="span-5 box">
        <p><?php echo $negocio->negocioNombre; ?></p>
        <p><?php echo $negocio->negocioDireccion; ?></p>
        <p><?php echo $negocio->negocioDescripcion; ?></p>
        <p><?php echo form_radio('Eventos[eventoLugar]', $negocio->negocioId); ?></p>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
    <?php echo form_hidden('Eventos[eventoLugar]', $idLugar); ?>
<?php endif; ?>
<div class="span-18">
    <h3>¿Quien?</h3>
    <?php foreach($amigos AS $amigo): ?>
    <div class="span-5 box">
        <p>
        <?php echo $amigo->nombre; ?>       
        </p>
        <p>
        <?php echo img(array('src'=>get_avatar($amigo->id), 'width'=>'90', 'height'=>'90')); ?>
        </p>
        <p>
        <?php echo form_checkbox('amigos[]', $amigo->id); ?>
        </p>
    </div>
    <?php endforeach; ?>
</div>
<?php echo form_submit(array('value'=>'Planear')); ?>
<?php echo form_close(); ?>
