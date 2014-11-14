<?php

echo anchor($user_link, 'Facebook');
echo "<br /><br />";
echo form_open('redessociales/guardar_t1/'.$id, array('id'=>'forma-usuario'));
echo form_input(array('id'=>'',
                      'value'=>$facebook->accessToken,
                      'name'=>'Redes[tokenFacebook]',
                      'class'=>''));
echo form_submit(array('id'=>'',
                       'value'=>'hola'));
echo form_close();

echo "<br /><br />";
