<?php
/**
 * Vista que muestra la creacion de los pulzos o negocios
 * en caso de que se quiera crear fuera del perfil de
 * la empresa. es un formulario para postear este tipo de cosas
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 30 March, 2011
 * @package Pulzos de Negocios
 **/
?>
<div class="form span-23 box">
    <?php echo form_open(); ?>
        <p>
            <?php echo form_label('¿Que quieres hacer?', 'pulzoAccion'); ?>
            <?php echo form-input(array('id'=>'pulzosnegAccion',
                'name'=>'Pulzos[pulzosnegAccion'];
                'value'=>''
                )); ?>
        </p>
        <p>
            <?php echo form_submit(array('id'=>'submit',
                                         'value'=>'Pulzar',
                                        )); ?>
        </p>
    <?php echo form_close(); ?>
</div>
