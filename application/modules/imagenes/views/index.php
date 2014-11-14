<?php
/**
 * Vista inicial. Se muestran todas las fotos relacionadas con el album.
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright Zavordigital, 09 March, 2011
 * @package Imagenes
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_lightbox/js/jquery.lightbox-0.5.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo base_url().'statics/js/jquery/plugins/jquery_lightbox/css/jquery.lightbox-0.5.css';?>" type="text/css" media="screen" />
<script type="text/javascript">
$("#imagenes-crear").click(function(event){
    event.preventDefault();
    urlToLoad = $(this).attr("href");
    $("#tabs").load(urlToLoad);
});
$("#albums-regresar").click(function(event){
    event.preventDefault();
    urlToLoad = $(this).attr("href");
    $("#tabs").load(urlToLoad);
});
$(".imagenes-ver").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#tabs").load(urlToLoad);
});
$(".imagenes-borrar").click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().parent().hide("fast");
});
var texto = $("div#menu-derecha").html();
    $("#main-div").html(texto);
	
name_complete = $("#nombre-usuario-plan").text();
$("#nombre-profile").text(name_complete);	
$("a.lightbox").lightBox();

$(".borrarA").click(function(event){
                event.preventDefault();
                var urlA = $(event.currentTarget).attr("href");
                $.get(urlA);
                $(event.currentTarget).parent().parent().hide("fast");
});

</script>  
<div style="display:none">
    <div id="nombre-usuario-plan"><?php echo $album[0]->albumNombre;?>

    </div>
</div>
<div id="menu-derecha" style="display: none">
<?php if($this->session->userdata('id')== $album[0]->albumUsuarioId){?>

                    <?php echo 
                                      img(array('src'=>'statics/img/default/pulzos-images/cargar-foto.jpg',
                                                'id'=>'imagenes-crearr',
                                                'width'=>'80',
                                                'height'=>'20',
                                                'style'=>'margin-top: 22px; margin-left: -23px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/imagenes/crear_imagen/".$albumId."',null),''")); ?>
<?php echo 
                                      img(array('src'=>'statics/img/default/pulzos-images/editar-album.jpg',
                                                'id'=>'imagenes-editar',
                                                'width'=>'80',
                                                'height'=>'20',
                                                'style'=>'margin-top: 22px; margin-left: 1px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/albums/editar/".$albumId."',null),''")); ?>
                                                <?php }?>
                                                
</div>

<?php if($album[0]->albumDefault!=2){?>
    <?php foreach($imagenes as $imagen): ?>
  		
    <div class="grid_element span-3">
    	<ul class="grid-element span-4">
        <div style="background-color: #dccedd;width:100px; height:100px; border: 3px solid  #FFFFFF; border-bottom:0px;">
        <p> 
        
        <a href="<?php echo base_url().$imagen->imagenRuta;?>" rel="lightbox[roadtrip]" class="lightbox" ><img src="<?php echo base_url().$imagen->imagenRuta;?>" width="100" height="100" alt="" /></a>
      
        </p>
        </div>
		<div style=" margin:0px;font-size:10px;color:#999999;">
		<?php if($this->session->userdata('id')== $album[0]->albumUsuarioId){?>
        	<?php if($imagen->albumDefault == 1): ?>
         		<?php if($imagen->imagenAvatar == 1): ?>
         
          
            <?php else: ?>
            <?php echo anchor('imagenes/avatar/'.$imagen->imagenId, 'avatar', array('id'=>"imagenes-avatar",'style'=>"text-decoration:none;color:#999999;")); ?>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        	<?php echo anchor('imagenes/borrar/'.$imagen->imagenId, 'Borrar', array('id'=>'imagenes-borrar','style'=>"text-decoration:none;color:#999999;",'class'=>'borrarA')); ?>
            <?php endif; ?>
          
            <?php else: ?>
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        	<?php echo anchor('imagenes/borrar/'.$imagen->imagenId, 'Borrar', array('id'=>'imagenes-borrar','style'=>"text-decoration:none;color:#999999;",'class'=>'borrarA')); ?>
            <?php endif; ?>
        <?php }else{?>
        
        <?php }?>    
        </div>
        
        <ul>
           
        </ul>
        </p>
        </ul>
    </div>
    <?php endforeach; ?>
<?php }else{?>


	<?php foreach($anexo as $anexos): ?>
  	<?php if($anexos->foto==NULL){?>
    
    <?php }else {?>		
    <div class="grid_element span-3">
    	<ul class="grid-element span-4">
        <div style="background-color: #dccedd;width:100px; height:100px; border: 3px solid  #FFFFFF; border-bottom:0px;">
        <p> 
        
        <a href="<?php echo base_url().$anexos->foto;?>" rel="lightbox[roadtrip]" class="lightbox" ><img src="<?php echo base_url().$anexos->foto;?>" width="100" height="100" alt="" /></a>
      
        </p>
        </div>
		<div style=" margin:0px;font-size:10px;color:#999999;">
		
        </div>
        
        <ul>
           
        </ul>
        </p>
        </ul>
    </div>
    <?php }?>
    
    <?php endforeach; ?>
    
    
    
    <?php foreach($imagenes as $imagen): ?>
    <div class="grid_element span-3">
    	<ul class="grid-element span-4">
        <div style="background-color: #dccedd;width:100px; height:100px; border: 3px solid  #FFFFFF; border-bottom:0px;">
        <p> 
        
        <a href="<?php echo base_url().$imagen->imagenRuta;?>" rel="lightbox[roadtrip]" class="lightbox" ><img src="<?php echo base_url().$imagen->imagenRuta;?>" width="100" height="100" alt="" /></a>
      
        </p>
        </div>
		<div style=" margin:0px;font-size:10px;color:#999999;">
		
        	<?php if($this->session->userdata('id')== $album[0]->albumUsuarioId){?>
        	<?php if($imagen->albumDefault == 1): ?>
         		<?php if($imagen->imagenAvatar == 1): ?>
         
          
            <?php else: ?>
            <?php echo anchor('imagenes/avatar/'.$imagen->imagenId, 'avatar', array('id'=>"imagenes-avatar",'style'=>"text-decoration:none;color:#999999;")); ?>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        	<?php echo anchor('imagenes/borrar/'.$imagen->imagenId, 'Borrar', array('id'=>'imagenes-borrar','style'=>"text-decoration:none;color:#999999;",'class'=>'borrarA')); ?>
            <?php endif; ?>
          
            <?php else: ?>
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        	<?php echo anchor('imagenes/borrar/'.$imagen->imagenId, 'Borrar', array('id'=>'imagenes-borrar','style'=>"text-decoration:none;color:#999999;",'class'=>'borrarA')); ?>
            <?php endif; ?>
        <?php }else{?>
        
        <?php }?> 
        </div>
        
        <ul>
           
        </ul>
        </p>
        </ul>
    </div>
    <?php endforeach; ?>

<?php }?>		
