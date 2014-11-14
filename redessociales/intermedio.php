<?php
session_start();
//GET THE VAR FOR SEND BETWEEN VAR GLOBAL SESSION
$id = $_GET['id'];
$ids = base64_decode($id);
$_SESSION['id'] = $ids;
header('Location: index.php');
