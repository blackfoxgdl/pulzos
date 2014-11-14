<?php
/**
 *
 **/
?>
<script type="text/javascript">
//FUNCTION FOR CHECK THE CHECKBOX CHECKED IN THE CONTRACT
$(document).ready(function(){
    $("#contract_terms").load($("#url_load").attr('href'));
});

function checkit()
{
    if($("input[name=aceptar]").is(':checked'))
    {
        return true;
    }
    else
    {
        $("#acept_terms_contract").show();
        return false;
    }
}
</script>
<?php echo anchor('negocios/contract_text', '', array('style'=>'display: none;', 'id'=>'url_load')); ?>
<?php echo form_open('negocios/form_direct', array('onsubmit'=>'return checkit();')); ?> 
    <div class="prepend-6">
        <div class="prepend-5" style="margin-top: 20px; color: #531F5B; font-size: 16px">
            Contrato de Pulzos
        </div>
        <div style="overflow: auto; width: 600px; height: 400px; margin-top: 20px" id="contract_terms">
        </div>
        <div style="color: #531F5B; font-size: 14px; margin-top: 10px">
            <?php echo form_checkbox(array('id'=>'terms_contract',
                                           'class'=>'',
                                           'name'=>'aceptar',
                                           'value'=>'')); ?>
            Acept terms and conditions
            <span id="acept_terms_contract" style="display: none; color: #FF0000">
                Please accept the terms and conditions
            </span>
        </div>
        <div style="margin-top: 20px;" class="prepend-5">
            <span>
                <?php echo form_submit(array('id'=>'',
                                             'class'=>'',
                                             'name'=>'Acept',
                                             'value'=>'Acept')); ?>
            </span>
            <span style="color: #531F5B; margin-left: 10px; font-size: 14px">
                or <?php echo anchor('negocios/perfil',
                                     'Cancel',
                                     array('style'=>'color: #531F5B; font-size: 14px; text-decoration: none')); ?>
            </span>
        </div>
    </div>
<?php echo form_close(); ?>
