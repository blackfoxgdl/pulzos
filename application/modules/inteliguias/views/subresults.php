<?php
/**
 * Views for check all the data of the
 * option where send a subcategory Id and return a
 * result with relationship of the subcategory
 **/
?>
<div>
    <ul data-role="listview" data-inset="true" data-filter="true" data-theme="c">
        <?php foreach($data as $result): ?>
            <li>
                <?php echo anchor('inteliguias/obtener_negocios_personal/'.$result->negocioId,
                                  $result->negocioNombre); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
