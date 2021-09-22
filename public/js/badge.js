jQuery(function($) {
    var ids = JSON.parse(localStorage.getItem('oshiBasket'));
    console.log(ids.length);
    $('#badge').text(ids.length);
});    