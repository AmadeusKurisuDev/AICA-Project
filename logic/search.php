<?php
include('./../config/conn.php');
/*
$fname=array();
$fregione=array();
$fprovincia=array();
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

if(!isset($_POST['submit'])){
    echo 'ok';
    $q = $_REQUEST["q"];
    $sql=mysqli_query($conn,"SELECT comune FROM posizione WHERE comune = '$q'");
    $stmt = $conn->query($sql);

    // Controllo risultati query
    if ($stmt->num_rows > 0) {
        // Stampa risultati
        while($row = $stmt->fetch_assoc()) {
            $fname[]=$row['comune'];
            $fregione[]=$row['regione'];
            $fprovincia[]=$row['provincia'];
            $fdescription[]=$row['descrizione'];
        }

        if($q !== ""){
            $q = strtolower($q);
            $len=strlen($q);
            foreach($fname as $name) {
                if (stristr($q, substr($name, 0, $len))) {
                    if ($hint == "") {
                        $description = $fdescription[$counter];
                        $hint = <<<EOD
                        <div class="search-item">
                            <a href="#" onclick="searchEdit('$name')">
                                <p>$name</p>
                            </a>
                        </div>
                        EOD;
                        $ris++;
                    } else {
                        $description = $fdescription[$counter];
                        $hint .= <<<EOD
                        <br>
                        <div class="search-item">
                            <a href="#" onclick="searchEdit('$name')">
                                <p>$name</p>
                            </a>
                        </div>
                        EOD;
                        $ris++;
                    }
                }
                $counter++;
            }
        }
    } else {
    echo "Nessun risultato trovato.";
    }
}*/

$fname=array();
$fregione=array();
$fprovincia=array();
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

if(!isset($_POST['submit'])){

    $q = $_REQUEST["q"];
    //$query=mysqli_query($conn,"SELECT s.nome as nome, s.descrizione as descrizione, p.comune as comune FROM sedi s JOIN posizione p ON s.id_posizione = p.id WHERE p.comune = '$q'");
    $query=mysqli_query($conn,"SELECT DISTINCT s.nome as nome, s.descrizione as descrizione, p.comune as comune, p.regione as regione, p.provincia as provincia FROM sedi s JOIN posizione p ON s.id_posizione = p.id");
    while($row=mysqli_fetch_assoc($query)){
        $fname[]=$row['comune'];
        $fregione[]=$row['regione'];
        $fprovincia[]=$row['provincia'];
        $fdescription[]=$row['descrizione'];
    }
     
    // lookup all hints from array if $q is different from "" 
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        foreach($fname as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint == "") {
                    $description = $fdescription[$counter];
                    $hint = <<<EOD
                    <div class="search-item">
                        <a href="#" onclick="searchEdit('$name')">
                            <p>$name</p>
                        </a>
                    </div>
                    EOD;
                    $ris++;
                } /*else {
                    $description = $fdescription[$counter];
                    $hint .= <<<EOD
                    <br>
                    <div class="search-item">
                        <a href="#" onclick="searchEdit('$name')">
                            <p>$name</p>
                        </a>
                    </div>
                    EOD;
                    $ris++;
                }*/
            }
            $counter++;
            
        }
    }
    if($hint==""){
        echo "Nessun risultato correlato.";
    }else{
        echo $hint;
    }
    
}


?>