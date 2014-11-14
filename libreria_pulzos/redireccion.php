<?php

$var1 = $_POST['dinero'];
$var2 = $_POST['url'];

echo "valores: " . $var1 . '<br />' . $var2;

?>
    <a href='http://pulzos.zavordigital.com/inicio.php/connects/index/4/<?php echo $var1; ?>/<?php echo str_replace('/', '%2F', $var2); ?>'>
        redirect</a>
