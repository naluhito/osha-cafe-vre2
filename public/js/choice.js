jQuery(function($) {
	var printFrameWidth = 2000;
	var printFrameHeight = 2134;
	var frameWidth;
	var frameHeight;
	var dspScale;
	var canvas;
	var imageCanvas;
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
	var paperKind = "ホワイト";
	var orientation = 0;

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
		$("#overlay").fadeIn(500);
		var data = {};
		var file = {};
		file['name'] = photo.name;
		file['type']= photo.type;
		file['uri'] = trimPhoto();
		data['photo'] = file;
		data['frame'] = choiceFrame;
		data['paper'] = paperKind;
		var imageInfo = {};
		imageInfo['width'] = canvas.width;
		imageInfo['height'] = canvas.height;
		imageInfo['diffx'] = dragDiffX;
		imageInfo['diffy'] = dragDiffY;
		imageInfo['scale'] = scale;
		imageInfo['frameWidth'] = frameWidth;
		imageInfo['frameHeight'] = frameHeight;
		imageInfo['orientation'] = orientation;
		data['imageInfo'] = imageInfo;
		data['beans'] = beans;
		console.dir(data);
		storBasket(data);
		return false;
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
				$("#overlay").fadeOut(500);
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
		$("#confirmFrame").attr('src', 'img/frame_pv/' + choiceFrame);
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
		$('#input_file').val(null);
   		$('#editModal').modal('hide');
    });

    $('#editReturn').click(function(){
    	$("#photo").remove();
		$('#input_file').val(null);
   		$('#editModal').modal('hide');
    });
    
    $('#previewWhite').click(function(){
		paperKind = "ホワイト";
		$('#kraftImage').hide();
 		$('#whiteImage').show();
    });

    $('#previewKraft').click(function(){
		paperKind = "クラフト";
		$('#kraftImage').show();
 		$('#whiteImage').hide();
    });

	$('.bean-num').on('change', function() {
		let beanNum = 0;
		$('.bean-num').each(function(){
			beanNum += Number($(this).val());
		});
		$('#bean-total').text(beanNum);
		if (beanNum > 0) {
			$("#beansOk").prop("disabled", false);
		} else {
			$("#beansOk").prop("disabled", true);
		}
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
	
	function getOrientation(buffer) {
		const dv = new DataView(buffer)
		let app1MarkerStart = 2
		// もし JFIF で APP0 Marker がある場合は APP1 Marker の取得位置をずらす
		if (dv.getUint16(app1MarkerStart) !== 65505) {
		  const length = dv.getUint16(4)
		  app1MarkerStart += length + 2
		}
		if (dv.getUint16(app1MarkerStart) !== 65505) {
		  return 0
		}
		const littleEndian = dv.getUint8(app1MarkerStart + 10) === 73
		const count = dv.getUint16(app1MarkerStart + 18, littleEndian)
		for (let i = 0; i < count; i++) {
		  const start = app1MarkerStart + 20 + i * 12
		  const tag = dv.getUint16(start, littleEndian)
		  if (tag === 274) {
			return dv.getUint16(start + 8, littleEndian)
		  }
		}
		return 0
	  }

	function handleFiles(files) {
		var file = files[0];
		photo = files[0];
		var imageType = 'image.*';

		if (! file.type.match(imageType)) {
			alert('画像を選択してください');
			$('#input_file').val('');
			return;
		}
		var arrayReader = new FileReader();
		arrayReader.onload = function (e) {
			orientation = getOrientation(e.target.result);
			console.log(orientation);
		}
		arrayReader.readAsArrayBuffer(file);

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
		imageCanvas = document.createElement('canvas');;

    	image = new Image();
    	image.onload = function() {
			width  = image.width;
			height = image.height;
			frameWidth = $('#frame').width();
			frameHeight = $('#frame').height();
			dspScale =  frameHeight / printFrameHeight;
			if (height > width) {
				if (width < printFrameWidth) {
					r = printFrameWidth / width;
					width = width * r * 2;
					height = height * r * 2;
				} else {
					width *= 1.5;
					height *= 1.5;
				}
			} else {
				if (height < printFrameHeight) {
					r = printFrameHeight / height;
					width = width * r * 2;
					height = height * r * 2;
				} else {
					width *= 1.5;
					height *= 1.5;
				}
			}

			imageCanvas.width = width * dspScale;
			imageCanvas.height =  height * dspScale;
			imagrCtx = imageCanvas.getContext('2d');
			imagrCtx.drawImage(image, 0, 0, image.width, image.height, 0, 0, imageCanvas.width, imageCanvas.height);
			
			canvas.width =  width * dspScale;
			canvas.height =  height * dspScale;
			canvas.setAttribute('id', 'photo');
	    	ctx.clearRect(0, 0, canvas.width, canvas.height);
			ctx.fillStyle = "white";
			ctx.fillRect(0,0, canvas.width, canvas.height);
			ctx.translate(0, 63);
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
    	ctx.drawImage(imageCanvas, dragDiffX, dragDiffY);

    	ctx.scale(1 / scale, 1 / scale);
    	if (frameImage !== null) {
			x = Math.ceil(canvas.width / 2) - Math.ceil(frameWidth / 2);
			y = Math.ceil(canvas.height / 2) - Math.ceil(frameHeight / 2);
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
			sx = Math.ceil(canvas.width / 2) - Math.ceil(frameWidth / 2);
			sy = Math.ceil(canvas.height / 2) - Math.ceil(frameHeight / 2) + 63;
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
			dx = 55;
			dy = 127;
			dw = 387;
			dh = 415;
			ctx.drawImage(wcanvas, 0, 0, wcanvas.width, wcanvas.height, dx, dy, dw, dh);
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
			sx = Math.ceil(canvas.width / 2) - Math.ceil(frameWidth / 2);
			sy = Math.ceil(canvas.height / 2) - Math.ceil(frameHeight / 2) + 63;
			dx = 55;
			dy = 127;
			dw = 387;
			dh = 415;
	    	ctx.drawImage(canvas, sx, sy, frameWidth, frameHeight, dx, dy, dw, dh);
	    	data = pcanvas.toDataURL('image/png');
	    	$('#whiteImage').attr('src', data);
    	}
	}

	function trimPhoto() {
		width = image.width;
		height = image.height;
		if (height > width) {
			if (width < printFrameWidth) {
				r = printFrameWidth / width;
				width = width * r * 2;
				height = height * r * 2;
			} else {
				width *= 1.5;
				height *= 1.5;
			}
		} else {
			if (height < printFrameHeight) {
				r = printFrameHeight / height;
				width = width * r * 2;
				height = height * r * 2;
			} else {
				width *= 1.5;
				height *= 1.5;
			}
		}
		dspScale =  printFrameWidth / frameWidth;

    	canvas = document.createElement('canvas');
		canvas.width = width;
		canvas.height =  height;
    	ctx = canvas.getContext('2d');

		ctx.clearRect(0, 0, canvas.width, canvas.height);
        px = dragDiffX * dspScale;
        py = dragDiffY * dspScale;
		ctx.scale(scale, scale);
    	ctx.drawImage(image, 0, 0, image.width, image.height, px, py, width, height);
//    	ctx.drawImage(image, 0, 0, image.width, image.height, px, py, canvas.width, canvas.height);
    	ctx.scale(1 / scale, 1 / scale);

    	pcanvas = document.createElement('canvas');
		pcanvas.width = printFrameWidth;
		pcanvas.height = printFrameHeight;
    	pctx = pcanvas.getContext('2d');
		fx = (width / 2) - (printFrameWidth / 2);
        fy = (height / 2) - (printFrameHeight / 2);
		pctx.drawImage(canvas, fx, fy, printFrameWidth, printFrameHeight, 0, 0, printFrameWidth, printFrameHeight);
		return pcanvas.toDataURL("image/jpeg");
	}
});