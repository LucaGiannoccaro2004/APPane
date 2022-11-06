if(localStorage.getItem("token") != undefined){
    document.getElementById("login").textContent = "Ciao, " + localStorage.getItem("email");
    document.getElementById("signin").style.display = "none";
    document.getElementById("logout").style.display = "block";
    document.getElementById("login").addEventListener("mouseover", ()=>{
        document.getElementById("login").style.border = "1px solid #ffd6b6"
        document.getElementById("login").href = "";
    })
}

document.getElementById("logout").addEventListener("click", ()=>{
    localStorage.clear();
    document.getElementById("login").textContent = "Login";
    document.getElementById("signin").style.display = "block";
    document.getElementById("logout").style.display = "none";
    document.getElementById("login").addEventListener("mouseover", ()=>{
        document.getElementById("login").style.border = "1px solid #5c2626"
        document.getElementById("login").href = "login.html";
    })
    let formData = new FormData();
    formData.append("api", "logout");
    new Xhr("POST", "users/logout").makeRequest(()=>{}, "application/json", formData); 
    
});
    


categories = document.getElementById("categories");

new Xhr("GET", "categories/list").makeRequest(handleCategories, "application/json", undefined); 

function handleCategories(){
    let result = JSON.parse(this.response);
    for(let i=0; i<result.length; i++){
        if(i==0)
            getItem(result[i].id);
        let element = document.createElement("li");
        element.addEventListener("click", ()=>{
            getItem(result[i].id);
        });
        element.textContent = result[i].categoria;
        categories.appendChild(element);
    }
}



function getItem(id){
    new Xhr("GET", "products/published/"+id).makeRequest(handleResponse, "application/json", undefined); 

    var id;
    
    function handleResponse(){

        let container = document.getElementById("homeContainer");
        container.innerHTML="";
        let result = JSON.parse(this.response);
        if(!Array.isArray(result))
            result = [result];
        for(let i=0; i<result.length; i++){
            
            let element = document.createElement("div");
            element.setAttribute("id", result[i].id);
            element.classList.add("element");
    
            let img = document.createElement("img");
            img.src = "../assets/media/" + result[i].foto;
    
            let nome = document.createElement("h1");
            nome.textContent = result[i].nome;
            let descrizione = document.createElement("p");
            descrizione.textContent = result[i].descrizione;
            let prezzo = document.createElement("h2");
            prezzo.textContent = result[i].prezzo + "€";
    
            let button = document.createElement("button");
            button.textContent = "Aggiungi al Carrello";
            button.id="btnAggiungiCarrello";
            $(button).click(()=>{


                var imgtodrag = img;
                var topoff = Math.round(imgtodrag.offsetTop);
                var leftoff = Math.round(imgtodrag.offsetLeft);
                var cart = $('#cartImg');
                if (imgtodrag) {
                    var imgclone = $(img).clone()
                        .css({
                        'opacity': '0.5',
                            'position': 'absolute',
                            'height': '150px',
                            'width': '150px',
                            'z-index': '100',
                            'top' : topoff + 'px',
                            'left' : leftoff + 'px'
                    })
                        .appendTo($('body'))
                        .animate({
                        'top': $(cart).offset().top + 10,
                            'left': $(cart).offset().left + 10,
                            'width': 75,
                            'height': 75
                    }, 1000, 'easeInOutExpo');
                    
                    // setTimeout(function () {
                    //      $(cart).effect("shake", {
                    //         times: 2
                    //      }, 200);
                    //  }, 1500);

                    imgclone.animate({
                        'width': 0,
                            'height': 0
                    }, function () {
                        $(this).detach()
                    });
                }
                let formData = new FormData();
                formData.append("api", "cart");
                formData.append("idProdotto", result[i].id);
                formData.append("quantita", 1);
                new Xhr("POST", "cart/insert").makeRequest(()=>{}, "application/json", formData);
                qtyContainer.style.display = "flex";
                button.style.display = "none";
            });

            let qtyContainer = document.createElement("div");
            qtyContainer.classList.add("qtyContainer");


            let quantity = document.createElement("input");
            quantity.value = 1;
            quantity.classList.add("qty");
            quantity.type = "button";

            let minus = document.createElement("input");
            minus.value = "-";
            minus.classList.add("qtyminus");
            minus.classList.add("minus");
            minus.type = "button";
            minus.addEventListener("click", ()=>{
                quantity.value = parseInt(quantity.value) - 1;
                if(quantity.value == 0){
                    quantity.value = 1;
                    let formData = new FormData();
                    formData.append("api", "cart");
                    formData.append("delete", "byId");
                    formData.append("idProdotto", result[i].id);
                    formData.append("e", "e");
                    new Xhr("DELETE", "cart/delete").makeRequest(()=>{}, "application/json", formData);
                    button.style.display = "flex";
                    qtyContainer.style.display = "none";
                }else{
                    let formData = new FormData();
                    formData.append("api", "cart");
                    formData.append("update", "quantita");
                    formData.append("idProdotto", result[i].id);
                    formData.append("quantita", quantity.value)
                    formData.append("e", "e");
                    new Xhr("PUT", "cart/update").makeRequest(()=>{}, "application/json", formData);
                }
            })
            let plus = document.createElement("input");
            plus.value = "+";
            plus.classList.add("qtyplus");
            plus.classList.add("plus");
            plus.type = "button";
            plus.addEventListener("click", ()=>{
                quantity.value = parseInt(quantity.value) + 1;
                let formData = new FormData();
                formData.append("api", "cart");
                formData.append("update", "quantita");
                formData.append("idProdotto", result[i].id);
                formData.append("quantita", quantity.value)
                formData.append("e", "e");
                new Xhr("PUT", "cart/update").makeRequest(()=>{}, "application/json", formData);
            })



            qtyContainer.appendChild(minus);
            qtyContainer.appendChild(quantity);
            qtyContainer.appendChild(plus);

            qtyContainer.style.display = "none";
    
            element.appendChild(img);
            element.appendChild(nome);
            element.appendChild(descrizione);
            element.appendChild(prezzo);
            element.appendChild(button);
            element.appendChild(qtyContainer);
            container.appendChild(element);

            
        }
    }


}