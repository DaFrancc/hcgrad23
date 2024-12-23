function lazyLoadImages() {
	const lazyImages = document.querySelectorAll(".lazyimage");

	let i = 0;
	const loadNextImage = () => {
		if (i < lazyImages.length) {
			const image = lazyImages[i];
			const src = image.getAttribute("data-lazy");
			image.setAttribute("src", src);
			image.classList.remove("lazyimage");
			i++;
			image.onload = () => {
				loadNextImage();
			};
		}
	};

	loadNextImage();
}

function closePanel() {
    document.getElementById('viewer').style.display = 'none';
    document.getElementById('selected-img').setAttribute('org-img', null);
    document.getElementById('selected-img').setAttribute('src', null);
    document.getElementById('download-anchor').setAttribute('href', null);
}

function openImage(element) {
    const imageElement = element.children[0];
    
    const originalImage = imageElement.getAttribute("org-img");
    const compressedImage = imageElement.getAttribute("comp-img");
    document.getElementById('selected-img').setAttribute('src', compressedImage);
    document.getElementById('download-anchor').setAttribute('href', originalImage);
    document.getElementById('viewer').style.display = 'initial';
}

window.addEventListener("load", lazyLoadImages);