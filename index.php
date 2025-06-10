<?php
    include "auth.php";
    session_start();
    
    if(checkAuth()){
        header("Location: home.php");
        exit;
    }

    if(!empty($_POST["email"]) && !empty($_POST["password"])){
        $conn = mysqli_connect("127.0.0.1", "root", "", "hw1");

        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $query = "SELECT * FROM users WHERE email = '".$email."'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(mysqli_num_rows($res) > 0){
            $entry = mysqli_fetch_assoc($res);
            if(password_verify($_POST["password"], $entry["password"])){
                $_SESSION["_agora_name"] = $entry["name"];
                $_SESSION["_agora_user_id"] = $entry["id"];

                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "E-mail o password errati";
    }
    else if (isset($_POST["email"]) || isset($_POST["password"])) {
        // Se solo uno dei due è impostato
        $error = "Inserisci e-mail e password";
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Boutique Ufficiale Herno®: Abbigliamento per Uomo, Donna e Bambino</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sofia+Sans:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="mhw2.js" defer></script>
        <!--<script src="mhw3.js" defer></script>-->
    </head>

    <body>
        <div id="accessibilità-menu">
            <img src="immagini/manFix_body_wh.svg">
        </div>

        <div id="button-chatbot">
            <a href="chatbot.php"> <img src="immagini/icons8-chatbot-32.png"> </a>
        </div>

        <header>
            <div data-dropup="linguaPaese" class="hidden">
                <div> 
                    <div class="sel_paese"> 
                        <p><strong>SELEZIONA IL PAESE</strong></p> <!--php ???-->
                        <br/>                                        
                        <div>
                            <p>USA</p>
                            <p>GERMANIA</p>
                            <p>AUSTRIA</p>
                            <p>BELGIO</p>
                            <p>PAESI BASSI</p>
                            <p>FRANCIA</p>
                            <p>AUSTRALIA</p>
                            <p>CINA</p>
                            <p>DANIMARCA</p>
                        </div>
                        <div>
                            <p>ITALIA</p>
                            <p>REGNO UNITO</p>
                            <p>SPAGNA</p>
                            <p>LUSSEMBURGO</p>
                            <p>SVIZZERA</p>
                            <p>GIAPPONE</p>
                            <br/><br/><br/><br/>
                            <a>PIU' PAESI</a>
                        </div>
                    </div>
                    <!--<div class="light-line"></div>-->
                    <div class="sel_lingua"> 
                        <p><strong>SELEZIONA LA LINGUA</strong></p> <!--php ???-->
                        <br/>
                        <div>
                            <p>ENGLISH (EN)</p>
                            <p>DEUTSCH (DE)</p>
                            <p>FRANÇAIS (FR)</p>
                            <p>ESPAÑOL (ES)</p>
                            <p>日本語 (JA)</p>
                            <p>ITALIANO (IT)</p>
                            <p>한국어 (KO)</p>
                            <br/><br/><br/>
                        </div>
                    </div>
                </div>
                <div>
                    <img class="close" src="immagini/icons8-close-50.png">
                </div>
            </div>
            <div data-dropup="ricerca" class="hidden"> <!--SERVE CHIAMATA AD UNA REST API DI RICERCA-->
                <div class="ricerca">
                    <div class="search">
                        <input type="text" name="search-bar">
                    </div>

                    <div class="radio-buttons">
                        <input type="radio" name="genere" value="M" id="genere">UOMO
                        <input type="radio" name="genere" value="F">DONNA
                        <input type="radio" name="genere" value="B">BAMBINO
                    </div>

                    <div class="submit">
                        <input type="submit" value="VISUALIZZA RISULTATI">
                    </div>

                    <div>
                        <img class="close" src="immagini/icons8-close-50.png">
                    </div>
                </div>
            </div>


            <div id="account" data-dropup="account" class="hidden">
                <div class="container-AP"> <!--Account e Preferiti (AP)-->
                    <div class="macro-blocco">
                        <div class="micro-blocco">
                            <h3>CREA UN ACCOUNT ORA</h3>
                            <p>Entra a far parte del mondo Herno S.p.A. e crea il tuo profilo. Potrai salvare i tuoi dati e averli sempre disponibili, conoscere le novità in anteprima e assicurarti un’esperienza di shopping esclusiva.</p>
                        </div>
                        <div class="micro-blocco">
                            <a href="signup.php" class="submit">REGISTRATI SUBITO</a>
                        </div>
                    </div>
                

                    <div class="macro-blocco">
                        <div class="micro-blocco">
                            <h3>ACCEDI</h3>
                            <p>Se sei un utente registrato, per favore inserisci la tua email e la tua password</p>
                        </div>
                        <div class="micro-blocco">
                            
                            <?php
                                if (isset($error)) {
                                    echo "<p class='error'>$error</p>";
                                }
                            ?>
                            <form name='login' method='post'>
                                <div class="container-input">
                                    <span class="email">
                                        <input type="email" name="email" placeholder="EMAIL" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                                    </span>
                                    <span class="password">
                                        <input type="password" name="password" placeholder="PASSWORD" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                                    </span>
                                </div>
                                <div class="submit">
                                    <input type="submit" value="ACCEDI">
                                </div>
                            </form>

                            <a href="#" class="forgot-password">Ho dimenticato la password</a>
                        </div>
                    </div>
                </div>
                
                <div>
                    <img class="close" src="icons8-close-50.png">
                </div>
            </div>
            <div data-dropup="preferiti" class="hidden">
                <div class="container-AP"> <!--Account e Preferiti (AP)-->
                    <div class="macro-blocco">
                        <div class="micro-blocco">
                            <h3>CREA UN ACCOUNT ORA</h3>
                            <p>Entra a far parte del mondo Herno S.p.A. e crea il tuo profilo. Potrai salvare i tuoi dati e averli sempre disponibili, conoscere le novità in anteprima e assicurarti un’esperienza di shopping esclusiva.</p>
                        </div>
                        <div class="micro-blocco">
                            <a href="signup.php" class="submit">REGISTRATI SUBITO</a>
                        </div>
                    </div>
                

                    <div class="macro-blocco">
                        <div class="micro-blocco">
                            <h3>ACCEDI</h3>
                            <p>Se sei un utente registrato, per favore inserisci la tua email e la tua password</p>
                        </div>
                        <div class="micro-blocco">
                            
                            <?php
                                if (isset($error)) {
                                    echo "<p class='error'>$error</p>";
                                }
                            ?>
                            <form name='login' method='post'>
                                <div class="container-input">
                                    <span class="email">
                                        <input type="email" name="email" placeholder="EMAIL" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                                    </span>
                                    <span class="password">
                                        <input type="password" name="password" placeholder="PASSWORD" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                                    </span>
                                </div>
                                <div class="submit">
                                    <input type="submit" value="ACCEDI">
                                </div>
                            </form>
                            
                            <a href="#" class="forgot-password">Ho dimenticato la password</a>
                        </div>
                    </div>
                </div>
                
                <div>
                    <img class="close" src="icons8-close-50.png">
                </div>
            </div>
            <div data-dropup="shoppingBag" class="hidden">
                <p>NON CI SONO ARTICOLI NELLA TUA SHOPPING BAG</p>
                <div>
                    <img class="close" src="icons8-close-50.png">
                </div>
            </div>

            <div class="light-line"></div>
            <div class="banner-nero">
                <div id="banner-item-block"></div>
                <a id="link-banner-nero">SCOPRI LA COLLEZIONE</a>
            </div>

            <nav>
                <div id="menu">
                    <div></div>
                    <div></div>
                </div>

                <div id="logo"></div>
                <div id="links">
                    <a data-index="0">#BARÇAXHERNO</a>
                    <a data-index="1">NEW IN</a>
                    <a data-index="2">DONNA</a>
                    <a data-index="3">UOMO</a>
                    <a data-index="4">BAMBINO</a>
                    <a data-index="5">PROMOZIONI</a>
                    <a data-index="6">BRAND E FILOSOFIA</a>
                    <a data-index="7">NEGOZI</a>
                    <a data-index="8">CONTATTI</a>
                </div>
                <div id="buttons">
                    <span data-button="linguaPaese" id="paese-lingua">
                        <span id="paese">IT</span>
                        <span id="pipe">|</span>
                        <span id="lingua">ITA</span>
                    </span>
                    <div id="icon-container">
                        <span data-button="ricerca" class="material-icons">search</span>
                        <span data-button="account" class="material-icons">person</span>
                        <span data-button="preferiti" class="material-icons">favorite_border</span>
                        <span data-button="shoppingBag" class="material-icons">shopping_bag</span>
                    </div>                   
                </div>
            </nav>
            <div class="light-line"></div>

            <div data-id="1" class="hidden">
                <div>
                    <a class="primo_tend"><strong>NUOVI ARRIVI DONNA</strong></a>
                    <a>Midnight Glam</a>
                    <a>Aqua Heritage</a>
                    <a>Refined Allure</a>
                    <a>New Winter</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>NUOVI ARRIVI UOMO</strong></a>
                    <a>Aqua Heritage</a>
                    <a>Refined Allure</a>
                    <a>New Winter</a>
                </div>
                <div>
                    <img src="immagini/flyout_new_in_donna.jpg">
                </div>
                <div>
                   <img src="immagini/flyout_new_in_uomo.jpg"> 
                </div>
            </div>
            <div data-id="2" class="hidden">
                <div>
                    <a class="primo_tend"><strong>MUST HAVE</strong></a>
                    <a>Vedi tutto</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>CAPOSPALLA</strong></a>
                    <a>Vedi tutto</a>
                    <a>Cappe</a>
                    <a>A-Shape</a>
                    <a>Cappotti e Trench</a>
                    <a>Gilet e Smanicati</a>
                    <a>Parka e Giacche</a>
                    <a>Bomber</a>
                    <a>Blazer</a>
                    <a>Shackets</a>
                    <a>Impermeabili</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>PIUMINI</strong></a>
                    <a>Vedi tutto</a>
                    <a>Piumini Corti</a>
                    <a>Piumini Lunghi</a>
                    <a>Piumini Ultralight</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>ABBIGLIAMENTO</strong></a>
                    <a>Vedi tutto</a>
                    <a>Maglieria</a>
                    <a>Felpe e Bomber</a>
                    <a>Maglioni e Cardigan</a>
                    <a>Camicie</a>
                    <a>T-shirt e Top</a>
                    <a>Gonne e Abiti</a>
                    <a>Pantaloni</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>ACCESSORI</strong></a>
                    <a>Vedi tutto</a>
                    <a>Cappelli</a>
                    <a>Scarpe</a>
                    <a>Borse</a>
                    <a>Manicotti e Guanti</a>
                    <a>Sciarpe</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>ACQUISTA PER COLLEZIONE</strong></a>
                    <a>Vedi tutto</a>
                    <a>New Winter</a>
                    <a>Resort</a>
                    <a>Main</a>
                    <a>Iconico</a>
                </div>
            </div>
            <div data-id="3" class="hidden">
                <div>
                    <a class="primo_tend"><strong>MUST HAVE</strong></a>
                    <a>Vedi tutto</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>CAPOSPALLA</strong></a>
                    <a>Vedi tutto</a>
                    <a>Blazer</a>
                    <a>Cappotti e Trench</a>
                    <a>Parka e Giacche</a>
                    <a>Bomber</a>
                    <a>Gilet e Smanicati</a>
                    <a>Impermeabili</a>
                    <a>Shackets</a>
                    <a>Field Jacket</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>PIUMINI</strong></a>
                    <a>Vedi tutto</a>
                    <a>Piumini Corti</a>
                    <a>Piumini Lunghi</a>
                    <a>Piumini Ultralight</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>ABBIGLIAMENTO</strong></a>
                    <a>Vedi tutto</a>
                    <a>Maglieria</a>
                    <a>Felpe e Bomber</a>
                    <a>Maglioni e Cardigan</a>
                    <a>Camicie</a>
                    <a>T-shirt e Polo</a>
                    <a>Pantaloni</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>ACCESSORI</strong></a>
                    <a>Vedi tutto</a>
                    <a>Cappelli</a>
                    <a>Scarpe</a>
                    <a>Sciarpe</a>
                </div>
                <div>
                    <a class="primo_tend"><strong>ACQUISTA PER COLLEZIONE</strong></a>
                    <a>Vedi tutto</a>
                    <a>New Winter</a>
                    <a>Resort</a>
                    <a>Main</a>
                    <a>Legend</a>
                </div>
            </div>
            <div data-id="4" class="hidden">
                <div>
                    <a class="primo_tend"><strong>BAMBINO</strong></a>
                    <a>Vedi tutto</a>
                </div>
                <div>
                    <img src="immagini/flyout_bambino.webp">
                </div>
                <div>
                    <a class="primo_tend"><strong>BAMBINA</strong></a>
                    <a>Vedi tutto</a>
                </div>
                <div>
                    <img src="immagini/flyout_bambina.webp">
                </div>
                <div>
                    <a class="primo_tend"><strong>ACCESSORI</strong></a>
                    <a>Vedi tutto</a>
                </div>
            </div>
            <div data-id="5" class="hidden">
                <div>
                    <a class="primo_tend"><strong>PROMOZIONI DONNA</strong></a>
                    <a>Vedi tutto</a>
                    <a>Capospalla Donna</a>
                    <a>Maglieria Donna</a>
                    <a>Accessori Donna</a>
                </div>
                <div>
                    <img src="immagini/woman-sale-flyout.jpg">
                </div>
                <div>
                    <a class="primo_tend"><strong>PROMOZIONI UOMO</strong></a>
                    <a>Vedi tutto</a>
                    <a>Capospalla Uomo</a>
                    <a>Maglieria Uomo</a>
                    <a>Accessori Uomo</a>
                </div>
                <div>
                    <img src="immagini/man-sale-flyout.webp">
                </div>
                <div>
                    <a class="primo_tend"><strong>PROMOZIONI KIDS</strong></a>
                    <a>Vedi tutto</a>
                    <a>Capospalla Kids</a>
                    <a>Maglieria Kids</a>
                    <a>Accessori Kids</a>
                </div>
                <div>
                    <img src="immagini/kids-sale-flyout.jpg">
                </div>
            </div>
            <div data-id="6" class="hidden">
                <div><a class="primo_tend"><strong>AMBIENTE</strong></a></div>
                <div><a class="primo_tend"><strong>STORIA</strong></a></div>
                <div><a class="primo_tend"><strong>MAKING-IT</strong></a></div>
                <div><a class="primo_tend"><strong>STAMPA</strong></a></div>
            </div>

            <div id="info-block">
                <span id="info">SPEDIZIONE E RESO GRATUITI</span>
            </div>
            <div class="light-line"></div>
        </header>

        <div id="uty1"></div> <!--altrimenti la prima immagine "sale" e viene coperta dall'header-->

        <section class="sezione-presInfo">
            <div id="main-banner">
                <!--<div class="container-banner-img">
                    <img src="immagini/Woman_banner_desktop.webp">
                </div>-->
                <div class="frecce-sxdx">
                    <img data-freccebanner="frecce1" class="prev" src="immagini/icons8-chevron-left-30.png">
                    <img data-freccebanner="frecce1" class="next" src="immagini/icons8-chevron-right-30.png">
                </div>
                <div class="descr-container">
                    <p>COLLEZIONE PRIMAVERA ESTATE 2025</p>
                    <a class="button">Scopri donna</a>
                </div>
            </div>
        </section>

    <article class="products">
        <a href="#" class="frecce-article1"><img src="immagini/arrow_back_ios_16dp_1F1F1F_FILL0_wght400_GRAD0_opsz20.svg"></a>
        <div class="products-container">
            <div class="product11">
                <img data-product-id="p1" data-img-id="0" src="immagini/PI002006D12017Z_9014_0.webp">
                <p class="categoria">Parka E Giacche</p>
                <a class="nome-capo">GIACCA IN NYLON ULTRALIGHT</a>
                <form>
                    <input type="submit" value="€525" class="price">
                </form>
                <!--<a href="mhw3_confermaAcquisto.html" class="price">€525</a>-->
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product11">
                <img data-product-id="p1" data-img-id="1" src="immagini/bluPI001210U12017Z_9026_0.webp">
                <p class="categoria">Bomber</p>
                <a class="nome-capo">BOMBER IN NYLON ULTRALIGHT</a>
                <a href="mhw3_confermaAcquisto.html" class="price">€655</a>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p1" data-img-id="2" src="immagini/gialloPI001880D12017ZM01_3130_0.webp">
                <p class="categoria">Parka E Giacche</p>
                <a class="nome-capo">GIACCA IN NYLON ULTRALIGHT E NEW TECHNO TAFFETÀ</a>
                <a href="mhw3_confermaAcquisto.html" class="price">€555</a>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p1" data-img-id="3" src="immagini/pantGrigPT000076U12503Z_1250_0.webp">
                <p class="categoria">Pantaloni</p>
                <a class="nome-capo">PANTALONI IN NYLON DIVE</a>
                <a href="mhw3_confermaAcquisto.html" class="price">€255</a>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
        </div>
        <a href="#" class="frecce-article1"><img src="immagini/arrow_forward_ios_16dp_1F1F1F_FILL0_wght400_GRAD0_opsz20.svg"></a>
    </article>

    <section class="sezione-presInfo">
        <div id="main-banner2">
            <div class="frecce-sxdx">
                <img data-freccebanner="frecce2" class="prev" src="immagini/icons8-chevron-left-30.png">
                <img data-freccebanner="frecce2" class="next" src="immagini/icons8-chevron-right-30.png">
            </div>
            <div class="descr-container">
                <p>MIDNIGHT GLAM</p>
                <a class="button">Scopri di più</a>
            </div>
        </div>
    </section>

    <article class="products">
        <a href="#" class="frecce-article1"><img src="immagini/arrow_back_ios_16dp_1F1F1F_FILL0_wght400_GRAD0_opsz20.svg"></a>
        <div class="products-container">
            <div class="product11">
                <img data-product-id="p2" data-img-id="0" src="immagini/1TT000007D12607_9300_0.webp">
                <p class="categoria">Gonna E Abiti</p>
                <a class="nome-capo">TUTA IN VISCOSE EFFECT E NEW TECHNO TAFFETÀ</a>
                <p class="price">€350</p>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product11">
                <img data-product-id="p2" data-img-id="1" src="immagini/2CA000581D12721_9300_0.webp">
                <p class="categoria">Cappotti E Trench</p>
                <a class="nome-capo">CAPPOTTO IN ALTERNATIVE NAPPA</a>
                <p class="price">€1.585</p>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p2" data-img-id="2" src="immagini/3PI001667D12017Z_9300_0.webp">
                <p class="categoria">Parka E Giacche</p>
                <a class="nome-capo">BOMBER IN NYLON ULTRALIGHT</a>
                <p class="price">€695</p>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p2" data-img-id="3" src="immagini/4PT000118D52102_9300_0.webp">
                <p class="categoria">Pantaloni</p>
                <a class="nome-capo">PANTALONI IN WRINKLED EFFECT</a>
                <p class="price">€295</p>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
        </div>
        <a href="#" class="frecce-article1"><img src="immagini/arrow_forward_ios_16dp_1F1F1F_FILL0_wght400_GRAD0_opsz20.svg"></a>
    </article>

    <section class="sezione-presInfo">
        <div id="main-banner3">
            <div class="descr-container">
                <p>LAMINAR</p>
                <a class="button">Scopri di più</a>
            </div>
        </div>
    </section>

    <article class="products2">
        <a href="#" class="frecce-article2"><img src="immagini/icons8-back-64.png"></a>
        <div class="products-container2">
            <div class="product11">
                <img data-product-id="p3" data-img-id="0" src="immagini/11GI00119DL12831_9300_0.webp">
                <p class="categoria2">Laminar</p>
                <a class="nome-capo2">PARKA LAMINAR IN 3L TRANSLUCENT RIPSTOP</a>
                <p class="price2">€695</p>
                <p class="vestibilita2">RELAXED FIT</p>
            </div>
            <div class="product11">
                <img data-product-id="p3" data-img-id="1" src="immagini/22GI00169UL12830_1115_0.webp">
                <p class="categoria2">Laminar</p>
                <a class="nome-capo2">SHACKET LAMINAR IN ORGANIC-TECH FEEL</a>
                <p class="price2">€665</p>
                <p class="vestibilita2">RELAXED FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p3" data-img-id="2" src="immagini/33GI00117DL13242S_9438_0.webp">
                <p class="categoria2">Laminar</p>
                <a class="nome-capo2">SHACKET LAMINAR IN DIAGONAL-TECH COTTON ED EXTRALIGHT STRETCH</a>
                <p class="price2">€830</p>
                <p class="vestibilita2">RELAXED FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p3" data-img-id="3" src="immagini/44PI00371UL11128_9300_0.webp">
                <p class="categoria2">Laminar</p>
                <a class="nome-capo2">GIACCA LAMINAR IN 2L GORETEX</a>
                <p class="price2">€1.020</p>
                <p class="vestibilita2">RELAXED FIT</p>
            </div>
        </div>
        <a href="#" class="frecce-article2"><img src="immagini/icons8-forward-64.png"></a>
    </article>

    <section class="sezione-presInfo">
        <div id="main-banner4">
            <div class="frecce-sxdx-MB4">
                <img data-freccebanner="frecce4" class="prev" src="immagini/icons8-chevron-left-30.png">
                <img data-freccebanner="frecce4" class="next" src="immagini/icons8-chevron-right-30.png">
            </div>
            <div class="descr-container">
                <p>DIALOGO SULL'ARTE CONTEMPORANEA CON CLAUDIO MARENZI, PRESIDENTE DI HERNO</p>
                <a class="button">Scopri di più</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="light-line"></div>
        <div id="footer-block1">
            <div id="fb1-parte1">
                <span>
                    <p>PAESE: </p>
                    <p class="sub"> ITALIA <a>(CAMBIA)</a> </p>
                </span>
                <span>
                    <p> LINGUA: </p>
                    <p class="sub"> ITALIANO <a>(CAMBIA)</a> </p>
                </span>
            </div>
            <div id="fb1-parte2">
                <span>
                    <p>ISCRIVITI ALLA NEWSLETTER: </p>
                </span>
                <span>
                    <input type="email" name="email" placeholder="Il tuo indirizzo e-mail">
                    <!--<span class="input">Il tuo indirizzo e-mail</span> -->
                    <!--<p class="input">Il tuo indirizzo e-mail</p> -->
                </span>
            </div>
        </div>
        <div class="light-line"></div>
        <div id="footer-block2">
            <div class="liste-fb2">
                <div id="tendina-footer">
                    <a class="links-tendina"><strong>|</strong></a>
                    <p>  SERVIZIO CLIENTI</p><br/>
                    <a class="links-tendina"><strong>|</strong></a>
                    <p>  AREA LEGALE</p><br/>
                    <a class="links-tendina"><strong>|</strong></a>
                    <p>  CAPISPALLA</p><br/>
                    <a class="links-tendina"><strong>|</strong></a>
                    <p>  UOMO</p><br/>
                    <a class="links-tendina"><strong>|</strong></a>
                    <p>  DONNA</p><br/>
                    <a class="links-tendina"><strong>|</strong></a>
                    <p>  KIDS</p><br/>
                </div>
                <div class="ref">
                    <p>SERVIZIO CLIENTI</p>
                    <a>Hai bisogno di aiuto?</a> <br/>
                    <a>Segui il tuo ordine</a> <br/>
                    <a>My Account</a> <br/>
                    <a>Spedizioni</a> <br/>
                    <a>Resi e Rimborsi</a> <br/>
                    <a>Newsletter</a> <br/>
                </div>
                <div class="ref">
                    <p>AREA LEGALE</p>
                    <a>Privacy policy</a> <br/>
                    <a>Cookie policy</a> <br/>
                    <a>Termini e condizioni</a> <br/>
                    <a>Dichiarazione di Accessibilità</a> <br/>
                    <a>Corporate</a> <br/>
                    <a>Mappa del sito</a> <br/>
                </div>
                <div class="ref">
                    <p>CAPISPALLA</p>
                    <a>Piumini Eleganti Uomo</a> <br/>
                    <a>Piumini Eleganti Donna</a> <br/>
                    <a>Shackets Uomo</a> <br/>
                    <a>Shackets Donna</a> <br/>
                </div>
                <div class="ref">
                    <p>UOMO</p>
                    <a>Capospalla</a> <br/>
                    <a>Maglieria</a> <br/>
                    <a>Acquista per collezione</a> <br/>
                </div>
                <div class="ref">
                    <p>DONNA</p>
                    <a>Capospalla</a> <br/>
                    <a>Maglieria</a> <br/>
                    <a>Acquista per collezione</a> <br/>
                </div>
                <div class="ref">
                    <p>KIDS</p>
                    <a>Bambino</a> <br/>
                    <a>Bambina</a> <br/>
                </div>
            </div>
            <div id="socials">
                <div class="social">
                    <a>FACEBOOK</a>
                    <a>INSTAGRAM</a>
                    <a>YOUTUBE</a>
                    <!--<a><img src="immagini/icons8-facebook-30.png"></a>
                    <a><img src="immagini/icons8-instagram-30.png"></a>
                    <a><img src="immagini/icons8-youtube-30.png"></a> -->
                </div>
                <!--<div class="social">
                    <span class="material-icons">facebook</span>
                    <span class="material-icons">camera_alt</span>
                    <span class="material-icons">ondemand_video</span>
                </div>-->
            </div>
            <div id="crediti">
                <div class="contentCrediti">
                    <a>SITE</a>
                    <span> - MANAGED BY THE LEVEL S.R.L - COPYRIGHT © HERNO S.P.A. 2020 - ALL RIGHTS RESERVED - </span>
                    <a>PRIVACY POLICY</a>
                </div>
            </div>
        </div>

    </footer>
    </body>
</html>
