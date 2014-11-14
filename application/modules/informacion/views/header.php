<?php
 /**
  * Header for the users
  * with open session
  *
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  * @version 0.1
  * @copyright Zavordigital February 22, 2011
  * @package Core
  **/  
echo doctype();
echo link_tag('statics/css/ext/noregistro.css');
?>
<div id="header1">
    <div class="container"><!-- main -->
    	<div class="header_profile">
            <div class="prepend-1 span-1">
            	<div style="height:3px;">
                	&nbsp;
            	</div>
                <?php echo anchor('usuarios',img(array('src'=>'statics/img/logo_general.png',
                                                              'border'=>'0'))); ?>
            </div>
            <div class="prepend-1 span-4 last">
            	<div class="span-4 last">
                	&nbsp;
            	</div>
                <?php echo img('statics/img/slogan_general.png'); ?>
            </div>
            <div class="prepend-2 span-10 last" id="buscar">
            	<div style="height:8px;"></div>
            		<?php echo form_open('negocios/busqueda'); ?>
                    	<span style="vertical-align:top">
                		<?php echo form_input(array('name'=>'buscar',
													'id'=>'buscar',
													'style'=>'height:18px;',
													'dojoType'=>'dijit.form.ValidationTextBox',
													'placeholder'=>'Buscar',
													)); ?>
                        </span>
                        <span style="vertical-align:middle">
                    	<?php echo form_submit(array('id'=>'buscar',
													 'class'=>'buscar'
													 )); ?>
                        </span>
                	<?php echo form_close(); ?>
            </div>
           </div>
        </div>
        <div class="barra">
        </div>
    </div><!-- main -->
</div>
