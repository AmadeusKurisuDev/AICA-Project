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
                <a href="./login.php"><img src="../images/icons/users.png"> ACCEDI</a>
                <a href="./register.php"> <img src="../images/icons/register.png"> REGISTRATI</a>
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
    <?php
        if(isset($_SESSION["createAccountStatus"])){
            $value = $_SESSION["createAccountStatus"];
            if($value !== ""){
                $testo = $value;
                $popup = <<<EOD
                <div class="popup">
                    <p>$testo</p>
                </div>
                EOD;
                echo $popup;
                $_SESSION["createAccountStatus"]=NULL;
            }
        }
        
    ?>
    <!--
    <div class="popup">
        ciao
    </div>-->
    <div class="content">
        <div class="main-container">
            <div class="login-container">
                <div class="login">
                    <div class="login-article">
                        <p>LOGIN</p>
                        <p>Gentile utente,</p>
                        <ul>
                            <li>Per accedere al Portale AICA come responsabile <strong>Test Center</strong>, inserisca le sue credenziali di ATLAS;</li>
                        </ul>
                    </div>
                    <form action="authenticate.php" method="post" id="login-form">
                        <label for="email">EMAIL</label>
                        <input type="text" name="email" id="email" class="inputtxt" required>
                        <label for="password">PASSWORD <!--(<a href="#" class="passforgotten">Dimenticata?</a>)--></label>
                        <input type="password" name="password" id="password" class="inputtxt" required>
                        <hr>
                        <input type="submit" value="ACCEDI" id="login-btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <div class="footer-one">
            <img src="../images/footer-logo.png">
        </div>
    </div>
</body>
</html>