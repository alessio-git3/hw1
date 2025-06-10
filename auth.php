<?php
    session_start();

    function checkAuth() {
        //ritorno la sessione se esiste, altrimenti ritorno 0
        if(isset($_SESSION['_agora_user_id'])) {
            return $_SESSION['_agora_user_id'];
        } else
            return 0;
    }
?>