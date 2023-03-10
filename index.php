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
      <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>
    <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
    <title>Portale AICA</title>
</head>
<body>
    <div class="top-header">
        <div class="top-header-btn-container">
            <div class="top-header-btn">
                <a href="#"><img src="./images/icons/users.png"> ACCEDI</a>
                <a href="#"> <img src="./images/icons/register.png"> REGISTRATI</a>
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
    <div class="main-container">
        <div class="map-container">
            <div class="map-container-column">
                <div id="map-search">
                    <form action="" method="post" id="map-form">
                        <div class="form-div-container" id="near">
                            <label for="map-near">VICINO A:</label>
                            <input type="text" name="map-near" id="map-near" placeholder="Inserisci un Indirizzo, Città o CAP">
                        </div>
                        <div class="form-div-container" id="radius">
                            <label for="map-radius">RAGGIO:</label>
                            <select name="map-radius" id="map-radius">
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                        </div>
                        <div class="form-div-container" id="code">
                            <label for="map-code">CODICE TEST CENTER:</label>
                            <input type="text" name="map-code" id="map-code">
                        </div>
                        <div class="form-div-container" id="date">
                            <label for="map-datefrom">SESSIONE DA:</label>
                            <input type="date" name="map-datefrom" id="map-dateto">
                            <label for="map-dateto">SESSIONE A:</label>
                            <input type="date" name="map-dateto" id="map-dateto">
                        </div>
                    </form>
                </div>
                <div id="map"></div>
            </div>
            
        </div>
    </div>
    <div class="footer">
        <div class="footer-one">
            <img src="./images/footer-logo.png">
        </div>
    </div>
    <script src="./assets/js/app.js"></script>
</body>
</html>