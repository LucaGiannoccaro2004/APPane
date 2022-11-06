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
                
            });
    
            element.appendChild(img);
            element.appendChild(nome);
            element.appendChild(descrizione);
            element.appendChild(prezzo);
            element.appendChild(button);
            container.appendChild(element);
        }
    }


}