categories = document.getElementById("categories");

new Xhr("GET", "categories/list").makeRequest(handleCategories, "application/json", undefined); 

function handleCategories(){
    let result = JSON.parse(this.response);
    for(let i=0; i<result.length; i++){
        let element = document.createElement("li");
        element.textContent = result[i].categoria;
        categories.appendChild(element);
    }
}

let container = document.getElementById("homeContainer");

new Xhr("GET", "products/published").makeRequest(handleResponse, "application/json", undefined); 

var id;

function handleResponse(){
    let result = JSON.parse(this.response);
    if(!Array.isArray(result))
        result = [result];
    for(let i=0; i<result.length; i++){
        let element = document.createElement("div");
        element.setAttribute("id", result[i].id);
        element.classList.add("element");

        let img = document.createElement("img");
        img.src = result[i].foto;

        let nome = document.createElement("h3");
        nome.textContent = result[i].nome;
        let descrizione = document.createElement("p");
        descrizione.textContent = result[i].descrizione;
        let prezzo = document.createElement("h3");
        prezzo.textContent = result[i].prezzo;

        let button = document.createElement("button");
        button.textContent = "Aggiungi al Carrello";
        button.id="btnAggiungiCarrello";
        button.addEventListener("click", ()=>{

        });

        element.appendChild(img);
        element.appendChild(nome);
        element.appendChild(descrizione);
        element.appendChild(prezzo);
        element.appendChild(button);
        container.appendChild(element);
    }
}