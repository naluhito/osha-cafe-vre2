jQuery(function($) {
	var canvas;
	var image;
	var isDragging = false;
	var dragStartX = 0;
	var dragStartY = 0;
	var dragDiffX = 0;
	var dragDiffY = 0;
	var canvasX = 0;
	var canvasY = 0;
	var scale = 1;
	var frameWidth = 0;
	var frameHeight = 0;

	var frameImage = null;
	var choiceFrame = '';
	let beans = {};
	var photo;
	var photoURI = null;
	
	// フレームを選ぶ
	$('#btn1_1').click(function(){
		$('#frameModal').modal('show');
	});
	// 編集
	$('#btn2_1').click(function(){
		$('#editModal').modal('show');
	});
	// 豆
	$('#btn3_1').click(function(){
		$('#choiceBeansModal').modal('show');
	});
	// 買い物かご
	$('#btn4').click(function(){
		var data = {};
		var file = {};
		file['name'] = photo.name;
		file['type']= photo.type;
		file['uri'] = photoURI;
		data['photo'] = file;
		data['frame'] = choiceFrame;
		var imageInfo = {};
		imageInfo['width'] = canvas.width;
		imageInfo['height'] = canvas.height;
		imageInfo['diffx'] = dragDiffX;
		imageInfo['diffy'] = dragDiffY;
		imageInfo['scale'] = scale;
		imageInfo['frameWidth'] = frameWidth;
		imageInfo['frameHeight'] = frameHeight;
		data['imageInfo'] = imageInfo;
		data['beans'] = beans;
		storBasket(data);
	});

	function storBasket(basket) {
		let url = 'storebasket';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            datatype: 'json',
			contentType: "application/json",
			data: JSON.stringify(basket),
            url: url
        })
        .done(function(data){
            if (data.status === 'OK') {
				var temp = localStorage.getItem('oshiBasket')
				if (temp) {
					basket = JSON.parse(temp);
				} else {
					basket = [];
				}
				basket.push(data.id);
				localStorage.setItem('oshiBasket', JSON.stringify(basket));
				location.href='basket';
			}
        })
        .fail(function(data){
			console.log('Ajax failed');
        });        
		return false;
	}

	$('.c01').click(function(){
		choiceFrame = $(this).val();
		$("#confirmFrame").attr('src', 'frame/' + choiceFrame);
		$('#confirmModal').modal('show');
	});
    
	$('#confirmOk').click(function(){
		$('#btn1_1').hide();
		$('#btn1_2').show();
		$('#btn2_0').hide();
		$('#btn2_1').show();
		$('#confirmModal').modal('hide');
		$('#frameModal').modal('hide');
	});

	$('#previewButton').click(function(){
    	createPreview();
 		$('#editModal').modal('hide');
 		$('#previewModal').modal('show');
 		$('#kraftImage').css("display", "none");
    });
    
    $('#previewReturn').click(function(){
 		$('#previewModal').modal('hide');
 		$('#editModal').modal('show');
    });

    $('#PreviewOk').click(function(){
		$('#btn2_1').hide();
		$('#btn2_2').show();
		$('#btn3_0').hide();
		$('#btn3_1').show();
 		$('#previewModal').modal('hide');
    });
    
    $('#beansOk').click(function(){

		$('.bean-num').each(function(){
			if (Number($(this).val()) > 0) {
				beans[$(this).data('id')] = $(this).val();
			}
		});

		$('#btn3_1').hide();
		$('#btn3_2').show();
		$('#btn4').show();
 		$('#choiceBeensModal').modal('hide');
    });
    
    $('#editClose').click(function(){
    	$("#photo").remove();
   		$('#editModal').modal('hide');
    });

    $('#editReturn').click(function(){
    	$("#photo").remove();
   		$('#editModal').modal('hide');
    });
    
    $('#previewWhite').click(function(){
 		$('#kraftImage').hide();
 		$('#whiteImage').show();
    });

    $('#previewKraft').click(function(){
 		$('#kraftImage').show();
 		$('#whiteImage').hide();
    });

	$('.bean-num').on('change', function() {
		let beanNum = 0;
		$('.bean-num').each(function(){
			beanNum += Number($(this).val());
		});
		$('#bean-total').text(beanNum);
	});

    // 写真選択
    $('#input_file').on('change', function() {
		if ($('#input_file')[0].files.length > 1) {
			alert('アップロードできる画像は1つだけです');
			$('#input_file').val('');
			return;
		}
		handleFiles($('#input_file')[0].files);
    });
    // ドラッグ領域内
	$('#drop_area').on('dragenter dragover', function (event) {
		event.stopPropagation();
		event.preventDefault();
		$('#drop_area').css('background-color', '#dddddd');
	});
	// ドラッグ領域から外れた
	$('#drop_area').on('dragleave', function (event) {
		event.stopPropagation();
		event.preventDefault();
		$('#drop_area').css('background-color', '#ffffff');
	});
	// ドロップ
	$('#drop_area').on('drop', function (event) {
  		event.preventDefault();
		$('#drop_area').css('background-color', '#ffffff');

		$('#input_file')[0].files = event.originalEvent.dataTransfer.files;

		if ($('#input_file')[0].files.length > 1) {
			alert('アップロードできる画像は1つだけです');
			$('#input_file').val('');
			return;
		}
		handleFiles($('#input_file')[0].files);
	});	
	
	$('#controlRange').on('input', function() {
		scale = $(this).val();
		redraw();
	});
	
	function handleFiles(files) {
		var file = files[0];
		photo = files[0];
		var imageType = 'image.*';

		if (! file.type.match(imageType)) {
			alert('画像を選択してください');
			$('#input_file').val('');
			return;
		}

		var reader = new FileReader();
		reader.onload = function (e) {
			photoURI = e.target.result;
			loadImage(e.target.result);
		}
		reader.readAsDataURL(file);
	}
	
	function loadImage(imageFile) {
    	canvas = document.createElement('canvas');
    	ctx = canvas.getContext('2d');
		$("#img").append(canvas);

    	image = new Image();
    	image.onload = function() {
			width  = image.width;
			height = image.height;
			frameWidth = $('#frame').width();
			frameHeight = $('#frame').height();
			if (width < frameWidth) {
				width = frameWidth;
			}
			if (height < frameHeight) {
				height = frameHeight + 200;
			}
			canvas.setAttribute('width' , width);
			canvas.setAttribute('height', height);
			canvas.setAttribute('id', 'photo');
	    	ctx.clearRect(0, 0, canvas.width, canvas.height);
			ctx.fillStyle = "white";
			ctx.fillRect(0,0, canvas.width, canvas.height);
			ctx.translate(0,63.5);
			if (!choiceFrame) {
				redraw();
			} else {
				handleFrame(choiceFrame);
			}
    	}
    	image.src = imageFile;
    	addEventListener();
		return false;
	}
	
	function handleFrame(frame) {
    	frameURL = 'frame/' + frame;
    	ctx = canvas.getContext('2d');
    	frameImage = new Image();
    	frameImage.src = frameURL;
		frameImage.height = $('#drop_area').innerHeight();
		frameImage.width = $('#drop_area').innerWidth();
    	frameImage.onload = function() {
			redraw();
    	}
	}
	
	function dragStart(e) {
		e.preventDefault();
	    isDragging = true;
	    dragStartX = event.clientX;
	    dragStartY = event.clientY;
	}
	
	function drag(e) {
		e.preventDefault();
		if (isDragging) {
			dragDiffX = canvasX + (e.clientX - dragStartX) / scale;
			dragDiffY = canvasY + (e.clientY - dragStartY) / scale;
			redraw();
		}
	}
	
	function dragEnd(e) {
		e.preventDefault();
	    isDragging = false;
	    canvasX = dragDiffX;
	    canvasY = dragDiffY;
	}

	function handleTouchMove(event) {
	    event.preventDefault();
	}
		
	function toucDragStart(e) {
		e.preventDefault();
		console.log('ontouchstart');
	    isDragging = true;
		var touch = event.targetTouches[0];
		dragStartX = touch.pageX;	
		dragStartY = touch.pageY;
	}
	
	function toucDrag(e) {
		e.preventDefault();
		console.log('ontouchmove');
		if (isDragging) {
			var touch = event.targetTouches[0];
			x = touch.pageX;	
			y = touch.pageY;
			dragDiffX = canvasX + (x - dragStartX) / scale;
			dragDiffY = canvasY + (y - dragStartY) / scale;
			redraw();
		}
	}
	
	function toucDragEnd(e) {
		e.preventDefault();
		console.log('ontouchend');
	    isDragging = false;
	    canvasX = dragDiffX;
	    canvasY = dragDiffY;
	}

	function handleTouchMove(event) {
	    event.preventDefault();
	}
		
	function addEventListener() {
		canvas.addEventListener('touchstart', toucDragStart, false);
		canvas.addEventListener('touchmove', toucDrag, false);
		canvas.addEventListener('touchend', toucDragEnd, false);
		canvas.addEventListener('mousedown', dragStart, false);
		canvas.addEventListener('mousemove', drag, false);
		canvas.addEventListener('mouseup', dragEnd, false);
	}
	
	function redraw() {
    	ctx = canvas.getContext('2d');
    	ctx.clearRect(0, 0, canvas.width, canvas.height);
    	ctx.scale(scale, scale);
    	ctx.drawImage(image, dragDiffX, dragDiffY);

    	ctx.scale(1 / scale, 1 / scale);
    	if (frameImage !== null) {
			x = (canvas.width / 2) - (frameWidth / 2);
			y = (canvas.height / 2) - (frameHeight / 2);
	    	ctx.drawImage(frameImage, x, y, frameWidth, frameHeight);
    	}
	}
	
	function createPreview() {
    	pcanvas = document.createElement('canvas');    	
    	ctx = pcanvas.getContext('2d');
    	paper = new Image();
    	paper.src = 'img/kraftpaper.png';
    	paper.onload = function() {
			pcanvas.setAttribute('width' , paper.width);
			pcanvas.setAttribute('height', paper.height);
	    	ctx.drawImage(paper, 0, 0);
			sx = (canvas.width / 2) - (frameWidth / 2);
			sy = (canvas.height / 2) - (frameHeight / 2) + 63.5;
			dx = (paper.width / 2) - (frameWidth / 2);
			dy = (paper.height / 2) - (frameHeight / 2);
			sctx = canvas.getContext('2d');
			tranImageData = sctx.getImageData(sx, sy, frameWidth, frameHeight);
			tranData = tranImageData.data;
			for(var i = 0; i < tranImageData.data.length; i += 4){
				if((tranImageData.data[i] == 255) &&
				   (tranImageData.data[i + 1] == 255) &&
				   (tranImageData.data[i + 2] == 255)) {
				    tranImageData.data[i + 3] = 0;
				} else {
				    tranImageData.data[i + 3] = 210;
				}
			}
	    	wcanvas = document.createElement('canvas');
			wcanvas.setAttribute('width' , frameWidth);
			wcanvas.setAttribute('height', frameHeight);
	    	wctx = wcanvas.getContext('2d');
			wctx.putImageData(tranImageData, 0, 0);
			ctx.drawImage(wcanvas, dx, dy, frameWidth, frameHeight);
	    	data = pcanvas.toDataURL('image/png');
	    	$('#kraftImage').attr('src', data);
	    	createWhite();
    	}
	}
	
	function createWhite() {
    	pcanvas = document.createElement('canvas');
    	ctx = pcanvas.getContext('2d');
    	paper = new Image();
    	paper.src = 'img/whitepaper.png';
    	paper.onload = function() {
			pcanvas.setAttribute('width' , paper.width);
			pcanvas.setAttribute('height', paper.height);
	    	ctx.drawImage(paper, 0, 0);
			sx = (canvas.width / 2) - (frameWidth / 2);
			sy = (canvas.height / 2) - (frameHeight / 2) + 63.5;
			dx = (paper.width / 2) - (frameWidth / 2);
			dy = (paper.height / 2) - (frameHeight / 2);
	    	ctx.drawImage(canvas, sx, sy, frameWidth, frameHeight, dx, dy, frameWidth, frameHeight);
	    	data = pcanvas.toDataURL('image/png');
	    	$('#whiteImage').attr('src', data);
    	}
	}

});