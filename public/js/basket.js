jQuery(function($) {
    var canvas = document.createElement('canvas');
    var loadFLg = false;


    function createItem(item) {
        loadFLg = true;
        var uri = item.photo.uri;
        var uriParts = uri.split(",");
        var fileContent = uriParts[1];
        var binary = atob(fileContent);
        var bytes = new Uint8Array(binary.length);
        for (var i = 0; i < binary.length; i++) {
            bytes[i] = binary.charCodeAt(i)
        }
        var file = new File([bytes], item.photo.name, {type: item.photo.type});

        let clone = $('#item').clone();
        var num = 0;
        $.each(item.beans, function() {
            num += Number(this);
        })
        clone.show();
        var frameEl = clone.find('#frame');

        handleFiles(file, item, frameEl);
        clone.attr('id', '');
        clone.find('#num').text(num);
        clone.find('#shipping').text('100');
        clone.find('#amount').text('200');
        clone.find('#tax').text('300');
        $('#item').before(clone);
    }

	function handleFiles(file, item, frameEl) {
		var reader = new FileReader();
		reader.onload = function (e) {
			loadImage(e.target.result, item, frameEl);
		}
		reader.readAsDataURL(file);
	}

	function loadImage(imageFile, item, frameEl) {
    	image = new Image();
    	image.onload = function() {
            ctx = canvas.getContext('2d');
			width  = image.width;
			height = image.height;
			if (width < item.imageInfo.frameWidth) {
				width = frameWidth;
			}
			if (height < item.imageInfo.frameHeight) {
				height = frameHeight + 200;
			}
			canvas.setAttribute('width' , width);
			canvas.setAttribute('height', height);
	    	ctx.clearRect(0, 0, canvas.width, canvas.height);
			ctx.fillStyle = "white";
			ctx.fillRect(0,0, canvas.width, canvas.height);
			ctx.translate(0,63.5);

            if (!item.frame) {
                var data = draw(item, image, null);
				frameEl.attr('src', data);
                loadFLg = false;
			} else {
				handleFrame(item, frameEl, image);
			}
    	}
        image.onerror = function(e) {
            console.log(e);
        };        
    	image.src = imageFile;
		return false;
	}

	function handleFrame(item, frameEl, image) {
    	frameURL = 'frame/' + item.frame;
    	frameImage = new Image();
		frameImage.width = item.imageInfo.frameWidth;
		frameImage.height = item.imageInfo.frameHeight;
    	frameImage.onload = function() {
            var data = draw(item, image, frameImage);
            frameEl.attr('src', data);
            loadFLg = false;
        }
        frameImage.onerror = function(e) {
            console.log(e);
        };        
    	frameImage.src = frameURL;
	}

    function draw(item, image, frameImage) {
    	ctx = canvas.getContext('2d');
    	ctx.clearRect(0, 0, canvas.width, canvas.height);
    	ctx.scale(item.imageInfo.scale, item.imageInfo.scale);
    	ctx.drawImage(image, item.imageInfo.diffx, item.imageInfo.diffy);

    	ctx.scale(1 / item.imageInfo.scale, 1 / item.imageInfo.scale);
    	if (frameImage !== null) {
			x = (canvas.width / 2) - (item.imageInfo.frameWidth / 2);
			y = (canvas.height / 2) - (item.imageInfo.frameHeight / 2);
	    	ctx.drawImage(frameImage, x, y, item.imageInfo.frameWidth, item.imageInfo.frameHeight);
    	}
    	dcanvas = document.createElement('canvas');
    	dctx = dcanvas.getContext('2d');
        dcanvas.setAttribute('width' , item.imageInfo.frameWidth);
        dcanvas.setAttribute('height', item.imageInfo.frameHeight);
        sx = (canvas.width / 2) - (item.imageInfo.frameWidth / 2);
        sy = (canvas.height / 2) - (item.imageInfo.frameHeight / 2) + 63.5;
        dctx.drawImage(canvas, sx, sy, item.imageInfo.frameWidth, item.imageInfo.frameHeight, 0, 0, item.imageInfo.frameWidth, item.imageInfo.frameHeight);


        data = dcanvas.toDataURL('image/png');
        return data;
	}

    var basket = JSON.parse(localStorage.getItem('oshiBasket'));

    $.each(basket, function() {
        var item = this;
        var timer = setInterval(function(){
            if (!loadFLg) {
                clearInterval(timer);
                createItem(item);
            }
         }, 50)
    })
});