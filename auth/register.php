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
                <a href="#"><img src="../images/icons/users.png"> ACCEDI</a>
                <a href="#"> <img src="../images/icons/register.png"> REGISTRATI</a>
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
            <div class="register-container">
                <div class="register">
                    <div class="register-article">
                        <p>REGISTRATI</p>
                        <p>Ti stai registrando con il profilo "Utente Sede"</p>
                        <p>La password deve contenere almeno 6 caratteri</p>
                    </div>
                    <form action="regauth.php" method="post" id="register-form">
                        <label for="nome">NOME*</label>
                        <input type="text" name="nome" id="reg-nome" class="inputtxt" required>
                        <label for="nome">COGNOME*</label>
                        <input type="text" name="cognome" id="reg-cognome" class="inputtxt" required>
                        <hr>
                        <label for="email">EMAIL*</label>
                        <input type="text" name="reg-email" id="email" class="inputtxt" required>
                        <label for="email">INSERISCI NUOVAMENTE EMAIL*</label>
                        <input type="text" name="cont-email" id="email" class="inputtxt" required>
                        <label for="password">PASSWORD (<a href="#" class="passforgotten">Dimenticata?</a>)</label>
                        <input type="password" name="password" id="password" class="inputtxt" required>
                        <hr>
                        <input type="submit" value="ACCEDI" id="register-btn">
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