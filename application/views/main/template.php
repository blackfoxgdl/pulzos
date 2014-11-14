<?php
/**
* Master template of pulzos site
*
* @author axoloteDeAccion <mario.r.vallejo@gmail.com>
* @author blackfoxgdl <ruben.alonso21@gmail.com>
* @version 0.1
* @copyright axoloteDeAccion, 28 February, 2011
* @package Pulzos
**/
echo doctype();
?>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="-1" />
        
        <?php 
/*           echo header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );  // disable IE caching
           echo header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" ); 
           echo header( "Cache-Control: no-cache, must-revalidate" ); 
           echo header( "Pragma: no-cache" );*/
        ?>
<!--        <meta http-equiv="Cache-Control" content="no-cache" />-->
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=100" ><![endif]-->
        
        <link href='http://fonts.googleapis.com/css?family=Arimo:regular,bold' rel='stylesheet' type='text/css'/>
        <!--[if IE]><?php include('statics/ie/no-cache.php'); ?><![endif]-->
        <!--[if IE]> <?php echo link_tag('statics/ie/style.css'); ?> <![endif]-->
        <!--[if IE]> <?php echo link_tag('statics/ie/style.css'); ?> <![endif]-->
        <?php echo link_tag('statics/css/blueprint/screen.css'); ?>
        <?php echo link_tag('statics/css/ext/index.css'); ?>
        <?php echo link_tag('statics/js/jquery/jquery-ui/css/ui-lightness/jquery-ui-1.8.13.custom.css'); ?>
        <?php echo link_tag('statics/css/ext/new_index.css'); ?>
        <?php echo link_tag('statics/css/ext/redondeo.css'); ?>
        <?php echo link_tag('statics/img/pulzos.ico', 'shortcut icon', 'image/ico'); ?>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/validate/jquery.validate.min.js'; ?>"></script>
        <!-- script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery.address-1.4.min.js'; ?>"></script -->
        <script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery.history.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'statics/ie/browser.js'; ?>"></script>
<div id="comp" style="display: none;"></div>
        <?php if(isset($included_file)): ?>
        <?php foreach($included_file as $file): ?>
        <script type="text/javascript" src="<?php echo base_url().$file; ?>"></script>
        <?php endforeach; ?>
        <?php endif; ?>
        <title>Pulzos - El pulzo de tu ciudad</title>
        
    </head>
    <body>
        <?php if(isset($header)):?>
        <?php echo $header; ?>
        <?php endif; ?>
        <div id="frontend">
            <div class="container" id="content1">
                <?php echo $content; ?>
            </div>
        </div>
        <div id="footer" style="margin-bottom: 20px">
            <div class="container"> 
                <div class="prepend-3 span-21">
                    <div class="prepend-6 span-1" style="margin-left: 20px">
                        <?php echo anchor('developers/index',
                                          'API',
                                          array('style'=>'text-decoration: none',
                                                'id'=>'footer')); ?>
                    </div>
                    <div class="span-1">
                        <?php echo anchor('http://www.pulzos.com/blog',
                                          'Blog',
                                          array('style'=>'text-decoration:none',
                                                'id'=>'footer',
                                                'target'=>'_blank')); ?>
                    </div>
                    <div class="span-3 copyright" style="margin-left: 10px">
                        &#169 2012 Pulzos&nbsp;
                    </div>
                    &nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <div style="margin-top: 20px">
            &nbsp;
        </div>
    </body>
</html>
