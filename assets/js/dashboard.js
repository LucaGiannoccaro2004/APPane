let menuIcon = document.getElementById("menuIcon");
let verticalNavbar = document.getElementById("verticalNavbar");
let sectionContent = document.getElementById("sectionContent");
menuIcon.addEventListener("click", ()=>{
    menuIcon.classList.toggle("change");
    if(menuIcon.classList.contains("change")){
        sectionContent.style.width = "62%";
        verticalNavbar.style.display = "block";
    }else{
        sectionContent.style.width = "100%";
        verticalNavbar.style.display = "none";
    }
});



let container = document.getElementById("container");

new Xhr("GET", "categories/list").makeRequest(handleResponse, "application/json", undefined); 

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
        let nome = document.createElement("h2");
        nome.textContent = result[i].categoria;
        let buttons = document.createElement("div");
        buttons.classList.add("buttonsGroup");
        let modify = document.createElement("button");
        modify.classList.add("modifyButton");
        modify.textContent = "Modifica";
        modify.addEventListener("click", ()=>{
            "use strict";
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
        element.appendChild(nome);
        element.appendChild(buttons);
        container.appendChild(element);
    }
}

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