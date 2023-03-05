
//--------------show initial splash screen only once--------------//

const splash = document.querySelector('.splash');

document.addEventListener('DOMContentLoaded', (e)=>{
setTimeout(()=>{
    splash.classList.add('display-none');
}, 1500);
})

document.cookie;
let z = document.cookie;

const hide = document.getElementById("hide");
    if(z == document.cookie.match(/PHPSESSID=[^;]+/)){
        hide.style.display = "content";
        document.cookie = 1;
    }else{
        hide.style.display = "none";    
    }
    

//---------------------sign-up form---------------------//

const form1 = document.getElementById("form1");
const form2 = document.getElementById("form2");

const next1 = document.getElementById("next1");
const back1 = document.getElementById("back1");

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

//----------set max calendar date to current date------------//

const today = new Date().toLocaleDateString('en-CA')
document.getElementById("customdob").setAttribute("max", today);














