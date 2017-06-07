(function() {

	var streaming = false,
	video        = document.querySelector('#video'),
	  cover        = document.querySelector('#cover'),
	  canvas       = document.querySelector('#canvas'),
	  canvas2       = document.querySelector('#canvas2'),
	  takebutton  = document.querySelector('#takebutton'),
	  mario = document.getElementById("mario_i"),
	  pikachu = document.getElementById("pikachu_i"),
	  sonic = document.getElementById("sonic_i"),
	  link = document.getElementById("link_i"),
	  width = 320,
	  height = 0;

	navigator.getMedia = ( navigator.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.msGetUserMedia);

	navigator.getMedia(
		{
			video: true,
				audio: false
		},
		function(stream) {
			if (navigator.mozGetUserMedia) {
				video.mozSrcObject = stream;
			} else {
				var vendorURL = window.URL || window.webkitURL;
				video.src = vendorURL.createObjectURL(stream);
			}
			video.play();
		},
			function(err) {
				console.log("An error occured! " + err);
			}
	);

	video.addEventListener('canplay', function(ev){
		if (!streaming) {
			height = video.videoHeight / (video.videoWidth/width);
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas.setAttribute('width', width);
			canvas.setAttribute('height', height);
			canvas2.setAttribute('width', width);
			canvas2.setAttribute('height', height);
			canvas2.style.display = "none";

			streaming = true;
		}
	}, false);
	
	
	


	function AllowPhoto() {
		
		takebutton.disabled = false;
		uploadbutton.disabled = false;
		var publish = document.getElementById("publishbutton");
		if (publish)
		{
		var sticker  = SelectedSticker();
			DrawCanvas(canvas2, sticker, false);
		}

		function TakePicture() {
		var sticker  = SelectedSticker();
		DrawCanvas(video, sticker, true);
		}
	
	takebutton.addEventListener('click', function(ev){
		TakePicture();
		ev.preventDefault();
	}, false);
	}


	function NoSticker() {
			var sticker = SelectedSticker();
			var publish = document.getElementById("publishbutton");
			if (!sticker)
				alert("selectionnez un stickers");
			else if  (!publish){
				var button_div = document.getElementById("button");
				var button = document.createElement("button");
				var text = document.createTextNode("Publier la photo");
				button.setAttribute("id", "publishbutton");
				button.setAttribute("onclick", "SavePhoto(PutPhoto)");
				button.appendChild(text);
				button_div.appendChild(button);
			}
	}
	
		function UploadFile(e)
		{
			var sticker = SelectedSticker();
			var file = document.getElementById("uploadbutton").files[0];
			var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'];
			if (file)
			{
				var imgType = file.name.split('.');
				imgType = imgType[imgType.length - 1];

				if (allowedTypes.indexOf(imgType) != -1){
					var reader = new FileReader();
					reader.onload = function(event){
						var img = new Image();
						img.onload = function () {
							DrawCanvas(img, sticker, true);
						}
					img.src = event.target.result;
					}
				reader.readAsDataURL(e.target.files[0]);
				NoSticker();

				};
			}
		}

		function SelectedSticker()
		{
			var sticker;
			if (document.getElementById('pikachu_i').checked) {
				sticker = document.getElementById('pikachu_i').value;
			}
			else if (document.getElementById('mario_i').checked) {
				sticker = document.getElementById('mario_i').value;
			}
			else if (document.getElementById('link_i').checked) {
				sticker = document.getElementById('link_i').value;
			}
			else if (document.getElementById('sonic_i').checked) {
				sticker = document.getElementById('sonic_i').value;
			}
			return sticker;
		}
		 
		function DrawCanvas(img, sticker, flag)
		{
						canvas.width = width;
						canvas.height = height;
						canvas.getContext('2d').drawImage(img, 0, 0, width, height);
						if (flag)
						{
							canvas2.width = width;
							canvas2.height = height;
							canvas2.getContext('2d').drawImage(img, 0, 0, width, height);
						}
		var stickerSelected = document.getElementById(sticker);
						canvas.getContext('2d').drawImage(stickerSelected, 
							width - stickerSelected.width, 
								height - stickerSelected.height, 
									stickerSelected.width, stickerSelected.height);
		}

	takebutton.addEventListener('click', NoSticker);
	uploadbutton.addEventListener('change', UploadFile);
	mario.addEventListener('click', AllowPhoto);
	pikachu.addEventListener('click', AllowPhoto);
	sonic.addEventListener('click', AllowPhoto);
	link.addEventListener('click', AllowPhoto);

	div_scroll = document.getElementById("photos");
	div_scroll.addEventListener("wheel", function(e){
		e.preventDefault();
	div_scroll.scrollLeft+=e.deltaY;
	});
	

})();

