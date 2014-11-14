<?php
session_start();
if(isset($_SESSION['id']))
{
    require_once('conexion.php');
    $conectar = conectar();
    //GET DATA TO SAVE
    $tokenFacebook = $_POST['tokenFacebook'];
    $twitter_oauth = $_POST['twitter_oauth'];
    $twitter_oauth_secret = $_POST['twitter_oauth_secret'];
    $status = $_POST['status'];
    if($status == 0)
    {
        $query = "INSERT INTO social_media values(NULL, '', '" . $tokenFacebook . "', '" . $twitter_oauth . "', '" . $twitter_oauth_secret . "', " . $_SESSION['id'] . ")";
        $sql = mysql_query($query, $conectar)
            or die('Error en la consulta: ' . $query . '<br />' . mysql_error());
    }
    else
    {
        $query = "UPDATE social_media SET tokenFacebook = '" . $tokenFacebook . "', twitter_oauth = '" . $twitter_oauth . "', twitter_oauth_secret = '" . $twitter_oauth_secret . "' WHERE socialUsuarioId = " . $_SESSION['id'];
        $sql = mysql_query($query, $conectar)
            or die('Error en la actualizacion: ' . $query . '<br />' . mysql_error());
    }
    
    unset($_SESSION['twitter_oauth_tokens']['access_key']);
    unset($_SESSION['twitter_oauth_tokens']['access_secret']);
    session_unset();
    session_destroy();
    header('Location: http://www.pulzos.com/inicio.php/usuarios/perfil');
}
else
{
    header('Location: http://www.pulzos.com/');
}
