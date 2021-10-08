jQuery(function($) {
    var ids = JSON.parse(localStorage.getItem('oshiBasket'));
    if (ids !== null) {
        if (ids.length == 0) {
            $('#badge').text('');
        } else {
            $('#badge').text(ids.length);
        }
    }
});    