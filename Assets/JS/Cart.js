let plusButtons = document.getElementsByClassName('plusButtons');
let minusButtons = document.getElementsByClassName('minusButtons');
let productQuantities = document.querySelectorAll('.product-quantity');
let product_price = document.querySelectorAll('.product-price');
let product_prices = [];
let updatecartquantitydb;

let productInput = 0, Product_id;
let total_price_to_display = 0, initial_total_price = 0, Shipping_fee = 0;

updatecartquantitydb = (Product_id) => {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            updatecartquantity: true,
            productInput: productInput,
            productid: Product_id,
        },
        success: function (response) {
              response=response.trim();
            if (response == 'OutOfStock') {
                butterup.toast({
                    message: 'Product is not enough in stock!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            } else {
                location.reload();
            }
        }
    });
};


for (let i = 0; i < productQuantities.length; i++) {
    let initialProductPrice = parseInt(productQuantities[i].innerHTML) * parseInt(product_price[i].innerText.replace('Rs. ', ''));
    product_prices.push(initialProductPrice);
    total_price_to_display += parseInt(product_price[i].innerText.replace('Rs. ', ''));
    plusButtons[i].addEventListener("click", () => {
        productInput = parseInt(productQuantities[i].innerHTML);
        productInput++;
        Product_id = document.getElementsByClassName('quantity-increase')[i].getAttribute('data-product-id-plus-minus');
        updatecartquantitydb(Product_id);
    });

    minusButtons[i].addEventListener("click", () => {
        productInput = parseInt(productQuantities[i].innerHTML);

        if (productInput > 1) {
            productInput--;
            Product_id = document.getElementsByClassName('quantity-increase')[i].getAttribute('data-product-id-plus-minus');
            updatecartquantitydb(Product_id);
        }
    });
}
let ShippingFeeAdd = 0;
$('#shippingOptions input[type="checkbox"]').change(function () {
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
                    ShippingFeeChange: true,
                    ShippingFeeChangeing: shippingFee,
                },
                success: function (response) {
                      response=response.trim();
                    let totalPriceText = $('.price.grand-total-price.total').text();
                    let totalPrice = parseInt(totalPriceText.replace('Rs. ', ''));
                    totalPrice += shippingFee - ShippingFeeAdd;
                    ShippingFeeAdd = shippingFee;
                    $('.price.grand-total-price.total').text('Rs. ' + totalPrice);
                },
            });
    }
})



$(document).ready(function () {
    $('.cart-delete-item').click(function (e) {
        let ProductID = $(this).data('product-id');
        let DeleteElement = $(this).closest('.product-divider');
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                DeleteProductIsset: true,
                ProductID: ProductID,
            },
            success: function (response) {
                  response=response.trim();
                $(DeleteElement).slideUp("fast", function () {
                    $(this).remove();
                });
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            }
        });
    });
});

$(document).ready(function () {
    $('.checkout-btn').click(function (e) {
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
    });
});
function CouponCodeShowDate() {
    $('.discount-data, .promo-applied').css({
        'height': 'auto',
        'margin': '0 0 7px 0'
    });
}


$(document).ready(function () {
    let couponbtncount = 0;
    $('#applycode').click(function (e) {
        couponbtncount++;
        e.preventDefault();
        let CouponCode = $('.couponcode').val();
        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                ApplyCoupon: true,
                CouponCode: CouponCode,
            },
            dataType: "json",
            success: function (CouponResponse) {
                if (couponbtncount >= 2) {
                    window.location.reload();
                }
                if (CouponResponse['Message'] === 'Fixed Amount') {
                    CouponCodeShowDate();
                    $('.discount-price').html("- Rs. " + CouponResponse['Discount Amount']);
                    $('.grand-total-price').html("Rs. " + CouponResponse['Amount']);
                    $('.promo-code').html(CouponCode);
                    $('.price.order-total-price.total, .price.grand-total-price.total').html("Rs. " + CouponResponse['Amount']);
                } else if (CouponResponse['Message'] === 'Percentage') {
                    CouponCodeShowDate();
                    $('.promo-code').html(CouponCode);
                    $('.discount-price').html(CouponResponse['Discount Amount'] + "%");
                    $('.grand-total-price').html("Rs. " + CouponResponse['Amount']);
                    $('.price.order-total-price.total, .price.grand-total-price.total').html("Rs. " + CouponResponse['Amount']);
                } else {
                    butterup.options.maxToasts = 2;
                    butterup.toast({
                        message: 'Invalid Coupon code!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }

            }
        });
    });
});

$('.AddToWishlist-1').click(function (e) {
    $(this).removeClass('bx-heart').addClass('bxs-heart');
    e.preventDefault();
    let ProductID = $(this).data('product-id-wishlist');
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            AddToWishlist: true,
            ProductID: ProductID,
        },
        success: function (response) {
              response=response.trim();
            if (response == 'Added') {
                butterup.toast({
                    message: 'Successfully Added To The Wishlist',
                    icon: true,
                    dismissable: true,
                    type: 'success',
                });
            } else if (response == 'AlreadyExist') {
                butterup.toast({
                    message: 'Product Already Exists In Wishlist!!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
            else {
                butterup.toast({
                    message: 'Something went wrong',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
        }
    });
});