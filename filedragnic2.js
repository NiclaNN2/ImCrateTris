// getElementById
function $id(id) {
	return document.getElementById(id);
}

function Remplacer_Image2(file) {

window.URL    = window.URL || window.webkitURL;
useBlob   = false && window.URL; // `true` to use Blob instead of Data-URL

  var reader = new FileReader();
  reader.addEventListener("load", function () {
    var image  = new Image();
    image.addEventListener("load", function () {

    var image_width = image.width;
    var image_height = image.height;

    if(image_width>image_height)
	{
		var n_width = 250; 
		//var n_height = 0;
		var n_height = parseInt(n_width * image_height / image_width);	
	}
	else
	{
		var n_height = 250; 
		var n_width = parseInt(n_height * image_width / image_height);
	}

/*
 	alert('image width : ' + image_width + 
    'image height : ' + image_height + 
	'new image width : ' + n_width + 
   'new image height : ' + n_height);*/


    var photo2 = $id('photo2');
	var photo2_figure = photo2.firstElementChild;

	var photo2_canvas = document.createElement('canvas');

	var ctx2 = photo2_canvas.getContext('2d');
	var img2 = new Image();
	img2.onload = function() {
        ctx2.drawImage(img2, 0, 0, image_width, image_height, 0, 0, n_width, n_height);    
    }
	img2.src = useBlob ? window.URL.createObjectURL(file) : reader.result;  

	photo2.removeChild(photo2_figure);
	photo2.appendChild(photo2_canvas);
	

    });
    image.src = useBlob ? window.URL.createObjectURL(file) : reader.result;
    if (useBlob) {
      window.URL.revokeObjectURL(file); // Free memory
    }

  });
  reader.readAsDataURL(file);  
     
}

function Remplacer_photo2(file) {
	//On remplace l'élément image par un canvas.

		var photo2 = $id('photo2');
		var photo2_figure = photo2.firstElementChild;

		var photo2_canvas = document.createElement('canvas');

		var ctx2 = photo2_canvas.getContext('2d');
		var img2 = new Image();
		img2.onload = function() {
	        ctx2.drawImage(img2, 0, 0, 4000, 3000, 0, 0, 250, 187);    
	    }
		img2.src = file;  

		photo2.removeChild(photo2_figure);
		photo2.appendChild(photo2_canvas);
	
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

function FileSelectHandler(e) {

	// cancel event and hover styling
	FileDragHover(e);

	// fetch FileList object
	var files = e.target.files || e.dataTransfer.files;

	// process all File objects
	for (var i = 0, f; f = files[i]; i++) {
		Analyser_photo2(f);
		if(Analyser_photo2(f)){
			Proposer_Downloa2(adresse_download_2);
			Remplacer_Image2(f);
			UploadFile2(f);
		}
	}

}

function Afficher_message2(msg){
	var Message2 = $id('messages2');
	Message2.innerHTML = msg;
}

function Analyser_photo2(file){

	var MIN_FILE_SIZE = 100000;
	var MAX_FILE_SIZE = 10000000;

	if(file.type == "image/jpeg" || file.type == "image/png"){			
		if(file.size <= MIN_FILE_SIZE){
			Afficher_message2('Please use a larger image ! Minimum size : ' + MIN_FILE_SIZE/1000 +  ' Ko');
			return false;
			}
		else if(file.size >= MAX_FILE_SIZE){
			Afficher_message2('Please use a smaller image ! Maximum size : 10000000' + MAX_FILE_SIZE/1000000 +  ' Mo');
			return false;

			}
		else{
			Afficher_message2('Thanks ! Download your picture using the link below.')
			return true;
			}
		}	
	else{
		Afficher_message2('Please use a jpeg or a png file ! ');
		return false;
		}
}

function Proposer_Downloa2(path){

	var Message2 = $id('messages2');

	var Download2 = document.createElement('p');
	Message2.appendChild(Download2);

	var Download_link2 = document.createElement('a');
	Download_link2.innerHTML = "Download picture";
	Download_link2.href = path;
	Download_link2.download = 'ImCrate_'+date_download;
	Download_link2.addEventListener('click', function(){
		location.reload();
	});

	Download2.appendChild(Download_link2);

}

function Replace2(file) {

	if (file.type.indexOf("image") == 0) {
		var reader = new FileReader();
		reader.onload = function(e) {
			Remplacer_photo2(e.target.result);
		}
		reader.readAsDataURL(file);
	}
		
}

// upload JPEG or png files
function UploadFile2(file) {

	var xhr = new XMLHttpRequest();
	if (xhr.upload && (file.type == "image/jpeg" || file.type == "image/png") && file.size <= $id("MAX_FILE_SIZE").value) {
		//start upload
		xhr.open("POST", $id("upload2").action, true);
		xhr.setRequestHeader("X_FILENAME", file.name);
		xhr.send(file);
	}
	else
	{
		alert('The upload does not work.');
	}

}


