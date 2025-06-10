const images1 = [
    "immagini/Woman_banner_desktop.webp",
    "immagini/Man_banner_desktop.webp",
    "immagini/box_HP_desktop_BARCA.webp"
];
const contentP1 = ["COLLEZIONE PRIMAVERA ESTATE 2025", "COLLEZIONE PRIMAVERA ESTATE 2025", " "];
const contentA1 = ["Scopri donna", "Scopri uomo", "Scopri di più"];

const images2 = [
    "immagini/box_HP_desktop_midnight.webp",
    "immagini/box_HP_desktop_REFINED_w.webp",
    "immagini/box_HP_desktop_REFINED_m.webp",
    "immagini/box_HP_desktoPP.webp"
];
const contentP2 = ["MIDNIGHT GLAM", "REFINED ALLURE PRIMAVERA ESTATE 2025", "REFINED ALLURE PRIMAVERA ESTATE 2025", "AQUA HERITAGE"];
const contentA2 = ["Scopri di più", "Scopri donna", "Scopri uomo", "Scopri di più"];

const images4 = [
    "immagini/Arte_HP_dsk.jpg",
    "immagini/ambiente-new.jpg",
    "immagini/eccellenza.webp",
    "immagini/storiaPP.webp"
];
const contentP4 = ["DIALOGO SULL'ARTE CONTEMPORANEA CON CLAUDIO MARENZI, PRESIDENTE DI HERNO", "AMBIENTE", "IL PERCORSO DELL'ECCELLENZA", "STORIA"];
const contentA4 = ["Scopri di più", "Scopri di più", "Scopri di più", "Scopri di più"];
let count = 0;
let frecceBanner;


const overImage1 = ["immagini/PI002006D12017Z_9014_1_3.webp", "immagini/PI001210U12017Z_9026_1.webp", "immagini/PI001880D12017ZM01_3130_1.webp", "immagini/PT000076U12503Z_1250_1.jpg"];
const initialImage1 = ["immagini/PI002006D12017Z_9014_0.webp", "immagini/bluPI001210U12017Z_9026_0.webp", "immagini/gialloPI001880D12017ZM01_3130_0.webp", "immagini/pantGrigPT000076U12503Z_1250_0.webp"];

const overImage2 = ["immagini/1p2TT000007D12607_9300_1.webp", "immagini/2p2CA000581D12721_9300_1.webp", "immagini/3p3PI001667D12017Z_9300_1.webp", "immagini/4p4PT000118D52102_9300_1.webp"];
const initialImage2 = ["immagini/1TT000007D12607_9300_0.webp", "immagini/2p2CA000581D12721_9300_1.webp", "immagini/3PI001667D12017Z_9300_0.webp", "immagini/4PT000118D52102_9300_0.webp"];

const overImage3 = ["immagini/11p3GI00119DL12831_9300_1.webp", "immagini/22p3GI00169UL12830_1115_1.webp", "immagini/33p3GI00117DL13242S_9438_1.webp", "immagini/44p3PI00371UL11128_9300_1.webp"];
const initialImage3 = ["immagini/11GI00119DL12831_9300_0.webp", "immagini/22GI00169UL12830_1115_0.webp", "immagini/33GI00117DL13242S_9438_0.webp", "immagini/44PI00371UL11128_9300_0.webp"];


/*DROPDOWN MENU*/
function nascondiDropdown(event){
    const blocks_t = event.currentTarget;
    blocks_t.classList.remove('dropdown');
    blocks_t.classList.add('hidden');
}

function mostraDropdown(data_index){
    const blocks_t = document.querySelectorAll('div[data-id]');

    //ciclo for necessario per togliere il dropdown relativo all'elemento su cui si è passati sopra
    for(let i = 0; i < blocks_t.length; i++){
        blocks_t[i].classList.add('hidden');
        blocks_t[i].classList.remove('dropdown');
    }

    for(let i = 0; i < blocks_t.length; i++){
        let id = parseInt(blocks_t[i].dataset.id);
        if (id === data_index){
            blocks_t[i].classList.remove('hidden');
            blocks_t[i].classList.add('dropdown');
            //isDropdown = true;
        }
    }
}

function getDataIndexLinks(event) { 
    const link = event.currentTarget;
    const data_index = parseInt(link.dataset.index);
    mostraDropdown(data_index);
}


/*DROPUP*/
function mostraDropup(data_button){
    const blocks_dpu = document.querySelectorAll('div[data-dropup]');

    for(let i = 0; i < blocks_dpu.length; i++){
        blocks_dpu[i].classList.add('hidden');
        blocks_dpu[i].classList.remove('dropup');
    }

    for(let i = 0; i < blocks_dpu.length; i++){
        let data = blocks_dpu[i].dataset.dropup;
        if (data === data_button){
            blocks_dpu[i].classList.remove('hidden');
            blocks_dpu[i].classList.add('dropup');
        }
    }
}

function getDataButtons(event){
    //console.log("ciao");
    const button = event.currentTarget;
    const data_button = button.dataset.button;
    mostraDropup(data_button);
}

function onClickCloseX(){
    //console.log("img");
    const blocks_dpu = document.querySelectorAll('div[data-dropup]');
    for(let i = 0; i < blocks_dpu.length; i++){
        blocks_dpu[i].classList.add('hidden');
        blocks_dpu[i].classList.remove('dropup');
    }
}


