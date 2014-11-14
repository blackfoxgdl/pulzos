<?php
  /**
   * View for show the list of the
   * users that can you add like 
   * friends
   * @version 0.1 
   * @copyright ZavorDigital, 21 February, 2011
   * @package Negocios
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.usuariosSearch').css('cursor','pointer')
    $('.usuariosSearch').click(function(event)
    {
          event.preventDefault();
          idUs=$('input#idUser',this).attr("value");
          status=$('input#status',this).attr("value");
          (status==null || status=='undefined')?direccion='/negocios/':direccion='/usuarios/';
          raiz='pulzos/index.php';
          urlMain=raiz+direccion+'perfil'+'/' + idUs;
          window.location = /./+urlMain;
    });
});
</script>
<div class="span-14" style="margin-left: 12px; margin-top: 20px">
<?php if($contador != 0): ?>
        <div class="span-14" style="color: #000">
            <?php //Solo si el usuario teclea en nombre de su busqueda 
            if(isset($buscar)):
                foreach($buscar as $busqueda): 
                 if($busqueda->id != $this->session->userdata('id')): 
                     if($busqueda->statusEU == '0'): ?>
                        
               <div id="usuario" class="usuariosSearch span-5" style="border-bottom: 1px solid #DBDBDB;margin-top:15px;">
                        <div class="span-2">
                            <?php echo img(array('src'=>get_avatar($busqueda->id),
                                                 'width'=>'40',
                                                 'height'=>'40')); ?>
                        </div>
                        <div class="span-2" style="margin-top: 10px">
                             <div style="color: #666666;font-size: 10px;"><?php echo $busqueda->nombre;?></div>
                            <input type="hidden" id="idUser" value="<?php echo $busqueda->id; ?>"/>
                            <input type="hidden" id="status" value="<?php echo $busqueda->statusEU;?>" />
                        </div>
                </div>
                        <div class="span-14 last"></div>
                    <?php else: ?>
                        <div id="usuario" class="usuariosSearch span-5" style="border-bottom: 1px solid #DBDBDB; margin-top: 15px;">   
                            <div class="span-2">
                                <?php $n = get_data_company($busqueda->id); ?>
                                <?php echo img(array('src'=>get_avatar_negocios($n->negocioId),
                                                     'width'=>'40',
                                                     'height'=>'40')); ?>
                            </div>
                            <div class="span-2" style="margin-top: 10px">
                                 <div style="font-size: 10px;color: #666666;"><?php echo $busqueda->nombre; ?></div>
                                 <input type="hidden" id="idUser" value="<?php echo $n->negocioId; ?>" />
                            </div>
                        </div>
                        <div class="span-14 last">
                            &nbsp;
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; 
                 
                 
                 
           else:
            foreach($perfiles as $busqueda): 
                 if($busqueda->id != $this->session->userdata('id')): 
                     if($busqueda->statusEU == '0'): ?>
                        <div class="span-2">
                            <?php echo img(array('src'=>get_avatar($busqueda->id),
                                                 'width'=>'40',
                                                 'height'=>'40')); ?>
                        </div>
                        <div class="prepend-2 span-9" style="margin-top: 10px">
                            Nombre:
                            <?php echo anchor('usuarios/perfil/'.$busqueda->id,
                                              $busqueda->nombre,
                                              array('style'=>'text-decoration:none',
                                              'id'=>'footer')); ?>
                            <br />
                            Ciudad: <?php echo ciudad_usuario($busqueda->ciudad); ?>
                            <br />
                            Edad: <?php echo edad_usuario($busqueda->edad); ?> a&ntilde;os
                            <br />
                                <?php echo anchor('usuarios/perfil/'.$busqueda->id,
                                                  'Ver Perfil',
                                                  array('style'=>'text-decoration:none',
                                                        'id'=>'footer')); ?>
                        </div>
                        <div class="span-14 last">
                            &nbsp;
                        </div>
                    <?php else: ?>
                        <div class="span-2">
                            <?php $n = get_data_company($busqueda->id); ?>
                            <?php echo img(array('src'=>get_avatar_negocios($n->negocioId),
                                                 'width'=>'40',
                                                 'height'=>'40')); ?>
                        </div>
                        <div class="prepend-2 span-9">
                            Nombre:
                            <?php echo anchor('negocios/perfil/'.$n->negocioId,
                                              $busqueda->nombre,
                                              array('style'=>'text-decoration: none',
                                                    'id'=>'footer')); ?>
                            <br />
                            Direccion: <?php echo $n->negocioDireccion; ?>
                            <br />
                            Telefono: <?php echo $n->negocioTelefono; ?>
                            <br />
                            <?php echo anchor('negocios/perfil/'.$n->negocioId,
                                              'Ver Perfil',
                                              array('style'=>'text-decoration:none',
                                                    'id'=>'footer')); ?>
                        </div>
                        <div class="span-14 last">
                            &nbsp;
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; 
            endif; ?>
        </div>
    <?php 
    else:
        echo "<strong>No se encontraron resultados</strong>";
    endif; ?>
</div>
