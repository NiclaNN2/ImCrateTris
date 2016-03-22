// getElementById
function $id(id) {
	return document.getElementById(id);
}

function Output1(file) {
	//On remplace l'élément image par un canvas.

	var photo1 = $id('photo1');
	var photo1_figure = photo1.firstElementChild;

	var photo1_canvas = document.createElement('canvas');

	var ctx1 = photo1_canvas.getContext('2d');
	var img1 = new Image();
	img1.onload = function() {
        ctx1.drawImage(img1, 0, 0, 250, 250);    
    }
	img1.src = file;  

	photo1.removeChild(photo1_figure);
	photo1.appendChild(photo1_canvas);
}

// call initialization file
if (window.File && window.FileList && window.FileReader) {
	Init();
}

//
// initialize
function Init() {

	var fileselect = $id("fileselect1"),
		filedrag = $id("filedrag1"),
		submitbutton = $id("submitbutton1");

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
		ParseFile1(f);
		UploadFile1(f);
	}

}


function ParseFile1(file) {

	// display an image
	if (file.type.indexOf("image") == 0) {
		var reader = new FileReader();
		reader.onload = function(e) {
			Output1(e.target.result
				//"<p><strong>" + file.name + ":</strong><br />" +
				//'<img src="' + e.target.result + '" /></p>'
			);
		}
		reader.readAsDataURL(file);
	}


	
}

// upload JPEG files
function UploadFile1(file) {

	//alert('salut');

	var xhr = new XMLHttpRequest();
	if (xhr.upload && (file.type == "image/jpeg" || file.type == "image/png") && file.size <= $id("MAX_FILE_SIZE").value) {
		//start upload
		//alert('salut');
		xhr.open("POST", $id("upload1").action, true);
		xhr.setRequestHeader("X_FILENAME", file.name);
		xhr.send(file);
		//alert('send');

	}
	else
	{
		alert('bitch');
	}

}


