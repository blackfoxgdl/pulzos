<?php
/**
* Muestra todos los albumes en no sé. Un grid? Habrá que ver
*
* @author axoloteDeAccion <mario.r.vallejo@gmail.com>
* @version 0.1
* @copyright ZavorDigital, 07 March, 2011
* @package Albums
**/
?>
<script type="text/javascript">
$(".agregar-imagenes").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#tabs").load(urlToLoad);
});
$(".ver-imagenes").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#tabs").load(urlToLoad);
});
$(".borrar-albums").click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().parent().parent().hide("fast");
});
$(".editar-albums").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#tabs").load(urlToLoad);
});
$("#agregar-albums").click(function(event){
    event.preventDefault();
    urlToLoad = $(this).attr("href");
    $("#tabs").load(urlToLoad);
});

name_complete = $("#nombre-usuario-plan").text();
$("#nombre-profile").text(name_complete);
var texto = $("div#menu-derecha").html();
    $("#main-div").html(texto);
	
	
	
	// Extender jQuery con un método personalizado:
function prueba(){
  hola=$("input:checkbox").attr('checked', true);
  hola=$('input[name=checkbox]').is(':checked');
} 

$(".borrarA").click(function(event){
                event.preventDefault();
                var urlA = $(event.currentTarget).attr("href");
                $.get(urlA);
                $(event.currentTarget).parent().parent().hide("fast");
});


// esto muestra un pop-up con los checkboxes seleccionados
</script>
<div style="display:none">
    <div id="nombre-usuario-plan">Fotos</div>
</div>
<div id="menu-derecha" style="display: none">
<?php if($this->session->userdata('id')== $albums[0]->albumUsuarioId){?>
                    <?php echo 
                                      img(array('src'=>'statics/img/default/pulzos-images/crear-album.jpg',
                                                'id'=>'imagenes-crearr',
                                                'width'=>'80',
                                                'height'=>'20',
                                                'style'=>'margin-top: 22px; margin-left: -23px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/albums/crear/',null),''")); ?>   
                                                <?php }?>  
                                              
                                                
                                                
                                                            
</div>
        <?php foreach($albums as $album): ?>
        <div class="grid_element span-3">
            <ul class="grid-element span-4">
            	<div  style="margin-left:20px; border:1px  solid #CCCCCC; width:96px; background:#FFFFFF;">
                    <div style="background-color:#f0e6ef;width:90px; height:90px; border: 3px solid  #FFFFFF; border-bottom:0px solid #FFFFFF;">
                    <?php if($this->album->contar_filas($album->albumId)!=0){?>
                   <?php echo img(array(
                    'src'=>get_ultima_imagen_album($album->albumId), 'width'=>'90', 'height'=>'90','onclick'=>"dhtmlHistory.add('".base_url()."index.php/imagenes/imagenes_album/".$album->albumId."/".$album->albumUsuarioId."',null),''",'title'=>$album->albumNombre
                    )); ?>
                    <?php }else{
			
					echo img(array(
                    'src'=>'statics/img/default/pulzos-images/fondo-album.jpg', 'width'=>'90','style'=>'','height'=>'90','onclick'=>"dhtmlHistory.add('".base_url()."index.php/imagenes/imagenes_album/".$album->albumId."/".$album->albumUsuarioId."',null),''",'title'=>$album->albumNombre
                    ));
					
					}?>
                    </div>
                    <?php if($this->session->userdata('id')==$album->albumUsuarioId){?>
                    
						<?php if($album->albumDefault==1 || $album->albumDefault==2){?>
                                <?php if($album->albumDefault==2){?>
                                <li style="margin-left:4px; color:#999999; font-size:10px;"><?php echo $this->album->contar_filas($album->albumId)+$this->album->contar_filas_anexo($album->albumUsuarioId);?> fotos &nbsp &nbsp  </li>
                                <?php }else{?>
                                <li style="margin-left:4px; color:#999999; font-size:10px;"><?php echo $this->album->contar_filas($album->albumId);?> fotos &nbsp &nbsp  </li>
                                <?php }?>
                        <?php }else{?>
                        <li style="margin-left:4px; color:#999999; font-size:10px;"><?php echo $this->album->contar_filas($album->albumId);?> fotos &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  </li>
                        <?php }?>
                     </div>   
                    
                    <li class="title-name" style=" margin-left:20px; font-size:11px;"><?php echo  $this->album->cortar_texto($album->albumNombre,19);?></li>
                    <li></li>
                    
                  <?php }else{?> 
                  
                  	<?php if($album->albumDefault==1 || $album->albumDefault==2){?>
                                <?php if($album->albumDefault==2){?>
                                <li style="margin-left:4px; color:#999999; font-size:10px;"><?php echo $this->album->contar_filas($album->albumId)+$this->album->contar_filas_anexo($album->albumUsuarioId);?> fotos &nbsp &nbsp  </li>
                                <?php }else{?>
                                <li style="margin-left:4px; color:#999999; font-size:10px;"><?php echo $this->album->contar_filas($album->albumId);?> fotos &nbsp &nbsp  </li>
                                <?php }?>
                        <?php }else{?>
                        <li style="margin-left:4px; color:#999999; font-size:10px;"><?php echo $this->album->contar_filas($album->albumId);?> fotos &nbsp &nbsp  </li>
                        <?php }?>
                     </div>   
                    
                    <li class="title-name" style=" margin-left:20px; font-size:11px;"><?php echo  $this->album->cortar_texto($album->albumNombre,19);?></li>
                    
                    <?php }?>
                    
            </ul>
        </div>
        <?php endforeach; ?>
