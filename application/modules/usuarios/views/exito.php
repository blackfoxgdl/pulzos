<?php
 /**
  * Vista de exito en caso
  * de que el registro del
  * usuario sea correcto.
  *
  * @version 0.1 
  * @copyright ZavorDigital, 21 February, 2011
  * @package Usuarios
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
echo doctype();  
echo link_tag('statics/css/ext/noregistro.css');
?>
<div class="container">
	<div class="span-24 last">
    	&nbsp;
    </div>
    <br />
    <br />
    <br />
    <div class="span-3">
    	&nbsp;
        <br />
        <br />
    </div>
    <div class="span-4" id="titulo">
    	Entrar a Pulzos
    </div>
    <div class="span-18" id="margen">
    	<br />
        <br />
        <div class="span-4">
        	&nbsp;
        </div>
        <div class="prepend-1 span-8" id="bordes" style="color: #FFFFFF">
        	<p>
                <div class="span-9">
                    &nbsp;
                    &nbsp;
                </div>
            </p>
         	T&uacute; cuenta se ha registrado correctamente
            <div class="prepend-4">
            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo anchor('usuarios/perfil', 'ver perfil', 
                            array('style'=>'text-decoration:none;',
                                  'class'=>'links')); ?>
        	</div>
           	<br />
            <br />
        </div>
        <div class="span-18">
        		<br />
                <br />
                <br />
                <br />
                <br />
                <br />
        	</div>
        	<div class="span-18">
        		<br />
                <br />
                <br />
                <br />
        	</div>
        	<div class="span-18">
        		<br />
                <br />
            </div>

hola<div align="center">
        <img id="image"/>
        <div id="name"></div>
      </div>

    </div>
    <div class="span-3">
    	&nbsp;
    </div>
</div>
