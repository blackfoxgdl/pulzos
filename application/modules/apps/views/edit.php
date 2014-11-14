<?php
/**
* Edit view
* TODO: Separate the form and make the same
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 24 February, 2011
 * @package Apps
 **/
?>
<div class="container showgrid">
    <div class="span-24 center">
        <h1>Pulzos->Apps</h1>
        <p>
        Cambiar algún dato de tu app 
       </p>
    </div>
    <div class="prepend-4 span-19 box form">
        <?php echo form_open('apps/editar/'.$appId, array('dojoType'=>'dijit.form.Form', 'method'=>'post'));?>
                <script type="dojo/method" event="onSubmit">
                </script>
        <p>
        <?php echo form_label('Nombre de tu Aplicación', 'app-nombre'); ?>
        <?php echo form_input(array(
            'id'=>'app-nombre',
            'name'=>'Apps[appNombre]',
            'value'=>set_value('Apps[appNombre]', $app->appNombre),
            'dojoType'=>'dijit.form.ValidationTextBox',
            'required'=>'true',
            'placeholder'=>'Nombre para listar',
            'missingMessage'=>'Agregar el nombre es obligatorio',
            'promptMessage'=>'El nombre será usado para listar en las busquedas de apps',
        ));?>
<?php echo form_error('Apps[appNombre]');?>
        </p>
        <p>
        <?php echo form_label('Descripción', 'app-descripcion');?>
        <?php echo form_textarea(array(
            'id'=>'app-descripcion',
            'name'=>'Apps[appDescripcion]',
            'value'=>set_value('Apps[appDesripcion]', $app->appDescripcion),
            'dojoType'=>'ValidationTextarea',
            'required'=>'true',
            'placeholder'=>'Descripción de App',
            'missingMessage'=>'Describe tu app para que sea interesante a los usuarios',
            'cols'=>'30',
            'rows'=>'10',
        ));?>
        </p>
        <p>
        <?php echo form_label('URL del developer', 'app-developer'); ?>
        <?php echo form_input(array(
            'id'=>'app-url_developer',
            'name'=>'Apps[appUrl]',
            'value'=>set_value('Apps[appUrl]', $app->appUrl),
            'dojoType'=>'dijit.form.ValidationTextBox',
            'required'=>'true',
            'missingMessage'=>'La URL de tu app es necesaria',
            'invalidMessage'=>'Debe de tener el formato subdominio.dominio.com',
            'placeholder'=>'URL de tu App',
            'promptMessage'=>'Lugar donde tienes hosteado tu código',
            'validator'=>'dojox.validate.isUrl',
        ));?>
        </p>
        <p>
        <?php echo form_label('Email de soporte', 'app-soporte');?>
        <?php echo form_input(array(
            'id'=>'app-email_soporte',
            'name'=>'Apps[appEmailSoporte]',
            'value'=>set_value('Apps[appEmailSoporte]', $app->appEmailSoporte),
            'dojoType'=>'dijit.form.ValidationTextBox',
            'required'=>'true',
            'placeholder'=>'Email soporte',
            'missingMessage'=>'Email al cual usuarios pueden comunicarse con el dev',
            'invalidMessage'=>'Debe de ser una dirección de Email válida',
            'promptMessage'=>'La dirección a la cual el usuario puede mandar dudas y sugerencias',
            'validator'=>'dojox.validate.isEmailAddress',
        )); ?>
        </p>
        <p>
        <?php echo form_submit(array(
            'id'=>'app-submit',
            'class'=>'app-submit',
            'value'=>'Crear App',
            'label'=>'Actualizar App',
            'dojoType'=>'dijit.form.Button',
        )); ?>
        </p>
        <?php echo form_close(); ?>
    </div>
</div>
