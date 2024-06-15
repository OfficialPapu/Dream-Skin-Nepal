$('.AddToCart').click(function (e) {
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
        }
    });
});

function handleOptionSelection(selectedOption) {
    $('.SelectedText').html(selectedOption.html().trim());
    $('.option-list').removeClass('selected');
    selectedOption.addClass('selected');
    let ShortType = $(selectedOption).data('shorttype');
    let ProductTypeID = $('.options').data('producttypeid');
    let BrandID = $('.options').data('brandid');
    let FeaturedProduct = $('.options').data('featuredproduct');
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            ShortItem: true,
            ProductTypeID:ProductTypeID,
            BrandID:BrandID,
            FeaturedProduct:FeaturedProduct,
            ShortType: ShortType,
        },
        success: function (response) {
            $('.product-main-container-brands').html(response);
        }
    });
}

$('.option-tag').click(function (e) {
    $(this).toggleClass('active');
});

$('.option-list').click(function (e) {
    let selectedOption = $(this);
    handleOptionSelection(selectedOption);
    currentSelectedIndex = $('.option-list').index(selectedOption);
});


$(document).on('click', '.AddToWishlist-btn', function(e) {
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
