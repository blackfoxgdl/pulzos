<?php

/*
 *Vista que muestra en autocompetar los amigos del Usuario al precionar la tecla
 * @version 0.1
 * @author jorgeLeon 
 * @Copyright ZavorDigital, Agosto 2, 2011 
 */
?>
<script type="text/javascript">
$('.busquedaAmigos').click(function(){
$('.para_quien').hide();
$('#addUsuario').html('<div style="width: 450px;border: 1px solid #DFCBDF;">\n\
                                <span style="background-color:#FFFFFF;border: 1px solid #DFCBDF;font-family:Arial, Helvetica, sans-serif;font-size: 11px;color: #555555;margin-left:1px;">'+$(this).children('.oculto').attr('value')+
                                            '<img id="imgBorrar" style="margin-left:2px;cursor:pointer;margin-bottom:1px" src="<?php echo base_url().'/statics/img/cierra-mensaje.jpg'; ?>"  width="12" height="12" align="absbottom" />\n\
                                </span>\n\
                          </div>');
   
   
 
$('#idOculto').attr('value',$(this).children('.id').attr('value'));
$('#completarAmigos').hide();
$('#imgBorrar').click(function(){
    nuevo=$('#crear').attr('href');
    $("#inbox").load(nuevo);
 
});
});
</script>

<?php
 if(isset($amigos)):
     foreach($amigos as $amigo): ?> 
        
       <?php if($amigo->statusEU==0):?>
                <div id="usuarios" class="span-7 busquedaAmigos" style="margin-left: 4px;margin-top: 4px;margin-bottom: 4px"> 
                    <div class="span-1">
                        <?php echo img(array('src'=>get_avatar($amigo->id),'width'=>'40','height'=>'40'));?>
                    </div>
                    <div class="span-5 last" style="margin-top:8px;margin-left: 10px;color: #666666">
                        <?php echo $amigo->nCompleto; ?>
                    </div>
                    <div class="span-11 last" style="border-bottom:1px solid #DBDBDB;margin-left: 4px"></div>              
                    <input type="hidden" id="usuario" class="oculto" value="<?php echo $amigo->nCompleto; ?>" />
                    <input type="hidden" id="usuario" class="id" value="<?php echo $amigo->id; ?>" /> 
                
           
                
                </div>
               

  <?php else: ?>
                <div id="empresas" class="span-7 busquedaAmigos" style="margin-left: 4px;margin-top: 4px;margin-bottom: 4px" >
                    <div class="span-1">
                        <?php echo img(array('src'=>get_avatar_negocios($amigo->amigoId),'width'=>'40','height'=>'40'));?>
                    </div>
                    <div class="span-5 last" style="margin-top:8px;margin-left:10px;color: #666666">
                        <?php echo $amigo->nombre; ?>
                       
                    </div>
                    <div class="span-11 last" style="border-bottom:1px solid #DBDBDB;margin-left: 4px"></div>

                    <input type="hidden" id="empresa" class="oculto" value="<?php echo $amigo->nombre; ?>" />
                    <input type="hidden" id="empresa" class="id" value="<?php echo $amigo->id; ?>" />
                </div>
                    
    <?php endif; ?>

        
<?php    
     endforeach;
     
    else:
 endif;
    ?>
