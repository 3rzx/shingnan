$(document).ready(function() {
    $('tbody').on("click", ".btn-warning",function(e) {
        e.preventDefault();
        var index = $('.btn-warning').index(this);
        $('.collapse').eq(index).toggle();
    });
});