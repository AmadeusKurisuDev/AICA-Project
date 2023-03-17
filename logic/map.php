<?php
session_start();
include('./../config/conn.php');
if(!isset($_POST['submit'])){
    $input  = $_REQUEST["q"];
    $code = $_REQUEST["map-code"];
    $sql = "SELECT s.co_x as x, s.co_y as y, s.nome as nome, s.via as via, s.telefono as telefono, s.codice as codice, p.cap as cap, p.comune as comune, p.provincia as prov FROM sedi s JOIN posizione p ON s.id_posizione = p.id WHERE p.comune = '$input' OR s.codice = '$code'";
    $stmt = $conn->query($sql);

    // Controllo risultati query
    if ($stmt->num_rows > 0) {
        // Stampa risultati
        while($row = $stmt->fetch_assoc()) {
            $x = $row['x'];
            $y = $row['y'];
            $nome = $row['nome'];
            $via = $row['via'];
            $telefono = $row['telefono'];
            $codice = $row['codice'];
            $cap = $row['cap'];
            $comune = strtoupper($row['comune']);
            $prov = $row['prov'];
            $text = <<<EOD
            <script>
            var map = L.map('map').setView([$x, $y], 50);
    
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://8digital.it/">8Digital</a>'
            }).addTo(map);
    
            L.marker([$x, $y]).addTo(map)
                .bindPopup('<p class="nameMap">$nome</p><br><p class="codeMap">$codice</p><br><p class="addressMap">$via - $cap $comune ($prov)</p><br><p class="telephoneMap">Tel.: $telefono</p><a class="linkMap" href="#">VAI ALLA SCHEDA ></a>')
                .openPopup();
            </script>
            EOD;
            $_SESSION['mapCode'] = $text;
            header("Location: ./../index.php");
        }
    }
}

?>