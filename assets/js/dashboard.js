let formData = new FormData();
formData.append("api", "auth");
formData.append("auth", "admin");
formData.append("token", localStorage.getItem("token"));
new Xhr("POST", "auth").makeRequest(function(){
    let result = JSON.parse(this.response);
    if(result.auth == 0)
        location.href = "../public/login.html";
}, "application/json", formData);

document.addEventListener("DOMContentLoaded", ()=>{
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
});