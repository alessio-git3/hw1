<?php
    require_once 'auth.php'; //per importare la libreria auth che contiene checkAuth()
    if (!$userid = checkAuth()) {
        header("Location: index.php");
        exit;
    }
?>

<html>
    <?php   
        $conn = mysqli_connect("127.0.0.1", "root", "", "hw1");
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);
    ?>

    <head>
        <meta charset="utf-8">
        <title>Boutique Ufficiale Herno®: Abbigliamento per Uomo, Donna e Bambino</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sofia+Sans:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="mhw2.js" defer></script>
        <script src="pagamento.js" defer></script>
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


            <div data-dropup="account" class="hidden"> <!--da fare in PHP-->
                <div class="container-1">
                    <div class="intestazione">
                        <h3>BENVENUTO <?php echo strtoupper($_SESSION["_agora_name"])?></h3>
                        <a href="logout.php">ESCI</a>
                    </div>
                    
                    <div class="container-2">
                        <div class="macro-blocco">
                            <div class="micro-blocco">
                                <h5>SELEZIONATI PER TE</h5>
                                <p>Una selezione speciale solo per te</p>
                            </div>
                            <div class="micro-blocco">
                                <h5>INDIRIZZI</h5>
                                <p>Gestisci i tuoi indirizzi di fatturazione e spedizione</p>
                            </div>
                            <div class="micro-blocco">
                                <h5>WISH LIST</h5>
                                <p>Vedi e modifica gli articoli nella tua Wish list</p>
                            </div>
                        </div>
                        <div class="macro-blocco">
                            <div class="micro-blocco">
                                <h5>DATI PERSONALI</h5>
                                <p>Vedi o aggiorna le tue informazioni personali</p>
                            </div>
                            <div class="micro-blocco">
                                <h5>INFORMAZIONI DI PAGAMENTO</h5>
                                <p>Gestisci le tue carte di credito</p>
                            </div>
                            <div class="micro-blocco">
                                <h5></h5>
                                <p></p>
                            </div>
                        </div>
                        <div class="macro-blocco">
                            <div class="micro-blocco">
                                <h5>NEWSLETTER</h5>
                                <p>Gestisci le iscrizioni alle newsletter</p>
                            </div>
                            <div class="micro-blocco">
                                <h5>ORDINI</h5>
                                <p>Gestisci lo stato dei tuoi ordini, o vedi gli ordini precedenti</p>
                            </div>
                            <div class="micro-blocco">
                                <h5></h5>
                                <p></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <img class="close" src="immagini/icons8-close-50.png">
                    </div>
                </div>
            </div>

            <div data-dropup="preferiti" class="hidden"> <!--da fare in PHP-->
                <div class="container-1">
                    <div class="intestazione">
                        <h3>WISHILIST DI <?php echo strtoupper($_SESSION["_agora_name"])?></h3>
                    </div>
                </div>

                <div class="container-2">
                    
                </div>
                
                <div>
                    <img class="close" src="immagini/icons8-close-50.png">
                </div>
            </div>


            <div data-dropup="shoppingBag" class="hidden">
                <p>NON CI SONO ARTICOLI NELLA TUA SHOPPING BAG</p> <!--da fare in PHP-->
                <div>
                    <img class="close" src="immagini/icons8-close-50.png">
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
                <form class="pagamento">
                    <input type="submit" value="€525">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Giacca in nylon ultralight">
                    <input type="hidden" class="price" name="price" value="525">
                </form>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product11">
                <img data-product-id="p1" data-img-id="1" src="immagini/bluPI001210U12017Z_9026_0.webp">
                <p class="categoria">Bomber</p>
                <a class="nome-capo">BOMBER IN NYLON ULTRALIGHT</a>
                <form class="pagamento">
                    <input type="submit" value="€655">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Bomber in nylon ultralight">
                    <input type="hidden" class="price" name="price" value="655">
                </form>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p1" data-img-id="2" src="immagini/gialloPI001880D12017ZM01_3130_0.webp">
                <p class="categoria">Parka E Giacche</p>
                <a class="nome-capo">GIACCA IN NYLON ULTRALIGHT E NEW TECHNO TAFFETÀ</a>
                <form class="pagamento">
                    <input type="submit" value="€555">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Giacca in nylon ultralight e new techno taffetà">
                    <input type="hidden" class="price" name="price" value="555">
                </form>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p1" data-img-id="3" src="immagini/pantGrigPT000076U12503Z_1250_0.webp">
                <p class="categoria">Pantaloni</p>
                <a class="nome-capo">PANTALONI IN NYLON DIVE</a>
                <form class="pagamento">
                    <input type="submit" value="€255">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Pantaloni in nylon dive">
                    <input type="hidden" class="price" name="price" value="255">
                </form>
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
                <form class="pagamento">
                    <input type="submit" value="€350">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Tuta in viscose effect e new techno taffetà">
                    <input type="hidden" class="price" name="price" value="350">
                </form>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product11">
                <img data-product-id="p2" data-img-id="1" src="immagini/2CA000581D12721_9300_0.webp">
                <p class="categoria">Cappotti E Trench</p>
                <a class="nome-capo">CAPPOTTO IN ALTERNATIVE NAPPA</a>
                <form class="pagamento">
                    <input type="submit" value="€1.585">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Cappotto in alternative nappa">
                    <input type="hidden" class="price" name="price" value="1585">
                </form>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p2" data-img-id="2" src="immagini/3PI001667D12017Z_9300_0.webp">
                <p class="categoria">Parka E Giacche</p>
                <a class="nome-capo">BOMBER IN NYLON ULTRALIGHT</a>
                <form class="pagamento">
                    <input type="submit" value="€695">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Bomber in nylon ultralight">
                    <input type="hidden" class="price" name="price" value="695">
                </form>
                <p class="vestibilita">REGULAR FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p2" data-img-id="3" src="immagini/4PT000118D52102_9300_0.webp">
                <p class="categoria">Pantaloni</p>
                <a class="nome-capo">PANTALONI IN WRINKLED EFFECT</a>
                <form class="pagamento">
                    <input type="submit" value="€295">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Pantaloni in wrinkled effect">
                    <input type="hidden" class="price" name="price" value="295">
                </form>
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
                <form class="pagamento">
                    <input type="submit" value="€695">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Parka laminar in 3L translucent ripstop">
                    <input type="hidden" class="price" name="price" value="695">
                </form>
                <p class="vestibilita2">RELAXED FIT</p>
            </div>
            <div class="product11">
                <img data-product-id="p3" data-img-id="1" src="immagini/22GI00169UL12830_1115_0.webp">
                <p class="categoria2">Laminar</p>
                <a class="nome-capo2">SHACKET LAMINAR IN ORGANIC-TECH FEEL</a>
                <form class="pagamento">
                    <input type="submit" value="€665">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Shacket laminar in organic-tech feel">
                    <input type="hidden" class="price" name="price" value="665">
                </form>
                <p class="vestibilita2">RELAXED FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p3" data-img-id="2" src="immagini/33GI00117DL13242S_9438_0.webp">
                <p class="categoria2">Laminar</p>
                <a class="nome-capo2">SHACKET LAMINAR IN DIAGONAL-TECH COTTON ED EXTRALIGHT STRETCH</a>
                <form class="pagamento">
                    <input type="submit" value="€655">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Shacket laminar in diagonal-tech cotton ed extralight stretch">
                    <input type="hidden" class="price" name="price" value="830">
                </form>
                <p class="vestibilita2">RELAXED FIT</p>
            </div>
            <div class="product22">
                <img data-product-id="p3" data-img-id="3" src="immagini/44PI00371UL11128_9300_0.webp">
                <p class="categoria2">Laminar</p>
                <a class="nome-capo2">GIACCA LAMINAR IN 2L GORETEX</a>
                <form class="pagamento">
                    <input type="submit" value="€1.020">
                    <input type="hidden" class="nome_capo" name="nome_capo" value="Giacca laminar in 2L goretex">
                    <input type="hidden" class="price" name="price" value="1020">
                </form>
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
