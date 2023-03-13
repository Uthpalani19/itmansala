
//------------------------------drag and drop file upload---------------------------//

document.querySelectorAll(".drop-zone-input").forEach((inputElement) => {
	const dropZoneElement = inputElement.closest(".drop-zone");

	inputElement.addEventListener("change", (e) => {
		if (inputElement.files.length) {
			updateThumbnail(dropZoneElement, inputElement.files[0]);
		}
	});

	dropZoneElement.addEventListener("dragover", (e) => {
		e.preventDefault();
		dropZoneElement.classList.add("drop-zone-hover");
	});

	["dragleave", "dragend"].forEach((type) => {
		dropZoneElement.addEventListener(type, (e) => {
			dropZoneElement.classList.remove("drop-zone-hover");
		});
	});

	dropZoneElement.addEventListener("drop", (e) => {
		e.preventDefault();

		if (e.dataTransfer.files.length) {
			inputElement.files = e.dataTransfer.files;
			updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
		}

		dropZoneElement.classList.remove("drop-zone-hover");
	});
});


function updateThumbnail(dropZoneElement, file) {
	let thumbnailElement = dropZoneElement.querySelector(".drop-zone-thumbnail");

	// remove text
	if (dropZoneElement.querySelector(".drop-zone-text")) {
		dropZoneElement.querySelector(".drop-zone-text").remove();
	}

	// create thumbnail
	if (!thumbnailElement) {
		thumbnailElement = document.createElement("div");
		thumbnailElement.classList.add("drop-zone-thumbnail");
		dropZoneElement.appendChild(thumbnailElement);
	}

	thumbnailElement.dataset.label = file.name;

	// Show thumbnail
	if (file.type.startsWith("image/")) {
		const reader = new FileReader();

		reader.readAsDataURL(file);
		reader.onload = () => {
			thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
		};
	}
}

//------------------add-course popup-----------------------//

const newLesson = document.getElementById("newLesson");
const navId = document.getElementById("navId");
const content = document.getElementById("content");
const footer = document.getElementById("footer");
const formId = document.getElementById("formId");
const discard = document.getElementById("discard");

newLesson.onclick = function(){
    navId.style.display = "none";
    content.style.display = "none";
	footer.style.display = "none"
    formId.style.display = "block"
}

discard.onclick = function(){
    navId.style.display = "block";
    content.style.display = "block";
	footer.style.display = "block"
    formId.style.display = "none";
}


// Getting the selected course from the drop down menu



