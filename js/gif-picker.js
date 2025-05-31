console.log('gif picker')

const gifBtn = document.querySelector('#gif-picker');
const dialog = document.querySelector("dialog");
gifBtn.addEventListener('click', (event) => {
    // Your click handling code here
    event.preventDefault(); // Prevents form submission
    event.stopPropagation(); // Stops event bubbling
    cleanOldGif();
    dialog.showModal();
});

const confirm = document.querySelector('#confirm');
confirm.addEventListener("click", () => {
	event.preventDefault(); // Prevents form submission
	event.stopPropagation(); // Stops event bubbling
	const chosenGif = document.querySelector(".selected");
	attachChosenGif(chosenGif);
	dialog.close();
 });

function attachChosenGif(chosenGif){
	const formId = document.querySelector(".gform_wrapper form").dataset.formid	
	const field = `#field_${formId}_14`;
	const destination = document.querySelector(field);//FLIP _2_14 & _1_14
	const img = document.createElement("img");
	img.src = chosenGif.src;
	img.classList.add("chosen-gif");
	destination.appendChild(img);		
}

function cleanOldGif(){
	if(document.querySelector('.chosen-gif')){
		const oldGif = document.querySelector('.chosen-gif');
		oldGif.remove();
	}

}

fetch('../wp-json/wp/v2/media?mime_type=image/gif&per_page=100')
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            console.log(data);
            makeGif(data)
            imageClicker()
        })
        .catch(function (err) {
            console.log('error: ' + err);
        });


function makeGif(data){
	const destination = document.querySelector("#gif-library");
	data.forEach(function(gif){
		if(gif.caption.rendered === ""){
			const img = document.createElement("img");
			img.src = gif.guid.rendered;
			img.classList.add('gif');
			img.dataset.id = gif.id;
			destination.appendChild(img);	
		}			
	})
}


function imageClicker(){
	const formId = document.querySelector(".gform_wrapper form").dataset.formid	
	const urlField = `#input_${formId}_10`;
	const imageIdField = `#input_${formId}_16`;
	const allImages = document.querySelectorAll(".gif");	
	const urlDestination = document.querySelector(urlField); //change between _2_10 & _1_10 for prod
	const imageIdDestination = document.querySelector(imageIdField); //change 
	allImages.forEach(function(gif){
		gif.addEventListener('click', () => {		  
		    urlDestination.value = gif.src;//value to url
		    imageIdDestination.value = gif.dataset.id;//value to image ID
		    cleanSelected(allImages);
		    gif.classList.toggle('selected');
		  });
	})
}

function cleanSelected(allImages){
	allImages.forEach(function(img){
		img.classList.remove('selected')
	})
}


