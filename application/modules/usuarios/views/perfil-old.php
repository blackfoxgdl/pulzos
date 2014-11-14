<?php
/** 
* View users profile when login
* to the plataform with the e-mail
* and password, If is correct the first
* view will be profile
*
* @version 0.1 
* @copyright ZavorDigital, 21 February, 2011
* @package Usuarios
* @author blackfoxgdl <ruben.alonso21@gmail.com>
* @revision axoloteDeAccion <mario.r.vallejo@gmail.com>
**/ 
?>
<div id="perfil" class="span-24 last">
    <div class="span-7 last"><!-- columna 1 --> 
        <div class="span-3">
            <?php echo img(array(
            'src'=>get_avatar($usuario->id),
            'width'=>'90',
            'height'=>'90',
            'id'=>'imagen-principal-avatar',
            )); ?>
        </div>
        <div class="span-3 last" id="titulos">
            <?php echo $usuario->nombre; ?>
            <br />
            <?php echo $localidad->nombre; ?>
            <br />
            <?php echo $edad; ?>
            <br />
            <?php 
            if($this->session->userdata('id') === $usuario->id)
            {
            echo anchor('usuarios/editar_datos', 'Editar Perfil',
            array('style'=>'text-decoration:none',
            'id'=>'footer'));
            }
            ?>
            <br />
            <?php echo is_friend($this->session->userdata('id'), $usuario->id); ?>
        </div>
    </div><!-- columna 1 -->
    <div class="span-13 last"><!--columna 2-->
        <div class="prepend-1 span-5 menu-solo-amigos">
            <ul class="menu-top">
                <li><?php echo anchor('inboxes/crear', 'Inbox', array('class'=>'menu-accordion')); ?></li>
                <li><?php echo anchor('conversaciones', 'Conversaciones', array('class'=>'menu-accordion')); ?></li>
                <li><?php echo anchor('amigos', 'Amigos', array('class'=>'menu-accordion')); ?></li>
            </ul>
        </div>
        <div class="prepend-1 span-5 menu-usuarios">
            <ul class="menu-top">
                <li><?php echo anchor('albums/ver/'.$usuario->id, 'Albums', array('class'=>'menu-accordion')); ?></li>
                <li><?php echo anchor('negocios/sigo/'.$usuario->id, 'Empresas', array('class'=>'menu-accordion')); ?></li>
                <li><?php echo anchor('planes', 'Planes', array('class'=>'menu-accordion')); ?></li>
            </ul>
        </div>
    </div><!-- columna 2 -->
    <div class="span-4 last">
        <?php echo anchor('usuarios/cerrar_sesion', 'Cerrar Sesion'); ?>
        <div style="color: #EF3F69; font-size: 1em">
            Experiencias Disponibles
        </div>
        <?php echo img('statics/img/acomulados.png'); ?>
    </div>
</div>
<div class="span-24 last">
    <div class="prepend-10 span-4 append-10 last">
        <div id="boton">Ocultar Perfil</div>
        <div id="boton-1" style="display:none">Ver Perfil</div>
    </div>
</div>
<div class="span-24">&nbsp;</div>
<div id="canvas" class="span-18">
    
</div>
<div class="span-6 last">
    <div class="prepend-1" style="font-size: 1.5em; color:#EF3F69;">
        Pulzos en vivo
    </div>
    <br />
    <br />
    <?php if($total != 0): ?>
    <?php foreach($pulzos_negocios as $pulzos_en_vivo): ?>
    <div style="color:#240004;">
        <div class="span-2">
            <?php echo img(array('src'=>get_avatar_negocios($pulzos_en_vivo->negocioUsuarioId),
            'width'=>60,
            'height'=>60)); ?>
        </div>
        <div class="span-4 last">
            <div style="color:#EF3F69">
                <?php echo $pulzos_en_vivo->negocioNombre; ?>
            </div>
            <br />
            <?php echo $pulzos_en_vivo->pulzosnegAccion; ?>
            <br />
            <?php echo anchor('pulzosneg/ver_pulzo/'.$pulzos_en_vivo->pulzosnegId.'/'.$this->session->userdata('id'), 'Ver Pulzo'); ?>
            <br />
            <br />
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="prepend-1" style="color: #240004;">
        <?php echo $pulzos_negocios; ?>
    </div>
    <?php endif; ?>
</div>
<div class="span-24 last">
    &nbsp;
</div>
