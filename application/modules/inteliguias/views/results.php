<?php
/**
 * Load this view once the user selected one
 * QR Code with data of the personal information
 * with some latitudes and longitudes, and the 
 * user check all the restaurans, is for subcategories
 **/
?>
<div>
    <ul data-role="listview" data-inset="true" data-filter="true" data-theme="c">
        <?php foreach($totales as $total): ?>
            <li>
                <?php echo anchor('inteliguias/obtener_negocios_personal/'.$total->negocioId,
                                  $total->negocioNombre); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
