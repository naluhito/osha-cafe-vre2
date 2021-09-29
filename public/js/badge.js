jQuery(function($) {
    var ids = JSON.parse(localStorage.getItem('oshiBasket'));
    $('#badge').text(ids.length);
});    