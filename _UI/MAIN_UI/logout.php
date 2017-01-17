<?
session_start();
session_destroy();
session_write_close();
session_unregister();
header('Location: http://'.$_SERVER['SERVER_NAME'].'');
exit();
?>