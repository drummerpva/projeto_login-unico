<?php
session_start();
require './config.php';
if(!empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $sql->execute(array($email,$senha));
    if($sql->rowCount()>0){
        $sql = $sql->fetch();
        $_SESSION['lg'] = $sql['id'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql = $pdo->prepare("UPDATE usuarios SET ip = ? WHERE id = ?");
        $sql->execute(array($ip,$_SESSION['lg']));
        header("Location: ./");
        
    }else{
        echo "<p>Usuário e/ou senha inváliido.</p>";
    }
}

if(!empty($_SESSION['lg'])){
    header("Location: ./");
}


?>
<form method="POST">
    Email:<br/>
    <input type="email" name="email" required/><br/><br/>
    Senha:<br/>
    <input type="password" name="senha" required/><br/><br/>
    <input type="submit" value="Entrar"/>
</form>