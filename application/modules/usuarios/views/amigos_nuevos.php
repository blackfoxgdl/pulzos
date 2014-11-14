<?php
/**
 * Vista para la actualizacion de
 * los amigos con los cuales se pueden
 * actualizar si tienes nuevos amigos o
 * eliminas amigos
 **/
?>
<div class="span-4 last" style="width: 160px; border-bottom: 1px solid #DBDBDB; margin-top: 5px">
                <div class="span-4 last" style="margin-left: 10px">
                    <?php $friends = get_friends_recently($usuario->id); ?>
                    <?php $i = 1; ?>
                    <?php foreach($friends as $friend): ?>
                        <div class="span-4" style="margin-right: 20px">
                            <div class="span-4">
                                <div class="span-1">
                                    <?php $tipos = exists_avatar($friend->amigoAmigoId); ?>
                                    <?php if($tipos != 0): ?>
                                        <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                            img(array('src'=>get_thumb_avatar($friend->amigoAmigoId),
                                                      'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                    <?php else: ?>
                                        <?php $datos = get_sex_of_user($friend->amigoAmigoId); ?>
                                        <?php if($datos->sexo == 0): ?>
                                            <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                              img(array('src'=>'statics/img/default/nopic-fem.jpg',
                                                                        'width'=>'45px',
                                                                        'height'=>'55px',
                                                                        'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                    <?php elseif($datos->sexo == 1): ?>
                                        <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                          img(array('src'=>'statics/img/default/avatar.jpg',
                                                                    'width'=>'45px',
                                                                    'height'=>'55px',
                                                                    'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                    <?php else: ?>
                                        <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                          img(array('src'=>'statics/img/default/avatar.jpg',
                                                                    'width'=>'45px',
                                                                    'height'=>'55px',
                                                                    'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                </div>
                                <div class="span-2" style="margin-left: 20px; margin-top: 10px; color: #83547F">
                                    <?php
                                        $nombre = get_user_name($friend->amigoAmigoId);
                                        $cortes_nombre = cut_name_user($nombre);
                                        $apellido = get_last_user_name($friend->amigoAmigoId);
                                        $cortes_apellidos = cut_name_user($apellido);
                                        $nombre_mostrar = $cortes_nombre . ' ' . $cortes_apellidos;
                                    ?>
                                    <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                      $nombre_mostrar,
                                                     
                                                      array('style'=>'text-decoration: none; color: #83547F')); ?>
                                </div>
                            </div>
                        </div>
                        <br  />
                        <?php $i++; ?>
                        <?php if($i >= 4): ?>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
