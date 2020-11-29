$(document).ready(function () {
    var judul = document.getElementById('judul-header');
    var img = document.getElementById('img-header');
    judul.style.opacity = '1';
    img.style.opacity = '1';

    $(window).scroll(function () {
        $('#buku-info').each(function () {
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            if (bottom_of_window > bottom_of_object) {
                $('#buku-info').animate({
                    'opacity': '1'
                }, 500);                
            }
        });
        $('#anggota-info').each(function () {
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            if (bottom_of_window > bottom_of_object) {
                setTimeout(function () {
                    $('#anggota-info').animate({
                        'opacity': '1'
                    }, 1000);
                }, 500);
            }
        });
        $('#pengunjung-info').each(function () {
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            if (bottom_of_window > bottom_of_object) {
                setTimeout(function () {
                    $('#pengunjung-info').animate({
                        'opacity': '1'
                    }, 1000);
                }, 600);
            }
        });
    });
});