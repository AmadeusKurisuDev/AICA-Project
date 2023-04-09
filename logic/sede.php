<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/fonts/fonts.css">
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <title>Portale AICA</title>
</head>
<body>
    <div class="top-header">
        <div class="top-header-btn-container">
            <div class="top-header-btn">
                <a href="./../auth/logout.php"><img src="../images/icons/users.png"> ESCI</a>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="logo-container">
            <a href="./../index.php"><img src="../images/logo-aica-def.jpg" alt="AICA-logo"></a>
        </div>
        <div class="header-link-container">
            <!--pulsanti menu-->
        </div>
    </div>

    <div class="content">
        <div class="main-container">
            <?php
                $codice=$_POST['mapLoc'];
                $descrizione="";
                $nome="";
                $comune="";
                $provincia="";
                $cap="";
                $telefono="";
                $via="";
                $regione="";
                $query=mysqli_query($conn,"SELECT s.descrizione as descrizione, s.civico as civico, p.provincia as prov, s.co_y as y, s.co_x as x, s.codice as codice, p.cap as cap, s.telefono as telefono, s.via as via, s.nome as nome, s.descrizione as descrizione, p.comune as comune, p.regione as regione, p.provincia as provincia FROM sedi s JOIN posizione p ON s.id_posizione = p.id WHERE s.codice='$codice'");
            
                while($row=mysqli_fetch_assoc($query)){
                    $row['nome'] = $nome;
                    $row['descrizione'] = $descrizione;
                    $row['provincia'] = $provincia;
                    $row['cap'] = $cap;
                    $row['telefono'] = $telefono;
                    $ris = <<<EOD

                    EOD;
                    echo $ris;
                    /**------------- Da fare la logica per visualizzare la sede */
                }

            ?>
        </div>
    </div>
  
        <div class="footer">
            <div class="footer-one">
                <img src="../images/footer-logo.png">
            </div>
    </div>
</body>
</html>