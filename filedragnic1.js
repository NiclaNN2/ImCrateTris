// getElementById
function $id(id) {
	return document.getElementById(id);
}


function Remplacer_photo1(file) {
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

function FileSelectHandler(e) {

	// cancel event and hover styling
	FileDragHover(e);

	// fetch FileList object
	var files = e.target.files || e.dataTransfer.files;

	// process all File objects
	for (var i = 0, f; f = files[i]; i++) {
		Analyser_photo1(f);
		if(Analyser_photo1(f)){
			Proposer_Download1(adresse_download_1);
			Replace1(f);
			UploadFile1(f);
		}
	}

}

function Afficher_message1(msg){
	var Message1 = $id('messages1');
	Message1.innerHTML = msg;
}

function Analyser_photo1(file){

	var MIN_FILE_SIZE = 100000;
	var MAX_FILE_SIZE = 10000000;

	if(file.type == "image/jpeg" || file.type == "image/png"){			
		if(file.size <= MIN_FILE_SIZE){
			Afficher_message1('Please use a larger image ! Minimum size : ' + MIN_FILE_SIZE/1000 +  ' Ko');
			return false;
			}
		else if(file.size >= MAX_FILE_SIZE){
			Afficher_message1('Please use a smaller image ! Maximum size : 10000000' + MAX_FILE_SIZE/1000000 +  ' Mo');
			return false;

			}
		else{
			Afficher_message1('Thanks ! Download your picture using the link below.')
			return true;
			}
		}	
	else{
		Afficher_message1('Please use a jpeg or a png file ! ');
		return false;
		}
}

function Proposer_Download1(path){

	var Message1 = $id('messages1');

	var Download1 = document.createElement('p');
	Message1.appendChild(Download1);

	var Download_link1 = document.createElement('a');
	Download_link1.innerHTML = "Download picture";
	Download_link1.href = path;
	Download_link1.download = 'ImCrate';
	Download1.appendChild(Download_link1);

}

function Replace1(file) {

	if (file.type.indexOf("image") == 0) {
		var reader = new FileReader();
		reader.onload = function(e) {
			Remplacer_photo1(e.target.result);
		}
		reader.readAsDataURL(file);
	}

}

// upload JPEG or png files
function UploadFile1(file) {

	var xhr = new XMLHttpRequest();
	if (xhr.upload && (file.type == "image/jpeg" || file.type == "image/png") && file.size <= $id("MAX_FILE_SIZE").value) {
		//start upload
		xhr.open("POST", $id("upload1").action, true);
		xhr.setRequestHeader("X_FILENAME", file.name);
		xhr.send(file);
	}
	else
	{
		alert('The upload does not work.');
	}

}


