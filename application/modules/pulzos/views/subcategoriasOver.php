<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">
   
 $(".enlace").click(function(event){
        event.preventDefault();
        urlSubId= $(event.currentTarget).attr("id");
        urlSubDom=$(event.currentTarget).attr("name");
        red=$(event.currentTarget).attr("href");
        a=red.split('planesusuarios/');
        alert(a[1]);
        $('#lugares').html('<input id="lugar" class="ubicacion" name="Planes[planLugar]" style="margin-bottom:5px;color:#666666;background-color:#F0F0F0;width: 510px;border: 1px solid #CDCDCD;margin-top: 7px;" value="'+urlSubId+'" readonly="readonly"/>\n\
                            <input id="domicilio" class="ubicacion" name="Planes[plandireccion]" style="color:#666666;background-color:#F0F0F0;width: 510px;border: 1px solid #CDCDCD;margin-top: 7px;" value="'+urlSubDom+'" readonly="readonly"/>\n\
                            <input type="hidden" class="ubicacion" name="Planes[planEmpresaPulzoId]" value="'+a[1]+'" />');
        $('.close').trigger('click');
 });

$("#ciudad-header").click(function(event){
    event.preventDefault();
    var urlBackGiro = $(this).attr('href');
    $("#texto-menu").load(urlBackGiro);
});

</script>
<div class="span-14 last" style="margin-top: 10px;">
    <!--div class="soft-header">
        < ?php echo $subcategoria->nombre; ? > 
    </div-->
    
    <div class="span-14 last">
        <?php foreach($pulzos as $pulzo): ?>
            <div class="span-13" style="border-bottom: 1px solid #CBCBCB; margin-top: 15px; margin-bottom: 5px"><!-- DIV PRINCIPAL DE DIRECTORIO -->
                <div class="span-1">
                    <?php echo anchor('/planesusuarios/'.$pulzo->negocioId,
                                      img(array('src'=>get_avatar_negocios($pulzo->negocioId),
                                                'width'=>'37',
                                                'height'=>'37')),
                                      array('id'=>'', 'style'=>'text-decoration: none')); ?>
                </div>
                <div class="span-11 last" style="margin-left: 10px">
                    <div class="span-12">
                        <?php echo anchor('planesusuarios/'.$pulzo->negocioId,
                                          $pulzo->negocioNombre,
                                          array('id'=>$pulzo->negocioNombre,'name'=>$pulzo->negocioDireccion,'class'=>'enlace', 'style'=>'text-decoration: none; color: #660066;')); ?>
                    </div>
                    <div class="span-12" style="color: #8F8F8F">
                        <span class="interlineado" style="line-height: -2px">
                            <?php echo $pulzo->negocioDescripcion; ?>
                        </span>
                    </div>
                </div>
                <div class="span-12" style="margin-bottom: 10px">
                    <div class="prepend-10">
                        <?php echo anchor('/planesusuarios/'.$pulzo->negocioId,
                                          'Ver mas',
                                          array('id'=>$pulzo->negocioNombre,'name'=>$pulzo->negocioDireccion,'class'=>'enlace','style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div> 
</div>
