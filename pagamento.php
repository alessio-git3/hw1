<?php
    require_once "auth.php";
    
    session_start();

    if (!$userid = checkAuth()) {
        header("Location: index.php");
        exit;
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Pagamento PayPal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="pagamento.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sofia+Sans:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
    </head>

    <body>
        <div id="logo">
            <img src="immagini/menu-logo.png">
        </div>
        <div class="light-line"></div>
        
        <section>
            <h3>Esecuzione del pagamento del prodotto selezionato con PayPal</h3>
            
            <h4>Dettagli ricevuta pagamento:</h4>
            <div class="box">
                <div id="ricevuta">
                    <?php
                        if(isset($_GET["paymentId"]) && isset($_GET["PayerID"])){
                            $payment_id = $_GET['paymentId'];
                            $payer_id = $_GET['PayerID'];
                            $client_id = '';
                            $client_secret = '';
                            
                            //richiesta token
                            $headers = array("Content-type: application/x-www-form-urlencoded", 
                                            "Authorization: Basic ".base64_encode($client_id.':'.$client_secret)
                            );
                            $body = "grant_type=client_credentials";
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
                            curl_setopt($curl, CURLOPT_POST, 1);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $token_response = curl_exec($curl);
                            curl_close($curl);

                            $token_data = json_decode($token_response, true); //con true non viene ritornato un oggetto, ma $jsono sarà un'array associativo

                            if (isset($token_data['access_token'])) {
                                $token = $token_data['access_token'];
                            } 
                            else {
                                echo "<div> Errore richiesta token. </div>";
                            }

                            //esecuzione pagamento
                            $headers =  array("Content-type: application/json", 
                                                "Authorization: Bearer ".$token
                            );
                            $body = array("payer_id" => $payer_id);

                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/payments/payment/".$payment_id."/execute");
                            curl_setopt($curl, CURLOPT_POST, 1);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $response_executePayment = curl_exec($curl);
                            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                            curl_close($curl);

                            if($http_code === 200){
                                $execute_payment_data = json_decode($response_executePayment, true);

                                //salvo dati pagamento
                                $stato_pagamento = $execute_payment_data["state"];
                                $time_pay = $execute_payment_data["update_time"];
                                $paymentID = $execute_payment_data["id"];
                                $payerID = $execute_payment_data["payer"]["payer_info"]["payer_id"];
                                $first_name = $execute_payment_data["payer"]["payer_info"]["first_name"];
                                $second_name = $execute_payment_data["payer"]["payer_info"]["second_name"];
                                $email_payer = $execute_payment_data["payer"]["payer_info"]["email"];
                                $totale_pagamento = $execute_payment_data["transactions"][0]["amount"]["currency"] . $execute_payment_data["transactions"][0]["amount"]["total"];
                                $items = $execute_payment_data["transactions"][0]["item_list"]["items"][0]["name"];

                                echo "<div> <span><strong>Stato pagamento: </strong> $stato_pagamento</span> </div>";
                                echo "<div> <span><strong>Orario esecuzione pagamento: </strong> $time_pay</span> </div>";
                                echo "<div> <span><strong> Payment-ID: </strong> $paymentID </span> </div>";
                                echo "<div> <span><strong>Payer-ID: </strong> $payerID</span> </div>";
                                echo "<div> <span><strong>Nome: </strong> $first_name</span> </div>";
                                echo "<div> <span><strong>Cognome: </strong> $second_name</span> </div>";
                                echo "<div> <span><strong>Indirizzo di fatturazione: </strong> $email_payer</span> </div>";
                                echo "<div> <span><strong>Totale pagamento: </strong> $totale_pagamento</span> </div>";
                                echo "<div> <span><strong>Oggetto acquistato: </strong> $items</span></div>";

                                //salvo transazione nel database
                                if($stato_pagamento === "approved"){
                                    $conn = mysqli_connect("127.0.0.1", "root", "", "hw1");
                                    
                                    $user_id = mysqli_real_escape_string($conn, $_SESSION["_agora_user_id"]); //o $userid
                                    $stato_pagamento = mysqli_real_escape_string($conn, $stato_pagamento);
                                    $time_pay = mysqli_real_escape_string($conn, $time_pay);
                                    $paymentID = mysqli_real_escape_string($conn, $paymentID);
                                    $payerID = mysqli_real_escape_string($conn, $payerID);
                                    $first_name = mysqli_real_escape_string($conn, $first_name);
                                    $second_name = mysqli_real_escape_string($conn, $second_name);
                                    $email_payer = mysqli_real_escape_string($conn, $email_payer);
                                    $totale_pagamento = mysqli_real_escape_string($conn, $totale_pagamento);

                                    $query = "INSERT INTO pagamenti(user_id, stato_pagamento, timeT, payment_id, payer_id, first_name, second_name, email, totale) VALUES ('$user_id', '$stato_pagamento', '$time_pay', '$payment_id', '$payer_id', '$first_name', '$second_name', '$email_payer', '$totale_pagamento')";

                                    $res = mysqli_query($conn, $query);

                                    if ($res) {
                                        echo "<div> Pagamento registrato nel database. </div>";
                                    } 
                                    else {
                                        echo "<div> Errore nel salvataggio: ".mysqli_error($conn)."</div>";
                                    }
                                    mysqli_close($conn);
                                }

                            }
                        }
                        else{
                            echo "<div> Errore esecuzione pagamento. </div>";
                        }
                    ?>
                </div>
            </div>

        </section>
    </body>

</html>
