jQuery(function($) {
    var canvas = document.createElement('canvas');
    var loadFLg = false;

    $('.delete').click(function()　{
        var target = $(this).data('basketid');
        let url = 'removeBasket';
        var data = {
            id: target
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            datatype: 'json',
			contentType: "application/json",
			data: JSON.stringify(data),
            url: url
        })
        .done(function(data){
            if (data.status === 'OK') {
                var ids = JSON.parse(localStorage.getItem('oshiBasket'));
                newlist = ids.filter(function( value ) {
                    return value != target;
                });
                $('#item'+target).remove();
				localStorage.setItem('oshiBasket', JSON.stringify(newlist));
                if (newlist.length == 0) {
                    $('#badge').text('');
                    $("#buy").setAttribute("disabled", true);
                } else {
                    $('#badge').text(newlist.length);
                }
                resetTotal()
            }
        })
        .fail(function(data){
        });        
    });
    
    function resetTotal() {
        var ids = JSON.parse(localStorage.getItem('oshiBasket'));
        if (ids.length == 0) {
            $('#shipping').text('');
            $('#total-amount').text('');
            $('#pay-amount').text('');
            $('#tax').text('');
            return;
        }
        var param = {};
        param['ids'] = ids;
        let url = 'getBaskets';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            datatype: 'json',
			contentType: "application/json",
			data: JSON.stringify(param),
            url: url
        })
        .done(function(data){
            if (data.status === 'OK') {
                setTotal(data.baskets);
			}
        })
        .fail(function(data){
        });
    }
    
    function createItem(item) {
        loadFLg = true;
        var uri = item.photo_uri;
        var uriParts = uri.split(",");
        var fileContent = uriParts[1];
        var binary = atob(fileContent);
        var bytes = new Uint8Array(binary.length);
        for (var i = 0; i < binary.length; i++) {
            bytes[i] = binary.charCodeAt(i)
        }
        var file = new File([bytes], item.photo_name, {type: item.photo_type});

        let clone = $('#item').clone(true);
        var num = 0;
        $.each(item.beans, function() {
            num += Number(this);
        })
        clone.show();
        clone.find('.delete').data('basketid', item.id);
        var frameEl = clone.find('#frame');

        handleFiles(file, item, frameEl);
        clone.attr('id', 'item'+item.id);
        setItem(item, clone);
        $('#item').before(clone);
    }

    function setItem(item, basket) {
        const formatter = new Intl.NumberFormat();
        $.each(item.beans, function() {
            if (this.bean.kind == 0) {
                drip = basket.find('#drip');
                clone = drip.find("#item-tbl").clone();
                clone.find("#name").text(this.bean.name);
                clone.find("#num").text(formatter.format(this.number)+'個');
                var amount = 200 * this.number;
                clone.find("#amount").html(formatter.format(amount)+'<span class="fz-14">円</span>');
                clone.attr('id', '');
                drip.find("#item-tbl").before(clone);
                clone.show();
                drip.show();
            }
        })
        $.each(item.beans, function() {
            if (this.bean.kind == 1) {
                coffee = basket.find('#coffee');
                clone = coffee.find("#item-tbl").clone();
                clone.find("#name").text(this.bean.name);
                clone.find("#num").text(formatter.format(this.number)+'個');
                var amount = 200 * this.number
                clone.find("#amount").html(formatter.format(amount)+'<span class="fz-14">円</span>');
                $('#item-tbl').before(clone);
                clone.attr('id', '');
                coffee.find("#item-tbl").before(clone);
                clone.show();
                coffee.show();
            }
        })
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
			if (width < item.image_frameWidth) {
				width = item.image_frameWidth;
			}
			if (height < item.image_frameHeight) {
				height = item.image_frameHeight + 200;
			}
			canvas.setAttribute('width' , width);
			canvas.setAttribute('height', height);
	    	ctx.clearRect(0, 0, canvas.width, canvas.height);
			ctx.fillStyle = "white";
			ctx.fillRect(0,0, canvas.width, canvas.height);

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
		frameImage.width = item.image_frameWidth;
		frameImage.height = item.image_frameHeight;
    	frameImage.onload = function() {
            console.log('Frame loaded');
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
        canvas.setAttribute('width' , item.image_frameWidth);
        canvas.setAttribute('height', item.image_frameHeight);
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    	ctx.drawImage(image, 0, 0, image.width, image.height, 0, 0, canvas.width, canvas.height);

    	if (frameImage !== null) {
	    	ctx.drawImage(frameImage, 0, 0, item.image_frameWidth, item.image_frameHeight);
    	}
        data = canvas.toDataURL('image/png');

        return data;
	}

    function setTotal(basket) {
        if (basket.length == 0) {
            $('#shipping').text('');
            $('#total-amount').text('');
            $('#pay-amount').text('');
            $('#tax').text('');
            return;
        }
        var amount = 200;
        var totalAmount = 0;
        var totalNum = 0;
        var shipping = 0;
        var tax = 0;
        const formatter = new Intl.NumberFormat();
        $.each(basket, function() {
            $.each(this.beans, function() {
                totalNum += this.number;
            });
        });
        totalAmount = amount * totalNum;
        tax = totalAmount - Math.floor(totalAmount / 1.08);
        if (totalNum < 10) {
            shipping = 300;
            $('#shipping').text(formatter.format(shipping)+'円');
        } else {
            $('#shipping').text('無料');
        }
        $('#total-amount').text(formatter.format(totalAmount));
        $('#pay-amount').text(formatter.format(totalAmount+shipping));
        $('#tax').text(formatter.format(tax));        

    }

    function getBasket() {
        var ids = JSON.parse(localStorage.getItem('oshiBasket'));
        if (ids.length == null) {
            $("#buy").setAttribute("disabled", true);
        } else {
            if (ids.length == 0) {
                $("#buy").setAttribute("disabled", true);
            }
        }


        var param = {};
        param['ids'] = ids;
        let url = 'getBaskets';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            datatype: 'json',
			contentType: "application/json",
			data: JSON.stringify(param),
            url: url
        })
        .done(function(data){
            if (data.status === 'OK') {
                console.dir(data.baskets);
                $.each(data.baskets, function() {
                    var item = this;
                    var timer = setInterval(function(){
                        if (!loadFLg) {
                            clearInterval(timer);
                            createItem(item);
                        }
                     }, 50)
                })
                setTotal(data.baskets);
			}
        })
        .fail(function(data){
        });        

    }
    getBasket();
});