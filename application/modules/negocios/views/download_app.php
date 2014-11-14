<?php
/**
 * View where the user can check the option where
 * can select if download the package of the app
 * in diferent extension and his contract as well
 **/
?>
<div class="prepend-6">
    <div class="prepend-1" style="font-size: 16px; margin-top: 20px; color: #531F5B;">
        Download your Contract
    </div>
    <div class="prepend-1" style="margin-top: 20px">
        <?php echo anchor('',
                          'Download your contract',
                          array('style'=>'color: #531F5B; font-size: 14px;')); ?>
    </div>
    <div class="prepend-1" style="margin-top: 20px; color: #531F5B; font-size: 16px;">
        Download the desktop app.
    </div>
    <div class="prepend-1" style="margin-top: 20px">
        <?php echo anchor('',
                          'Download .ZIP file',
                          array('style'=>'color: #531F5B; font-size: 14px')); ?>
        <br />
        <?php echo anchor('',
                          'Download .RAR file',
                          array('style'=>'color: #531F5B; font-size: 14px')); ?>
    </div>
    <div class="prepend-5" style="margin-top: 20px">
        <?php echo anchor('negocios/perfil',
                          'Back',
                          array('style'=>'text-decoration: inline; color: #531F5B; font-size: 16px')); ?>
    </div>
</div>
