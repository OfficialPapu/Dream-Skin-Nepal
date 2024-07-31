let FreeShippingConditionPrice = $('#SubTotal').html();
FreeShippingConditionPrice = parseInt(FreeShippingConditionPrice.replace(/Rs. |\.\d{2}/g, ''));

function CheckFreeShipping() {
    if (FreeShippingConditionPrice >= 5000) {
        ShowBox(".FreeShippingBox");
    }
}
CheckFreeShipping();
let ShippingFeeAdd = 0;
$('#shippingOptions input[type="checkbox"]').change(function () {
    if (FreeShippingConditionPrice >= 5000) {
        $('#shippingOptions input[type="checkbox"]').not(this).prop('checked', false);
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                ShippingFeeChange: true,
                ShippingFeeChangeing: 0,
            },
        });
    } else {
        if ($(this).is(':checked')) {
            $('#shippingOptions input[type="checkbox"]').not(this).prop('checked', false);
            let shippingFee = 0;
            switch ($(this).attr('id')) {
                case 'Outside-Valley':
                    shippingFee = 200;
                    break;
                case 'Inside-Valley':
                    shippingFee = 100;
                    break;
                case 'Collect-From-Store':
                    shippingFee = 0;
                    break;
            }
            $.ajax({
                type: "POST",
                url: "Assets/PHP/Configuration/Common Function.php",
                data: {
                    ShippingFeeChangeSet: true,
                    ShippingFeeChangeing: shippingFee,
                },
                success: function (response) {
                    response = response.trim();
                    let GrandTotal = $('#GrandTotal').html();
                    let TotalPrice = parseInt(GrandTotal.replace(/Rs. |\.\d{2}/g, ''));
                    TotalPrice += shippingFee - ShippingFeeAdd;
                    ShippingFeeAdd = shippingFee;
                    $('#GrandTotal').html('Rs. ' + TotalPrice + '.00');
                },
            });
        }
    }
})




$(document).ready(function () {
    $('.checkout-btn').click(function (e) {
        if (FreeShippingConditionPrice >= 5000) {
            window.open("Account/UserAccount/Checkout.php", "_self");
        } else {
            if ($('input[name="Shipping-rate"]:checked').length === 0) {
                butterup.options.maxToasts = 2;
                butterup.toast({
                    message: 'Please Select Shipping Fee!!!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            } else {
                window.open("Account/UserAccount/Checkout.php", "_self");
            }
        }
    });
});

function ShowBox(Element) {
    $(Element).removeClass("hidden");
}
function OverWriteData(Element, Data) {
    $(Element).html(Data);
}

