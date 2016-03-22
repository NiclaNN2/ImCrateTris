// output information
function Output3(file) {
	//On remplace l'élément image par un canvas.

	var photo3 = $id('photo3');
	var photo3_figure = photo3.firstElementChild;

	var photo3_canvas = document.createElement('canvas');

	var ctx3 = photo3_canvas.getContext('2d');
	var img3 = new Image();
	img3.onload = function() {
        ctx3.drawImage(img3, 0, 0, 250, 250);    
    }
	img3.src = file;  

	photo3.removeChild(photo3_figure);
	photo3.appendChild(photo3_canvas);   
}

// call initialization file
if (window.File && window.FileList && window.FileReader) {
	Init();
}

//
// initialize
function Init() {

	var fileselect = $id("fileselect3"),
		filedrag = $id("filedrag3"),
		submitbutton = $id("submitbutton3");

	// file select
	fileselect.addEventListener("change", FileSelectHandler, false);

	// is XHR2 available?
	var xhr = new XMLHttpRequest();
	if (xhr.upload) {
	
		// file drop
		filedrag.addEventListener("dragover", FileDragHover, false);
		filedrag.addEventListener("dragleave", FileDragHover, false);
		filedrag.addEventListener("drop", FileSelectHandler, false);
		filedrag.style.display = "block";
		
		// remove submit button
		submitbutton.style.display = "none";
	}

}


// file drag hover
function FileDragHover(e) {
	e.stopPropagation();
	e.preventDefault();
	e.target.className = (e.type == "dragover" ? "hover" : "");
}


// file selection
function FileSelectHandler(e) {

	// cancel event and hover styling
	FileDragHover(e);

	// fetch FileList object
	var files = e.target.files || e.dataTransfer.files;

	// process all File objects
	for (var i = 0, f; f = files[i]; i++) {
		ParseFile3(f);
		UploadFile3(f);

	}

}


function ParseFile3(file) {


	// display an image
	if (file.type.indexOf("image") == 0) {
		var reader = new FileReader();
		reader.onload = function(e) {
			Output3(e.target.result
				//"<p><strong>" + file.name + ":</strong><br />" +
				//'<img src="' + e.target.result + '" /></p>'
			);
		}
		reader.readAsDataURL(file);
	}


	
}

// upload JPEG files
function UploadFile3(file) {

	//alert('salut');

	var xhr = new XMLHttpRequest();
	if (xhr.upload && (file.type == "image/jpeg" || file.type == "image/png") && file.size <= $id("MAX_FILE_SIZE").value) {
		// start upload
		//alert('salut');
		xhr.open("POST", $id("upload3").action, true);
		xhr.setRequestHeader("X_FILENAME", file.name);
		xhr.send(file);
		//alert('send');

	}
	else
	{
		alert('bitch');
	}

	//window.refresh();


}


