<?php
session_start();
session_unset();
session_destroy();

header("location: manager_login");
exit;
?>