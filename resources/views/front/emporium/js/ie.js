jQuery(function($) {
    $('.accordion-button').click(function() {
        var saveattr = $(this).attr('aria-expanded');
        if (saveattr == 'true') {
            $(this).attr('aria-expanded', false);
        } else {
            $(this).attr('aria-expanded', true);
        }
        var savehref = $(this).attr('data-bs-target');
        $(savehref).slideToggle();
    });

    $('#loginTab .nav-item button').click(function() {
        var saveId = $(this).attr('id');
        $('#loginTab .nav-item button').removeClass('active');
        $(this).addClass('active');
        $(this).parents().find('[aria-labelledby]').removeClass('active show');
        $('[aria-labelledby="' + saveId + '"]').addClass('active show');
    });



});