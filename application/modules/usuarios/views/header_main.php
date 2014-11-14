<?php
/**
 * View header where the user can
 * view just le pulzos logo and 
 * just appear in the part of get in to the
 * platform
 **/
?>
<div class="span-24">
    <div class="span-15">
        <div class="prepend-13 span-1" style="margin-top: 25px; margin-left: 30px">
            <?php echo anchor('',
                              img(array('src'=>'statics/img/logo_home.png',
                                        'width'=>'314px',
                                        'height'=>'127px')),
                              array('style'=>'border: none; text-decoration: none')); ?>
        </div>
    </div>
    <div class="span-8">
        <div class="prepend-11" style="margin-top: 25px">
            <?php echo anchor('negocios/crear',
                              img(array('src'=>'statics/img/BusinessCenter.png',
                                        'width'=>'181px',
                                        'height'=>'135px',
                                        'style'=>'border: none')),
                              array('style'=>'text-decoration: none')); ?>
        </div>
    </div>
</div>
