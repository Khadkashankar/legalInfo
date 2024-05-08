<?php
session_start();
session_destroy();

header("Location: ../lawyer/index.php");
exit();
?>
