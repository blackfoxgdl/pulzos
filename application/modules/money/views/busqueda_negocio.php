<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">

    $('.listaEmpresas').click(function(event){
        event.preventDefault();
        var user=$(event.currentTarget).children().attr('id');
        var userId=$(event.currentTarget).children().attr('class');
        var id=replaceAll(userId,'span-2','');
        var actionAttr=$('#lnkOfertas').attr('href');
        var urlSelect = $("#select_dinamico").attr('href');
        var total_url = urlSelect+'/'+id;
        $.get(total_url, function(data){
                  $("#ofertas_empresa").html(data);
              }, 'html');
        $('#empresas').val(user);
        $('#listaE').slideUp();
        $('#contenido').slideDown('fast');
        $('#idHidden').html('<input type="hidden" name="moneyUser[moneyNegocioId]" value="'+id+'" />');
        $("#options").html($("#select").html());
    });
function cargarOfertas(id)
{
    urlReturn=$('#lnkOfertas').attr('href');
    urlRet=urlReturn+'/'+id;
    urlOferta=replaceAll(urlRet,' ','');
    $('#descuentos').load(urlOferta);
    setTimeout('$("#important").slideDown("slow");',1500);
}   
function replaceAll(t, r, c) { return t.replace(new RegExp(r, 'g'),c); }
     
</script>
<?php 
echo anchor('money/index','', array('id'=>'lnkBuscarN','style'=>'display:none'));
echo anchor('money/buscar_oferta_negocio','',array('id'=>'lnkOfertas','style'=>'display:none'));
echo anchor('money/create_select_dinamically', '', array('id'=>'select_dinamico', 'style'=>'display: none'));
if(isset($busquedaN)){}
if(isset($busqueda) && !empty($busqueda)): ?>
    
       
   <?php  
   foreach($busqueda as $buscar): ?>
            <div id="lstEmpresas" class="span-5 last listaEmpresas" style="border-bottom:1px solid #DBDBDB;margin-left: 5px;margin-top: 5px">     

                <div style="margin-bottom: 3px" class="span-2 <?php echo $buscar->negocioId; ?>" id="<?php echo $buscar->negocioNombre; ?>">
                   <?php echo img(array('src'=>  get_avatar_negocios($buscar->negocioId),'width'=>'40','height'=>'40'));?>
                </div>

                <div id="nombre"  class="span-3 last" style="margin-top: 11px;color: #666666">
                    <?php echo $buscar->negocioNombre; ?>
                </div>

                <div id="contador" style="color:#339900;font-size: 8px;font-family: Arial, Helvetica, sans-serif">
                    <?php echo 'Ofertas: '.$buscar->contador; ?>
                </div>

                <input type="hidden" id="idEmpresa" value="<?php echo $buscar->negocioId; ?>" />
            </div> 
       <?php
   endforeach;
    
else: echo "<div id='no' style='text-align:center;color:#666666'><strong>No se encontraron resultados...</strong></div>";
endif; ?>
