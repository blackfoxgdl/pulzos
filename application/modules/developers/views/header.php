<?php
/**
 * vista para visualizar la parte del header
 * de los desarrolladores, pues esta pagina sera
 * diferente comparado al perfil del usuario como 
 * plataforma
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/sessvars.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
function Enviar1(pagina,capa){
			sessvars.pagina1=pagina;
				sessvars.capa1=capa;
				
}
</script>
<div id="header1-1" style="background-color: #FFFFFF; height: 95px">    <div class="container">
        <div class="span-13 last" id="header_login_form">
            <?php if($this->session->userdata('idN')): ?>
                <?php echo anchor('negocios/perfil/',
                                  img(array('src'=>'statics/img/logo-blancoAPI.jpg',
                                            'width'=>'160px',
                                            'height'=>'68px',
                                            'style'=>'margin-top: -15px'))); ?>
            <?php if($this->session->userdata('id')): ?>
               
            <?php else: ?>
                <?php echo anchor('',
                                  img(array('src'=>'statics/img/logo-blancoAPI.jpg',
                                            'width'=>'160px',
                                            'height'=>'68px'))); ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div style="background-color: #511E59; color: #FFFFFF; margin-top: -5px">
    <div class="container">
        <?php if($this->session->userdata('id')): ?>
            <div class="prepend-17 span-8 last" style="margin-top: 0px">
                <span style="color: #FFFFFF; margin-left: 30px">
                    <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                      'Comunidad',
                                      array('id'=>'comunidadApi', 'style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF')); ?>
                </span>
                <span style="color: #FFFFFF; margin-left: 5px">
                    |
                </span>
                <span style="color: #FFFFFF">
                    <?php echo anchor('#',
                                      'Editar Cuenta',
                                      array('id'=>'editarApi', 'style'=>'text-decoration: none; margin-left: 5px; color: #FFFFFF')); ?>
                </span>
                <span style="color: #FFFFFF; margin-left: 5px">
                    |
                </span>
                <span style="color: #FFFFFF; margin-left: 5px">
                    <?php echo anchor('usuarios/cerrar_sesion',
                                      'Salir',
                                      array('id'=>'salirApi', 'style'=>'text-decoration: none; color: #FFFFFF')); ?>
                </span>
            </div>
        <?php else: ?>
            <div class="prepend-13 span-8 last">
                &nbsp;
            </div>
        <?php endif; ?>
    </div> 
</div>
