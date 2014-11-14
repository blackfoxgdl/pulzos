<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">
$(document).ready(function(){
    $("div#checkOfer span").css('color','#666666');
    if($('.check').attr('value')=='0'){
        $('#contenido').slideUp('slow',function(){
            $('#noDescuentos').html('No hay ofertas en este negocio').slideDown('slow', function(){
                setTimeout(function(){
                    $('#noDescuentos').slideUp('slow',function(){
                        $('#empresas').select();
                    });
                },1500);
            });
        });
        
    }else{
            $('#contenido').slideDown(3000);
    }
});

    $(':checkbox').click(function(){
        if($(':checkbox').is(':checked')==true){
            $('#checkBox').removeAttr('style');
        }
    });


</script>
<div id="cat" style="margin-bottom: 5px;color: #996699;font-family:Arial, Helvetica, sans-serif;font-size:11px">Categorias de descuento: </div>
<?php
if(isset($negocioOfertas)):
    if(empty($negocioOfertas)): ?>
        <input class="check" type="hidden" value="0" />    
<?php 
    else: ?>
        <input class="check" type="hidden" value="1" />    
<?php endif; ?>
            <div id="checkOfer">
              <?php  
              foreach($negocioOfertas as $catego): ?>  
               <div id="checkBox" class="span-2" style="font-family:Arial, Helvetica, sans-serif;font-size:11px">
                          <?php echo form_checkbox('categorias[]','todo'/*$catego->product_category*/,true); ?>
                          <span><?php echo 'Todo'; //$catego->product_category; ?></span>
                          <input id="porcentaje" type="text" value="<?php echo $catego->bonificaPorcentaje; ?>" />
                          <input id="tipoOferta" type="text" value="<?php echo $catego->statusIva; ?>" />
                          <input id="consumoMin" type="text" value="<?php echo $catego->consumoMinimo; ?>"/>
                          <input id="statusOfer" type="text" name="moneyUser[statusTipoBonificacion]" value="<?php echo $catego->statusTipoBonificacion; ?>" class="statusOferta" />
               </div> 
                <?php endforeach; ?>
            </div>
<?php endif; ?>
      
