$(document).ready(function () {

    // initialize the plugin for login-form
    $('#login-form').validate( {
        rules: {
            log_username: {
                required: true,
                minlength: 6,
                maxlength: 40
            },
            log_password: {
                required: true,
                minlength: 6,
                maxlength: 30
            }
        }
    });

    // initialize the plugin for register-form
    $('#register-form').validate( {
        rules: {
            reg_username: {
                required: true,
                minlength: 6,
                maxlength: 40
            },
            reg_password: {
                required: true,
                minlength: 6,
                maxlength: 30
            },
            reg_repassword: {
                required: true,
                equalTo: "#reg_password",
                minlength: 6,
                maxlength: 30
            },
            reg_email: {
                required: true,
                email: true,
                maxlength: 125
            }
        }
    });

    // initialize the plugin for forgot-form
    $('#forgot-form').validate( {
        rules: {
            for_email: {
                required: true,
                email: true,
                maxlength: 125
            }
        }
    });

    // initialize the plugin for pchange-form
    $('#pchange-form').validate( {
        rules: {
            pch_password: {
                required: true,
                minlength: 6,
                maxlength: 30
            },
            pch_repassword: {
                required: true,
                equalTo: "#pch_password",
                minlength: 6,
                maxlength: 30
            }
        }
    });

    // initialize the plugin for add-book-form
    $('#add-book-form').validate( {
        rules: {
            adb_title: {
                required: true,
                maxlength: 125
            },
            adb_auth_first: {
                required: true,
                maxlength: 45
            },
            adb_auth_last: {
                required: true,
                maxlength: 45
            },
            adb_publisher: {
                required: true,
                maxlength: 50
            },
            adb_isbn: {
                required: true,
                maxlength: 13
            }
        }
    });

    // initialize the plugin for add-book-form
    $('#del-book-form').validate( {
        rules: {
            del_id: {
                required: true,
                number: true
            }
        }
    });
});