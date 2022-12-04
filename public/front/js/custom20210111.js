jQuery(function($) {
    feather.replace();
    setTimeout(function() {
        //$('#stagepadding1 .owl-nav .owl-next').addClass('disabledset');
        //$('#stagepadding1 .owl-nav .owl-prev').addClass('disabledset');
        $('#stagepadding1 .owl-nav .owl-next,#stagepadding1 .owl-nav .owl-prev').append('<span class="disabledset"></span>');

    }, 1000);
    $('body').on('click', '#stagepadding1 .owl-nav .disabledset', function() {
        $(this).parents('.col-lg-9').addClass('full_width');
        $(this).parents('.col-lg-9').prev('.col-lg-3').addClass('zero_width');
        setTimeout(function() {
            $('#stagepadding1').owlCarousel('destroy');
            $('#stagepadding1').owlCarousel({
                margin: 20,
                loop: false,
                stagePadding: 70,
                nav: true,
                dots: false,
                navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                    },
                    575: {
                        items: 2,
                    },
                    1000: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    }
                }
            });
            $('#stagepadding1 .owl-nav button').append('<span class="disabledset_full"></span>');;
        }, 500);
    });

    $('body').on('click', '#stagepadding1 .owl-nav .disabled span.disabledset_full', function() {
        $(this).parents('.col-lg-9').removeClass('full_width');
        $(this).parents('.col-lg-9').prev('.col-lg-3').removeClass('zero_width');
        setTimeout(function() {
            $('#stagepadding1').owlCarousel('destroy');

            $('#stagepadding1').owlCarousel({
                margin: 20,
                loop: false,
                stagePadding: 70,
                nav: true,
                dots: false,
                navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                    },
                    575: {
                        items: 2,
                    },
                    1000: {
                        items: 3,
                    }
                }
            });
            $('#stagepadding1 .owl-nav button').append('<span class="disabledset"></span>');
        }, 500);
    });

    $('#owl_slideshow').owlCarousel({
        margin: 0,
        loop: true,
        items: 1,
        nav: true,
        dots: false,
        navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>']
    });



    $('#stagepadding1,#todaysDeal,#weeklydeals,#monthdeals,#similarProd,#RecentlyViewed').owlCarousel({
        margin: 20,
        loop: false,
        items: 3,
        stagePadding: 70,
        nav: true,
        dots: false,
        navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            575: {
                items: 2,
            },
            1000: {
                items: 3,
            }
        }
    });


    $('#boughtTogther').owlCarousel({
        margin: 25,
        loop: false,
        nav: true,
        dots: false,
        navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            575: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });

    $('#small-images-carousel').owlCarousel({
        margin: 25,
        loop: false,
        nav: true,
        dots: false,
        navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>'],
        responsive: {
            0: {
                items: 2,
            },
            575: {
                items: 3,
            },
            768: {
                items: 4,
            },
            1200: {
                items: 5,
            }
        }
    });

    $('#toprated').owlCarousel({
        margin: 20,
        loop: false,
        items: 3,
        stagePadding: 32,
        nav: true,
        dots: false,
        navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            575: {
                items: 2,
            },
            1000: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });


    $('#continueleft').owlCarousel({
        margin: 20,
        loop: false,
        items: 3,
        stagePadding: 100,
        nav: true,
        dots: false,
        navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            575: {
                items: 2,
            },
            1000: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });






    $('#category_list,#bestseller,#justlaunched,#earlysale,#toppicks').owlCarousel({
        margin: 15,
        loop: false,
        nav: true,
        dots: false,
        navText: ['<i class="gg-chevron-left"></i>', '<i class="gg-chevron-right"></i>'],
        responsive: {
            0: {
                items: 2,
            },
            575: {
                items: 3,
            },
            1000: {
                items: 5,
            },
            1200: {
                items: 6,
                margin: 30,
            }
        }
    });


    $('.see_all').click(function(e) {
        e.preventDefault();
        $(this).prev('.see_more_toggle').slideToggle();
        $(this).text()
        if ($(this).text() == "SEE ALL") {
            $(this).text("SEE LESS");
        } else {
            $(this).text("SEE ALL");
        }
    });

    $('.aside_toggle').click(function() {
        $('#product_aside_bar').toggleClass('active');
    });
    $('.close_aside_toggle').click(function() {
        $('#product_aside_bar').removeClass('active');
    });

    $('.grid_filter').click(function() {
        $('.product_wrapper').removeClass('product_list');
        $('.product_wrapper').addClass('product_grid');
        $('.view_filter .active').removeClass('active');
        $(this).addClass('active');
    });
    $('.list_filter').click(function() {
        $('.product_wrapper').removeClass('product_grid');
        $('.product_wrapper').addClass('product_list');
        $('.view_filter .active').removeClass('active');
        $(this).addClass('active');
    });




    $(".toggle-password").on('click', function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var saveattr = $('#exampleInputPassword1').attr('type');
        if (saveattr == 'password') {
            $('#exampleInputPassword1').attr('type', 'text');
        } else {
            $('#exampleInputPassword1').attr('type', 'password');
        }
    });

    $('.smallimage_list').click(function() {
        var datasrc = $(this).attr('data-src');
        var dataid = $(this).attr('data-id');
        $('.big_image img').attr('src', datasrc).attr('data-id', dataid);
    });
    $('.big_image').click(function() {
        var dataid = $(this).find('img').attr('data-id');
        $('.lightbox_gallery a[data-id="' + dataid + '"]').trigger('click');
    });



    var shareButtons = document.querySelectorAll(".share-btn");

    if (shareButtons) {
        [].forEach.call(shareButtons, function(button) {
            button.addEventListener("click", function(event) {
                var width = 650,
                    height = 450;

                event.preventDefault();

                window.open(this.href, 'Share Dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=' + width + ',height=' + height + ',top=' + (screen.height / 2 - height / 2) + ',left=' + (screen.width / 2 - width / 2));
            });
        });
    }


    $('.add').click(function() {
        var th = $(this).closest('.wrap').find('.count');
        th.val(+th.val() + 1);
    });
    $('.sub').click(function() {
        var th = $(this).closest('.wrap').find('.count');
        if (th.val() > 1) th.val(+th.val() - 1);
    });
    addonPrices();

    function addonPrices() {
        var totalPrice = 0;
        $('.addon_prod_count').empty();
        var i = 0;
        $('.products_unit>[type="checkbox"]:checked').each(function() {
            i++;
            $('.addon_prod_count').parent().removeClass('d-none');
            var savePrice = $(this).parent().find('.p_price').text();
            totalPrice += Number(savePrice);
            $('.addon_prod_count').append('<div class="addon text-center"> <span class="ft-10 text-light">' + i + ' Add-on</span> <p class="addon_price ft-20 lh-30 ft-medium text-black">£' + savePrice + '</p> </div>');
        });
        totalPrice = totalPrice.toFixed(2);
        $('.addon_prod_count').append('<div class="addon_equalto text-center"> <span class="ft-10 text-light">Total</span> <p class="addon_price ft-20 lh-30 ft-medium text-black">£' + totalPrice + '</p> </div>');
        if (totalPrice == 0) {
            $('.addon_prod_count').parent().addClass('d-none');
        }
    }

    $('.products_unit>[type="checkbox"]').click(function() {
        addonPrices();
    });








    $('.rating').each(function() {
        var ratingContent = $(this).text();
        var ratingScore = parseInt((ratingContent / 5) * (100));
        $(this).css('background', 'conic-gradient(#EB5673 ' + ratingScore + '%, #DEDEDE 0 100%)');
        $(this).html('<span>' + ratingContent + '</span>');
    });

    /*
        const ratings = document.querySelectorAll(".rating");

        // Iterate over all rating items

        ratings.forEach((rating) => {
            // Get content and get score as an int
            const ratingContent = rating.innerHTML;
            const ratingScore = parseInt((ratingContent / 5) * (100));

            // Define if the score is good, meh or bad according to its value
            const scoreClass =
                ratingScore < 40 ? "bad" : ratingScore < 60 ? "meh" : "good";

            // Add score class to the rating
            rating.classList.add(scoreClass);

            // After adding the class, get its color
            const ratingColor = window.getComputedStyle(rating).backgroundColor;

            // Define the background gradient according to the score and color
            const gradient = `background: conic-gradient(${ratingColor} ${ratingScore}%, #DEDEDE 0 100%)`;

            // Set the gradient as the rating background
            rating.setAttribute("style", gradient);

            // Wrap the content in a tag to show it above the pseudo element that masks the bar
            rating.innerHTML = `<span>${ratingContent}</span>`;
        });


    */



    $('.view_answer_set_btn').click(function() {
        $(this).parents('.question_answer').find('.remaning_answer_set').slideToggle();
        $(this).find('i').toggleClass('fa-caret-down fa-caret-up');
    });



    $('.ratings_progress').each(function() {
        var ratingContent = $(this).attr('data-rating');
        var ratingScore = parseInt((ratingContent / 5) * (100));
        ratingScore = ratingScore / 100;
        ratingScore = 100 - (ratingScore * 100);
        $(this).parent('.svg_cntr').append('<span>' + ratingContent + '</span>');
        $(this).find(".js-progress-bar").css("stroke-dashoffset", ratingScore);

    });







});