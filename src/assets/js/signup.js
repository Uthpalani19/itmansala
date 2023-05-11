
    

//---------------------sign-up form---------------------//

const form1 = document.getElementById("form1");
const form2 = document.getElementById("form2");

const next1 = document.getElementById("next1");
const back1 = document.getElementById("back1");

const phone = document.getElementById("phone");

phone.addEventListener("keyup", (e) => {
const value = e.currentTarget.value;
next1.disabled = false;
next1.style.background = "#5C26A9";
next1.style.cursor = "pointer";
if (value === ""){
    next1.disabled = true;
    next1.style.background = "#c1b7cf";
    next1.style.cursor = "not-allowed";
}
});

next1.onclick = function(){
    form1.style.display = "none";
    form2.style.display = "block";
}

back1.onclick = function(){
    form2.style.display = "none";
    form1.style.display = "block";
}



//-----------------hide/show password---------------//

const psw1 = document.getElementById("psw1");
const psw2 = document.getElementById("psw2");
const hidePsw1 = document.getElementById("hidePsw1");
const hidePsw2 = document.getElementById("hidePsw2");

hidePsw1.onclick = function(){
    if (psw1.type === "password"){
        psw1.type = "text";
    }else{
        psw1.type = "password";
    }
    if (hidePsw1.className == "fa-regular fa-eye-slash"){
        hidePsw1.className = "fa-regular fa-eye";
    }else{
        hidePsw1.className = "fa-regular fa-eye-slash";
    }
}

hidePsw2.onclick = function(){
    if (psw2.type === "password"){
        psw2.type = "text";
    }else{
        psw2.type = "password";
    }
    if (hidePsw2.className == "fa-regular fa-eye-slash"){
        hidePsw2.className = "fa-regular fa-eye";
    }else{
        hidePsw2.className = "fa-regular fa-eye-slash";
    }
}