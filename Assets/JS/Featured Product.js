$('.AddToCart-btn').click(function (e) {
    let ClickedElement = $(this);
    e.preventDefault();
    let ProductID = $(this).data('product-id');
    let Quantity = 1;
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
                $(ClickedElement).removeClass('bx-cart').addClass('bx-check');
                butterup.toast({
                    message: 'Successfully Added To The Cart',
                    icon: true,
                    dismissable: true,
                    type: 'success',
                });
            } else if (response == 'NotLoggedIn') {
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
            else {
                butterup.toast({
                    message: 'Something went wrong!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            }
        },
    });
});


$('.AddToWishlist-btn').click(function (e) {
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
            }else if (response == 'NotLoggedIn') {
                window.location.href="Account/Authentication/LoginInterface.php";
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