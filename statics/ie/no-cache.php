<?php
/*
 * Se necesita para borrar cache del Internet explorer
 */
//[HTTP_USER_AGENT] => Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)
//header("HTTP/1.x 205 OK");
header("HTTP/1.x 200 OK");
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
//header("Expires: -1");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // immer geändert
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: no-cache, cachehack=".time());
header("Cache-Control: no-store, must-revalidate");
header("Cache-Control: post-check=-1, pre-check=-1", false);
?>



