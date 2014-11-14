<?php
/**
 * Mostrara la busqueda que los usuarios hayan hecho una vez
 * que se haya puesto algun parametro de valores o incluso si
 * esta vacio tambien
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @Copyright ZavorDigital, May 30, 2011
 * @package amigos
 **/
?>
<script type="text/javascript">
$(".eliminar-amistad").click(function(event){
    event.preventDefault();
    var urlDelete = $(event.currentTarget).attr("href");
    $.get(urlDelete);
    $(event.currentTarget).parent().parent().hide();
});
</script>
<div class="span-14 last">
    <?php foreach($pendientes as $amistad): ?>
        <div class="span-4 last" style="margin-top: 10px">
            <div align="center">
                <span class="menu-izq-menor">
                    <?php echo $amistad->nombre; ?>
                </span>
                <p style="margin-top: 5px; margin-bottom: 5px">
                    <?php echo anchor('usuarios/perfil/'.$amistad->id,
                                      img(array('src'=>get_avatar($amistad->id),
                                                'width'=>'90',
                                                'height'=>'90'))); ?>
                </p>
                <p>
                    <?php echo anchor('usuarios/perfil/'.$amistad->id,
                                      'Ver Perfil', array('class'=>'ver-perfil', 'style'=>'text-decoration: none; color: #8D6E98; font-size:9pt; font-weight: normal')); ?>
                    <br />
                    <?php echo anchor('amigos/borrar/'.$amistad->id.'/'.$this->session->userdata('id'),
                                      'Eliminar', array('class'=>'eliminar-amistad', 'style'=>'text-decoration: none; color: #8D6E98; font-size:9pt; font-weight: normal')); ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
