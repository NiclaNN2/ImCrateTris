// output information
function Output2(file) {
	//var m = $id("messages");
	//m.innerHTML = msg + m.innerHTML;
	var photo2 = $id('photo2');
	photo2.src = file;
}

// call initialization file
if (window.File && window.FileList && window.FileReader) {
	Init();
}

//
// initialize
function Init() {

	var fileselect = $id("fileselect2"),
		filedrag = $id("filedrag2"),
		submitbutton = $id("submitbutton2");

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
		ParseFile2(f);
		UploadFile(f);
	}

}


function ParseFile2(file) {

	// display an image
	if (file.type.indexOf("image") == 0) {
		var reader = new FileReader();
		reader.onload = function(e) {
			Output2(e.target.result
				//"<p><strong>" + file.name + ":</strong><br />" +
				//'<img src="' + e.target.result + '" /></p>'
			);
		}
		reader.readAsDataURL(file);
	}


	
}

// upload JPEG files
function UploadFile(file) {

	//alert('salut');

	var xhr = new XMLHttpRequest();
	if (xhr.upload && (file.type == "image/jpeg" || file.type == "image/png") && file.size <= $id("MAX_FILE_SIZE").value) {
		// start upload
		//alert('salut');
		xhr.open("POST", $id("upload").action, true);
		xhr.setRequestHeader("X_FILENAME", file.name);
		xhr.send(file);
		//alert('send');

	}
	else
	{
		alert('bitch');
	}

}


