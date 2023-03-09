<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            
            <div id="map"></div>
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