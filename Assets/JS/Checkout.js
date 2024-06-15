let showAddress = document.getElementsByClassName('select-address')[0];
let userMainBox = document.getElementsByClassName('cart-page-container')[0];
let addCloseBtn = document.getElementsByClassName('add-close-btn')[0];
let overlay = document.getElementsByClassName('overlay')[0];
let body = document.body;

showAddress.addEventListener("click", () => {
    userMainBox.classList.add("active");
    body.classList.add("no-scroll");
});

addCloseBtn.addEventListener("click", () => {
    userMainBox.classList.remove("active");
    body.classList.remove("no-scroll");
});

overlay.addEventListener("click", () => {
    userMainBox.classList.remove("active");
    body.classList.remove("no-scroll");
});



$('.cod').click(function (e) {
    $('.cod img').css("border", "2px solid blue");
    $('.e-sewa img').css("border", "2px solid gray");
    $('.check-icon-1').css("visibility", "visible");
    $('.check-icon-2').css("visibility", "hidden");
});
$('.e-sewa').click(function (e) {
    $('.e-sewa img').css("border", "2px solid blue");
    $('.cod img').css("border", "2px solid gray");
    $('.check-icon-1').css("visibility", "hidden");
    $('.check-icon-2').css("visibility", "visible");
});



$('.checkout-btn').click(function (e) {
    e.preventDefault();
    let DataCheck = $('.check-data-filled').val();
    if (DataCheck == '') {
        $('.select-address').css('border', '2px dashed red')
        butterup.options.maxToasts = 2;
        butterup.toast({
            message: 'Address Is Required!!',
            icon: true,
            dismissable: true,
            type: 'error',
        });
    }
    else {
        let paymentMethod = '';
        if ($('.cod img').css("border-color") === "rgb(0, 0, 255)") {
            paymentMethod = 'Cash on Delivery';
        } else if ($('.e-sewa img').css("border-color") === "rgb(0, 0, 255)") {
            paymentMethod = 'E-Sewa';
        }

        if (paymentMethod === 'Cash on Delivery') {
            $.ajax({
                type: "POST",
                url: "Checkout.php",
                data: {
                    PaymentMethod: "Cash on Delivery",
                },
            });
            window.location.href = 'Account/UserAccount/Cash On Delivery.php?PaymentInfo';

        } else if (paymentMethod === 'E-Sewa') {
            $.ajax({
                type: "POST",
                url: "Checkout.php",
                data: {
                    PaymentMethod: "E-Sewa",
                },
            });
            window.location.href = 'Account/UserAccount/Upload Payment Screenshot.php';
        }
        else {
            $('.payment-method-error').css("visibility", "initial");
            setTimeout(() => {
                $('.payment-method-error').css("visibility", "hidden");
            }, 2000);
            $('.e-sewa img').css("border", "2px solid red");
            $('.cod img').css("border", "2px solid red");
        }
    }

});



$(document).ready(function () {
    $('.data-submit-btn').click(function (e) {
        e.preventDefault();
        let user_name_data = $('.user-name-data').val();
        let user_number_data = $('.user-number-data').val();
        let user_city_data = $('.user-city-data').val();
        let user_address_data = $('.user-address-data').val();

        if (user_name_data != '' && user_number_data != '' && user_city_data != '' && user_address_data != '') {
            $.ajax({
                type: "POST",
                url: "",
                data: {
                    'check': true,
                    'user_name_data': user_name_data,
                    'user_number_data': user_number_data,
                    'user_city_data': user_city_data,
                    'user_address_data': user_address_data,
                },
                success: function (response) {
                    userMainBox.classList.remove("active");
                    body.classList.remove("no-scroll");
                    location.reload();
                }
            });

        } else {

            if (user_name_data == '') {
                $('.user-name-data').css({
                    "background": "white",
                    "border": "1px solid red",
                });
                setTimeout(() => {
                    $('.user-name-data').css({
                        "background": " rgba(189, 189, 189, 0.2)",
                        "border": "",
                    });
                }, 1000);
            }

            if (user_number_data == '') {
                $('.user-number-data').css({
                    "background": "white",
                    "border": "1px solid red",
                });
                setTimeout(() => {
                    $('.user-number-data').css({
                        "background": " rgba(189, 189, 189, 0.2)",
                        "border": "",
                    });
                }, 1000);
            }

            if (user_city_data == '') {
                $('.user-city-data').css({
                    "background": "white",
                    "border": "1px solid red",
                });
                setTimeout(() => {
                    $('.user-city-data').css({
                        "background": " rgba(189, 189, 189, 0.2)",
                        "border": "",
                    });
                }, 1000);
            }
            if (user_address_data == '') {
                $('.user-address-data').css({
                    "background": "white",
                    "border": "1px solid red",
                });
                setTimeout(() => {
                    $('.user-address-data').css({
                        "background": " rgba(189, 189, 189, 0.2)",
                        "border": "",
                    });
                }, 1000);
            }


        }

    });
});




// Check if scroll position is stored in sessionStorage
const scrollPosition = sessionStorage.getItem('scrollPosition');

if (scrollPosition) {
    // If scroll position is found, scroll to that position
    window.scrollTo(0, parseInt(scrollPosition));
}

// Save scroll position when the user scrolls
window.addEventListener('scroll', function () {
    const currentScroll = window.scrollY;
    sessionStorage.setItem('scrollPosition', currentScroll.toString());
});

// Clear scroll position when navigating away from the page
window.addEventListener('beforeunload', function () {
    sessionStorage.removeItem('scrollPosition');
});