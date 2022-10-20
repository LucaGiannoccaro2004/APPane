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
            window.$("#form").show();
            window.$("#form").css("display", "flex");
            id = modify.parentNode.parentNode.getAttribute("id");
        });
        let remove = document.createElement("button");
        remove.classList.add("removeButton");
        remove.textContent = "Rimuovi";
        buttons.appendChild(modify);
        buttons.appendChild(remove);
        element.appendChild(nome);
        element.appendChild(buttons);
        container.appendChild(element);
    }
}


window.$("#ovrlay").click(function () {

});
window.$("#cross").click(function () {
	"use strict";
	window.$("#overlay").hide();
	window.$("#form").hide();
});

window.$("#btn").click(function () {
    let formData = new FormData();
    formData.append('api', "categories");
    formData.append('update', "byId");
    formData.append('id', id);
    formData.append("categoria", String(document.getElementById("nome").value));
    formData.append("e", "e");
    new Xhr("PUT", "categories/update").makeRequest(function(){}, "application/json", formData);
});