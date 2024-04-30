<?php
session_start();
session_unset();
session_destroy();

header("location: volunteer_login");
exit;
?>