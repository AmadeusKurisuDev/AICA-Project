<?php
session_start();
include('./../config/conn.php');
if(!isset($_POST['submit'])){
$fname=array();
$fx = array();
$fy = array();
$fnome = array();
$fvia = array();
$ftelefono = array();
$fcodice = array();
$fcap = array();
$fregione=array();
$fprov=array();
$fdescription=array();
$fcomune=array();
$ftype=array();
$ftypename=array();
$ftypedescription=array();
$ftypeimage=array();
$hint = "";
$description = "";
$type = "";
$counter = 0;
$ris=0;
$multiple = 0;

if(!isset($_POST['submit'])){

    $q = $_REQUEST["q"];
    $cert = $_REQUEST["map-certification"];
    $code = $_REQUEST["map-code"];
    //$query=mysqli_query($conn,"SELECT s.nome as nome, s.descrizione as descrizione, p.comune as comune FROM sedi s JOIN posizione p ON s.id_posizione = p.id WHERE p.comune = '$q'");
    if($cert == 'all' && $code == ""){
        $query=mysqli_query($conn,"SELECT p.provincia as prov, s.co_y as y, s.co_x as x, s.codice as codice, p.cap as cap, s.telefono as telefono, s.via as via, s.nome as nome, s.descrizione as descrizione, p.comune as comune, p.regione as regione, p.provincia as provincia FROM sedi s JOIN posizione p ON s.id_posizione = p.id");
    }else if($cert == 'all' && $code !== ""){
        $query=mysqli_query($conn,"SELECT p.provincia as prov, s.co_y as y, s.co_x as x, s.codice as codice, p.cap as cap, s.telefono as telefono, s.via as via, s.nome as nome, s.descrizione as descrizione, p.comune as comune, p.regione as regione, p.provincia as provincia FROM sedi s JOIN posizione p ON s.id_posizione = p.id WHERE s.codice = '$code'");
    }else{
        $query=mysqli_query($conn,"SELECT p.provincia as prov, s.co_y as y, s.co_x as x, s.codice as codice, p.cap as cap, s.telefono as telefono, s.via as via, s.nome as nome, s.descrizione as descrizione, p.comune as comune, p.regione as regione, p.provincia as provincia FROM sedi s JOIN posizione p ON s.id_posizione = p.id WHERE s.codice = '$code' AND ce.id_corso = '$cert'");
    }
    while($row=mysqli_fetch_assoc($query)){
        $fname[]=$row['comune'];
        $fx[] = $row['x'];
        $fy[] = $row['y'];
        $fnome[] = $row['nome'];
        $fvia[] = strtoupper($row['via']);
        $ftelefono[] = $row['telefono'];
        $fcodice[] = $row['codice'];
        $fcap[] = $row['cap'];
        $fcomune[] = strtoupper($row['comune']);
        $fprov[] = $row['prov'];
    }
     
    // lookup all hints from array if $q is different from "" 
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        $multiple = 0;
        foreach($fname as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint == "") {
                    $x = $fx[$counter];
                    $y = $fy[$counter];
                    $name = $fname[$counter];
                    $nome = $fnome[$counter];
                    $via = $fvia[$counter];
                    $telefono = $ftelefono[$counter];
                    $codice = $fcodice[$counter];
                    $cap = $fcap[$counter];
                    $comune = $fcomune[$counter];
                    $prov = $fprov[$counter]; 
                    $hint = <<<EOD
                    <script>
                    var  myFGMarker = new L.FeatureGroup();
                    
                    

                    
                    var map = L.map('map').setView([$x, $y], 50);
            
                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://8digital.it/">8Digital</a>'
                    }).addTo(map);

                    marker = L.marker([$x, $y]).addTo(map)
                    .bindPopup('<p class="nameMap">$nome</p><br><p class="codeMap">$codice</p><br><p class="addressMap">$via - $cap $comune ($prov)</p><br><p class="telephoneMap">Tel.: $telefono</p><a class="linkMap" href="#">VAI ALLA SCHEDA ></a>')
                    .openPopup();

                    myFGMarker.addLayer(marker);
                    myFGMarker.addTo(map);
                    
                    EOD;
                    $ris++;
                } else {
                    $x = $fx[$counter];
                    $y = $fy[$counter];
                    $name = $fname[$counter];
                    $nome = $fnome[$counter];
                    $via = $fvia[$counter];
                    $telefono = $ftelefono[$counter];
                    $codice = $fcodice[$counter];
                    $cap = $fcap[$counter];
                    $comune = $fcomune[$counter];
                    $prov = $fprov[$counter]; 
                    $hint .= <<<EOD
                    marker = L.marker([$x, $y]).addTo(map)
                    .bindPopup('<p class="nameMap">$nome</p><br><p class="codeMap">$codice</p><br><p class="addressMap">$via - $cap $comune ($prov)</p><br><p class="telephoneMap">Tel.: $telefono</p><a class="linkMap" href="#">VAI ALLA SCHEDA ></a>')
                    .openPopup();

                    myFGMarker.addLayer(marker);
                    myFGMarker.addTo(map);
                    EOD;
                    $ris++;
                    $multiple++;
                }
            }
            $counter++;
            
        }
    }
    if($hint==""){
        echo "Nessun risultato correlato.";
    }else{
        $totrisultati = <<<EOD
                <p style="color: #ffffff; font-family: 'Roboto', sans-serif; font-size:16px;" class="risultatitot" > risultati correlati: $ris</p>
            EOD;
        $hint .= <<<EOD
        map.fitBounds(myFGMarker.getBounds());
        </script>
        EOD;
        $_SESSION['mapCode'] = $hint;
        header("Location: ./../index.php");
    }
    
}




















    /*$used = 0;
    $input  = $_REQUEST["q"];
    $cert = $_REQUEST["map-certification"];
    $code = $_REQUEST["map-code"];
    if($cert == 'all'){
        $sql = "SELECT s.co_x as x, s.co_y as y, s.nome as nome, s.via as via, s.telefono as telefono, s.codice as codice, p.cap as cap, p.comune as comune, p.provincia as prov FROM (sedi s JOIN posizione p ON s.id_posizione = p.id) JOIN center ce ON s.id = ce.id_sede WHERE p.comune = '$input' OR s.codice = '$code' GROUP BY p.comune";
    }else{
        $sql = "SELECT s.co_x as x, s.co_y as y, s.nome as nome, s.via as via, s.telefono as telefono, s.codice as codice, p.cap as cap, p.comune as comune, p.provincia as prov FROM (sedi s JOIN posizione p ON s.id_posizione = p.id) JOIN center ce ON s.id = ce.id_sede WHERE (p.comune = '$input' OR s.codice = '$code') AND ce.id_corso = $cert GROUP BY p.comune";
    }
    
    $stmt = $conn->query($sql);

    // Controllo risultati query
    if ($stmt->num_rows > 0) {
        
        // Stampa risultati
        while($row = $stmt->fetch_assoc()) {
            $text .= "v";
            $x = $row['x'];
            $y = $row['y'];
            $nome = $row['nome'];
            $via = $row['via'];
            $telefono = $row['telefono'];
            $codice = $row['codice'];
            $cap = $row['cap'];
            $comune = strtoupper($row['comune']);
            $prov = $row['prov'];
            if($used == 0){
                $text .= <<<EOD
                <script>
                var map = L.map('map').setView([$x, $y], 50);
        
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://8digital.it/">8Digital</a>'
                }).addTo(map);

                L.marker([$x, $y]).addTo(map)
                .bindPopup('<p class="nameMap">$nome</p><br><p class="codeMap">$codice</p><br><p class="addressMap">$via - $cap $comune ($prov)</p><br><p class="telephoneMap">Tel.: $telefono</p><a class="linkMap" href="#">VAI ALLA SCHEDA ></a>')
                .openPopup();
                EOD;
                $used = $used + 1;
            }else{
                $text .= <<<EOD
                L.marker([$x, $y]).addTo(map)
                .bindPopup('<p class="nameMap">$nome</p><br><p class="codeMap">$codice</p><br><p class="addressMap">$via - $cap $comune ($prov)</p><br><p class="telephoneMap">Tel.: $telefono</p><a class="linkMap" href="#">VAI ALLA SCHEDA ></a>')
                .openPopup();
                EOD;
            }
            
        }
        $text .= <<<EOD
        $used
        </>
        EOD;
        $_SESSION['mapCode'] = $text;
        header("Location: ./../index.php");
        $used = 0;
    }else{
        echo "nessun risultato";
    }*/
}

?>