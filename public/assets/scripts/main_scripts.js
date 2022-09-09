function SendContact() {
	var form = $('#contact_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/main/ajax/contact",
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
     	      	toastr.success('მოდლობა, შეტყობინებისთვის. ჩვენ მალე გიპასუხებთ.!!!!');
            } else {
                
            }
        }
    });
}

function CheckoutSubmit() {
	var form = $('#checkout_form')[0];
    var data = new FormData(form);

    $.ajax({
        dataType: 'json',
        url: "/main/ajax/checkout",
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
                
            }
        }
    });
}