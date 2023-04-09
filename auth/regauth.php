<?php
session_start();
include ('./../config/conn.php');
    $risposta="";
    $nome=$_POST['nome'];
    $cognome=$_POST['cognome'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $citta = $_POST['citta'];
    $cap = $_POST['cap'];
    $provincia = $_POST['provincia'];
    $regione = $_POST['regione'];
    $password = password_hash($pass, PASSWORD_BCRYPT);
    if(isset($_POST['telefono'])){
        $telefono=$_POST['telefono'];
    }else{
        $telefono=NULL;
    }
    $azienda=$_POST['azienda'];
    $id_settore=$_POST['settore'];
    
    $id_areaf=$_POST['areaf'];
    function city($cityName, $cityRegion, $cityProv, $cityCap, $conn) {
        // Controllo se il comune esiste già nel database
        $query = mysqli_query($conn, "SELECT * FROM posizione WHERE comune = '$cityName'");
        $result = mysqli_fetch_assoc($query);
        if ($result) {
            $query = mysqli_query($conn, "SELECT id FROM posizione WHERE comune = '$cityName'");
            while($row=mysqli_fetch_assoc($query)){
                return $row['id'];
            }
        }
        else {
            // Il comune non esiste nel database, lo inserisco
            $query = mysqli_query($conn, "INSERT INTO posizione (comune, regione, provincia, cap) VALUES ('$cityName', '$cityRegion', '$cityProv', '$cityCap')");
            if (!$query) {
                // Errore nell'esecuzione della query
                return false;
            }
            // Recupero i dati del comune appena inserito
            $query = mysqli_query($conn, "SELECT id FROM posizione WHERE comune = '$cityName'");
            while($row=mysqli_fetch_assoc($query)){
                return $row['id'];
            }
        }
    }
    $id_citta = city($citta, $regione, $provincia, $cap, $conn);
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