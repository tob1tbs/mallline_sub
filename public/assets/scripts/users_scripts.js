function UserSignUpSubmit() {
	var form = $('#user_signUp')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/user/ajax/sign-up",
        type: "POST",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
             	toastr.success('თქვენ წარმატებით გაიარეთ რეგისტრაცია!');
                window.location.href = data['redirect_url'];
            } else {
                toastr.options = {
                  "closeButton": true,
                  "positionClass": "toast-bottom-right",
                }
                $(".check-input").removeClass('input-error');
             	$.each(data['message'], function(key, value) {
                    $('#'+key).addClass('input-error');
                    toastr.warning(value);
                })
            }
        }
    });
}

function UserSignInSubmit() {
	var form = $('#user_signIn')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/user/ajax/sign-in",
        type: "POST",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                if(data['errors'] == true) {
                    toastr.options = {
                      "closeButton": true,
                      "positionClass": "toast-bottom-right",
                    }
                    toastr.warning(data['message'][0]);
                } else {
                    location.reload();
                }
            }
        }
    });
}

function UserSignInSubmitPage() {
    var form = $('#user_signInPage')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/user/ajax/sign-in",
        type: "POST",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                if(data['errors'] == true) {
                    toastr.options = {
                      "closeButton": true,
                      "positionClass": "toast-bottom-right",
                    }
                    toastr.warning(data['message'][0]);
                } else {
                    location.reload();
                }
            }
        }
    });
}

function UserUpdateSubmit() {
    var form = $('#user_update')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/user/ajax/update",
        type: "POST",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                toastr.success('პროფილი წარმატებით დარედაქტირდა');
            } else {
                toastr.options = {
                  "closeButton": true,
                  "positionClass": "toast-bottom-right",
                }
                $(".check-input").removeClass('input-error');
                $.each(data['message'], function(key, value) {
                    $('#'+key).addClass('input-error');
                    toastr.warning(value);
                })
            }
        }
    });
}

function UserUpdatePasswordSubmit() {
    var form = $('#user_update_password')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/user/ajax/updatePassword",
        type: "POST",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                toastr.success('პროფილი წარმატებით დარედაქტირდა');
            } else {
                toastr.options = {
                  "closeButton": true,
                  "positionClass": "toast-bottom-right",
                }
                $(".check-input").removeClass('input-error');
                $.each(data['message'], function(key, value) {
                    $('#'+key).addClass('input-error');
                    toastr.warning(value);
                })
            }
        }
    });
}

function PasswordRestore() {
    var form = $('#password_restore')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/user/ajax/restore",
        type: "POST",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
                $("#resetpasswordmodal").modal('show');
            } else {
                toastr.options = {
                  "closeButton": true,
                  "positionClass": "toast-bottom-right",
                }
                $(".check-input").removeClass('input-error');
                $.each(data['message'], function(key, value) {
                    $('#'+key).addClass('input-error');
                    toastr.warning(value);
                })
            }
        }
    });
}

function SubmitRestoreCode() {
    var form = $('#restore_code_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/user/ajax/restore/submit",
        type: "POST",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data['status'] == true) {
               
            } else {
                toastr.warning(data['message'][0]);
            }
        }
    });
}

