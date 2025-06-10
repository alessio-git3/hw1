<?php
    require_once "auth.php";
    require_once "Parsedown.php";
    
    session_start();

    if (!$userid = checkAuth()) {
        header("Location: index.php");
        exit;
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Chatbot - Boutique Ufficiale Herno®</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="chatbot.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sofia+Sans:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
        <script src="chatbot.js" defer></script>
    </head>

    <body>
        <div id="logo">
            <img src="immagini/menu-logo.png">
        </div>
        <div class="light-line"></div>
        
        <section>
            <h1><?php echo $_SESSION["_agora_name"]?>, chiedi al chatbot:</h1> 
            <form name="request_chatbot">
                <div class="container">
                    <input type="text" id="request" placeholder="Inserisci messaggio...">
                    <input type="submit" id="submit">
                </div>
            </form>
        </section>

        <div id="response">
            
        </div>
    </body>
</html>