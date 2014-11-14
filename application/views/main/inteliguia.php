<!DOCTYPE html> 
<html> 
	<head> 
	<title>Inteliguia</title> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<?php echo link_tag('statics/js/jmobile/jmobile.css'); ?>
	<script src="<?php echo base_url().'statics/js/jmobile/jquery.js'; ?>"></script>
    <script src="<?php echo base_url().'statics/js/jmobile/jmobile.js'; ?>"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
</head>

<script>
$(document).bind("mobileinit", function(){
  $.mobile.touchOverflowEnabled = true;
});
</script>

<body> 

<div data-role="page" data-fullscreen="true" data-add-back-btn="true">

    <div data-role="header">
    <?php 
        if(isset($header)):
            echo '<h1>'.$header.'</h1>';
        else:
           echo '<h1>Inteliguia</h1>';
        endif;
            ?>
	</div><!-- /header -->

	<div data-role="content" role="main">
		<?php echo $content; ?>
	</div><!-- /content -->
</div><!-- /page -->

</body>
</html>
