const formId2 = document.getElementById("formId2");
const discard = document.getElementById("discard");
const addSubtopic = document.getElementById("addSubtopic");


addSubtopic.onclick = function(){
    formId2.style.display = "block";
}

discard.onclick = function(){
    formId2.style.display = "none";
}

const dbsubtopic = document.getElementById("dbsubtopic");
const dblesson = document.getElementsByClassName("dblesson");
const addlesson = document.getElementById("addlesson");
const hidediv = document.getElementById("hidediv");
const formId1 = document.getElementById("formId1");
const discardlesson = document.getElementById("discardlesson");

dbsubtopic.onclick = function(){
    var i;
    for (i=0; i<dblesson.length; i++){
        dblesson[i].style.display = 'block';
    }
    addlesson.style.display = "block";
}

addlesson.onclick = function(){
    formId1.style.display = "block";
}

hidediv.onclick = function(){
    var x;
    for (x=0; x<dblesson.length; x++){
        dblesson[x].style.display = 'none';
    }
    
    addlesson.style.display = "none";
    formId1.style.display = "none";
}



discardlesson.onclick = function(){
    formId1.style.display = "none";
}




