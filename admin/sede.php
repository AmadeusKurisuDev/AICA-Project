<?php
session_start();
include('./../config/conn.php');
include ('./../config/code.php');
?>

<?php
$email = $_SESSION['email'];
$id_sede=NULL;
$query=mysqli_query($conn,"SELECT id_sede FROM accounts WHERE email = '$email'");

while($row=mysqli_fetch_assoc($query)){
    $id_sede = $row['id_sede'];
}
echo $id_sede;
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
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
                        if(isset($_SESSION["errorStatus"])){
                            $value = $_SESSION["errorStatus"];
                            if($value !== ""){
                                $testo = $value;
                                $popup = <<<EOD
                                <div class="popup">
                                    <p>$testo</p>
                                </div>
                                EOD;
                                echo $popup;
                                $_SESSION["errorStatus"]=NULL;
                            }
                        }
                        
                    ?>
            <?php
            if($id_sede==NULL){
                if(!isset($_SESSION['nextCode'])){
                    //se sede non creata
                    // Leggi il file JSON
                    $json = file_get_contents('codici.json');
                    // Decodifica il file JSON in un array associativo
                    $data = json_decode($json, true);
                    // Preleva l'ultimo codice
                    $lastCode = $data['lastCode'];
                    // Usa la funzione getNextCode per generare il prossimo codice
                    $nextCode = getNextCode($lastCode);
                    $_SESSION['nextCode'] = $nextCode;
                    // Aggiorna il file JSON con il nuovo codice
                    $data['lastCode'] = $nextCode;
                    $json = json_encode($data);
                    file_put_contents('codici.json', $json);
                }
                    $nextCode = $_SESSION['nextCode'];
                    $list = "";
                    $sql = "SELECT * FROM servizi";
                    $stmt = $conn->query($sql);
                                        
                    // Controllo risultati query
                    if ($stmt->num_rows > 0) {
                        // Stampa risultati
                        while($row = $stmt->fetch_assoc()) {
                            $nome=$row['nome'];
                            $id = $row['id'];
                            $list .= <<<EOD
                                <option value="$id">$nome</option>
                            EOD;
                        }
                    }
                $contenuto = <<<EOD
                    <form method="POST" action="./create.php" id="createSede" enctype="multipart/form-data">
                    <div class="form-div-container">
                        <p>CODICE: $nextCode</p>
                        <input type="hidden" name="codice" id="codice" value="$nextCode">
                    </div>
                    <div class="form-div-container">
                        <input type="text" name="nomesede" id="nomesede">
                    </div>
                    <div class="form-div-container">
                        <textarea id="description" name="description" rows="5" cols="50"></textarea>
                    </div>
                    <div class="form-div-container">
                        <label for="file">Seleziona il file:</label>
                        <input type="file" name="file">
                    </div>
                    <div class="form-div-container">
                        <label for="telefono">Telefono:</label>
                        <input type="text" name="telefono" id="telefono">
                        <label for="cert">Corsi:</label>
                        <select name="certification" id="cert">
                            $list
                        </select>
                        <label for="datada">Da:</label>
                        <input type="date" name="datada" id="datada">
                        <label for="dataa">A:</label>
                        <input type="date" name="dataa" id="dataa">
                    </div>
                        <div id="map"></div>
                        <input type="hidden" id="locationName" name="locationName" value="">
                        <input type="hidden" id="latitude" name="latitude" value="">
                        <input type="hidden" id="longitude" name="longitude" value="">
                        <input type="hidden" id="civico" name="civico" value="">
                        <input type="hidden" id="cap" name="cap" value="">
                        <input type="hidden" id="regione" name="regione" value="">
                        <input type="hidden" id="provincia" name="provincia" value="">
                        <input type="hidden" name="comune" id="comune" value="">
                        <input type="hidden" name="modifica" id="modifica" value="0">
                        <script>
                            var locationNamedoc = document.getElementById("locationName");
                            var latdoc = document.getElementById("latitude");
                            var londoc = document.getElementById("longitude");
                            var civicodoc = document.getElementById("civico");
                            var capdoc = document.getElementById("cap");
                            var regionedoc = document.getElementById("regione");
                            var provinciadoc = document.getElementById("provincia");
                            var comunedoc = document.getElementById("comune");
                            var map = L.map('map').setView([42.30031812670491, 12.412028984726453], 50);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://8digital.it/">8Digital</a>'
                            }).addTo(map);

                            var geocoder = L.Control.geocoder().addTo(map);
                            // quando viene selezionato un luogo nel geocoder, salva il nome del luogo, la latitudine e la longitudine su sessione
                            geocoder.on('markgeocode', function (e) {
                                var result = e.geocode;
                                var locationName = result.name;
                                var latitude = result.center.lat;
                                var longitude = result.center.lng;

                                var address = result.properties.address;
                                var nome_via = address.road;
                                var num_civico = address.house_number;
                                var cap = address.postcode || address.postalCode;
                                var provincia = address.county;
                                var regione = address.state;
                                var comune = address.city;
                                if (typeof comune === 'undefined') {
                                comune = address.town;
                                }

                                console.log('Nome del luogo:', nome_via);
                                console.log('Coordinate lat:', latitude);
                                console.log('Coordinate lon:', longitude);
                                console.log('cap:', cap);
                                console.log('civico:', num_civico);
                                console.log('città:', comune);
                                locationNamedoc.value = nome_via;
                                latdoc.value = latitude;
                                londoc.value = longitude;
                                civicodoc.value = num_civico;
                                capdoc.value = cap;
                                regionedoc.value = regione;
                                provinciadoc.value = provincia;
                                comunedoc.value = comune;
                            });
                        </script>
                        <div class="form-div-container" >
                            <button type="submit" id="submit-bt">Crea</button>
                        </div>
                    </div>
                </form>
                EOD;   
            }else{
                    $nome="";
                    $descrizione="";
                    $via="";
                    $civico="";
                    $telefono="";
                    $id_pos=0;
                    $codice="";
                    $foto="";
                    $cert="";
                    $da="";
                    $a="";

                    $query = mysqli_query($conn, "SELECT * FROM sedi WHERE id='$id_sede'");
                    while($row=mysqli_fetch_assoc($query)){
                        $nome = $row['nome'];
                        $descrizione = $row['descrizione'];
                        $via = $row['via'];
                        $civico = $row['civico'];
                        $telefono = $row['telefono'];
                        $id_pos = $row['id_posizione'];
                        $codice = $row['codice'];
                        $foto = $row['foto'];
                    }
                    $query = mysqli_query($conn, "SELECT * FROM center WHERE id_sede='$id_sede'");
                    while($row=mysqli_fetch_assoc($query)){
                        $cert = $row['id_corso'];
                        $da = $row['datafrom'];
                        $a = $row['datato'];
                    }

                    $list = "";
                    $sql = "SELECT * FROM servizi";
                    $stmt = $conn->query($sql);
                                        
                    // Controllo risultati query
                    if ($stmt->num_rows > 0) {
                        // Stampa risultati
                        while($row = $stmt->fetch_assoc()) {
                            $nomec=$row['nome'];
                            $idt = $row['id'];
                            if($idt == $cert){
                                $list .= <<<EOD
                                    <option value="$idt" selected>$nomec</option>
                                EOD;
                            }else{
                                $list .= <<<EOD
                            <option value="$idt">$nomec</option>
                            EOD;
                            }
                            
                            
                            
                        }
                    }

                $contenuto = <<<EOD
                <h1>MODIFICA</h1>
                <form method="POST" action="./create.php" id="editSede" enctype="multipart/form-data">
                    <div class="form-div-container">
                        <p>CODICE: $codice</p>
                        <input type="hidden" name="codice" id="codice" value="$codice">
                    </div>
                    <div class="form-div-container">
                        <input type="text" name="nomesede" id="nomesede" value="$nome">
                    </div>
                    <div class="form-div-container">
                        <textarea id="description" name="description" rows="5" cols="50">$descrizione</textarea>
                    </div>
                    <div class="form-div-container">
                        <img src="./foto/$foto" class="modifica-foto-preview">
                        <style>
                            .modifica-foto-preview {
                                height: 100px;
                            }
                        </style>
                        <label for="file">Seleziona il file:</label>
                        <input type="file" name="file">
                    </div>
                    <div class="form-div-container">
                        <label for="telefono">Telefono:</label>
                        <input type="text" name="telefono" id="telefono" value="$telefono">
                        <label for="cert">Corsi:</label>
                        <select name="certification" id="cert">
                            $list
                        </select>
                        <label for="datada">Da:</label>
                        <input type="date" name="datada" id="datada" value="$da">
                        <label for="dataa">A:</label>
                        <input type="date" name="dataa" id="dataa" value="$a">
                    </div>
                        <div id="map"></div>
                        <input type="hidden" id="locationName" name="locationName" value="">
                        <input type="hidden" id="latitude" name="latitude" value="">
                        <input type="hidden" id="longitude" name="longitude" value="">
                        <input type="hidden" id="civico" name="civico" value="">
                        <input type="hidden" id="cap" name="cap" value="">
                        <input type="hidden" id="regione" name="regione" value="">
                        <input type="hidden" id="provincia" name="provincia" value="">
                        <input type="hidden" name="comune" id="comune" value="">
                        <input type="hidden" name="modifica" id="modifica" value="1">
                        <input type="hidden" name="locedit" id="locedit" value="0">
                        <script>
                            var locationNamedoc = document.getElementById("locationName");
                            var latdoc = document.getElementById("latitude");
                            var londoc = document.getElementById("longitude");
                            var civicodoc = document.getElementById("civico");
                            var capdoc = document.getElementById("cap");
                            var regionedoc = document.getElementById("regione");
                            var provinciadoc = document.getElementById("provincia");
                            var comunedoc = document.getElementById("comune");
                            var locedit  = document.getElementById("locedit");
                            var map = L.map('map').setView([42.30031812670491, 12.412028984726453], 50);
    
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://8digital.it/">8Digital</a>'
                            }).addTo(map);
    
                            var geocoder = L.Control.geocoder().addTo(map);
                            // quando viene selezionato un luogo nel geocoder, salva il nome del luogo, la latitudine e la longitudine su sessione
                            geocoder.on('markgeocode', function (e) {
                                var result = e.geocode;
                                var locationName = result.name;
                                var latitude = result.center.lat;
                                var longitude = result.center.lng;
    
                                var address = result.properties.address;
                                var nome_via = address.road;
                                var num_civico = address.house_number;
                                var cap = address.postcode || address.postalCode;
                                var provincia = address.county;
                                var regione = address.state;
                                var comune = address.city;
                                if (typeof comune === 'undefined') {
                                comune = address.town;
                                }
    
                                console.log('Nome del luogo:', nome_via);
                                console.log('Coordinate lat:', latitude);
                                console.log('Coordinate lon:', longitude);
                                console.log('cap:', cap);
                                console.log('civico:', num_civico);
                                console.log('città:', comune);
                                locationNamedoc.value = nome_via;
                                latdoc.value = latitude;
                                londoc.value = longitude;
                                civicodoc.value = num_civico;
                                capdoc.value = cap;
                                regionedoc.value = regione;
                                provinciadoc.value = provincia;
                                comunedoc.value = comune;
                                locedit.value = '1';
                            });
                        </script>
                        <div class="form-div-container" >
                            <button type="submit" name="Modifica" id="submit-bt" value="Modifica">Modifica</button>
                            <button type="submit" name="Elimina" id="submit-bt" value="Elimina">Elimina</button>
                        </div>
                    </div>
                </form>
                EOD;
            }
            echo $contenuto;
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