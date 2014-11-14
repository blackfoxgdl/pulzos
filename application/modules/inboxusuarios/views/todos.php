<?php

/*
 * Vista que se encarga para mostrar sus
 * todo los mensajes enviados y de salida
 * 
 * 
 * @version 0.1
 * @author jorgeLeon <jorge@zavordigital.com>
 * @copyright ZavorDigital, May 6, 2011
 * @package 
 * 
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
////CARGA DE VISTAS

msjesRecibidos=$('#msjRecibido').attr('href');
$('#msjRecibidos').load(msjesRecibidos);

mEnviado=$('#msjEnviado').attr('href');
$('#msjEnviados').load(mEnviado);

mNLeido=$('#mNLeido').attr('href');
$('#msjNoLeidos').load(mNLeido);

msjesLeídos=$('#msjLeído').attr('href');
$('#msjLeído').load(msjesLeídos);



//****ACCIONES CLICK COLAMPSE RECIBIDOS
$('span#recibidos').click(function(){
    
    $('#msjRecibidos, #opcionesRecibidos').slideToggle();
    $('#msjRecibidos').show();
    $('#opcionesRecibidos').show();
});

 //OPCIONES de Leido sin leer de RECIBIDOS
$('#msjRLeidos').click(function(){
    $('#msjRecibidos').load(msjesLeídos);
});
$('#msjRSLeidos').click(function(){
    $('#msjRecibidos').load(mNLeido);
});
   
   
//****ACCION CLICK COLAPSE DE ENVIADOS
$('span#enviados').click(function(){
    $('#msjEnviados').slideToggle();
    $('#opcionesEnviados').show();
});
});
</script>

<?php echo anchor('inboxusuarios/sinLeer/'.$this->session->userdata('id'),'', array('id'=>'mNLeido','style'=>'display:none')); ?> 
<?php echo anchor('inboxusuarios/bandeja_salida/'.$this->session->userdata('id'),'', array('id'=>'msjEnviado','style'=>'display:none')); ?> 
<?php echo anchor('inboxusuarios/recibidos/'.$this->session->userdata('id'),'', array('id'=>'msjRecibido','style'=>'display:none')); ?> 
<?php echo anchor('inboxusuarios/bandeja_entrada/'.$this->session->userdata('id'),'', array('id'=>'msjLeído','style'=>'display:none')); ?> 



<div style="color: #339900">
 
    
<!--Recibidos-->
<div style="cursor:pointer;">
    
    <span id="recibidos">Recibidos</span>
    <div id="opcionesRecibidos" class="principalRecibidos" style="display: block;">
        <span id="msjRLeidos" style="color: #996699;cursor:pointer">Leídos | </span>
        <span id="msjRSLeidos" style="color: #996699;cursor:pointer">Sin Leer</span>
    </div>
</div>
    
<div id="msjRecibidos" class="principalRecibidos" style="display: block;"></div>



<!--Enviados-->
<div style="cursor:pointer;">
    <span id="enviados">Enviados</span>
</div>

<div id="msjEnviados" style="display:block"></div>

 

</div>