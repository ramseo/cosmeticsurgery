$(document).on('click', '.displayPassword', function () {
    var inputType = $(this).parents('.password-container').find('input').attr('type');
    if (inputType == 'password') {
        $(this).parents('.password-container').find('input').attr('type', 'text');
        $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
    } else {
        $(this).parents('.password-container').find('input').attr('type', 'password');
        $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>');
    }
});


$(document).on('click', '.album-cls', function () {
    $('html,body').animate({
        scrollTop: $(".new-div").offset().top - 100
    }, 'slow');
});

$(document).on('click', '.price-arrow-down', function () {
    $('html,body').animate({
        scrollTop: $(".pricing-col").offset().top - 100
    }, 'slow');
});

$(document).on('click', '.rating-scroll-event', function () {
    $('html,body').animate({
        scrollTop: $(".detail-review-header").offset().top - 140
    }, 'slow');
});

function copyLinkText(GfGInput) {
    /* Get the text field */
    var copyGfGText = document.getElementById(GfGInput);

    /* Select the text field */
    copyGfGText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    // change text
    $("#text-copy-btn").html("Copied!");
    setTimeout(function () {
        $("#shareModal").modal("hide");
        $("#text-copy-btn").html("Copy Link");
    }, 1000)
}

$(document).on('click', '.show-more-reviews', function () {
    $('.detail-review-body .single-review').css("display", 'block');
    $('.show-more-reviews').hide();
});

$(document).ready(function () {
    var totalReviews = $('.detail-review-body .single-review').length;
    if (totalReviews > 3) {
        $('.show-more-reviews').show();
    } else {
        $('.show-more-reviews').hide();
    }

    var showReviews = $('.detail-review-body .rev-mor-cls').length;
    $('.show-more-reviews').html("Show More" + " " + showReviews + " " + "Reviews");
})


// read more less code
var showChar = 250;
var ellipsestext = "...";
var moretext = "Read More";
var lesstext = "Read Less";
$('.more-content-cls').each(function () {
    var content = $(this).html();

    if (content.length > showChar) {
        console.log('fff');
        var c = content.substr(0, showChar);
        var h = content.substr(showChar - 1, content.length - showChar);

        var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

        $(this).html(html);
    }

});

$(document).on('click', '.morelink', function () {
    if ($(this).hasClass("less")) {
        $(this).removeClass("less");
        $(this).html(moretext);
    } else {
        $(this).addClass("less");
        $(this).html(lesstext);
    }
    $(this).parent().prev().toggle();
    $(this).prev().toggle();
    return false;
});
// read more less code


var timeout;

$(window).scroll(function () {
    if (typeof timeout == "number") {
        window.clearTimeout(timeout);
        delete timeout;
    }
    timeout = window.setTimeout(check, 100);
});

function check() {
    if (($(window).scrollTop() + $(window).height()) >= ($('body').height() * 0.7)) {
        // alert('Call me!')
        button_scroll();
    } else {
        $("#button-scroll").hide();
    }
}

function button_scroll() {
    $("#button-scroll").show();

    const goblogFreeBtnTop = document.getElementById("button-scroll");
    if (goblogFreeBtnTop) {
        goblogFreeBtnTop.addEventListener('click', () => window.scrollTo({
            top: 0.1,
            behavior: 'smooth',
        }));
    }
}

$(document).on('click', '#filter-validation', function (event) {
    var typeFilter = $('#typeFilter').find(":selected").val();
    var cityFilter = $('#cityFilter').find(":selected").val();

    if (typeFilter == 0) {
        alert("Please Select Category!");
        event.preventDefault();
    }

    if (cityFilter == 0) {
        alert("Please Select City!");
        event.preventDefault();
    }

});

$(document).on("click", "#eliminate-val-error", function () {
    $('.reviewAlert').hide();
});

$(document).on("click", '.show_reply_popup', function () {
    var review_id = $(this).attr("review_id");
    $("#update_review_id").val(review_id);

    $("#replyModal").modal("show");
})


