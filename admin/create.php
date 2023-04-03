<?php
session_start();
$email = $_SESSION['email'];
include('../config/conn.php');

$codice = isset($_POST['codice']) ? $_POST['codice'] : '';
$nomesede=isset($_POST['nomesede']) ? $_POST['nomesede'] : '';
$descrizione=isset($_POST['description']) ? $_POST['description'] : '';
$telefono=isset($_POST['telefono']) ? $_POST['telefono'] : '';
$locationName=isset($_POST['locationName']) ? $_POST['locationName'] : '';
$latitude=isset($_POST['latitude']) ? $_POST['latitude'] : '';
$longitude=isset($_POST['longitude']) ? $_POST['longitude'] : '';
$civico=isset($_POST['civico']) ? $_POST['civico'] : '';
$cap=isset($_POST['cap']) ? $_POST['cap'] : '';
$regione=isset($_POST['regione']) ? $_POST['regione'] : '';
$provincia=isset($_POST['provincia']) ? $_POST['provincia'] : '';
$comune=isset($_POST['comune']) ? $_POST['comune'] : '';
$modificaPos=isset($_POST['locedit']) ? $_POST['locedit'] : '';
$id_pos=0;
$modifica = $_POST['modifica'];
$certificati = isset($_POST['certification']) ? $_POST['certification'] : '';
$da = isset($_POST['datada']) ? $_POST['datada'] : '';
$a = isset($_POST['dataa']) ? $_POST['dataa'] : '';
$locedit = isset($_POST['locedit']) ? $_POST['locedit'] : '';

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

if($modifica == "0"){

//NUOVO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!




$id_pos = city($comune, $regione, $provincia, $cap, $conn);


// Prepara la query di inserimento




if($civico == 'undefined') {
    $civico=NULL;
}

// Bind dei parametri
    $sql = "INSERT INTO sedi (id, nome, via, civico, id_posizione, telefono, codice, descrizione, co_x, co_y)
VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssisssss", $nomesede, $locationName, $civico, $id_pos, $telefono, $codice, $descrizione, $latitude, $longitude);
    // Prepara lo statement

if (mysqli_stmt_execute($stmt)) {
} else {
    echo "Errore durante l'inserimento del record: " . mysqli_error($conn);
    //header('Location: ./sede.php');
}
mysqli_stmt_close($stmt);




$ids=0;
$query=mysqli_query($conn,"SELECT id FROM sedi WHERE codice = '$codice'");
            
while($row=mysqli_fetch_assoc($query)){
    $ids = $row['id'];
}


$statusMsg = '';

// File upload path
$targetDir = "foto/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(!empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->query("UPDATE sedi SET foto='".$fileName."', datafoto=NOW() WHERE codice = '$codice'");
            if($insert){
                $statusMsg = "";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

$_SESSION["errorStatus"] = $statusMsg;

$sql = "INSERT INTO center (id, id_sede, id_corso, datafrom, datato) VALUES (NULL, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt, "iiss", $ids, $certificati, $da, $a);

// Chiude lo statement e la connessione al database

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$query=mysqli_query($conn,"UPDATE accounts SET id_sede='$ids' WHERE email='$email'");
if($query){
    //echo 'tutto ok';
}else{
    //echo 'non ok';
}

mysqli_close($conn);

header('Location: ../index.php');
























} else if($modifica == "1"){





//VECCHIO!!!!!!!!!!!!!!!<<<<<<<<<<<<<<<<<<----------------------------------









if(isset($_POST['Elimina'])){
    $query=mysqli_query($conn,"SELECT id_sede FROM accounts WHERE email='$email'");
    $id_sede="";
    while($row=mysqli_fetch_array($query)){
        $id_sede=$row['id_sede'];
    }
    $query=mysqli_query($conn,"UPDATE accounts SET id_sede=NULL WHERE email='$email'");
    $query=mysqli_query($conn,"DELETE FROM center WHERE id_sede='$id_sede'");
    $query=mysqli_query($conn,"DELETE FROM sedi WHERE id='$id_sede'");
    $_SESSION["errorStatus"] = "sede eliminata con successo!";
    header('Location: ./sede.php');
}else if(isset($_POST['Modifica'])){








if(!($comune=="" && $regione=="" && $provincia=="" && $cap=="")){
    $id_pos = city($comune, $regione, $provincia, $cap, $conn);
}
    
$statusMsg = '';

// File upload path
$targetDir = "foto/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(!empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->query("UPDATE sedi SET foto='".$fileName."', datafoto=NOW() WHERE codice = '$codice'");
            if($insert){
                $statusMsg = "";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

$_SESSION["errorStatus"] = $statusMsg;

if($locedit=="1"){
$sql = "UPDATE sedi SET nome=?, via=?, civico=?, telefono=?, descrizione=?, id_posizione=?, co_x=?, co_y=? WHERE codice='$codice'";
// Prepara lo statement
$stmt = mysqli_prepare($conn, $sql);

if($civico == 'undefined') {
    $civico=NULL;
}
if($locationName == 'undefined') {
    $via=NULL;
}
if($telefono == 'undefined') {
    $telefono=NULL;
}
if($descrizione == 'undefined') {
    $descrizione=NULL;
}
if($nomesede == 'undefined') {
    $nome=NULL;
}

// Bind dei parametri
mysqli_stmt_bind_param($stmt, "sssssiss", $nomesede, $locationName, $civico, $telefono, $descrizione, $id_pos, $latitude, $longitude);
}else{
    $sql = "UPDATE sedi SET nome=?, telefono=?, descrizione=? WHERE codice='$codice'";
    // Prepara lo statement
$stmt = mysqli_prepare($conn, $sql);

if($civico == 'undefined') {
    $civico=NULL;
}
if($locationName == 'undefined') {
    $via=NULL;
}
if($telefono == 'undefined') {
    $telefono=NULL;
}
if($descrizione == 'undefined') {
    $descrizione=NULL;
}
if($nomesede == 'undefined') {
    $nome=NULL;
}

// Bind dei parametri
mysqli_stmt_bind_param($stmt, "sss", $nomesede, $telefono, $descrizione);
}

// Esegue la query
if (mysqli_stmt_execute($stmt)) {
} else {
    $_SESSION["errorStatus"] = "Errore durante la modifica del record: " . mysqli_error($conn);
    header('Location: ./sede.php');
}

// Chiude lo statement e la connessione al database
mysqli_stmt_close($stmt);



$ids=0;
$query=mysqli_query($conn,"SELECT id FROM sedi WHERE codice = '$codice'");
            
while($row=mysqli_fetch_assoc($query)){
    $ids = $row['id'];
}

$sql = "UPDATE center SET id_corso=?, datafrom=?, datato=? WHERE id_sede=?";
$stmt = mysqli_prepare($conn,$sql);
//echo 'cert:'.$certificati.' da:'.$da.' a:'.$a;
mysqli_stmt_bind_param($stmt, "issi", $certificati, $da, $a, $ids);
mysqli_stmt_execute($stmt);

// Chiude lo statement e la connessione al database
mysqli_stmt_close($stmt);

mysqli_close($conn);
}

header('Location: ../index.php');



}






?>