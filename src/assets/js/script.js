//job card description starts here
const jobButton = document.getElementsByClassName("lpage-4-button");
const jobDescriptions = document.getElementsByClassName("job-paths");
console.log(jobDescriptions);

jobDescriptions[0].style.display = "block";
// Add click event listeners to all buttons
for (let i = 0; i < jobButton.length; i++) {
    jobButton[i].addEventListener("click", () => {
      // Hide all descriptions
      for (let j = 0; j < jobDescriptions.length; j++) {
        jobDescriptions[j].style.display = "none";
      }
  
      // Show the corresponding description
      jobDescriptions[i].style.display = "block";
    });
  }


//course description starts here==========================================
const buttons = document.getElementsByClassName("lpage3-card-name");
const descriptions = document.getElementsByClassName("description");

descriptions[0].style.display = "block";

// Add click event listeners to all buttons
for (let i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", () => {
    // Hide all descriptions
    for (let j = 0; j < descriptions.length; j++) {
      descriptions[j].style.display = "none";
    }

    // Show the corresponding description
    descriptions[i].style.display = "block";
  });
}

// landing page slider starts here
const slider = document.querySelector('.slider');

const leftArrow = document.querySelector('.left');
const rightArrow = document.querySelector('.right');
const indicatorParents = document.querySelector('.nav-dots');
var sectionIndex = 0;

document.querySelectorAll('.nav-dots span').forEach(function(indicator, ind){
    indicator.addEventListener('click', function(){
        sectionIndex = ind;
        document.querySelector('.nav-dots .selected').classList.remove('selected');
        indicator.classList.add('selected');
        slider.style.transform = 'translate('+ (ind)*-25 +'%)';
    });
});

leftArrow.addEventListener('click',function(){
    sectionIndex = (sectionIndex > 0 ) ? sectionIndex - 1 : 0;
    document.querySelector('.nav-dots .selected').classList.remove('selected');
    indicatorParents.children[sectionIndex].classList.add('selected')
    slider.style.transform = 'translate('+ (sectionIndex)*-25 +'%)';
});

rightArrow.addEventListener('click',function(){
    sectionIndex = (sectionIndex <3 ) ? sectionIndex + 1 :3;
    document.querySelector('.nav-dots .selected').classList.remove('selected');
    indicatorParents.children[sectionIndex].classList.add('selected')
    slider.style.transform = 'translate('+ (sectionIndex)*-25 +'%)';
});

// Set the first description as visible by default
descriptions[0].style.display = "block";

   
//image drag and drop

document.querySelectorAll(".drop-zone__input").forEach(inputElement => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener("dragover", e => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    });

    ["dragleave","dragend"].forEach(type => {
        dropZoneElement.addEventListener(type, e => {
            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    dropZoneElement.addEventListener("drop", e =>{
        e.preventDefault();
        
        if(e.dataTransfer.files.length){
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("drop-zone--over");
    });
});
/** 
* updtaes the thumbnail
*@param {HTMLElement} dropZoneElement
*@param {file} file
*/


function updateThumbnail(dropZoneElement,file){
    let thumbnailELement = dropZoneElement.querySelector(".drop-zone__thumb");


    if(dropZoneElement.querySelector(".drop-zone__prompt")){
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }

    if (!thumbnailELement){
        thumbnailELement = document.createElement("div");
        thumbnailELement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailELement);
    }

    thumbnailELement.dataset.label = file.name;

    if(file.type.startsWith("image/")){
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
            thumbnailELement.style.backgroundImage = `url('${reader.result}')`;
        }
    }
}

//Payment Pop-up script strts here
document.querySelector('.pop-discard').addEventListener('click',
function(){
    document.querySelector('.bg-modal').style.display='none'

});

document.getElementById('btn-checkout').addEventListener('click',
function(){
    document.querySelector('.bg-modal').style.display='flex'
});

document.getElementById('btn-signin-1').addEventListener('click',
function(){
    document.querySelector('.form-container1').style.display='none'
});





