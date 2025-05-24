console.log('gif picker')

const gifBtn = document.querySelector('#gif-picker');

gifBtn.addEventListener('click', (event) => {
    // Your click handling code here
    event.preventDefault(); // Prevents form submission
    event.stopPropagation(); // Stops event bubbling
    console.log('Element clicked');
});


fetch('https://multisitetwo.local/extras/reclaim-gif/json.php')
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
		const img = document.createElement("img");
		img.src = 'https://multisitetwo.local/extras/reclaim-gif/imgs/'+ gif.url;
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