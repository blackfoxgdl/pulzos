<?php
/**
 * Vista que se usa para actualizar los datos de las
 * notificaciones que estara recibiendo la compania
 * de parte de los usuarios por algun comentario o por
 * alguna bonificacion o algo que se tenga que hacer
 **/
?>
<script type="text/javascript">
function Enviare(pagina,capa) {
	sessvars.pagina1=pagina;
	sessvars.capa1=capa;
}
</script>
<div id="header-container"><!-- DIV DEL HEADER DEL SUBMENU **INICIO** -->
        <div class="container">
            <div class="span-24 last">
                <div class="span-4">
                    &nbsp;
                </div>
                <div class="span-2">
                    &nbsp;<!-- INICIO -->
                </div>
                 <div class="span-2">
                   <!-- MENSAJES -->
                    <?php if($mensajes > 0): ?>
                            <div class="notificaciones" style="margin-left: 2px; margin-top: -4px"></div>
                                <div style="margin-top: -18px; margin-left: 8px; color: #FFFFFF">
                                    <?php if($mensajes > 99): ?>
                                        <?php echo "99"; ?>
                                    <?php else: ?>
                                        <?php echo $mensajes; ?>
                                    <?php endif; ?>
                                </div>
                        <?php else: ?>
                            &nbsp;
                        <?php endif; ?>
                </div>
                <div class="span-2">
                    &nbsp; <!-- HISTORIAL -->
                </div>
                <div class="span-2">
                    &nbsp; <!--  -->
                </div>
                <div class="span-1">
                    &nbsp;
                </div>
                <div class="span-2">
                    &nbsp; <!--  -->
                </div>
                <div class="span-4">
                    &nbsp;
                </div>
                <div class="span-4 last">
                    <div class="span-8" style="margin-left: -20px">
                        <span style="color: #FFFFFF">
                            <?php echo anchor('#',
                                              'Editar Cuenta',
                                              array('class'=>'submenu-negocios', 'style'=>'margin-right: 10px; text-decoration: none; color: #FFFFFF','onclick'=>"dhtmlHistory.add('".base_url()."index.php/negocios/editar/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/negocios/editar/".$this->session->userdata('id')."','#texto-menu');return false;")); ?>
                        </span>
                        <span style="color: #FFFFFF; margin-right: 10px">
                            |
                        </span>
                        <span style="color: #FFFFFF">
                        	 <?php echo anchor('developers/index',
                                          'API',
                                          array('style'=>'margin-left: 0px; text-decoration: none; margin-right: 10px; color: #FFFFFF')); ?>
                        </span>
                        <span style="color: #FFFFFF; margin-right: 10px;">
                            |
                        </span>
                        <span style="color: #FFFFFF;">
                            <?php echo anchor('usuarios/cerrar_sesion',
                                              'Salir', array('style'=>'text-decoration: none; color: #FFFFFF','onclick'=>"sessvars.$.clearMem();")); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- DIV DEL HEADER DEL SUBMENU **FIN** -->
</div><!-- DIV PRINCIPAL **FIN** -->
