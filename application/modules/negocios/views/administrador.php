<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("div#adminEventos span").css('color','#660068');
    $('div#eventosOld span').css('color','#660068');
    $('#ver').css('cursor','pointer');
    $('#normal').show();
//funciones de explorador para imagen
if($.browser.mozilla || $.browser.webkit){
            if($.browser.webkit){
                $('#imagenPlan').css('display','block');
            }else{
               $('#imagenPlan').css('display','none');
            }
            $(".notificacion, #preview").hover(function(event){
                event.preventDefault();
                $(".notificacion").css({'display':'block','position':'absolute','margin-top':'0px','width':'140px','margin-left':'0px'});
                }, function(event){
                    $(".notificacion").css('display', 'none');
                    });

            $('#preview').hover(function(){$(this).css('cursor','pointer')});

            $('.notificacion, #preview').click(function(){
            $('#imagenPlan').trigger('click');
            });
        }

});
    //Cambio de giro en lista desplegable
    $('#giro').change(function(event){
        event.preventDefault();
        id=$(this).attr('value');
        url= '<?php echo base_url();?>index.php/negocios/createSubGiro/';
        
        $.post(url, 
           {idC:id},
           function(data){
               $("#subgiro > option").remove();
               $.each(data, function(index, value){
                   $("#subgiro").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
           },"json");      
    });
    //envio de formulario
    $('#frm_admin').submit(function(event){
        event.preventDefault();
        var opciones={
            success:cargar
        }
        $(this).ajaxSubmit(opciones);
        return false;
        
    });
    function cargar(){
        urlMain=$('#return').attr('href');
        $('#texto-menu').load(urlMain);
    }
    //desplegar eventos
    $('#ver').click(function(){
        $('#eventosOld').slideToggle('slow');
    });
    //eliminar
    $('.lnkEliminar').click(function(event){
    var deleteC=confirm("Deseas eliminar el evento?");
    if(deleteC==true){
        event.preventDefault();
        urlEs = $(this).attr('href');
        $.get(urlEs);
        $(event.currentTarget).parent().parent().hide();
    }else{
        return false;
    }
    });


//imagen
$('#imagenPlan').live('change', function(){
        $("#preview").html('');
        $(".notificacion").css('display', 'none');
        $("#preview").html("<div style='margin-top:40px;text-align: center;background-color:#F0F0F0'><img src='<?php echo base_url().'/statics/img/cargador.gif'; ?>'  width='50' height='50'/><\div>");
        $("#subirImagenes").ajaxForm({
            target: '#preview'
            }).submit();

    });
//Cambio de tipo de publicacion 
$('select[name="admin[pulzoDuracionReto]"]').change(function(event){
    event.preventDefault();
    switch($(this).attr('value')){
        case 'normal':
          $('.tipo').slideUp('fast');
          $('#normal').slideDown('fast');
        break;
          
        case 'finDeSemana':  
          $('.tipo').slideUp('fast');
          $('#finSemana').slideDown('fast');
        break;    
        
        case 'entreSemana':
          $('.tipo').slideUp('fast');
          $('#entreSemana').slideDown('fast');
        break;
        }
        
        
});

</script>

<?php echo anchor('negocios/administrador/', '', array('id'=>'return','style'=>'display:none'));?>
<?php echo anchor('negocios/createSubGiro/', '', array('id'=>'subGiro','style'=>'display:none'));?>
<div id="eAdmin" style="margin-top: 30px" >
<h3 style="text-align:center "><span style="color:#8D6E98">Eventos Generales</span></h3>
<div class="span-13 " style="border-top:1px solid #DFCBDF;margin-top:5px"></div>
<p>&nbsp;</p>

<?php echo form_open('negocios/administrador/'.$this->session->userdata('idN'),array('id'=>'frm_admin')); ?>    
    <div class="span-14 last" id="adminEventos">
         <div class="span-4 last"><!-- DIV DE LA IZQUIERDA **INICIO** -->
             <div id="preview" style="width:140px">
                <?php echo img(array('src'=>'statics/img/default/pulzos-images/avatar.png','id'=>'avatar-photo')); ?>
             </div>    
        </div>
        
        <div class="notificacion" style="display: none;background-color: #BAA7BD;color: #FFFFFF;width: 160px;margin-bottom: 40px">
            <div style="cursor: pointer;">Cambiar Imagen</div>       
        </div>
       <div class="span-8" style="margin-top: 40px">
            <span>Titulo: </span>
            <input type="text" name="admin[pulzoTitulo]" id="" style="width: 350px;height: 18px"  />
       </div>
        
       <div class="span-8" style="margin-top: 15px">
            <span>Lugar:</span>
            <input type="text" name="admin[pulzoUbicacion]" id="lugar" style="width: 350px;height: 18px" />
       </div>
        
       <div class="span-12" style="margin-top: 15px">
            <span class="span-10">Descripcion:</span>
            <textarea name="admin[pulzoAccion]" id="descripcion" style="width: 500px;height: 80px"></textarea>
       </div>
        
       <div class="span-12" style="margin-top: 8px">
            <span>Aviso Legal: </span>
            <textarea name="admin[pulzoAvisoLegal]" id="avisoLegal" style="width: 500px;height: 55px"></textarea>
            
       </div>
        
<!--       Tipo de publicacion-->
       <div class="span-12" style="margin-top: 15px">
           <span>Tipo de publicacion:</span>
            <?php echo form_dropdown('admin[pulzoDuracionReto]',$tipo,'1',array('id="tipo"')); ?>
       </div>
        
        
<!--      Normal-->
       <div id="normal" class="span-12 tipo" style="margin-top: 15px" style="display: none">
            <span>Término del evento:</span>     
            <?php echo form_dropdown('admin[dia]',$dias,date('d'),array('id="dias"')); ?>
            <?php echo form_dropdown('admin[mes]',$meses,date('m'),array('id="meses"'));?>
            <span>Hora: </span>
            <?php echo form_dropdown('admin[pulzoHoraFin]',$horas,'',array('id="horas'));?>
       </div>  
<!--   Fines de Semana-->
        <div class="span-12 tipo" id="finSemana" style="display:none;margin-top: 15px">
            <span>Viernes, Sabado y Domingo</span> 
        </div>
<!--Entre Semana-->
        <div class="span-12 tipo" id="entreSemana" style="display:none;margin-top: 15px">
            <span>Lunes, Martes, Miercoles, Jueves, Viernes.</span>
        </div>
        
       <div class="span-12" style="margin-top: 15px" id="giroSub">
            <span>Giro: </span>
            <?php           $opcionesgiros = 'id="giro"
                                                class=""'; ?>
            <?php           echo form_dropdown('admin[pulzoCategoria]',
                                                 $giros,
                                                 '24',
                                                 $opcionesgiros); ?>
            
            <span>Subcategoria: </span>
            
            <?php           $opcionesSubgiros = 'id="subgiro"
                                                   class=""'; ?>
                            <?php echo form_dropdown('admin[pulzoSubcategoria]',
                                                 $subgiro,
                                                 '148',
                                                 $opcionesSubgiros); ?>

       </div>
    </div>
    <div class="span-14">
        <?php echo form_submit(array('id'=>'comentar','value'=>'Pulzar','style'=>'margin-top:30px;border: none; color: #FFFFFF; background-color: #660066; width: 72px; height: 20px;font-size: 11px;margin-left:400px;cursor:pointer')); ?>
    </div>
    <?php echo form_close(); ?>
  
<div id="up_input" style="margin-top: -383px;float: left;margin-right: 75px;">
    <iframe id="trgID" name="uploadTrg" height="0" width="0" frameborder="0" scrolling="yes"></iframe>
    <?php echo form_open_multipart('negocios/crearImagen/', array('id'=>'subirImagenes','target'=>'uploadTrg','onSubmit'=>'return cambioImg()')); ?>
         <div>
             <?php echo form_upload(array('id'=>'imagenPlan','name'=>'imagen','size'=>'9','value'=>''));?>  
         </div>    

    
    <?php echo form_close(); ?>
</div>  


<span id="ver" style="color:#8D6E98">Ver Eventos:</span>

<div id="eventosOld" class="span-19" style="display:none;border-top:1px solid #DFCBDF;margin-top:5px">
    <?php $contador=0;?>
    <?php $adminAll=get_all_admin($this->session->userdata('id'));
    foreach($adminAll as $data): ?>

    <div class="span-8 last" style="border: 1px solid #DAD6DB;;margin-top: 20px;margin-right:20px">
        <div class="span-1 last">
            <?php 
            echo anchor('negocios/borrar_pulzos/'.$data->planEmpresaPulzoId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $data->planEmpresaPulzoId,'class'=>'lnkEliminar'));
            ?>
            
        </div>
        <div class="span-2">
             <?php
             if($data->planImagenId=='0'){ $img=base_url().'statics/img/default/pulzos-images/avatar.png'; }else{ $img=get_avatar_plan($data->planId); }
             echo img(array('src'=>$img,'width'=>'50px','height'=>'50px'));
             ?>
        </div>
        <div class="span-5">
            <span >Titulo:</span>
            <?php echo $data->planMensaje; ?>
        </div>
        <div class="span-5">
            <span>Lugar:</span>
            <?php $lugar=substr($data->planLugar,0,22);
                    if(strlen($lugar)>21){ echo $lugar.'...'; }else{ echo $lugar; }?>
        </div>
            
        <div class="span-5"> 
            <span>Fecha fin:</span>
            <?php echo fecha_acomodo(unix_to_human($data->planFechaFin)); ?>
        </div>
    
    </div>
    <?php endforeach;?>
          
    
</div>
<div class="span-13 last" style="border-top:1px solid #DFCBDF;margin-top:15px"></div>
</div>
