<?php
session_start();
    include('./config/conn.php');
    
    if(!isset($_SESSION['resNum'])){
        $_SESSION['resNum']=0;
    }
    $_SESSION['codeMap'] = '<script src="./assets/js/app.js"></script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/fonts/fonts.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>
    <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
    <title>Portale AICA</title>
    <script>
    function showResult(str) {
        element = document.querySelector('.HomePage');
        if (str.length == 0) { 
            document.getElementById("results").innerHTML = "";
            element.style.visibility = 'visible';
            return;
        } else {
            element.style.visibility = 'hidden';
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("results").innerHTML = this.responseText;
    
                }
            };
            xmlhttp.open("GET", "./logic/search.php?q=" + str, true);
            xmlhttp.send();
        }
    }

    function searchEdit(valueii){
        var insertInput = document.getElementById('map-near-input');
        var results = document.getElementById('results');
        results.innerHTML = "";
        insertInput.value = valueii;
        var textin = document.getElementById("map-near-input").value;
        var btn = document.getElementById("submit");
        if (textin) {
            btn.removeAttribute('disabled');
        } else {
            btn.setAttribute('disabled', true);
        }
    }

    </script>
</head>
<body>
    <div class="top-header">
        <div class="top-header-btn-container">
            <div class="top-header-btn">
                <a href="./auth/login.php"><img src="./images/icons/users.png"> ACCEDI</a>
                <a href="./auth/register.php"> <img src="./images/icons/register.png"> REGISTRATI</a>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="logo-container">
            <img src="./images/logo-aica-def.jpg" alt="AICA-logo">
        </div>
        <div class="header-link-container">
            <!--pulsanti menu-->
        </div>
    </div>
    <div class="content">
        <div class="main-container">
            <div class="map-container">
                <div class="map-container-column">
                    <div id="map-search">
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
                        <!--action="./logic/search.php"-->
                        <form action="./logic/map.php" id="map-form" onkeydown="return event.key != 'Enter';">
                            <div class="search">
                                <div class="form-div-container" id="map-div-near-input">
                                    <label for="map-near">VICINO A:</label>
                                    <input type="text" name="q" id="map-near-input" placeholder="Inserisci un Comune" onkeyup="showResult(this.value)" autocomplete="off" required>
                                    <div id="results"></div>
                                    <style>
                                        #results {
                                            position: absolute;
                                            z-index: 999;
                                            width: calc(15% + 20px);
                                            min-width: 210px;
                                            background-color: #e2e2e2;
                                            font-size: 16px;
                                        }

                                        #results a {
                                            color: #0c0d0d;
                                            text-decoration: none;
                                        }

                                        #results a:hover {
                                            background-color: #3a4041;
                                            text-decoration: none;
                                        }
                                    </style>
                                </div>
                                <!--
                                <div class="form-div-container" id="radius">
                                    <label for="map-radius">RAGGIO:</label>
                                    <select name="map-radius" id="map-radius">
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                    </select>
                                </div>-->
                                <div class="form-div-container" id="code">
                                    <label for="map-code">CODICE TEST CENTER:</label>
                                    <input type="text" name="map-code" id="map-code">
                                </div>
                                <div class="form-div-container" id="date">
                                    <label for="map-datefrom">SESSIONE DA:</label>
                                    <input type="date" name="map-datafrom" id="map-dateto">
                                    <label for="map-dateto">SESSIONE A:</label>
                                    <input type="date" name="map-datato" id="map-dateto">
                                </div>
                                <div class="form-div-container" id="certification">
                                    <label for="map-radius">CERTIFICAZIONE:</label>
                                        <select name="map-certification" id="map-cert">
                                            <option value="all">TUTTI I CERTIFICATI</option>
                                            <?php
                                                $list = "";
                                                $sql = "SELECT * FROM servizi";
                                                $stmt = $conn->query($sql);
                                        
                                                // Controllo risultati query
                                                if ($stmt->num_rows > 0) {
                                                    // Stampa risultati
                                                    while($row = $stmt->fetch_assoc()) {
                                                        $nome=$row['nome'];
                                                        $id = $row['id'];
                                                        $list = <<<EOD
                                                            <option value="$id">$nome</option>
                                                        EOD;
                                                        echo $list;
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" id="submit" disabled>Ricerca</button>
                            </form>
                        </div>
                    <form action="./logic/sede.php" method="post">
                        <div id="map"></div>
                    </form>
                    <div class="risultati">
                    <?php 
                        if($_SESSION['resNum']=="0"){
                            echo 'Nessun risultato correlato.';
                        }else{
                            echo 'Risultati correlati: '.$_SESSION['resNum'];
                        }
                        
                        ?>
                        <div class="resoconto">
                            <!--
                            <div class="res">
                                <div class="t-res">
                                    <div class="t-count">
                                        <p>1</p>
                                    </div>
                                    <p class="res-titolo">Titolo</p><p class="res-codice"> | A0001</p>
                                </div>
                                <div class="c-res">
                                    <p class="res-indirizzo">via boh</p>
                                    <p class="res-telefono">Tel.: 0761 111111</p>
                                </div>
                            </div>-->
                            <?php 
                            if($_SESSION['resNum']!=="0"){
                                echo $_SESSION['res']; 
                            }
                            
                            ?>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <div class="HomePage">
    </div>
    <div class="footer">
        <div class="footer-one">
            <img src="./images/footer-logo.png">
        </div>
    </div>
    <?php
        echo $_SESSION['mapCode'];
    ?>
</body>
</html>

