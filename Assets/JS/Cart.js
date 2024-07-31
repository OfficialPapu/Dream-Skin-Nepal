let FreeShippingConditionPrice = $('#SubTotal').html();
FreeShippingConditionPrice = parseInt(FreeShippingConditionPrice.replace(/Rs. |\.\d{2}/g, ''));
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
            response = response.trim();
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
                    ShippingFeeChange: true,
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
                response = response.trim();
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
    SetNavigationPath();
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

function SucessNotify(title, text, icon) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon
    });
}
function SetNavigationPath(){
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            SetPath:true,
            Path:"CartPath",
        }
    });
}

$(document).ready(function () {
    let couponbtncount = 0;
    $('#applycode').click(function (e) {
        $('#shippingOptions input[type="checkbox"]').not(this).prop('checked', false);
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
                $("#TotalSavedInitial").addClass("hidden");
                ShowBox(".CouponCodeBox");
                ShowBox(".CouponCodeBox");
                ShowBox(".CouponValueBox");
                ShowBox(".TotalSavedBox");
                OverWriteData(".PromoCode", CouponCode);
                if (CouponResponse['Message'] === 'Fixed Amount') {
                    SucessNotify("Coupon Applied Successfully!", "Your discount has been applied.", "success");
                    OverWriteData(".CouponValue", "- Rs. " + CouponResponse['Discount Amount'] + ".00");
                    OverWriteData(".TotalSavedData", "- Rs. " + CouponResponse['Total Saved'] + ".00");
                    OverWriteData("#GrandTotal", "Rs. " + CouponResponse['Amount'] + ".00");
                } else if (CouponResponse['Message'] === 'Percentage') {
                    SucessNotify("Coupon Applied Successfully!", "Your discount has been applied.", "success");
                    OverWriteData(".CouponValue", CouponResponse['Discount Amount'] + "% OFF");
                    OverWriteData("#GrandTotal", "Rs. " + CouponResponse['Amount'] + ".00");
                    let GrandTotal = $('#GrandTotal').html();
                    let SubTotal = $('#SubTotal').html();
                    GrandTotal = parseInt(GrandTotal.replace(/Rs. |\.\d{2}/g, ''));
                    SubTotal = parseInt(SubTotal.replace(/Rs. |\.\d{2}/g, ''));
                    OverWriteData(".TotalSavedData", "- Rs. " + (SubTotal - GrandTotal + CouponResponse['Total Saved Amount']) + ".00");
                } else {
                    SucessNotify("Invalid Coupon code!", "Oops! The coupon code you entered is invalid. Please try again.", "error");
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
            response = response.trim();
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
