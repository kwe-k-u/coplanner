////////////////////// SELECTORS //////////////////////
let passwordToggles;


window.addEventListener("load", init);



////////////////////// FUNCTIONS //////////////////////
// initialization function
function init(){
    // ASSIGNING VARIABLES
    passwordToggles = document.querySelectorAll(".toggle-password-show");

    // EVENT LISTENERS
    passwordToggles.forEach(function(passwordToggle){
        passwordToggle.addEventListener("click", togglePasswordShow);
    })

}

// toggle password function
function togglePasswordShow(event){
    let target = event.target;
    let parent = target.parentElement;
    let passInput = parent.querySelector("input");
    
    if(passInput.type === "password"){
        passInput.type = "text";
        target.innerHTML = "<i class='fa-sharp fa-solid fa-eye-slash'></i>"
    }
    else{
        passInput.type = "password";
        target.innerHTML = "<i class='fa-solid fa-eye'></i>"
    }
}
