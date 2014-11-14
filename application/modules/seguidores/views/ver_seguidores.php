<?php
/**
 * vista que se usa para poder mnostrar
 * los seguidores que se tienen en la
 * empresa o negocios
 **/
?>
<div class="span-18">
    <div class="span-18 last">
    </div>
    <div class="span-13 last">
        <?php foreach($seguidores as $follower): ?>
            <div class="span-4 last" style="margin-top: 10px">
                <div align="center">
                    <span class="menu-izq-menor">
                        <?php echo anchor('usuarios/perfil/'.$follower->seguidorUsuarioId,
                                          substr(get_first_name($follower->seguidorUsuarioId), 0, 15) . '....',
                                          array('style'=>'color: #8D6E98; text-decoration: none')); ?>
                    </span>
                    <p style="margin-top: 5px; margin-bottom: 5px">
                        <?php echo anchor('usuarios/perfil/'.$follower->seguidorUsuarioId,
                                          img(array('src'=>get_avatar($follower->seguidorUsuarioId),
                                                    'width'=>'90',
                                                    'height'=>'90'))); ?>
                    </p>
                    <p>
                        <?php echo anchor('usuarios/perfil/'.$follower->seguidorUsuarioId,
                                          'Ver perfil', array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
