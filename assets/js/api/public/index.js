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
            button.addEventListener("click", ()=>{
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