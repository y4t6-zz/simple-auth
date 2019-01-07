<?php
require 'Auth.php'; 
$auth = new Auth();

$auth->unAuthorize();
header('Location: /login.php');