$('.AddToCart').click(function (e) {
    let DeleteElement = $(this).closest('.product-divider-wishlist');
    e.preventDefault();
    let ProductID = $(this).data('product-id');
    let Quantity = 1;
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            AddToCartFromWishlist: true,
            ProductID: ProductID,
            ProductQuantity: Quantity,
        },
        success: function (response) {
              response=response.trim();
            if (response == 'OutOfStock') {
                butterup.toast({
                    message: 'Product Is Out Of Stock!',
                    icon: true,
                    dismissable: true,
                    type: 'error',
                });
            } else {
                $(DeleteElement).slideUp("fast", function () {
                    $(this).remove();
                });
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            }
        }
    });
});
$('.deletefromwishlist').click(function (e) {
    let DeleteElement = $(this).closest('.product-divider-wishlist');
    let ProductID = $(this).data('product-id');
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            DeleteFromWishlist: true,
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
