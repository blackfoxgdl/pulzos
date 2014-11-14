<div class="span-14 last prepend-top">
    <?php foreach($results as $resultado): ?>
        <?php if($resultado->id != $this->session->userdata("id")): ?>
            <?php if($resultado->statusEU == 0): ?>
                <div class="span-2 left">
        	    	<?php echo img(array('src'=>get_avatar($resultado->id), 
				    					 'width'=>'90', 
					    				 'height'=>'90')); ?>
                </div>
                <div class="prepend-2 span-9">
                    Nombre:
                    <?php echo anchor('usuarios/perfil/' . $resultado->id ,
                                      $resultado->nombre, 
					    			  array('style'=>'text-decoration:none',
                                            'id'=>'footer')); ?>
                    <br />
                    Ciudad: <?php echo ciudad_usuario($resultado->ciudad); ?>
                    <br />
                    Edad: <?php echo edad_usuario($resultado->edad); ?> a&ntilde;os
                    <br />
		    		<?php echo anchor('usuarios/perfil/' . $resultado->id, 
                                      'Ver Perfil', 
				    				  array('style'=>'text-decoration:none',
                                            'id'=>'footer')); ?>
                </div>
                <div class="span-14 last">
                    &nbsp;
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?> 
</div>
