let email = document.getElementById("email");
let password = document.getElementById("password");
let confermaPassword = document.getElementById("confermaPassword");
let indirizzo = document.getElementById("indirizzo");
let note = document.getElementById("note");
let submit = document.getElementById("submit");

submit.addEventListener("click", ()=>{
    if(email.value == 0 || password.value == 0 || confermaPassword.value == 0 || indirizzo.value == 0){
        document.getElementById("wrongCredentials").textContent = "Compilare tutti i campi !";
        document.getElementById("wrongCredentials").style.display = "block";
    }else if(password.value != confermaPassword.value){
        document.getElementById("wrongCredentials").textContent = "Le password non corrispondono !";
        document.getElementById("wrongCredentials").style.display = "block";
    }else{
        let formData = new FormData();
        formData.append('email', email.value);
        formData.append('password', password.value);
        formData.append('indirizzo', indirizzo.value);
        formData.append('note', note.value);
        formData.append('api', 'signin');
        new Xhr("POST", "users/signin").makeRequest(function(){}, "application/json", formData);
    }
});