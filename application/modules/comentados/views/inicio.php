<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>
<script type="text/javascript">
$(document).ready(function(){
 $("#texto-menu").load("<?php echo base_url()?>index.php/comentados/ver/<?php echo $plan->planId;?>");

  });

</script>

<div id="texto-menu"></div>
