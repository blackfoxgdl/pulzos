<?php
/**
 * Vista para la redireccion del usuario una vez
 * que ya se haya aceptado el pago con sus pulzos
 * disponibles
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
    setTimeout('redireccion("' + $("#redirect").attr('href') + '")', 10000);
});

function redireccion(web)
{
    window.location = web;
}
</script>
<div class="span-24">
    <div class="span-14 last" id="margen" style="margin-top: 50px; margin-bottom: 20px; margin-left: 160px; color: #511E59">
        <div class="prepend-3">
            <div class="prepend-2 span-10" style="margin-top: 25px">
                <?php echo img(array('src'=>'statics/img/PaypulzosBlanco.png',
                                     'width'=>'146px',
                                     'height'=>'39px')); ?>
            </div>
            <div class="span-10 last" style="margin-top: 10px">
                Parte del texto antes de la redireccion
            </div>
            <div class="span-10 last" style="margin-top: 10px; margin-bottom: 30px">
                <?php echo anchor('connects/redirect/'.$id_negocio.'/'.$id_transaccion.'/'.$id_negocio_usuario.'/'.$time_creation,
                                  'Redireccionar',
                                  array('id'=>'redirect', 'style'=>'text-decoration: none; color: #660068')); ?>
            </div>
        </div>
    </div> 
</div>