$(document).on('click', '.del-link', function (e) {
    var answer = confirm('Are you sure?');
    if (answer) {
        // Proceed
    } else {
        e.preventDefault();
    }
});


function eliminate_active_cls(id) {
    console.log(id);
    $(id).removeClass("active");
    $($(id).parent()).removeClass("active");
    $('.all_content').removeClass("active in");
}


$('.accordion-toggle').on('click', function (event) {
    event.preventDefault();
    // create accordion variables
    var accordion = $(this);
    var accordionContent = accordion.next('.accordion-content');

    // toggle accordion link open class
    accordion.toggleClass("open");
    // toggle accordion content
    accordionContent.slideToggle(250);
});


function accordion_elm(elm) {
    var cls = $(elm).attr("class");
    var icon = $(elm).children().children();

    if (cls == "accordion-toggle") {
        $(icon).removeClass("fa fa-chevron-down");
        $(icon).addClass("fa fa-chevron-up");
    } else {
        $(icon).removeClass("fa fa-chevron-up");
        $(icon).addClass("fa fa-chevron-down");
    }
}


$(function () {
    var url = window.location.pathname;
    urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");

    if (url != "/procedures") {
        // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('#desktop-header-menu li a').each(function () {
            // and test its normalized href against the url pathname regexp
            if (window.location.href != base_url) {
                if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                    $(this).addClass('active');

                    var parent_cls = $(this).parent().attr("class");
                    if (parent_cls == "dropdown-menu") {
                        var main_parent = $(this).parent().parent();
                        var target_item = $(main_parent).children('a');
                        $(target_item).css({
                            'color': '#1877F2',
                            'font-weight': '600'
                        });
                    }
                }
            } else {
                $('.home-item-active-cls').addClass("active");
            }
        });
    }

});


$(document).on('click', '#fa-bars', function () {
    if (!$('#navbarSupportedContent').hasClass("show")) {
        $('#fa-bars').attr("class", "fa fa-times");
    } else {
        $('#fa-bars').attr("class", "fa fa-bars");
    }
});

$(document).on('click', '.remove-default-active-cls', function () {
    $('.default-active-cls').removeClass("active active in");
});

$(document).on('change', '.sel-open-next', function () {
    if (this.value) {
        window.open(this.value, '_blank');
    }
});


$(document).on('change', '#surgeon-filter', function () {
    var attr = $(this).attr("attr");
    callAjax(this.value, attr);
});

$(document).on('click', '#sort-by-asc-des', function () {
    $('#surgeon-filter').prop('selectedIndex', 0);

    var asc_desc = $(this).attr("attr");
    var cost = $(this).attr("page-attr");
    if (asc_desc == "desc") {
        $("#sort-by-asc-des").attr("attr", "asc");
        $("#sort-by-asc-des").html("Click To Sort By Ascending Order").css({ 'background': 'darkgrey', 'color': 'white' });
    } else {
        $("#sort-by-asc-des").attr("attr", "desc");
        $("#sort-by-asc-des").html("Click To Sort By Descending Order").css({ 'background': 'white', 'color': '#0056b3' });
    }

    callAjax(asc_desc, cost);
});

function callAjax(val, attr) {
    $.ajax({
        url: surgeons_filter_path,
        type: 'post',
        data: {
            value: val,
            attr: attr,
            "_token": csrf_token,
        },
        dataType: 'json',
        success: function (response) {
            $("#ajax-surgeons").html(response.html);
        }
    });
}

$(window).scroll(function (event) {
    var scroll = $(window).scrollTop();
    console.log(scroll);

    if (scroll >= 67) {
        $(".sidebar-menu").addClass("surgeons-fixed-sidebar");
    } else {
        $(".sidebar-menu").removeClass("surgeons-fixed-sidebar");
    }
});

$(document).on('mouseover mouseleave', '.main-child-cls', function (e) {
    var elm = $(this).children();
    var next_elm = $(elm).next(".drop-down-child");

    var width = $(this).width();
    $(next_elm).css({ "left": width + "px" });

    if (e.type === 'mouseover') {
        $(next_elm).show();
    } else {
        $(next_elm).hide();
    }
});
