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


            let minus = document.createElement("input");
            minus.value = "-";
            minus.classList.add("qtyminus");
            minus.classList.add("minus");
            minus.type = "button";
            let plus = document.createElement("input");
            plus.value = "+";
            plus.classList.add("qtyplus");
            plus.classList.add("plus");
            plus.type = "button";
            let quantity = document.createElement("input");
            quantity.value = 0;
            quantity.classList.add("qty");
            quantity.type = "button";

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