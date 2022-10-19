categories = document.getElementById("categories");

new Xhr("GET", "categories/list").makeRequest(handleResponse, "application/json", undefined); 

function handleResponse(){
    let result = JSON.parse(this.response);
    for(let i=0; i<result.length; i++){
        let element = document.createElement("li");
        element.textContent = result[i].categoria;
        categories.appendChild(element);
    }
}