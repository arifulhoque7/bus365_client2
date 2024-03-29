$(document).ready(function () {
    $("#pay_method").change(function () {
        var pay_method = $('#pay_method').val();
        if(pay_method==4){
            $('#submit-booking').hide();
            $('#mpesa-pay').show();   
        }else{
            $('#submit-booking').show();
            $('#mpesa-pay').hide();
            $('#login_mobile').prop('readonly', false);
        }
    });
});

//submit-Mpesa on click
$("#mpesa-pay").click(function () {
    var mobile = $('#login_mobile').val();
    var amount = $('#grandtotal').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var id_type = $('#id_type').find(":selected").val();
    var id_number = $('#id_number').val();
   

    if(mobile==''){
        alert('Mpesa Registered Mobile Number is Required');
    }else if(first_name==''){
            alert('First Name is Required');
    }else if(last_name==''){
            alert('Last Name is Required');
    }else if(id_type==''){
            alert('ID Type is Required');
    }else if(id_number==''){
            alert('ID Number is Required');       
    }else{
        $('#login_mobile').prop('readonly', true);
        var $env = $(this),
        $eloaderTarget = $env.parent();
        bdtaskIlmCommonJs.elemLoader.show($eloaderTarget, 20, false);
        var baseurl = $('#baseurl').val();
        var url = baseurl + '/modules/api/v1/paymethods/mpesa/mpesa_pay';

        $.ajax({
            method: "POST",
            url: url,
            data: { 
                phone: mobile, 
                amount: amount
            },
            success: function (data) {
                 alert(data.message);
                if(data.status=='Success'){
                    $('#MpesaModal').modal('show'); 
                    $('#paydetail').val('Checkout Request ID: ' + data.checkout_request_id);
                    setTimeout(function() {
                        validation(data.checkout_request_id,data.transection_id); // Call the function with parameters after a delay
                    }, 30000);
                    
                } 

                bdtaskIlmCommonJs.elemLoader.hide($eloaderTarget, 20, false);
            }

        });

    }
});
function validation(checkout_request_id,transection_id){
    var baseurl = $('#baseurl').val();
    var url = baseurl + '/modules/api/v1/paymethods/mpesa/mpesa-validate';

    $.ajax({
        method: "POST",
        url: url,
        data: { 
            checkout_request_id: checkout_request_id,
            transection_id:transection_id 
        },
        success: function (data) {
                if(data.status=='Success'){
                    $('#mpesaMsg').text('Payment Successfully Done by User');
                    $('#submit-booking').show();
                    $('#mpesa-pay').hide();
                    $('#createbooking').submit();
                }else{
                    $('#mpesaMsg').text(data.message?data.message:data.message.errorMessage);
                }
                setTimeout(function() {
                    $('#MpesaModal').modal('hide');
                }, 20000);
        }

    });
}