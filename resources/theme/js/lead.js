$('#google-sheet').submit(function (e) {
    e.preventDefault();

    var status = true;

    $(".name-err").html("");
    $(".msg-err").html("");
    $(".email-err").html("");
    $(".phone-err").html("");
    $(".city-err").html("");
    $(".age-err").html("");
    $(".appointment-err").html("");


    if (!$("input[name='name']").val()) {
        change_placeholder_color('.name-cls', 'red', 'Please enter name!');
        // $(".name-err").html("Please enter name").css("color", 'red');
        status = false;
    }

    if (!$("input[name='age']").val()) {
        change_placeholder_color('.age-cls', 'red', 'Please enter age!');
        // $(".age-err").html("Please enter age").css("color", 'red');
        status = false;
    }

    if (!$("input[name='email']").val()) {
        change_placeholder_color('.email-cls', 'red', 'Please enter email!');
        // $(".email-err").html("Please enter email").css("color", 'red');
        status = false;
    } else if (!isEmail($("input[name='email']").val())) {
        $("input[name='email']").val("");
        change_placeholder_color('.email-cls', 'red', 'Please enter an correct email!');
        // $(".email-err").html("Please enter an correct email").css("color", 'red');
        status = false;
    }

    if (!$("input[name='phone']").val()) {
        change_placeholder_color('.phone-cls', 'red', 'Please enter phone number!');
        // $(".phone-err").html("Please enter phone number").css("color", 'red');
        status = false;
    }

    if (!$("textarea[name='message']").val()) {
        change_placeholder_color('.message-cls', 'red', 'Please enter messages!');
        // $(".msg-err").html("Please enter messages").css("color", 'red');
        status = false;
    } else {
        var form_msg = $("textarea[name='message']").val();
        form_msg = form_msg.replace(/(?:(?:\r\n|\r|\n)\s*){2}/gm, "");
        form_msg = form_msg.replace(/(\r\n|\n|\r)/gm, "");
        $("textarea[name='message']").val(form_msg);
    }

    if ($("input[name='avoid_loc']").val() != 1) {
        if (!$('#city').find(":selected").val()) {
            $(".city-err").html("Please select city").css("color", 'red');
            status = false;
        }
    }

    if (!$('#appointment_for').find(":selected").val()) {
        $(".appointment-err").html("Please select an appointment").css("color", 'red');
        status = false;
    }

    if (grecaptcha.getResponse() == "") {
        $(".captcha-err").html("Please verify captcha").css("color", 'red');
        status = false;
    } else {
        $(".captcha-err").html('');
    }

    if (status) {

        const scriptURL = 'https://script.google.com/macros/s/AKfycbxY8wSXDUVWtsc58x2RqbumZxK-hlJX8hIyrlknhBj7ukFyZwT7Knm6HsH2aGLIIEpq/exec'
        const form = document.forms['google-sheet']

        fetch(scriptURL, {
            method: 'POST',
            body: new FormData(form)
        })
            .then(response => console.log('Form is successfully submitted'))
            .catch(error => console.error('Error!', error.message))

        // code
        $.ajax({
            url: lead_form_path,
            type: 'post',
            data: {
                form_data: $('#google-sheet').serialize(),
                "_token": csrf_token,
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status) {
                    $('#google-sheet')[0].reset();
                    grecaptcha.reset();

                    change_placeholder_color('.name-cls', 'initial', 'Patient s Name*');
                    change_placeholder_color('.age-cls', 'initial', 'Age in Years*');
                    change_placeholder_color('.email-cls', 'initial', 'Email Address*');
                    change_placeholder_color('.phone-cls', 'initial', 'Phone Number*');
                    change_placeholder_color('.message-cls', 'initial', 'Message*');

                    $('.sidebar-form .call-action').trigger("click");

                    $('#popup').modal('show');

                    setTimeout(function () {
                        $('#popup').modal('hide');

                        var url_arr = window.location.href.split('?');
                        url_arr.pop();
                        window.location.replace(url_arr[0]);
                    }, 4000);
                } else {
                    alert("Failed to send email.")
                }
            }
        });
        // code
    }

});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

(function ($) {
    $.fn.inputFilter = function (callback, errMsg) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function (e) {
            if (callback(this.value)) {
                // Accepted value
                if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                    $(this).removeClass("input-error");
                    this.setCustomValidity("");
                }
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                // Rejected value - restore the previous one
                $(this).addClass("input-error");
                this.setCustomValidity(errMsg);
                this.reportValidity();
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                // Rejected value - nothing to restore
                this.value = "";
            }
        });
    };
}(jQuery));

$("input[name='age']").inputFilter(function (value) {
    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
}, "Only digits allowed");

function change_placeholder_color(target_class, color_choice, msg) {
    $("body").append("<style>" + target_class + "::placeholder{color:" + color_choice + "}</style>");
    $(target_class).attr("placeholder", msg);
}