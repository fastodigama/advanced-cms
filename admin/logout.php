<?php

include('includes/config.php');

session_destroy();

header('Location: index.php');
die();
?>