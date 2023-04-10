<?php
session_start();
include('./../config/conn.php');
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
                $x="";
                $y="";
                $da="";
                $a="";
                $ncorso="";
                $foto="";
                $query=mysqli_query($conn,"SELECT cen.datafrom as da, cen.datato as a, ser.nome as corso, s.foto as foto, s.descrizione as descrizione, s.civico as civico, p.provincia as prov, s.co_y as y, s.co_x as x, s.codice as codice, p.cap as cap, s.telefono as telefono, s.via as via, s.nome as nome, s.descrizione as descrizione, p.comune as comune, p.regione as regione, p.provincia as provincia FROM (((sedi s JOIN posizione p ON s.id_posizione = p.id) LEFT JOIN center cen ON cen.id_sede = s.id) LEFT JOIN corsi cor ON cor.id = cen.id_corso) LEFT JOIN servizi ser ON ser.id = cor.id_servizi WHERE s.codice='$codice'");
            
                while($row=mysqli_fetch_assoc($query)){
                    $nome=$row['nome'];
                    $descrizione=$row['descrizione'];
                    $telefono=$row['telefono'];
                    $x=$row['x'];
                    $y=$row['y'];
                    $via=$row['via'];
                    $comune=$row['comune'];
                    $prov=$row['provincia'];
                    $cap=$row['cap'];
                    $regione=$row['regione'];
                    $foto = $row['foto'];
                    $ncorso = $row['corso'];
                    $da = $row['da'];
                    $a = $row['a'];
                    $ris = <<<EOD
                    <div class="form-div-container">
                    <p>CODICE: $codice</p>
                    </div>
                    <div class="form-div-container">
                        <label for="nomesede">Nome della sede:</label>
                        <p name="nomesede" id="nomesede">$nome</p>
                    </div>
                    <div class="form-div-container">
                        <label for="description">Descrizione:</label>
                        <p id="description" name="description">$descrizione</p>
                    </div>
                    <div class="form-div-container">
                        <img src="../admin/foto/$foto" class="modifica-foto-preview">
                        <style>
                            .modifica-foto-preview {
                                height: 100px;
                            }
                        </style>
                    </div>
                    <div class="form-div-container">
                        <label for="telefono">Telefono:</label>
                        <p name="telefono" id="telefono">$telefono</p>
                        <label for="cert">Corsi:</label>
                        <p name="certification" id="cert">$ncorso</p>
                        <label for="datada">Da:</label>
                        <input type="date" name="datada" id="datada" value="$da">
                        <label for="dataa">A:</label>
                        <input type="date" name="dataa" id="dataa" value="$a">
                    </div>
                        <div id="map"></div>
                        <script>
                            var  myFGMarker = new L.FeatureGroup();

                            var map = L.map('map').setView([$x, $y], 40);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://8digital.it/">8Digital</a>'
                            }).addTo(map);

                            marker = L.marker([$x, $y]).addTo(map)
                            .bindPopup('<p class="nameMap">$nome</p><br><p class="codeMap">$codice</p><br><p class="addressMap">$via - $cap $comune ($prov)</p><br><p class="telephoneMap">Tel.: $telefono</p>')
                            .openPopup();

                            myFGMarker.addLayer(marker);
                            myFGMarker.addTo(map);
                        </script>
                    </div>
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