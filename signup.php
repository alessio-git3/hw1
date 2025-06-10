<?php
    require_once 'auth.php';
    session_start();

    if (checkAuth()) {
        header("Location: home.php"); //se già si è registrati (o meglio autenticati) si va alla home
        exit;
    }

    if (!empty($_POST["nazionalita"]) && !empty($_POST["titolo"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["giorno"]) && !empty($_POST["mese"]) && !empty($_POST["anno"]) && !empty($_POST["prefisso"]) && !empty($_POST["telefono"]) && !empty($_POST["email"]) && !empty($_POST["confirm_email"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"])) {
        $error = array();
        $conn = mysqli_connect('127.0.0.1', 'root', '', 'hw1'); 

        //check numero telefonico
        if(!preg_match('/^[0-9]{6,15}$/', $_POST["telefono"])) {
            $error[] = "Numero telefonico non valido";
        }

        //check email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error[] = "Email non valida";
        }
        else{
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $query = "SELECT email FROM users WHERE email = '$email'";
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) > 0){
                $error[] = "Email già utilizzata";
            }
        }

        //conferma email
        if(strcmp($_POST["email"], $_POST["confirm_email"]) != 0){
            $error[] = "Le email non coincidono";
        }

        //check password
        if(strlen($_POST['password']) < 8){
            $error[] = "Numero caratteri password inseriti insufficente";
        }
        
        //conferma password
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }


        //registrazione/scrittura nel db
        $num_errors = count($error);
        if($num_errors == 0){
            $nazionalita = mysqli_real_escape_string($conn, $_POST["nazionalita"]);
            $titolo = mysqli_real_escape_string($conn, $_POST["titolo"]);
            $name = mysqli_real_escape_string($conn, $_POST["name"]);
            $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
            $date = mysqli_real_escape_string($conn, $_POST["anno"]."-".$_POST["mese"]."-".$_POST["giorno"]);
            $prefisso = mysqli_real_escape_string($conn, $_POST["prefisso"]);
            $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(nazionalita, titolo, name, surname, data_nascita, prefisso_telefono, numero_telefono, email, password) VALUES('$nazionalita', '$titolo', '$name', '$surname', '$date', '$prefisso', '$telefono', '$email', '$password_hash')";

            if (mysqli_query($conn, $query)) {
                $_SESSION["_agora_name"] = $_POST["name"];
                $_SESSION["_agora_surname"] = $_POST["surname"];
                $_SESSION["_agora_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                
                header("Location: home.php"); 
                exit;
            } 
            else {
                $error[] = "Errore di connessione al Database";
            }
        }
        mysqli_close($conn);
    }
    else if (isset($_POST["email"])) {
        $error = array("Riempi tutti i campi");
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Boutique Ufficiale Herno®: ISCRIVITI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='signup.css'>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sofia+Sans:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
        <script src='signup.js' defer></script>
    </head>    

    <body>
        <div id="logo">
            <img src="immagini/menu-logo.png">
        </div>
        <div class="light-line"></div>

        <main>
            <section class="main_left">
            </section>

            <section class="main_right">
                <h3>CREA UN ACCOUNT</h3>
                <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
                    
                    <div class="form-row">
                            <label for="nazionalita">NAZIONALITÀ*</label>
                            <select name="nazionalita" id="nazionalita">
                                <option value="">--</option>
                                <?php
                                    $nazioni = ["AF"=>"Afghanistan", "AL"=>"Albania", "DZ"=>"Algeria", "AR"=>"Argentina", "AU"=>"Australia", "AT"=>"Austria", "BE"=>"Belgio", "BR"=>"Brasile", "BG"=>"Bulgaria", "CA"=>"Canada", "CN"=>"Cina", "HR"=>"Croazia", "CU"=>"Cuba", "DK"=>"Danimarca", "EG"=>"Egitto", "FI"=>"Finlandia", "FR"=>"Francia", "DE"=>"Germania", "GR"=>"Grecia", "IN"=>"India", 
                                                "ID"=>"Indonesia", "IR"=>"Iran", "IE"=>"Irlanda", "IL"=>"Israele", "IT"=>"Italia", "JP"=>"Giappone", "MX"=>"Messico", "MA"=>"Marocco", "NL"=>"Paesi Bassi", "NZ"=>"Nuova Zelanda", "NG"=>"Nigeria", "NO"=>"Norvegia", "PK"=>"Pakistan", "PL"=>"Polonia", "PT"=>"Portogallo", "RO"=>"Romania", "RU"=>"Russia", "SA"=>"Arabia Saudita", "RS"=>"Serbia",
                                                "SG"=>"Singapore", "ZA"=>"Sud Africa", "KR"=>"Corea del Sud", "ES"=>"Spagna", "SE"=>"Svezia", "CH"=>"Svizzera", "TR"=>"Turchia", "UA"=>"Ucraina", "GB"=>"Regno Unito", "US"=>"Stati Uniti", "VE"=>"Venezuela", "VN"=>"Vietnam"
                                            ];
                                    foreach ($nazioni as $codice => $nome) {
                                        echo "<option value=\"$codice\">$nome</option>";
                                    }
                                ?>
                            </select>
                            <div class="break"><span>Per favore, inserisci la tua nazionalità</span></div>
                    </div>

                    <div class="form-row">
                            <label for="titolo">TITOLO*</label> 
                            <select name="titolo" id="titolo">
                                <option value="">--</option>
                                <?php
                                    $titoli = ["UOMO", "DONNA", "PREFERISCO NON SPECIFICARLO"];
                                    for ($i = 0; $i < 3; $i++) {
                                        echo "<option value=\"$titoli[$i]\">$titoli[$i]</option>";
                                    }
                                ?>
                            </select>
                            <div class="break"><span>Per favore, popola il campo</span></div>
                    </div>

                    <div class="form-row">
                            <label for="nome">NOME*</label> 
                            <input type="text" id="nome" class="name" name="name" <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>>
                            <div class="break"><span>Per favore, inserisci il tuo nome</span></div>
                    </div>

                    <div class="form-row">
                            <label for="cognome">COGNOME*</label> 
                            <input type="text" id="cognome" class="surname" name="surname" <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>>
                            <div class="break"><span>Devi inserire il tuo cognome</span></div>
                    </div>

                    <div class="form-row">
                        <label>DATA DI NASCITA*</label>
                        <select name="giorno" id="giorno">
                            <option value="">Giorno</option>
                            <?php 
                                for($i = 1; $i <= 31; $i++) echo "<option value=\"$i\">$i</option>"; 
                            ?>
                        </select>
                        <select name="mese" id="mese">
                            <option value="">Mese</option>
                            <?php
                                $mesi = ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];
                                foreach ($mesi as $index => $nome) {
                                    $val = $index + 1;
                                    echo "<option value=\"$val\">$nome</option>";
                                }
                            ?>
                        </select>
                        <select name="anno" id="anno">
                            <option value="">Anno</option>
                            <?php
                                for ($i = date("Y"); $i >= 1900; $i--) echo "<option value=\"$i\">$i</option>";
                            ?>
                        </select>
                            
                        <div class="break"><span>Per favore, popola i campi correttamente</span></div>                    
                    </div>
                    
                    <div class="form-row">
                        <label for="telefono">NUMERO DI TELEFONO*</label>
                        <div class="prefisso">
                            <select name="prefisso" id="prefisso">
                                <option value="">+Prefisso</option>
                                <?php
                                    $prefissi = ["+1" => "Stati Uniti / Canada", "+39" => "Italia", "+44" => "Regno Unito", "+33" => "Francia", "+49" => "Germania", "+34" => "Spagna", 
                                                "+81" => "Giappone", "+86" => "Cina", "+91" => "India", "+7" => "Russia", "+61" => "Australia", "+55" => "Brasile", "+234" => "Nigeria",
                                                "+90" => "Turchia", "+40" => "Romania"];
                                    foreach ($prefissi as $codice => $paese) {
                                        echo "<option value=\"$codice\">$codice ($paese)</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="tel" id="telefono" class="telefono" name="telefono" pattern="[0-9\s\-]{6,15}" placeholder="TELEFONO" <?php if(isset($_POST["telefono"])){echo "value=".$_POST["telefono"];} ?>>
                        
                        <div class="break"><span>Numero telefonico non valido</span></div>
                    </div>

                    <h3>E-MAIL</h3>
                        <div class="form-row">
                                <label for="email">E-MAIL*</label>
                                <input type="text" id="email" class="email" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>><br>
                                <div class="break email"><span>Indirizzo email non valido</span></div>
                        </div>
                        <div class="form-row">
                                <label for="confirm_email">CONFERMA E-MAIL*</label>
                                <input type="text" id="confirm_email" class="confirm_email" name="confirm_email" <?php if(isset($_POST["confirm_email"])){echo "value=".$_POST["confirm_email"];} ?>>
                                <div class="break confirm_email"><span>Le email non coincidono</span></div>                                 
                        </div>
                        <div class="form-row">
                                <label for="password">PASSWORD*</label>
                                <input type="password" id="password" class="password" name="password" placeholder="PASSWORD" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                                <div class="break password"><span>Inserisci almeno 8 caratteri</span></div>
                        </div>
                        <div class="form-row">
                                <label for="confirm_password">CONFERMA PASSAWORD*</label>
                                <input type="password" id="confirm_password" class="confirm_password" name="confirm_password" <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>>
                                <div class="break confirm_password"><span>Le password non coincidono</span></div>
                        </div>
                        <div class="allow">
                            <input type="checkbox" id="allow1" name="allow[]" value="1">
                            <label for="allow1">ACCONSENTO AL TRATTAMENTO DEI MIEI DATI PER FINALITÀ DI ANALISI DELLE MIE PREFERENZE, ABITUDINI E SCELTE DI CONSUMO DA PARTE DI HERNO E THE LEVEL GROUP</label>
                        </div>  
                        <div class="allow">
                            <input type="checkbox" id="allow2" name="allow[]" value="2">
                            <label for="allow2">ACCONSENTO AL TRATTAMENTO DEI MIEI DATI PERSONALI PER FINALITÀ DI MARKETING (NEWSLETTER, COMUNICAZIONI TRAMITE TELEFONO, SMS E SMART MESSAGE) DA PARTE DI HERNO</label>
                        </div>  
                        <div class="allow">
                            <input type="checkbox" id="allow3" name="allow[]" value="3">
                            <label for="allow3">ACCONSENTO ALLA COMUNICAZIONE DEI MIEI DATI ALLE ALTRE SOCIETÀ DEL GRUPPO HERNO PER LORO FINALITÀ DI MARKETING</label>
                        </div> 
                        <?php 
                            if(isset($error)) {
                                foreach($error as $err) {
                                    echo "<div class='errorj'><span>$err</span></div>";
                                }
                            } 
                        ?>
                        <div class="submit">
                            <input type="submit" value="APPLICA">
                        </div>
                </form>
                
                <div class="signup">Hai un account? <a href="index.php#account">Accedi</a></div>
            </section>
        </main>
        
    </body>
</html>