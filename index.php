<?php
session_start();
require './config.php';
if(!empty($_SESSION['lg'])){
    $ip = $_SERVER['REMOTE_ADDR'];
    $id = $_SESSION['lg'];
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = ? AND ip = ?");
    $sql->execute(array($id,$ip));
    if(!$sql->rowCount() > 0){
        $_SESSION['lg'] = NULL;
        header("Location: login.php");
        exit;
    }
}else{
    header("Location: login.php");
}

?>
<h2>Conteúdo do Index</h2>