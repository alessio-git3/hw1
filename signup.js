function checkNazionalita(event){
    const select = event.currentTarget;

    if (formStatus[select.name] = select.value.length > 0) {
        select.parentNode.classList.remove('errorj');
    } else {
        select.parentNode.classList.add('errorj');
    }
}

function checkTitolo(event){
    const select = event.currentTarget;

    if (formStatus[select.name] = select.value.length > 0) {
        select.parentNode.classList.remove('errorj');
    } else {
        select.parentNode.classList.add('errorj');
    }
}

function checkName(event) {
    const input = event.currentTarget;
    
    console.log("Ciao1");
    if (formStatus[input.name] = input.value.length > 0) {        
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function checkSurname(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function checkDate(event){
    const select = event.currentTarget;

    console.log("Ciao1");
    formStatus[select.name] = select.value;
    console.log("Ciao2");
    if (formStatus[select.name] = select.value.length > 0) {
        console.log("Ciao3");
        select.parentNode.classList.remove('errorj');
    } else {
        console.log("Ciao4");
        select.parentNode.classList.add('errorj');
    }
}

function checkTelefono(event){
    const input = event.currentTarget;

    const formRow = input.closest('.form-row'); //per selezionare il "padre ultimo/definitivo"

    if(formStatus[input.name] = input.value.length > 0){
        formRow.classList.remove("errorj");
    }
    else{
        formRow.classList.add("errorj");
    }
}

function jsonCheckEmail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.email = !json.exists) {
        document.querySelector('div.email').classList.remove('errorj');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('div.email').classList.add('errorj');
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkEmail(event) {
    const emailInput = document.querySelector('input.email');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "Indirizzo email non valido";
        document.querySelector('div.email').classList.add('errorj');
        formStatus.email = false;

    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkConfirmEmail(event) {
    const confirmEmailInput = document.querySelector('input.confirm_email');
    if (formStatus.confirmEmail = confirmEmailInput.value === document.querySelector('input.email').value) {
        document.querySelector('.confirm_email span').classList.remove('errorj');
    } else {
        document.querySelector('div.confirm_email').classList.add('errorj');
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('input.password');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('.password span').classList.remove('errorj');
    } else {
        document.querySelector('div.password').classList.add('errorj');
    }
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('input.confirm_password');
    if (formStatus.confirmPassword = confirmPasswordInput.value === document.querySelector('input.password').value) {
        document.querySelector('.confirm_password span').classList.remove('errorj');
    } else {
        document.querySelector('div.confirm_password').classList.add('errorj');
    }
}

function checkSignup(event) {
    const checkbox = document.querySelector('.allow input');
    formStatus[checkbox.name] = checkbox.checked;
    if (Object.keys(formStatus).length !== 11 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
    }
}

const formStatus = {'upload': true};
document.querySelector('#nazionalita').addEventListener('blur', checkNazionalita);
document.querySelector('#titolo').addEventListener('blur', checkTitolo);
document.querySelector('input.name').addEventListener('blur', checkName);
document.querySelector('input.surname').addEventListener('blur', checkSurname);
document.querySelector('#giorno').addEventListener('blur', checkDate);
document.querySelector('#mese').addEventListener('blur', checkDate);
document.querySelector('#anno').addEventListener('blur', checkDate);
document.querySelector('#prefisso').addEventListener('blur', checkTelefono);
document.querySelector('input.telefono').addEventListener('blur', checkTelefono);
document.querySelector('input.email').addEventListener('blur', checkEmail);
document.querySelector('input.confirm_email').addEventListener('blur', checkConfirmEmail);
document.querySelector('input.password').addEventListener('blur', checkPassword);
document.querySelector('input.confirm_password').addEventListener('blur', checkConfirmPassword);
const checks = document.querySelector('form');
for(let i = 0; i < checks[i].length; i++){
    checks[i].addEventListener('submit', checkSignup);
}