/*SLIDESHOW*/
function showImage(){
    let imageBanner;
    let new_p, new_a, container;
    switch(frecceBanner){
        case 'frecce1':
            imageBanner = document.getElementById("main-banner");
            imageBanner.style.backgroundImage = images1[count];
            
            new_p = document.createElement('p');
            new_p.textContent = contentP1[count];
            new_a = document.createElement('a');
            new_a.textContent = contentA1[count];
            new_a.classList.add('button');
            container = document.querySelector('#main-banner .descr-container');
            container.innerHTML = '';
            container.appendChild(new_p);
            container.appendChild(new_a);
            break;
        case 'frecce2':
            imageBanner = document.getElementById("main-banner2");
            imageBanner.style.backgroundImage = images2[count];
            
            new_p = document.createElement('p');
            new_p.textContent = contentP2[count];
            new_a = document.createElement('a');
            new_a.textContent = contentA2[count];
            new_a.classList.add('button');
            container = document.querySelector('#main-banner2 .descr-container');
            container.innerHTML = '';
            container.appendChild(new_p);
            container.appendChild(new_a);
            break;
        case 'frecce4':
            imageBanner = document.getElementById("main-banner4");
            imageBanner.style.backgroundImage = images4[count];

            new_p = document.createElement('p');
            new_p.textContent = contentP4[count];
            new_a = document.createElement('a');
            new_a.textContent = contentA4[count];
            new_a.classList.add('button');
            container = document.querySelector('#main-banner4 .descr-container');
            container.innerHTML = '';
            container.appendChild(new_p);
            container.appendChild(new_a);
            break;
        default: 
            console.log("Errore");
    }
}

function calcolaDim(event){
    const f = event.currentTarget;
    //console.log(f);
    frecceBanner = f.dataset.freccebanner;
    //console.log(data);
    let N = 0;
    switch(frecceBanner){
        case 'frecce1':
            N = images1.length;
            break;
        case 'frecce2':
            N = images2.length;
            break;
        case 'frecce4':
            N = images4.length;
            break;
        default: 
            console.log("Errore");
    }

    return N;
}

function incr(event){
    let N = calcolaDim(event);
    //console.log(N);
    count = (count + 1) % N;
    showImage(event);
}

function decr(event){
    let N = calcolaDim(event);
    count = (count - 1 + N) % N;
    showImage(event);
}


/*OVER-IMG*/
function refreshImage(event){
    const img = event.currentTarget;
    const data_productImg = img.dataset.productId;
    let id_img = parseInt(img.dataset.imgId);

    switch(data_productImg){
        case 'p1':
            img.src = initialImage1[id_img];
            break;
        case 'p2':
            img.src = initialImage2[id_img];
            break;
        case 'p3':
            img.src = initialImage3[id_img];
            break;
        default: console.log("Errore");
    }
}

function showOverImage(event){
    const img = event.currentTarget;
    const data_productImg = img.dataset.productId;
    let id_img = parseInt(img.dataset.imgId);

    switch(data_productImg){
        case 'p1':
            img.src = overImage1[id_img];
            break;
        case 'p2':
            img.src = overImage2[id_img];
            break;
        case 'p3':
            img.src = overImage3[id_img];
            break;
        default: console.log("Errore");
    }
}


// MAIN

/*DROPDOWN MENU*/
const links = document.querySelectorAll('#links a');
for(let i = 0; i < links.length; i++){
    if (i > 0 && i < 7){
        links[i].addEventListener('mouseover', getDataIndexLinks);
        //links[i].addEventListener('mouseleave', nascondiDropdownFromLink);
    }
}

const blocks_t = document.querySelectorAll('div[data-id]');
for(let i = 0; i < blocks_t.length; i++){
    blocks_t[i].addEventListener('mouseleave', nascondiDropdown);
}


/*DROPUP*/
const buttons = document.querySelectorAll('#buttons span[data-button]');
//console.log("Bottoni trovati: ", buttons.length);
//console.log("CIAO");
for(let i = 0; i < buttons.length; i++){
    buttons[i].addEventListener('click', getDataButtons);
}

const closeImages = document.querySelectorAll('img.close');
//console.log("img trovate: ", closeImages.length);
for(const closeImage of closeImages){
    closeImage.addEventListener('click', onClickCloseX);
}

/*SLIDESHOW*/
const prevButtons = document.querySelectorAll('.prev');
//console.log("lenght: " + prevButtons12.length);
const nextButtons = document.querySelectorAll('.next');
//console.log("lenght: " + nextButtons12.length);
for(const prev of prevButtons){
    prev.addEventListener('click', decr);
}
for(const next of nextButtons){
    next.addEventListener('click', incr);
}

/*OVER-IMG*/
const productImages1 = document.querySelectorAll('.products-container img');
const productImages2 = document.querySelectorAll('.products-container2 img');

for(const pImg1 of productImages1){
    pImg1.addEventListener('mouseover', showOverImage);
    pImg1.addEventListener('mouseleave', refreshImage);
}
for(const pImg2 of productImages2){
    pImg2.addEventListener('mouseover', showOverImage);
    pImg2.addEventListener('mouseleave', refreshImage);
}

