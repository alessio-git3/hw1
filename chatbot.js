function onHtml(html_string){
    const response = document.getElementById("response");
    response.innerHTML = "";

    //let mess = document.createElement('div');
    //mess.textContent = html;
    //response.appendChild(mess);
    
    // Usa DOMParser per convertire la stringa in document fragment
    const parser = new DOMParser();
    const doc = parser.parseFromString(html_string, 'text/html');
    
    let mess = document.createElement('div');
    while (doc.body.firstChild) { //sposta tutti i nodi figlio di doc.body dentro il div mess
        mess.appendChild(doc.body.firstChild);
    }
    response.appendChild(mess);
}

function onResponse(response){
    return response.text();
}

function sendRequest(event){
    event.preventDefault();

    const request = document.getElementById("request");
    fetch("chatbot_request.php", {
        method: 'post',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'request=' + encodeURIComponent(request.value)
    }
    ).then(onResponse).then(onHtml);
}

const form = document.querySelector("form");
form.addEventListener("submit", sendRequest);