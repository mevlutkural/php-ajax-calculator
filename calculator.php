<?php
@session_start();

if (!$_POST['_token'] || $_POST['_token'] !== $_SESSION['csrf_token']) {
    die("Token hatası");
}

if ($_POST && is_numeric($_POST['n1']) && is_numeric($_POST['n2']) && $_POST['custom'] != '1') {
    $result = 'hatalı giriş ';
    switch ($_POST['option']) {
        case '+':
            $result = ($_POST['n1'] + $_POST['n2']);
            break;
        case '-':
            $result = ($_POST['n1'] - $_POST['n2']);
            break;
        case '*':
            $result = ($_POST['n1'] * $_POST['n2']);
            break;
        case '/':
            $result = ($_POST['n1'] / $_POST['n2']);
            break;
        default:
            $result = ($_POST['n1'] + $_POST['n2']);
            break;
    }

    echo 'Sonuç : ' . $result;
} else if ($_POST && is_numeric($_POST['n1']) && $_POST['custom'] == '1') {
    $result = 0;
    for ($i = 0; $i <= $_POST['n1']; $i++) {
        $result += $i;
    }
    echo 'Faktoriyel sonucu : ' . $result;
} else {
    echo 'Hatalı giriş.'.$_POST['custom'];
}
