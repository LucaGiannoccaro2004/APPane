/* <div class = "element">
    <img src = "..\assets\media\images\colorlogo.png">
    <div class = "info">
        <h1>Pane</h1>
        <p>Cane Pazzo Pazzo Cane, Cane Pazzo Pazzo Cane, Cane Pazzo Pazzo Cane, Cane Pazzo Pazzo Cane, Cane Pazzo Pazzo Cane</p>
        <h2>1€</h2>
    </div>
    <button>Rimuovi</button>
</div> */

new Xhr("GET", "cart/list").makeRequest(handleResponse, "application/json", undefined);

function handleResponse(){

    let container = document.getElementById("cartContainer");
    container.innerHTML="";
    let result = JSON.parse(this.response);
    let totale = 0;
    if(!Array.isArray(result))
        result = [result];
    for(let i=0; i<result.length; i++){
        let prodotto = result[i].idProdotto;
        totale += result[i].quantita*prodotto.prezzo;
        

        let element = document.createElement("div");
        element.setAttribute("id", prodotto.id);
        element.classList.add("element");

        let img = document.createElement("img");
        img.src = "../assets/media/" + prodotto.foto;

        let info = document.createElement("div");
        info.classList.add("info");

        let nome = document.createElement("h1");
        nome.textContent = prodotto.nome;

        let descrizione = document.createElement("p");
        descrizione.textContent = prodotto.descrizione;
        let prezzo = document.createElement("h2");
        prezzo.textContent = prodotto.prezzo + "€";

        info.appendChild(nome);
        info.appendChild(descrizione);
        info.appendChild(prezzo);


        let qtyContainer = document.createElement("div");
            qtyContainer.classList.add("qtyContainer");


            let quantity = document.createElement("input");
            quantity.value = result[i].quantita;
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
                    formData.append("idProdotto", prodotto.id);
                    formData.append("e", "e");
                    new Xhr("DELETE", "cart/delete").makeRequest(()=>{}, "application/json", formData);
                    location.reload();
                }else{
                    let formData = new FormData();
                    formData.append("api", "cart");
                    formData.append("update", "quantita");
                    formData.append("idProdotto", prodotto.id);
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
                formData.append("idProdotto", prodotto.id);
                formData.append("quantita", quantity.value)
                formData.append("e", "e");
                new Xhr("PUT", "cart/update").makeRequest(()=>{}, "application/json", formData);
            })



            qtyContainer.appendChild(minus);
            qtyContainer.appendChild(quantity);
            qtyContainer.appendChild(plus);

        let button = document.createElement("button");
        button.textContent = "Rimuovi";
        button.id="rimuovi";
        button.addEventListener("click", ()=>{
            let formData = new FormData();
            formData.append("api", "cart");
            formData.append("delete", "byId");
            formData.append("idProdotto", prodotto.id);
            formData.append("e", "e");
            new Xhr("DELETE", "cart/delete").makeRequest(()=>{}, "application/json", formData);
            location.reload();
        });



        element.appendChild(img);
        element.appendChild(info);
        element.appendChild(qtyContainer);
        element.appendChild(button);
        container.appendChild(element);
        document.getElementById("totale").textContent = "Totale: " + totale + "€";
    }

    document.getElementById("submitOrder").addEventListener("click", ()=>{
        if(localStorage.getItem("token") == undefined){
            location.href = "./login.html";
        }
        let formData = new FormData();
        formData.append("api", "ordineMaster");
        formData.append("numero", 0);
        formData.append("nota", localStorage.getItem("note"));
        new Xhr("POST", "ordineMaster/insert").makeRequest(()=>{}, "application/json", formData);

        new Xhr("GET", "cart/list").makeRequest(function(){
            let result = JSON.parse(this.response);
            if(!Array.isArray(result))
            result = [result];
            for(let i=0; i<result.length; i++){
                let formData = new FormData();
                formData.append("api", "ordineDetail");
                formData.append("idProdotto", result[i].idProdotto.id);
                formData.append("quantita", result[i].quantita);
                formData.append("prezzo", result[i].idProdotto.prezzo);
                new Xhr("POST", "ordineDetail/insert").makeRequest(()=>{}, "application/json", formData);
            }
            formData = new FormData();
            formData.append("api", "cart");
            formData.append("delete", "byIdCliente");
            formData.append("e", "e");
            new Xhr("DELETE", "cart/delete").makeRequest(()=>{location.reload(); alert("Ordine avvenuto con successo!!")}, "application/json", formData);
        }, "application/json", undefined);

            
    });
}