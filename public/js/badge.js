jQuery(function($) {
    var ids = JSON.parse(localStorage.getItem('oshiBasket'));
    if (ids !== null) {
        $('#badge').text(ids.length);
    }
});    