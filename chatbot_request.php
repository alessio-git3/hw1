<?php
    require_once "auth.php";
    require_once "Parsedown.php";
    
    session_start();

    if (!$userid = checkAuth()) {
        header("Location: index.php");
        exit;
    }


    if(!empty($_POST["request"])){
        //richieste alla API REST di Gemini
        $api_key = "AIzaSyBb54Tkec-shhpkz_k8ffw-Zm2L5Jv0ZzQ";

        $user_input = $_POST["request"];
        $headers = array("Content-Type: application/json");
        $body_data = array(
            "contents" => array(
                array(
                    "role" => "user",
                    "parts" => array(
                        array(
                            "text" => $user_input
                        )
                    )
                )
            )
        );
        $json_data = json_encode($body_data);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=".$api_key);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $json_response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($json_response); //json_decode restituisce un oggetto
        
        //controllo risposta chatbot
        if (isset($response->candidates[0]->content->parts[0]->text)) { //...->text per accedere alla risposta restituita dal chatbot
            $markdown = $response->candidates[0]->content->parts[0]->text;
        } 
        else {
            $markdown = "Errore: risposta non valida dal server.";
        }
        
        //conversione in "formato chatbot"
        $Parsedown = new Parsedown();
        $html = $Parsedown->text($markdown);

        echo $html;
    }
    else{
        echo "Errore: messaggio inviato al chatbot non valido.";
    }
?>