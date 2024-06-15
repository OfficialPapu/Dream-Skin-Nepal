var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});

$('.AddToCart').click(function (e) {
    let ProductID = $(this).data('product-id');
    let Quantity = $('#quantity').val();
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            AddToCart: true,
            ProductID: ProductID,
            ProductQuantity: Quantity,
        },
        success: function (response) {
            response = response.trim();
            if (response == 'Added') {
                butterup.toast({
                    message: 'Successfully Added To The Cart',
                    icon: true,
                    dismissable: true,
                    type: 'success',
                });
            } 
            else if (response == 'NotLoggedIn') {
                window.location.href="Account/Authentication/LoginInterface.php";
            }else if (response == 'AlreadyExist') {
                butterup.toast({
                    message: 'Product Already Exists In Cart!!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
            else if (response == 'OutOfStock') {
                butterup.toast({
                    message: 'Product Is Out Of Stock!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
            else if (response == 'NotEnoughStock') {
                butterup.toast({
                    message: 'Product is not enough in stock',
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


$('#increase').click(function (e) {
    let CurrentValue = $("#quantity").val();
    CurrentValue++;
    $("#quantity").val(CurrentValue);
});
$('#decrease').click(function (e) {
    let CurrentValue = $("#quantity").val();
    if (CurrentValue > 1) {
        CurrentValue--;
        $("#quantity").val(CurrentValue);
    }
});

$('.AddToWishlistProductDetail').click(function (e) {
    $(this).removeClass('bx-heart').addClass('bxs-heart');
    e.preventDefault();
    let ProductID = $(this).data('product-id');
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
            } else if (response == 'NotLoggedIn') {
                window.location.href="Account/Authentication/LoginInterface.php";
            }else if (response == 'AlreadyExist') {
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

const clipboard = new ClipboardJS('#copy-button');
clipboard.on('success', function(e) {
    showSuccess();
    setTimeout(() => {
        resetToDefault();
    }, 2000);
    e.clearSelection();
});

const showSuccess = () => {
    document.getElementById('default-icon').classList.add('hidden');
    document.getElementById('success-icon').classList.remove('hidden');
}

const resetToDefault = () => {
    document.getElementById('default-icon').classList.remove('hidden');
    document.getElementById('success-icon').classList.add('hidden');
}

$('.ShareBtn').click(function (e) { 
    e.preventDefault();
    $(this).toggleClass('active');
    $('.share-link-box').toggleClass('active');
});

$('.BuyNow').click(function (e) {
    let ProductID = $(this).data('product-id');
    let Quantity = $('#quantity').val();
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            BuyNow: true,
            ProductID: ProductID,
            ProductQuantity: Quantity,
        },
        success: function (response) {
            response = response.trim();
            if (response == 'Success') {
                window.location.href = "Account/UserAccount/Cart.php";
            } else if (response == 'OutOfStock') {
                butterup.toast({
                    message: 'Product Is Out Of Stock!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
            else if (response == 'NotEnoughStock') {
                butterup.toast({
                    message: 'Product is not enough in stock',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
        }
    });
});

