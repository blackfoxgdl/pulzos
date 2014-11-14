<?php
/**
 * Vista en la cual se mostrar el formulario para responder
 * la usuario la duda que esta solicitando o alguna
 * informacion especifica. NOTA SE USA EL ID DE EMPRESA EN
 * LA TABLA DE USUARIOS NO EN LA TABLA DE NEGOCIOS
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 6, 2011
 * @package InboxNegocios
 **/ 

?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#responderForm").submit(function(event){
    event.preventDefault();
    if($('#InboxM').val()==''){
        $('.'+$(event.currentTarget).attr("class")).hide('1000');
        return false;
    }else{
        $('.'+$(event.currentTarget).attr("class")).hide('1000');
        var opciones = {
            success: loadView
        };
        $(this).ajaxSubmit(opciones);
        return false;
    }
});

function loadView()
{
    urls = $("#regresarIU").attr("href");
    urlP=$('.redirect').attr('value');
    urlMain=urls+'/'+urlP;
    setTimeout(function(){
        $("#inbox").load(urlMain);
    },200);
    
}

$("#cancelar").click(function(event){
     event.preventDefault();
     $('.formResp').hide('1000');
});


</script>
<div class="span-14 last formResp" >
    <div class="span-14">

    </div>
    <div class="" style="margin-left: 52px;">
        <?php
            if($datosUserInbox->inboxnUsuarioId==$this->session->userdata('id'))
            {
            echo form_open('inboxusuarios/responder/'.$this->session->userdata('id').'/'.$datosUserInbox->inboxnUsuarioRecibeId.'/'.$datosUserInbox->inboxnConversacionId,
                             array('id'=>'responderForm', 'class'=>'responderF'));?>
            <input type="hidden" class="redirect" value="<?php echo $datosUserInbox->inboxnUsuarioRecibeId; ?>" />
           <?php      
           }else{
               echo form_open('inboxusuarios/responder/'.$this->session->userdata('id').'/'.$datosUserInbox->inboxnUsuarioId.'/'.$datosUserInbox->inboxnConversacionId,
                             array('id'=>'responderForm', 'class'=>'responderF'));?>
                <input type="hidden" class="redirect" value="<?php echo $datosUserInbox->inboxnUsuarioId; ?>" />
               
         <?php } ?>
            <div class="span-13">

                <div class="span-11 last">
                    <?php echo form_textarea(array('id'=>'InboxM',
                                                   'class'=>'InboxMensaje',
                                                   'name'=>'Respuesta[inboxnMensaje]',
                                                   'style'=>'width: 465px; height: 22px; border: 1px solid;border-color:#999999',
                                                   'cols'=>'40',
                                                   'rows'=>'1')); ?>
  
                </div>
            </div>
            <div class="span-13 last" style="margin-bottom: 30px;margin-top: 3px">
                
                <?php echo form_input(array('id'=>'cancelar',
                                            'style'=>'cursor:pointer;margin-right:10px;background-color:#660066;border:none;font-size:12px;color:#FFF;font-size:12px;height:20px;width:66px;margin-top:10px',
                                            'type'=>'submit',
                                            'value'=>'Cancelar'));
                
              echo anchor('inboxusuarios/ver/','', array('id'=>'regresarIU', 
                                                    'style'=>'display:none',
                                                    'class'=>'menu'));?>

              <?php echo form_submit(array('id'=>'enviar',
                                             'class'=>'enviarI',
                                             'style'=>'cursor:pointer;background-color:#660066;width:75px;color:#FFF;border:none;font-size:12px;height:20px;margin-top:10px',
                                             'value'=>'Responder')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
