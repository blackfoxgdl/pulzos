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
        $('#empresas').val(user);
        
        $('#listaE').slideUp('fast');
        $('#contenido').slideDown('fast');
        
    });
    function replaceAll(t, r, c) { return t.replace(new RegExp(r, 'g'),c); }
     
</script>
<?php 
if(isset($busquedaN)){}
if(isset($busqueda) && !empty($busqueda)): ?>
    
       
   <?php  foreach($busqueda as $buscar):  ?>

        <div id="lstEmpresas" class="span-7 last listaEmpresas">     
       
            <div class="span-2" id="<?php echo $buscar->negocioNombre; ?>">
               <?php echo img(array('src'=>get_avatar($buscar->negocioId),'width'=>'40','height'=>'40'));?>
            </div>

            <div id="nombre"  class="span-3" style="margin-top: 11px;color: #666666">
                <?php echo $buscar->negocioNombre; ?>
            </div>
        </div>
<div class="span-5" style="border-bottom:1px solid #DBDBDB;margin-left: 5px;margin-bottom: 5px"></div>
  <?php endforeach;
    
else: echo "<div id='no'><strong>No se encontraron resultados</strong></div>";
endif; ?>