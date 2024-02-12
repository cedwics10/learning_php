<?php
session_start();
unset($_SESSION['pseudo']);
print_r($_SESSION);
header('Location: index.php');
