const isMobile =
	typeof window.orientation !== "undefined" ||
	navigator.userAgent.indexOf("IEMobile") !== -1;

if (isMobile) {
	window.location = "/mobile.php";
}

const uploadForm = document.getElementById("uploadForm");
const inpFile = document.getElementById("inpFile");

inpFile.addEventListener("change", (e) => {
	const select_tr = document.getElementById("select-tr");
	select_tr.style.display = "none";

	const submit_tr = document.getElementById("submit-tr");
	submit_tr.style.display = "initial";
});

uploadForm.addEventListener("submit", submitProcess);

function submitProcess(e) {
	e.preventDefault();

	const endpoint = "upload.php";
	const formData = new FormData();
	const files = inpFile.files;
	const fileCount = files.length;
	let uploadedCount = 0;

	console.log(inpFile.files);

	for (let i = 0; i < inpFile.files.length; i++) {
		formData.append("inpFile[]", inpFile.files[i]);
	}

	const options = {
		method: "post",
		body: formData,
	};

	const xhr = new XMLHttpRequest();

	document.getElementById("info").innerText =
		"Keep the page open while the files upload";

	xhr.upload.addEventListener("progress", function (event) {
		uploadedCount = event.loaded / (event.total / fileCount);
		const percentComplete = (uploadedCount / fileCount) * 100;
		document.getElementById("submit-button").innerText =
			(Math.floor(percentComplete) > 99 ? 99 : Math.floor(percentComplete)) +
			"%";
	});

	xhr.open("POST", endpoint);

	xhr.addEventListener("load", function (event) {
		if (xhr.status === 200) {
			// Upload was successful
			document.getElementById("submit-button").innerText = "Success";
			document.getElementById("info").innerText =
				"You may safely close or refresh the page";
		} else {
			// Upload failed
			document.getElementById("submit-button").innerText = "Failed";
		}
	});

	xhr.send(formData);

	uploadForm.removeEventListener("submit", submitProcess);
}

window.onbeforeunload = function () {
	// Get a reference to the form element
	const form = document.getElementById("uploadForm");

	// Reset the form to clear all field values
	form.reset();
};

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
				image.classList.add("fade-in");
			};
		}
	};

	loadNextImage();
}

window.addEventListener("load", lazyLoadImages);

function adjustScroll() {
	let thumb = document.getElementById("scrollthumb");
	let bar = document.getElementById("scrollbody");
	const bar_width = Math.max(
		bar.scrollWidth,
		bar.offsetWidth,
		bar.clientWidth,
		bar.scrollWidth,
		bar.offsetWidth
	);
	const limit =
		Math.max(
			document.body.scrollWidth,
			document.body.offsetWidth,
			document.documentElement.clientWidth,
			document.documentElement.scrollWidth,
			document.documentElement.offsetWidth
		) - window.innerWidth;
	thumb.style.transform = `translateX(${bar_width *
		((window.scrollX - thumb.getBoundingClientRect().width) /
			(limit + thumb.getBoundingClientRect().width))
		}px)`;
}

window.addEventListener("scroll", adjustScroll);
