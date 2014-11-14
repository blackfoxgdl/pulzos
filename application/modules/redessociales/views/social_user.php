<?php
/**
 * Vista que se encarga de ligar las redes sociales con el
 * perfil del usuario para que estas puedan cazar los datos
 * como son los tokens de los usuarios y estos puedan recibir y 
 * activar la bonificacion que les estan ofreciendo el negocio
 **/

?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#forma-usuario").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarUsuario
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarUsuario()
{
    url = $("#urlUsuarios").attr('href');
    location.href = url; 
}

$(document).ready(function(){
    $(".face-delete").click(function(event){
        event.preventDefault();
        url_face = $(event.currentTarget).attr('href');
        $.get(url_face);
        $("#facebook_borrar").hide();
        $("#mensaje_activate_deactivate_fb").text('');
        var cssFB = {
            'color' : 'RED',
            'margin-left' : '10px',
            'font-size' : '14px'
        }
        $("#mensaje_activate_deactivate_fb").text('Desactivada').css(cssFB);
    });

    $(".twett-delete").click(function(event){
        event.preventDefault();
        url_twitter = $(event.currentTarget).attr('href');
        $.get(url_twitter);
        $("#twitter_borrar").hide();
        $("#mensaje_activate_deactivate_tw").text('');
        var cssTW = {
            'color' : 'RED',
            'margin-left' : '10px',
            'font-size' : '14px'
        }
        $("#mensaje_activate_deactivate_tw").text('Desactivada').css(cssTW);
    });
});
</script>
<?php echo anchor('#', '', array('id'=>'urlUsuarios', 'style'=>'display: none')); ?>
<div class="container">
    <div class="span-24 last">
        <div class="span-4 last" style="margin-top: 0px; margin-right: 10px">
            <?php if($tipo_usuario->statusEU == 0): ?>
                <?php echo img(array('src'=>get_avatar($this->session->userdata('id')),
                                     'class'=>'foto-medidas')); ?>
            <?php else: ?>
                <?php echo img(array('src'=>get_avatar_negocios($this->session->userdata('idN')),
                                     'class'=>'foto-medidas')); ?>
            <?php endif; ?>
        </div>
        <div class="span-20 last" style="background-color: #EEEDF4; margin-left: 0px; width: 790px;">
            <div class="span-1">
                &nbsp;
            </div>
            <div class="prepend-4 span-12 last" style="margin-top: 20px">
                <span class="span-12" style="font-size: 18px; color: #660066">
                    Tus redes sociales
                </span>
                <div class="span-12" style="margin-top: 10px">
                    <?php echo anchor($user_link, 
                                      img(array('src'=>base_url().'/statics/img/facebook_original.png',
                                                'width'=>'80px',
                                                'height'=>'80px')), 
                                      array('id'=>''));
                    ?>
                    <a href="http://www.pulzos.com/inicio.php/redessociales/get_twitter_tokens_bonficacionU" style="text-decoration: none">
                        <?php echo img(array('src'=>base_url().'/statics/img/twitter_original.png',
                                                'height'=>'80px', 
                                                'width'=>'80px')); ?>
                    </a> 
                </div>
                <?php if($tipo_usuario->statusEU == 0): ?>
                    <?php $datosUsuarios = get_data_user_social($this->session->userdata('id')); ?>
                    <?php echo form_open('redessociales/guardar_tokens/'.$id, array('id'=>'forma-usuario')); ?>
                        <div class="span-12">
                            <div class="span-1" style="margin-left: -10px">
                                <div id="mensaje_activate_deactivate_fb">
                                    <?php if(!empty($datosUsuarios)): ?>
                                        <?php if($datosUsuarios->tokenFacebook == ''): ?>
                                            <?php echo form_hidden('Redes[tokenFacebook]', $facebook->accessToken); ?>
                                            <?php if($facebook->accessToken != ''): ?>
                                                <span style="color: #8D6E98; font-size: 14px; margin-left: 12px">Guardar</span>
                                            <?php elseif($facebook->accessToken == ''): ?>
                                                <span style="color: #FF0000; margin-left: 10px; font-size: 14px">Desactivada</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo form_hidden('Redes[tokenFacebook]', $datosUsuarios->tokenFacebook); ?>
                                            <span style="color: #339900; font-size: 14px; margin-left: 12px">Activada</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo form_hidden('Redes[tokenFacebook]', $facebook->accessToken); ?>
                                        <?php if($facebook->accessToken != ''): ?>
                                            <span style="color: #8D6E98; font-size: 14px; margin-left: 12px">Guardar</span>
                                        <?php elseif($facebook->accessToken == ''): ?>
                                            <span style="color: #FF0000; margin-left: 10px; font-size: 14px">Desactivada</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div id="facebook_borrar">
                                    <?php if(!empty($datosUsuarios)): ?>
                                        <?php if($datosUsuarios->tokenFacebook != ''): ?>
                                            <?php echo anchor('redessociales/borrar_facebook/'.$this->session->userdata('id'),
                                                              'Borrar',
                                                              array('style'=>'color: #FF0000; margin-left: 10px; font-size: 14px; text-decoration: none', 'class'=>'face-delete')); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="prepend-1 span-1" style="margin-left: 7px">
                                <div id="mensaje_activate_deactivate_tw">
                                    <?php if(!empty($datosUsuarios)): ?>
                                        <?php if(($datosUsuarios->twitter_oauth == '') && ($datosUsuarios->twitter_oauth_secret == '')): ?>
                                            <?php echo form_hidden('Redes[twitter_oauth]', @$tokens['oauth_token']); ?>
                                            <?php echo form_hidden('Redes[twitter_oauth_secret]', @$tokens['oauth_token_secret']); ?>
                                            <?php if((@$tokens['oauth_token'] != '') && (@$tokens['oauth_token_secret'] != '')): ?>
                                                <span style="color: #8D6E98; font-size: 14px; margin-left: 10px">Guardar</span>
                                            <?php elseif((@$tokens['oauth_token'] == '') && (@$tokens['oauth_token_secret'] == '')): ?>
                                                <span style="color: #FF0000; margin-left: 3px; font-size: 14px">Desactivada</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo form_hidden('Redes[twitter_oauth]', $datosUsuarios->twitter_oauth); ?>
                                            <?php echo form_hidden('Redes[twitter_oauth_secret]', $datosUsuarios->twitter_oauth_secret); ?> 
                                            <span style="color: #339900; font-size: 14px; margin-left: 10px">Activada</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo form_hidden('Redes[twitter_oauth]', @$tokens['oauth_token']); ?>
                                        <?php echo form_hidden('Redes[twitter_oauth_secret]', @$tokens['oauth_token_secret']); ?>
                                        <?php if((@$tokens['oauth_token'] != '') && (@$tokens['oauth_token_secret'] != '')): ?>
                                            <span style="color: #8D6E98; font-size: 14px;margin-left: 10px">Guardar</span>
                                        <?php elseif((@$tokens['oauth_token'] == '') && (@$tokens['oauth_token_secret'] == '')): ?>
                                            <span style="color: #FF0000; margin-left: 3px; font-size: 14px">Desactivada</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div id="twitter_borrar">
                                    <?php if(!empty($datosUsuarios)): ?>
                                        <?php if(($datosUsuarios->twitter_oauth != '') && ($datosUsuarios->twitter_oauth_secret)): ?>
                                            <?php echo anchor('redessociales/borrar_twitter/'.$this->session->userdata('id'),
                                                              'Borrar',
                                                              array('style'=>'color: #FF0000; margin-left: 10px; font-size: 14px; text-decoration: none', 'class'=>'twett-delete')); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div> 
                        </div>
                        <div class="span-4" style="text-align: center; margin-bottom: 100px">
                            <?php echo form_submit(array('id'=>'guardarRedesSociales',
                                                         'class'=>'guardar_redessociales',
                                                         'value'=>'Guardar',
                                                         'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px; width: 70px')); ?>
                        </div>
                    <?php echo form_close(); ?>
                <?php else: ?>
                        <?php $datoEmpresa = get_data_social_media($this->session->userdata('idN')); ?>

                    <?php echo form_open('redessociales/guardar_company_tokens/'.$this->session->userdata('idN'), array('id'=>'forma-negocio')); ?>
                        <div class="span-12">
                            <?php if(!empty($datoEmpresa)): ?>
                                <?php if(($datoEmpresa->twitter_oauth == '') && ($datoEmpresa->twitter_oauth_secret == '')): ?>
                                    <?php echo form_hidden('Redes[twitter_oauth]', @$tokens['oauth_token']); ?>
                                    <?php echo form_hidden('Redes[twitter_oauth_secret]', @$tokens['oauth_token_secret']); ?>
                                <?php else: ?>
                                    <?php echo form_hidden('Redes[twitter_oauth]', $datoEmpresa->twitter_oauth); ?>
                                    <?php echo form_hidden('Redes[twitter_oauth_secret]', $datoEmpresa->twitter_oauth_secret); ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo form_hidden('Redes[twitter_oauth]', @$tokens['oauth_token']); ?>
                                <?php echo form_hidden('Redes[twitter_oauth_secret]', @$tokens['oauth_token_secret']); ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-12">
                            <?php if(!empty($datoEmpresa)): ?>
                                <?php if(($datoEmpresa->uidFacebook == '') && ($datoEmpresa->tokenFacebook == '')): ?>
                                    <?php echo form_hidden('Redes[uidFacebook]', $facebook->session('uid')); ?>
                                    <?php echo form_hidden('Redes[tokenFacebook]', $facebook->session('access_token')); ?>
                                <?php else: ?>
                                    <?php echo form_hidden('Redes[uidFacebook]', $datoEmpresa->uidFacebook); ?>
                                    <?php echo form_hidden('Redes[tokenFacebook]', $datoEmpresa->tokenFacebook); ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo form_hidden('Redes[uidFacebook]', $facebook->session('uid')); ?>
                                <?php echo form_hidden('Redes[tokenFacebook]', $facebook->session('access_token')); ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-12" style="text-align: center">
                            <?php echo form_submit(array('id'=>'guardarRedesSociales',
                                                         'class'=>'guardar_redessociales',
                                                         'value'=>'Guardar',
                                                         'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
                        </div>
                    <?php echo form_close(); ?>
                <?php endif; ?>
            </div>
        </div><!-- DIV FONDO **FIN** -->
    </div>
</div>
