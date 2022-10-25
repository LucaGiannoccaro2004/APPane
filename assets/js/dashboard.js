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



