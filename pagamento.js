function onJson(json) {
    if (json.approval_url) {
        window.location.href = json.approval_url; //reindirizzamento utente a PayPal
    }
    else if(json.error){
        alert(json.error);
    } 
    else {
        alert("Risposta inattesa dal server.");
        console.log(json); // Per debug, vedi cosa ha risposto il server
    }
}

function onResponse(response){
    return response.json();
}

function sendRequest(event){
    event.preventDefault();

    console.log("Ciao1");
    const form = event.currentTarget;
    const price = form.querySelector(".price");
    const nome_capo = form.querySelector(".nome_capo");

    fetch("pagamento_request.php", {
        method: 'post',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'price=' + encodeURIComponent(price.value) +
            '&nome_capo=' + encodeURIComponent(nome_capo.value)
    }
    ).then(onResponse).then(onJson);
}


const forms = document.querySelectorAll("form.pagamento");
console.log(forms);
for (let i = 0; i < forms.length; i++) {
    forms[i].addEventListener("submit", sendRequest);
}

/*
document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll(".pagamento");
    for (let i = 0; i < forms.length; i++) {
        forms[i].addEventListener("submit", sendRequest);
    }
});
*/