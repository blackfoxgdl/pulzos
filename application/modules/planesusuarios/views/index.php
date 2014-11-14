<?php
/**
 * Vista que se usa para poder mostrar el formulario de los
 * planes que los usuarios haran, esto dependiendo de que
 * tipo sea
 * 
 * @author jorgeLeon <jorge@zavordigital.com>
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_tools/jquery.tools.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){

        if($.browser.mozilla || $.browser.webkit){
            if($.browser.webkit){
                $('#imagenPlan').css('display','block');
            }else{
               $('#imagenPlan').css('display','none');
            }
            $(".notification-block, #preview").hover(function(event){
                event.preventDefault();
                $(".notification-block").css({'display':'block','position':'absolute','margin-top':'30px','width':'140px','margin-left':'10px'});
                }, function(event){
                    $(".notification-block").css('display', 'none');
                    });

            $('#preview').hover(function(){$(this).css('cursor','pointer')});

            $('.notification-block, #preview').click(function(){
            $('#imagenPlan').trigger('click');
            });
        }

    
    $('input[type="radio"]').click(function(){
        $('.ubicacion').val('');
        $('.ubicacion').css('background-color','#FFFFFF');
        $('.ubicacion').attr('readonly',false);
        $('.ubicacion').attr("disabled",false);
    });

    $('#ancla').click(function(event){
        event.preventDefault();
        carga=$(this).attr('href');
        $('.contenido').load(carga);
    });
    
    $("a[rel]").overlay({
       onLoad: function(){
           var cont = this.getOverlay().find(".contenido");
           cont.load(this.getTrigger().attr("href"));
       }
    });

    $('#aEstablecimiento').click(function(){
       $('input[type="radio"]').removeAttr('checked');
       $('.ubicacion').val('');
       $('.ubicacion').attr("disabled", true);
       $('.ubicacion').css('background-color','#F0F0F0');
    });

    $('#imagenPlan').live('change', function(){
        $("#preview").html('');
        $(".notification-block").css('display', 'none');
        $("#preview").html("<div style='margin-top:40px;text-align: center'><img src='<?php echo base_url().'/statics/img/cargador.gif'; ?>'  width='50' height='50'/><\div>");
        $("#subirImagenes").ajaxForm({
            target: '#preview'
            }).submit();
    });
    $('#imagenPlan').click(function(){
       setTimeout(function() { document.getElementById('planMensaje').focus(); }, 1000);
    });
    $('#calendario').click(function(){
       urlCal=$(this).attr('href');
       $('#planCentro').load(urlCal);
       
    });
});	
		
</script>

<div class="span-24 last"><!-- DIV PRINCIPAL DE ESTA VISTA -->

<?php echo form_open('planesusuarios/index/'.$this->session->userdata('id'), array('id'=>'armarPlan')); ?>
    
      
        <div class="span-4 last" style="margin-left: 10px; margin-top: 36px"><!-- DIV DE LA IZQUIERDA **INICIO** -->
             <div id="preview" style="width:140px">
                <?php echo img(array('src'=>'statics/img/default/planes.jpg','id'=>'avatar-photo')); ?>
             </div>    
        </div><!-- DIV DE LA IZQUIERDA **FIN** -->
  
        
        <div class="notification-block">
            <div class="middle-menu-link" style="cursor: pointer;">Cambiar Imagen</div>       
            <?php //echo anchor('planesusuarios', 'Cambiar Avatar', array('class'=>'middle-menu-link'))?>
           
        </div>
        <div class="span-14 last" style="margin-left: 30px; margin-top: 37px"><!-- DIV DEL CENTRO **INICIO** -->
            <div class="span-13 last">
                <div class="span-3" style="margin-top: 3px;">
                    <?php $atributos = array('class' => 'verLabel', 'style'=>'color: #660066');
                          echo form_label('¿Qu&eacute; vas a pulzar?','vasPulzar',$atributos); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'planMensaje',
                                                'class'=>'',
                                                'name'=>'Planes[planMensaje]',
                                                'value'=>'',
                                                'style'=>'color:#666666;width: 391px;border: 1px solid #CDCDCD;')); ?>
                </div>
            </div>
            <div class="span-13 last" style="margin-top: 10px">
                <div class="span-2" style="margin-top:17px">
                    <?php  
                    echo form_label('Fecha Inicio:','fechaInicio',$atributos); ?>
                </div>
                <div class="span-11 last" style="margin-top: 10px">
                    <div class="span-5 last" style="margin-top:7px">
                        <?php $diaI = 'id="diaInicio" class="dia_inicio" value=2'; ?>
                        
                        <?php echo form_dropdown('Planes[planDiaInicio]',$dias,date('d'),$diaI); ?>
                        
                        <?php $mesI = 'id="mesInicio"
                                       class="mes_inicio"'; ?>
                        <?php echo form_dropdown('Planes[planMesInicio]',$meses,date('m'),$mesI); ?>
                    </div>
                    <div class="span-1" style="margin-top: 7px">
                        <?php echo form_label('Hora:','horaInicio',$atributos); ?>
                    </div>
                    <div class="span-5 last" style="margin-top:7px">
                        <?php $horasI = 'id="horaInicio"
                                        class="hora_inicio"'; ?>
                        <?php echo form_dropdown('Planes[planHoraInicio]',$horas,'',$horasI); ?>
                    </div>
                </div>
           
            <div class="span-14 last" style="margin-top: 10px">
                <div class="span-2 last" style="margin-top: 16px">
                    <?php echo form_label('Lugar:','planLugar',$atributos); ?>
                </div>
                 <div class="span-4 last" style ="margin-top: 16px">
                        <?php  echo img(array('src'=>'statics/img/iconos_armar_pulzo/ico-establecimiento.png'));?>
                      <?php  echo anchor('pulzos/pulzos_usuarios/'.$this->session->userdata('id'),'Establecimiento:',array('id'=>'aEstablecimiento', 'style'=>'color: #660066;text-decoration:none','rel'=>'#establecimiento'));?>
<!--                      <a href=""  style="color: #660066;text-decoration:none" rel="#establecimiento">Establecimiento</a>-->
                 </div>
                
        <?php if(isset($planRadio)){ ?>
                 <div class="span-3 last" style ="margin-top: 16px;">
                        <?php  echo form_radio('plan','casa',($planRadio=='casa')?TRUE:'');?>
                        <?php  echo img(array('src'=>'statics/img/iconos_armar_pulzo/ico-casa.png'));?>
                        <?php  echo form_label('Casa:','',$atributos); ?>
                 </div>
                
                 <div class="span-3 last" style ="margin-top: 16px">
                        <?php  echo form_radio('plan','lugar',($planRadio=='lugar')?TRUE:'');?>
                        <?php  echo img(array('src'=>'statics/img/iconos_armar_pulzo/ico-publico.png'));?>
                        <?php  echo form_label('Lugar:','',$atributos); ?>
                 </div>
                
                 <div class="span-3 last" style ="margin-top: 16px">
                        <?php  echo form_radio('plan','otro',($planRadio=='otro')?TRUE:'');?>
                        <?php  echo img(array('src'=>'statics/img/iconos_armar_pulzo/ico-otro.png'));?>
                        <?php  echo form_label('Otro:','',$atributos); ?>
                 </div>       
      <?php  }else{ ?> 
                <div class="span-3 last" style ="margin-top: 16px;">
                        <?php  echo form_radio('plan','casa','');?>
                        <?php  echo img(array('src'=>'statics/img/iconos_armar_pulzo/ico-casa.png'));?>
                        <?php  echo form_label('Casa:','',$atributos); ?>
                 </div>
                
                 <div class="span-3 last" style ="margin-top: 16px">
                        <?php  echo form_radio('plan','lugar','');?>
                        <?php  echo img(array('src'=>'statics/img/iconos_armar_pulzo/ico-publico.png'));?>
                        <?php  echo form_label('Lugar:','',$atributos); ?>
                 </div>
                
                 <div class="span-3 last" style ="margin-top: 16px">
                        <?php  echo form_radio('plan','otro','');?>
                        <?php  echo img(array('src'=>'statics/img/iconos_armar_pulzo/ico-otro.png'));?>
                        <?php  echo form_label('Otro:','',$atributos); ?>
                 </div>
                
                <?php }?>
                 <div id="lugares" class="span-13 last" style="margin-top: 7px">
                    <?php echo form_label('Direcci&oacute;n:','',$atributos); ?>
                    <?php echo form_input(array('id'=>'lugar',
                                                'class'=>'ubicacion',
                                                'name'=>'Planes[planLugar]',
                                                'style'=>'margin-bottom:5px;color:#666666;width: 510px;border: 1px solid #CDCDCD;',
                                                'value'=>'',
                                                'disabled'=>'disabled')); ?>
                     
                      <?php echo form_input(array('id'=>'direccion',
                                                'class'=>'ubicacion',
                                                'name'=>'Planes[plandireccion]',
                                                'style'=>'color:#666666;width: 510px;border: 1px solid #CDCDCD;',
                                                'value'=>'',
                                                'disabled'=>'disabled')); ?>
                 </div>
            </div>
            
            <div class="span-13 last" style="margin-top: 10px">
                 <div class="span-13 last" style="margin-top: 16px">
                    <?php echo form_label('Descripci&oacute;n:','planDescripciones',$atributos); ?>
                 </div>
               
                 <div class="span-13 last">
                    <?php echo form_textarea(array('id'=>'planDescripcion',
                                                   'class'=>'',
                                                   'name'=>'Planes[planDescripcion]',
                                                   'style'=>'color:#666666;width: 510px;border: 1px solid #CDCDCD;',
                                                   'value'=>'',
                                                   'cols'=>'55',
                                                   'rows'=>'6')); ?>
                </div>
            </div>
            <div class="span-13 last" style="margin-top: 10px">
                <?php echo form_label('Amigos:','amigosDelPlan',$atributos); ?>
            </div>
            <div class="span-13 last">
                <?php $i = 1; ?>
                <?php foreach($amigos as $amigo): ?>
                    <div class="span-2 last">
                        <?php echo img(array('src'=>get_avatar($amigo->id),
                                             'width'=>'30',
                                             'height'=>'30',
                                             'title'=>$amigo->nombre)); ?>
                        <br />
                        <?php echo form_checkbox('amigos[]',$amigo->id,FALSE);
                              echo cut_name_user($amigo->nombre);
                        ?>
                        <?php $i = $i + 1; ?>
                    </div>
                <?php endforeach; ?>
                <input type="hidden" name="amigos[]" value="<?php echo $this->session->userdata('id')?>" />
            </div>
            <div class="span-13 last" style="margin-top: 10px">
                
                <?php  echo form_submit(array('id'=>'',
                                             'class'=>'',
                                             'style'=>'background-color:#660066;border:none;color:#FFFFFF;cursor:pointer;height:19px;width:40px ',
                                             'value'=>'Pulzar'));?>
            </div>
        </div><!-- DIV DEL CENTRO **FIN** -->
    <?php echo form_close();?>
<div id="up_input" style="margin-top: -265px;float: left;margin-right: 75px;">
    <iframe id="trgID" name="uploadTrg" height="0" width="0" frameborder="0" scrolling="yes"></iframe>
<?php echo form_open_multipart('planesusuarios/crearImagen/', array('id'=>'subirImagenes','target'=>'uploadTrg','onSubmit'=>'return cambioImg()')); ?>
         <div>
             <?php echo form_upload(array('id'=>'imagenPlan',
                                          'name'=>'imagen',
                                          'size'=>'9',
                                          'value'=>''));
             
               
             ?>  
         </div>    

    
<?php echo form_close(); ?>
</div>      
</div><!-- DIV PRINCIPAL DE ESTA VISTA -->
<div id="establecimiento" class="contenido-armaPulzo">
    
    <a id="ancla" href="<?php echo base_url().'index.php/pulzos/pulzos_usuarios/'.$this->session->userdata('id');?>" style="margin-left: 50px">
                 <?php echo img(array('src'=>'/statics/img/back.png',
                                                   'width'=>'19px',
                                                   'height'=>'16px',
                                                   'margin-top'=>'10px')); ?>
    </a>
    <div class="contenido" style="margin-left:115px"></div>
</div>
