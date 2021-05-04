<?php
session_start();

session_destroy();

header('Location: list.php');
exit();
