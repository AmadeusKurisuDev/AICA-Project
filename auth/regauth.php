<?php
session_start();
include ('./../config/conn.php');
    $risposta="";
    $nome=$_POST['nome'];
    $cognome=$_POST['cognome'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $password = password_hash($pass, PASSWORD_BCRYPT);
    if(isset($_POST['telefono'])){
        $telefono=$_POST['telefono'];
    }else{
        $telefono=NULL;
    }
    $azienda=$_POST['azienda'];
    $id_settore=$_POST['settore'];
    $id_citta=$_POST['citta'];
    $id_areaf=$_POST['areaf'];
    $sql = "INSERT INTO accounts (id,nome,cognome,password,email,telefono,azienda,id_settore,id_posizione,id_funzione) VALUES (NULL,'$nome','$cognome','$password','$email','$telefono','$azienda','$id_settore','$id_citta','$id_areaf')";
    if(mysqli_query($conn,$sql) === true){
        $risposta = "account creato con successo!";
        $_SESSION["createAccountStatus"] = $risposta;
        header('Location: ./login.php');
        
    }else{
        $risposta = "impossibile creare l'account!";
        $_SESSION["createAccountStatus"] = $risposta;
        header('Location: ./register.php');
    }

?>