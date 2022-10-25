let container = document.getElementById("container");

new Xhr("GET", "recipes/list").makeRequest(handleResponse, "application/json", undefined); 

var id;

document.getElementById("addButton").addEventListener("click", ()=>{
    "use strict";
    window.$("#overlay").fadeIn();
    window.$("#overlay").css("display", "flex");
    window.$("#addForm").show();
    window.$("#addForm").css("display", "flex");
});

function handleResponse(){
    let result = JSON.parse(this.response);
    for(let i=0; i<result.length; i++){
        let element = document.createElement("div");
        element.setAttribute("id", result[i].id);
        element.classList.add("element");

        let categoria = document.createElement("h4");
        categoria.textContent = result[i].categoria;
        let nome = document.createElement("h3");
        nome.textContent = result[i].nome;
        let descrizione = document.createElement("p");
        descrizione.textContent = result[i].descrizione;
        let prezzo = document.createElement("h3");
        prezzo.textContent = result[i].prezzo;
        let divIngredienti = document.createElement("div");
        divIngredienti.classList.add("ingredienti");
        let vett = result[i].ingredienti;
        for(let j=0; j<vett.length; j++){
            let ingrediente = document.createElement("div");
            ingrediente.classList.add("ingrediente");
            ingrediente.setAttribute("id", vett[j].id);
            ingrediente.textContent = vett[j].nome;
            divIngredienti.appendChild(ingrediente);
        }

        let buttons = document.createElement("div");
        buttons.classList.add("buttonsGroup");
        let modify = document.createElement("button");
        modify.classList.add("modifyButton");
        modify.textContent = "Modifica";
        modify.addEventListener("click", ()=>{
            "use strict";
            compileForm(element);
            window.$("#overlay").fadeIn();
            window.$("#overlay").css("display", "flex");
            window.$("#modifyForm").show();
            window.$("#modifyForm").css("display", "flex");
            id = modify.parentNode.parentNode.getAttribute("id");
        });
        let remove = document.createElement("button");
        remove.classList.add("removeButton");
        remove.textContent = "Rimuovi";
        remove.addEventListener("click", ()=>{
            "use strict";
            window.$("#overlay").fadeIn();
            window.$("#overlay").css("display", "flex");
            window.$("#deleteForm").show();
            window.$("#deleteForm").css("display", "flex");
            id = modify.parentNode.parentNode.getAttribute("id");
        });
        buttons.appendChild(modify);
        buttons.appendChild(remove);
        element.appendChild(categoria);
        element.appendChild(nome);
        element.appendChild(descrizione);
        element.appendChild(prezzo);
        element.appendChild(divIngredienti);
        element.appendChild(buttons);
        container.appendChild(element);
    }
}

// function compileForm(element){
//     new Xhr("GET", "recipes/" + element.getAttribute("id")).makeRequest(, "application/json", undefined);
// }

window.$(".cross").click(function () {
	"use strict";
	window.$("#overlay").hide();
	window.$("#modifyForm").hide();
});

window.$("#addSubmit").click(function () {
    let formData = new FormData();
    formData.append('api', "categories");
    formData.append("categoria", String(document.getElementById("nomeAggiunta").value));
    formData.append("e", "e");
    new Xhr("POST", "categories/insert").makeRequest(function(){}, "application/json", formData);
    window.$("#overlay").hide();
	window.$("#addForm").hide();
    location.reload();
});

window.$("#modifySubmit").click(function () {
    let formData = new FormData();
    formData.append('api', "categories");
    formData.append('update', "byId");
    formData.append('id', id);
    formData.append("categoria", String(document.getElementById("nomeModifica").value));
    formData.append("e", "e");
    new Xhr("PUT", "categories/update").makeRequest(function(){}, "application/json", formData);
    window.$("#overlay").hide();
	window.$("#modifyForm").hide();
    location.reload();
});

window.$("#deleteSubmit").click(function () {
    let formData = new FormData();
    formData.append('api', "categories");
    formData.append('delete', "byId");
    formData.append('id', id);
    formData.append("e", "e");
    new Xhr("DELETE", "categories/delete").makeRequest(function(){}, "application/json", formData);
    window.$("#overlay").hide();
	window.$("#deleteForm").hide();
    location.reload();
});

let selectAggiunta = document.getElementById("categorieAggiunta");
let selectModifica = document.getElementById("categorieModifica");

selectAggiunta.addEventListener("focus", selectionClick(selectAggiunta));
selectModifica.addEventListener("focus", selectionClick(selectModifica));

function selectionClick(select){
    return function(){
        new Xhr("GET", "categories/list").makeRequest(selectsOptions(select), "application/json", undefined);
    }
}

function selectsOptions(select){
    return function(){
        select.innerHTML = "";
        let result = JSON.parse(this.response);
        for(let i=0; i<result.length; i++){
            let option = document.createElement("option");
            option.value = result[i].id;
            option.textContent = result[i].categoria;
            select.appendChild(option);
        }
    }
}
