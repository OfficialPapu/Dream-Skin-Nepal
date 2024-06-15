let menu_btn = document.getElementById('menu-btn');
let menu_and_close_icon = document.getElementsByClassName('menu-and-close-icon')[0];
let close_btn = document.getElementById('close-btn');
let toggle_name = document.getElementsByClassName('toggle-name');
let dropdown_menu_container = document.getElementsByClassName('dropdown-menu-container')[0];
let sub_category_dorpdown_menu = document.getElementsByClassName('sub-category-dorpdown-menu');
let plus_minus_box = document.getElementsByClassName('plus-minus-box');
let screenwidth = window.innerWidth;
let redirect_to_account = document.getElementsByClassName("redirect-to-account");

$('#account-btn-icon').click(function (e) { 
    if (screenwidth > 860) {
        window.location.href = 'Account/UserAccount/My Account.php';
    }
    else {
        window.location.href = 'Assets/Components/Left Navbar.php';
    }   
});

let menu_close_btn_function = () => {
    menu_and_close_icon.classList.toggle("active");
    dropdown_menu_container.classList.toggle("active");
    document.body.classList.toggle("active");
}
menu_btn.addEventListener("click", menu_close_btn_function);
close_btn.addEventListener("click", menu_close_btn_function);

let redirect = () => {
    if (screenwidth > 860) {
        window.location.href = 'Account/UserAccount/My Account.php';
    }
    else {
        window.location.href = 'Assets/Components/Left Navbar.php';
    }
}
let GetCartValue = () => {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            CheckDataLoad: true,
        },
        success: function (response) {
            if (response > 0) {
                $('.cart-number').text(response);
                GetCartValue();
            } else if (response == 0) {
                $('.cart-number').text(0);
                GetCartValue();
            }
        }
    });
}

let GetWishlistValue = () => {
    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/Common Function.php",
        data: {
            WishlistDataLoad: true,
        },
        success: function (response) {
            if (response > 0) {
                $('.wishlist-number').text(response);
                GetWishlistValue();
            } else if (response == 0) {
                $('.wishlist-number').text(0);
                GetWishlistValue();
            }
        }
    });
}


$(document).ready(function () {
    GetCartValue();
    GetWishlistValue();
    $('.dropdown-align').click(function (e) {
        $(this).find('.sub-category-dorpdown-menu').toggleClass('active');
        $(this).find('.plus-minus-box').toggleClass('active');
        $('.sub-category-dorpdown-menu').not($(this).find('.sub-category-dorpdown-menu')).removeClass('active');
        $('.plus-minus-box').not($(this).find('.plus-minus-box')).removeClass('active');
    });
});



