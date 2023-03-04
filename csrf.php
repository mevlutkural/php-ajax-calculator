<?php 
@session_start();

if (!$_POST['_token']) {
    $_SESSION['csrf_token'] = (rand(1,999) * rand(1,999)) . date('Y-m-d-H:i:s');
}
