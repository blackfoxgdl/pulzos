<?php
/**
 * Vista con la cual se mostraran los datos
 * que se necesitan para que el usuario pueda enviar algun
 * mensaje a la persona que desee. Por lo pronto
 * solo se puede enviar a una persona
 * 
 * @author jorgeLeon 
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$('#paraQuienInbox').keyup(function(event){
       if($(this).attr('value')!=''){
           $('#completarAmigos').show().addClass('autoComplete-Inbox');
       }else{
           $('#completarAmigos').hide();

       }
       event.preventDefault();
       var actionAttr = $("#returnAmigos").attr("href");
       var dataAction = $("#paraQuienInbox").attr("value");
       $.ajax({
            type: "POST",
            url: actionAttr,
            data: "buscarAmigo="+dataAction,
            complete: function(){
               cargarAmigo();
            }
        });
});

function cargarAmigo()
{
    urlReturn = $("#returnAmigos").attr("href");
    var texto = $("#paraQuienInbox").attr("value");
    texto1=replaceAll(texto,' ','_');
    urlMain = urlReturn + '/' + texto1;
     $("#completarAmigos").load(urlMain);
}
$("#formInbox").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{ 
    $('#idPara').remove();
    var urlReturn = $("#indexReturn").attr("href");
    $('#msjCrear').hide();
    $("#inbox").load(urlReturn);
}

function replaceAll(t, r, c) {
        return t.replace(new RegExp(r, 'g'),c);
      }
    
$(document).ready(function(){
    nombre_profile = $("#nombre").text();
    $("#nombre-profile").text(nombre_profile);
    var texto = $("div#menu-derecha").html();
    $("#main-div").html(texto);
});

$('#planesU').click(function(event){
   
    event.preventDefault();
    nuevo= $("#formInbox").attr("action");

    $("#inbox").load(nuevo); 
});



</script>
<?php if(isset($idPara)){ ?>
<div style="display: none;">
    <div id="nombre">Mensajes</div>
    
</div>
<div id="inbox">
</div>
<?php } ?>
<div style="display: none;">
    <div id="nombre">Mensajes</div>
</div>
<div id="msjCrear" class="span-14 last" style="margin-top: 10px;border-bottom:1px solid #DFCBDF;">
    <?php if($numeroAmigos != '0'): ?>

        <?php echo anchor('inboxusuarios/index/'.$idUsuario, '', array('style'=>'display: none;', 'id'=>'indexReturn')); ?>
        <?php echo anchor('inboxusuarios/todos_mensajes', '', array('style'=>'display:none', 'id'=>'returnLoad')); ?>
        <?php echo anchor('inboxusuarios/autoAmigos/'.$idUsuario, '', array('style'=>'display:none', 'id'=>'returnAmigos')); ?>
        <?php echo form_open('inboxusuarios/crear/'.$idUsuario, array('id'=>'formInbox', 'class'=>'inboxForm')); ?>
        <input type="hidden" value="<?php echo $idUsuario;?>" id="idUsuario" />
            <div class="span-14 last" style="margin-left: 10px;margin-bottom:15px">
           
                <div class="span-2 last" style="color: #660066">
                    <?php echo form_label('Para:', 'paraInbox'); ?>
                </div>
                
                <div class="span-12 last" style="margin-bottom: 5px">
                    <?php $valores = 'id="paraQuienInbox"
                                      class="para_quien"'; ?>
                  <?php if(isset($idPara)){ ?> 
                    <input type="hidden" id="idOculto" name="Inbox[inboxnUsuarioRecibeId]" class="idPara" value="<?php echo $idPara;?>" />
                        <span id="paraQuien">
                            <div id="paraMsj" style="width: 450px;border: 1px solid #DFCBDF;">
                                    <span style="background-color:#FFFFFF;border: 1px solid #DFCBDF;font-family:Arial, Helvetica, sans-serif;font-size: 11px;color: #555555;margin-left:1px;"><?php echo get_complete_username($idPara).' ';?> 
                                    </span>
                            </div>
                        </span>
                        <?php }else{ ?>
                    <span id="addUsuario">
                    <?php echo form_input(array('id'=>'paraQuienInbox',
                                                'class'=>'para_quien',
                                                'autocomplete'=>'off',
                                                'style'=>'color: #666666;width: 450px;border: 1px solid #DFCBDF;' )); ?>
                    </span>
                    <?php } ?>
                    <?php echo form_input(array('id'=>'idOculto',
                                                'type'=>'hidden',
                                                'name'=>'Inbox[inboxnUsuarioRecibeId]',
                                                'value'=>(isset($idPara)?$idPara:'')));?>
                </div>
                
                <div class="span-2 last" style="color: #660066">
                    <?php echo form_label('Asunto: ', 'asuntoInbox'); ?>
                </div>
                
                <div class="span-12 last" style="margin-bottom: 5px ">
                    <?php echo form_input(array('id'=>'inboxNegociosAsunto',
                                                'class'=>'inbox_negocios_asunto',
                                                 'autocomplete'=>'off',
                                                'name'=>'Inbox[inboxnAsunto]',
                                                'style'=>'color: #555555;width: 450px;border: 1px solid #DFCBDF;' )); ?>
                </div>
                
                <div class="span-2 last" style="color: #660066">
                    <?php echo form_label('Mensaje: ','mensajeInbox'); ?> 
                </div>
                
                <div class="span-12 last">
                    <?php echo form_textarea(array('id'=>'cuerpoMensaje',
                                                   'name'=>'Inbox[inboxnMensaje]',
                                                   'style'=>'color: #555555;width: 450px;border: 1px solid #DFCBDF;',
                                                   'class'=>'',
                                                   'cols'=>'51',
                                                   'rows'=>'3')); ?>
                </div>
                 <div class="span-13" style="display: none; margin-top: 3px" id="link-comment">
                    <?php echo form_input(array('id'=>'enlace-comentario',
                                                'class'=>'',
                                                'value'=>'Enlace',
                                                'name'=>'enlace',
                                                'style'=>'width: 446px; heigth: 28px;margin-left: 70px',
                                                'onblur'=>"return aparecer('Enlace')",
                                                'onfocus'=>"return desaparecer('Enlace')")); ?> 
                     
                </div>
                
                <div id="btnsMsj" style="margin-left:395px;">
                    <?php echo form_submit(array('id'=>'enviarMensaje',
                                                 'class'=>'btn_inboxEnviar',
                                                 'style'=>'cursor:pointer;width:45px;background-color:#660066;color:#FFF;border:none;font-size:11px;height:20px;margin-top:10px',
                                                 'value'=>'Enviar')); ?>
                     
                    <?php echo form_submit(array('id'=>'cancelar',
                                                 'type'=>'reset',
                                                 'class'=>'cancelar_mensaje',
                                                 'style'=>'cursor:pointer;width:60px;background-color:#660066;color:#FFF;border:none;font-size:11px;height:20px;margin-left:5px;margin-top:10px',
                                                 'value'=>'Cancelar',
                                                 'onclick'=>'cargarVista()')); ?>
                </div>
<div id="completarAmigos"></div>
            </div>
        <?php echo form_close(); ?>
    <?php else: ?>
        <h3 style="color: #8D6E98;">
            No tienens amigos actualmente
        </h3>
    <?php endif; ?> 
        
</div>
