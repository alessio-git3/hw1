<?php
    require_once "auth.php";
    
    session_start();

    if (!$userid = checkAuth()) {
        header("Location: index.php");
        exit;
    }


    paypal();

    function paypal(){
        if(isset($_POST["price"]) && isset($_POST["nome_capo"])){
            $client_id = '';
            $client_secret = '';
            $name = $_POST["nome_capo"];
            $price = (float)$_POST["price"];
            $currency = "EUR";

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
                echo json_encode(["error" => "Errore nella richiesta del token."]);
            }

            //creazione pagamento
            $headers = array("Content-type: application/json", 
                            "Authorization: Bearer ".$token
            );
            $body = array(
                "intent" => "sale",
                "payer" => array(
                    "payment_method" => "paypal"
                ),
                "transactions" => array(array(
                    "amount" => array(
                        "total" => $price,
                        "currency" => $currency
                    ),
                    "description" => "Simulazione pagamento",
                    "item_list" => array(
                        "items" => array(
                            array(
                                "name" => $name,
                                "price" => $price,
                                "currency" => $currency,
                                "quantity" => "1"
                            )
                        )
                    )
                )),
                "redirect_urls" => array(
                    "return_url" => "http://localhost/sito/pagamento.php",
                    "cancel_url" => "http://localhost/sito/home.php"
                )
            );
            

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/payments/payment");
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            $response_createPayment = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($http_code !== 201){
                echo json_encode(["error" => "Errore nella creazione del pagamento."]);
                exit;
            }
            $payment_data = json_decode($response_createPayment, true);

            foreach ($payment_data['links'] as $link) {
                if ($link['rel'] === 'approval_url') {
                    $approval_url = $link['href'];
                    break;
                }
            }
            if (isset($approval_url)) {
                //header('Content-Type: application/json'); // Fondamentale per far capire al JS che è JSON
                echo json_encode(["approval_url" => $approval_url]);
                exit;
            }
            else {
                //header('Content-Type: application/json');
                echo json_encode(["error" => "URL di approvazione PayPal non trovato."]);
                exit;
            }

        }

    }
?>
