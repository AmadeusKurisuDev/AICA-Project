<?php
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
                        <label for="email">
                            EMAIL*
                            <p id="errore-email-1" class="errore-email-reg">Le email non corrispondono!</p>
                        </label>
                        <input type="text" name="email" id="email" class="inputtxt" onkeyup="ValidateEmail()" required>
                        <label for="email">
                            INSERISCI NUOVAMENTE EMAIL*
                            <p id="errore-email-2" class="errore-email-reg">Le email non corrispondono!</p>
                        </label>
                        <input type="text" name="cont-email" id="cont-email" class="inputtxt" onkeyup="ValidateEmail()" required>
                        <label for="password">
                            PASSWORD*
                            <p id="errore-email-3" class="errore-email-reg">Le password non corrispondono!</p>
                        </label>
                        <input type="password" name="password" id="password" class="inputtxt" onkeyup="ValidatePassword()" required>
                        <label for="password">
                            INSERISCI NUOVAMENTE PASSWORD*
                            <p id="errore-email-4" class="errore-email-reg">Le password non corrispondono!</p>
                        </label>
                        <input type="password" name="cont-password" id="cont-password" class="inputtxt" onkeyup="ValidatePassword()" required>
                        <hr>
                        <label for="telefono">TELEFONO</label>
                        <input type="text" name="telefono" id="telefono" class="inputtxt">
                        <label for="azienda">AZIENDA/ORGANIZZAZIONE*</label>
                        <input type="text" name="azienda" id="azienda" class="inputtxt" required>
                        <label for="settore">SETTORE*</label>
                        <select name="settore" id="settore" class="listtxt" required>
                            <?php
                                $ids=0;
                                $settore="";
                                $listasettore="";
                                $query=mysqli_query($conn,"SELECT * FROM settore");
                                while($row=mysqli_fetch_assoc($query)){
                                    $ids = $row['id'];
                                    $settore = $row['nome'];
                                    $listasettore = <<<EOD
                                        <option value="$ids">$settore</option>
                                    EOD;
                                    echo $listasettore;
                                }
                            ?>
                        </select>
                        <label for="citta">CITTÀ*</label>
                        <select name="citta" id="citta" class="listtxt" required>
                            <?php
                                include('./../config/conn.php');
                                $id=0;
                                $comune="";
                                $listacomune="";
                                $query=mysqli_query($conn,"SELECT * FROM posizione");
                                while($row=mysqli_fetch_assoc($query)){
                                    $id = $row['id'];
                                    $comune = $row['comune'];
                                    $listacomune = <<<EOD
                                        <option value="$id">$comune</option>
                                    EOD;
                                    echo $listacomune;
                                }
                            ?>
                        </select>
                        <label for="areaf">AREA FUNZIONALE*</label>
                        <select name="areaf" id="areaf" class="listtxt" required>
                            <?php
                                $idf=0;
                                $funzione="";
                                $listafunzione="";
                                $query=mysqli_query($conn,"SELECT * FROM funzione");
                                while($row=mysqli_fetch_assoc($query)){
                                    $idf = $row['id'];
                                    $funzione = $row['nome'];
                                    $listafunzione = <<<EOD
                                        <option value="$idf">$funzione</option>
                                    EOD;
                                    echo $listafunzione;
                                }
                            ?>
                        </select>
                        <hr>
                        <div class="aica-form-disclaimer"> 
                            <p><strong>INFORMATIVA AI SENSI DELL’ART.13 DEL </strong>
                            <strong>REGOLAMENTO UE 2016/679</strong></p> 
                            <p style="margin-left:18.0pt;"><strong>1.</strong>&nbsp;&nbsp; 
                            <strong>Titolare del trattamento. </strong></p> 
                            <p>Titolare del trattamento è <strong>AICA (Associazione Italiana per l’informatica ed il Calcolo Automatico)</strong>, con sede in Piazzale Rodolfo Morandi 2&nbsp; 20121 MILANO, Cod. fisc. 03720700156</p> 
                            <p style="margin-left:18.0pt;"><strong>2.</strong>&nbsp;&nbsp; 
                            <strong>Responsabile per il trattamento dei dati Personali. </strong></p> 
                            <p style="margin-left:18.0pt;">Responsabile per il trattamento dei dati personali è il Sig. <strong>Marco Miglio </strong>(<a href="mailto:privacy@aicanet.it">privacy@aicanet.it</a>)</p> 
                            <p style="margin-left:18.0pt;"><strong>3.</strong>&nbsp;&nbsp; <strong>Finalità del trattamento. </strong></p> 
                            <p>I dati sono trattati nell’ambito della normale attività di AICA e secondo le seguenti finalità:</p> 
                            <p><strong>a)</strong> Registrazione del candidato nel portale di AICA</p> 
                            <p><strong>b)</strong> Invio, tramite posta elettronica, di materiale informativo riguardante le attività di AICA<br> 
                            <strong>c)</strong> Invio, tramite posta elettronica, di inviti agli eventi&nbsp; locali o nazionali organizzati da AICA<br> 
                            <strong>d)</strong> Invio, tramite sistemi di messaggistica ( es. Whatsup o SMS ) di informazioni di servizio</p> 
                            <p>&nbsp;&nbsp;&nbsp;&nbsp; riguardanti gli eventi organizzati (es. cambiamenti ‘dell’ultimo momento’)<br> 
                            <strong>NB</strong>: la data di nascita viene richiesta per poter effettuare un controllo di validità dei dati inseriti confrontandoli con quelli della skills card precedentemente attivata</p> 
                            <p style="margin-left:18.0pt;"><strong>4.&nbsp;&nbsp; Liceità del trattamento. </strong></p> 
                            <p>Spuntando la casella ‘<strong><em>Ho letto l’informativa e accetto le condizioni</em></strong>’ si dichiara di aver letto la presente informativa e di accettare il trattamento che AICA effettuerà con i suoi dati personali; la mancanza del consenso comporta l’impossibilità di effettuare l’iscrizione al portale di AICA. Si precisa che AICA non intende utilizzare i dati personali allo scopo di profilazione per fini commerciali, ma intende utilizzare le informazioni per selezionare i destinatari ai quali inviare informazioni ed inviti di cui ai punti 1b) 1c) 1d); inoltre, buona parte dei dati richiesti sono facoltativi<br> <strong>5.&nbsp; Ambito di comunicazione e diffusione</strong></p> 
                            <p>I dati personali forniti dall’interessato saranno conosciuti e trattati, nel rispetto della vigente normativa in materia, dal personale di AICA <strong><em>autorizzato al trattamento</em></strong>, in servizio presso gli uffici di pertinenza e da Società e/o collaboratori di AICA in qualità di <strong><em>responsabili </em></strong>secondo quanto disposto dall’Art.28 del Regolamento UE 2016/679<strong><em>. </em></strong></p> <p><strong>6.&nbsp; Trasferimento all’estero. </strong></p> <p>I dati personali saranno memorizzati su server in ‘cloud’ ubicati in paesi della Comunità Europea</p> <p style="margin-left:18.0pt;"><strong>7.</strong>&nbsp;&nbsp; <strong>Periodo di conservazione dei dati. </strong></p> <p>I dati personali forniti saranno conservati sino alla richiesta di cancellazione dell’account da parte dell’interessato.</p> <p><strong>8.</strong>&nbsp;&nbsp; <strong>Minori.</strong></p> <p>Il Regolamento europeo fissa a 16 anni l’età al di sotto della quale è necessario il consenso di almeno uno dei genitori (o di chi ne fa le veci) per il trattamento dei dati personali del minore. Il minore, senza tale consenso, può liberamente navigare i nostri siti, ma non può utilizzare i servizi che richiedono la registrazione o il conferimento di dati e informazioni. Se un genitore (o chi ne fa le veci) desidera autorizzare il trattamento dei dati del soggetto minore per le finalità indicate al punto 3), deve scaricare il modulo <a href="http://www.aicanet.it/documents/10776/2261495/Liberatoria+registrazione+under+16+candidato/21f97844-6763-486e-9563-85c5a33582d5"><strong>consenso-minori-portale-candidato</strong></a> , compilarlo e inviarlo firmato a <a href="mailto:privacy@aicanet.it">privacy@aicanet.it</a></p> <p><strong>9.&nbsp;&nbsp; Diritti dell'interessato </strong></p> <p>Il Regolamento Europeo garantisce agli interessati una serie di diritti sui propri dati personali trattati dal Titolare del trattamento. In ogni momento, l'interessato può rivolgersi ad AICA, utilizzando l’indirizzo di posta elettronica <a href="mailto:privacy@aicanet.it">privacy@aicanet.it</a> direttamente o per il tramite di persona/associazione o organismo delegato. AICA, per garantire l'effettivo esercizio dei diritti dell'interessato, adotta misure idonee volte ad agevolare l'accesso ai dati personali da parte dell'interessato medesimo, a semplificare le modalità e a ridurre i tempi per il riscontro al richiedente. I diritti previsti dal Regolamento UE 2016/679 sono riportati negli Articoli dal 12 al 23, dei quali ricordiamo a titolo puramente esemplificativo:</p> <ol style="list-style-type:lower-alpha;"> <li>il diritto all’accesso ai propri dati al fine di verificarne la correttezza e l’esistenza</li> <li>il diritto alla rettifica/integrazione dei propri dati</li> <li>il diritto al richiederne la cancellazione</li> </ol> <p>L’interessato può approfondire l’argomento ‘privacy’ e trattamento dei dati personali, visitando la pagina web <a href="http://www.garanteprivacy.it/guida-all-applicazione-del-regolamento-europeo-in-materia-di-protezione-dei-dati-personali">http://www.garanteprivacy.it/guida-all-applicazione-del-regolamento-europeo-in-materia-di-protezione-dei-dati-personali</a> , o la documentazione in inglese, messa a disposizione all’indirizzo:&nbsp; <a href="https://www.eugdpr.org/">https://www.eugdpr.org/</a></p> <p>&nbsp;</p> <p>Marco Miglio</p> <p>AICA – Responsabile per il trattamento dei dati personali</p>
                        
                        </div>
                        <label for="checkbox">
                            <input type="checkbox" name="checkbox" id="rg-checkbox">
                            Dichiaro di aver preso visione dell'informativa privacy*
                        </label>
                        <input type="submit" value="REGISTRATI" id="register-btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function ValidateEmail(input) {
            var emailcheck = document.getElementById('cont-email');
            var email = document.getElementById('email');
            var invio = document.getElementById('register-btn');
            
            var er1 = document.getElementById('errore-email-1');
            var er2 = document.getElementById('errore-email-2');
            if(emailcheck.value != "" && email.value == ""){
                if(emailcheck.value != email.value){
                    console.log('uguale input:'+emailcheck.value+' altro:'+email.value);
                    er1.classList.remove("errore-email-reg");
                    er2.classList.remove("errore-email-reg");
                    er1.classList.add("errore-email-reg-v");
                    er2.classList.add("errore-email-reg-v");
                    }else{
                        console.log('non uguale input:'+emailcheck.value+' altro:'+email.value);
                        er1.classList.remove("errore-email-reg-v");
                        er2.classList.remove("errore-email-reg-v");
                        er1.classList.add("errore-email-reg");
                        er2.classList.add("errore-email-reg");
                    }
                }else if(emailcheck.value == "" && email.value == ""){
                    if(emailcheck.value != email.value){
                    console.log('uguale input:'+emailcheck.value+' altro:'+email.value);
                    er1.classList.remove("errore-email-reg");
                    er2.classList.remove("errore-email-reg");
                    er1.classList.add("errore-email-reg-v");
                    er2.classList.add("errore-email-reg-v");
                    }else{
                        console.log('non uguale input:'+emailcheck.value+' altro:'+email.value);
                        er1.classList.remove("errore-email-reg-v");
                        er2.classList.remove("errore-email-reg-v");
                        er1.classList.add("errore-email-reg");
                        er2.classList.add("errore-email-reg");
                    }
                }else{
                    if(emailcheck.value != email.value){
                    console.log('uguale input:'+emailcheck.value+' altro:'+email.value);
                    er1.classList.remove("errore-email-reg");
                    er2.classList.remove("errore-email-reg");
                    er1.classList.add("errore-email-reg-v");
                    er2.classList.add("errore-email-reg-v");
                    }else{
                        console.log('non uguale input:'+emailcheck.value+' altro:'+email.value);
                        er1.classList.remove("errore-email-reg-v");
                        er2.classList.remove("errore-email-reg-v");
                        er1.classList.add("errore-email-reg");
                        er2.classList.add("errore-email-reg");
                    }
                }
        }



        function ValidatePassword(input) {
            var passwordcheck = document.getElementById('cont-password');
            var password = document.getElementById('password');
            var invio = document.getElementById('register-btn');
            
            var er1 = document.getElementById('errore-email-3');
            var er2 = document.getElementById('errore-email-4');
            if(passwordcheck.value != "" && password.value == ""){
                if(passwordcheck.value != password.value){
                    console.log('uguale input:'+passwordcheck.value+' altro:'+password.value);
                    er1.classList.remove("errore-email-reg");
                    er2.classList.remove("errore-email-reg");
                    er1.classList.add("errore-email-reg-v");
                    er2.classList.add("errore-email-reg-v");
                    }else{
                        console.log('non uguale input:'+passwordcheck.value+' altro:'+password.value);
                        er1.classList.remove("errore-email-reg-v");
                        er2.classList.remove("errore-email-reg-v");
                        er1.classList.add("errore-email-reg");
                        er2.classList.add("errore-email-reg");
                    }
                }else if(passwordcheck.value == "" && password.value == ""){
                    if(passwordcheck.value != password.value){
                    console.log('uguale input:'+passwordcheck.value+' altro:'+password.value);
                    er1.classList.remove("errore-email-reg");
                    er2.classList.remove("errore-email-reg");
                    er1.classList.add("errore-email-reg-v");
                    er2.classList.add("errore-email-reg-v");
                    }else{
                        console.log('non uguale input:'+passwordcheck.value+' altro:'+password.value);
                        er1.classList.remove("errore-email-reg-v");
                        er2.classList.remove("errore-email-reg-v");
                        er1.classList.add("errore-email-reg");
                        er2.classList.add("errore-email-reg");
                    }
                }else{
                    if(passwordcheck.value != password.value){
                    console.log('uguale input:'+passwordcheck.value+' altro:'+password.value);
                    er1.classList.remove("errore-email-reg");
                    er2.classList.remove("errore-email-reg");
                    er1.classList.add("errore-email-reg-v");
                    er2.classList.add("errore-email-reg-v");
                    }else{
                        console.log('non uguale input:'+passwordcheck.value+' altro:'+password.value);
                        er1.classList.remove("errore-email-reg-v");
                        er2.classList.remove("errore-email-reg-v");
                        er1.classList.add("errore-email-reg");
                        er2.classList.add("errore-email-reg");
                    }
                }
        }
    </script>
    <div class="footer">
        <div class="footer-one">
            <img src="../images/footer-logo.png">
        </div>
    </div>
</body>
</html>