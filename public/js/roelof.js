var url = '/';

$(document).ready(function () {
    var scroll_start = 0;
    var startchange = $('#home');
    var offset = startchange.offset();
    $(document).scroll(function () {
        scroll_start = $(this).scrollTop();
        if (scroll_start > offset.top) {
            $('.navbar-roelof').css('background-color', 'rgba(44, 62, 80,1.0)');
        } else {
            $('.navbar-roelof').css('background-color', 'transparent');
        }
    });
});

$('a').click(function () {
    $('html, body').animate({
        scrollTop: $($(this).attr('href')).offset().top
    }, 500);
    return false;
});

jQuery(function ($) {
    $('.element').responsiveEqualHeightGrid();
});

var sections = $('.section')
        , nav = $('.nav')
        , nav_height = nav.outerHeight();

$(window).on('scroll', function () {
    var cur_pos = $(this).scrollTop();

    sections.each(function () {
        var top = $(this).offset().top - nav_height,
                bottom = top + $(this).outerHeight();

        if (cur_pos >= top && cur_pos <= bottom) {
            nav.find('a').removeClass('active');
            sections.removeClass('active');

            $(this).addClass('active');
            nav.find('a[href="#' + $(this).attr('id') + '"]').addClass('active');
        }
    });
});

$('.anim').on('click', function () {
    var $btn = $(this).button('loading');
});

function confirm(id, request) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to reverse this action!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        $.ajax({
            url: url+'Process.php',
            type: 'POST',
            data: {'request': request, 'request_id':id},
            success: function() {
                $('#' + id).hide();
                swal({
                    title: "Deleted!",
                    text: "The item has been deleted.",
                    timer: 1000,
                    type: "success"
                });
            }
        });
    });
}

$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    if(numFiles > 1) {
        $('#work-upload').val(numFiles + ' selected');
    } else {
        $('#work-upload').val(label);
    }
});


