<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="span-18">
    <div class="span-18 last">
    </div>
    
    <div class="span-6 last" style="font-family:Arial, Helvetica, sans-serif;font-size: 11px;margin-top: 25px;color: #660066;"><?php echo fecha_acomodo($fechas); ?> </div>
    
    <div class="span-13 last" style="border-bottom:1px solid #DFCBDF">
        <?php
        if(isset($semanaInvitados)):
             foreach($semanaInvitados as $semana): ?>
                            <div class="span-4" style="margin-top: 10px">
                                    <div align="center">
                                        <span class="menu-izq-menor">
                                            <?php echo get_name_user($semana->invitacionInvitadoPersonalId); ?>
                                        </span>
                                        <p style="margin-top: 5px; margin-bottom: 20px">
                                            <?php  echo img(array('src'=>get_avatar($semana->invitacionInvitadoPersonalId),
                                                                        'width'=>'90',
                                                                        'height'=>'90')); ?>
                                        </p>

                                    </div>
                            </div>
        
        <?php endforeach;
        endif; ?>
         
    </div>

</div>
