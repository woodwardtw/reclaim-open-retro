console.log('gif picker')

const gifBtn = document.querySelector('#gif-picker');
const dialog = document.querySelector("dialog");
gifBtn.addEventListener('click', (event) => {
    // Your click handling code here
    event.preventDefault(); // Prevents form submission
    event.stopPropagation(); // Stops event bubbling
    console.log('Element clicked');
    dialog.showModal();
});

const confirm = document.querySelector('#confirm');
confirm.addEventListener("click", () => {
	event.preventDefault(); // Prevents form submission
	event.stopPropagation(); // Stops event bubbling
	dialog.close();
 });



fetch('../wp-json/wp/v2/media?mime_type=image/gif&per_page=100')
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            //console.log(data);
            makeGif(data)
            imageClicker()
        })
        .catch(function (err) {
            console.log('error: ' + err);
        });


function makeGif(data){
	const destination = document.querySelector("#gif-library");
	data.forEach(function(gif){
		const img = document.createElement("img");
		img.src = gif.guid.rendered;
		img.classList.add('gif')
		destination.appendChild(img);		
	})
}


function imageClicker(){
	const allImages = document.querySelectorAll(".gif");
	const destination = document.querySelector("#input_2_10")
	allImages.forEach(function(gif){
		gif.addEventListener('click', () => {		  
		    console.log(gif.src)
		    destination.value = gif.src;
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


