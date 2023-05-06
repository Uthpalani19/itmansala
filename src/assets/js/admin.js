// Select file
const selectfile = document.getElementById("selectfile");
    const selectlabel = document.getElementById("selectlabel");

    selectfile.addEventListener('change', function(event){
        const selectfilename = event.target.files[0].name;
        selectlabel.textContent = selectfilename;
    })
    
            
            
// Drag and Drop
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