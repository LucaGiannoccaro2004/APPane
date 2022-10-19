document.getElementById("submit").addEventListener("click", ()=>{
    let formData = new FormData();
    formData.append("api", "login");
    formData.append("email", document.getElementById("email").value);
    formData.append("password", document.getElementById("password").value);
    new Xhr("POST", "users/login").makeRequest(handleLoginResponse, "application/json", formData); 
});

function handleLoginResponse(){
    let result = JSON.parse(this.response);
    if(result.auth == 0)
        document.getElementById("wrongCredentials").style.display = "block";
    else{
        localStorage.setItem("token", result.token);
        localStorage.setItem("email", result.email);
        localStorage.setItem("indirizzo", result.indirizzo);
        localStorage.setItem("note", result.note);
        location.href = "./index.html"
    }
}