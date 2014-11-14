<?php
/**
 * View where the platform load once get
 * just the id of select the option with
 * categories and load if don't receive the
 * latitudes and longitudes and just received
 * the id
 **/
?>
<div>
    <ul data-role="listview" data-inset="true" data-filter="true" data-theme="c">
        <?php foreach($results as $result): ?>
            <li>
                <?php echo anchor('inteliguias/obtener_negocios_especificos/'.$result->id,
                                  $result->nombre); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
