<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="span-18">
    <div class="span-18 last">
    </div>
    <div class="span-13 last">
       
        <?php
            if(isset($today)){
                foreach($today as $hoys):   
                ?>
                <div class="span-4 last" style="margin-top: 10px">
                    <div align="center">
                        <span class="menu-izq-menor">
                            <?php echo get_name_user($hoys->invitacionInvitadoPersonalId); ?>
                        </span>
                        <p style="margin-top: 5px; margin-bottom: 5px">
                            <?php echo img(array('src'=>get_avatar($hoys->invitacionInvitadoPersonalId),
                                                        'width'=>'90',
                                                        'height'=>'90')); ?>
                        </p>
                    </div>
                </div>

         
       <?php endforeach;
       }?>

    </div>
</div>
